<?php

namespace App\Http\Controllers;

use App\Models\Academic\AcademicClass;
use App\Models\Academic\ClassArm;
use App\Models\Academic\Program;
use App\Models\Academic\Session;
use App\Models\Academic\StudentProgramEnrollment;
use App\Models\Academic\StudentSessionRecord;
use App\Models\Academic\StudentTermRecord;
use App\Models\Academic\Term;
use App\Models\ApplicationProgram;
use App\Models\StudentApplication;
use App\Models\Users\Guardian;
use App\Models\Users\Student;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search', ''));
        $searchNoSpace = str_replace(' ', '', $search);
        $applications = StudentApplication::when($search, function ($query) use ($search, $searchNoSpace) {
            $query->where(function ($q) use ($search, $searchNoSpace) {

                $q->where('student_first_name', 'like', "%{$search}%")
                    ->orWhere('student_middle_name', 'like', "%{$search}%")
                    ->orWhere('student_last_name', 'like', "%{$search}%")
                    ->orWhere('guardian_first_name', 'like', "%{$search}%")
                    ->orWhere('guardian_middle_name', 'like', "%{$search}%")
                    ->orWhere('guardian_last_name', 'like', "%{$search}%")
                    ->orWhere('guardian_phone', 'like', "%{$search}%")
                    ->orWhere('guardian_email', 'like', "%{$search}%");

                $q->orWhereRaw(
                    "CONCAT(student_first_name, ' ', COALESCE(student_middle_name,''), ' ', student_last_name) LIKE ?",
                    ["%{$search}%"]
                );

                $q->orWhereRaw(
                    "REPLACE(CONCAT(student_first_name, COALESCE(student_middle_name,''), student_last_name), ' ', '') LIKE ?",
                    ["%{$searchNoSpace}%"]
                );

                $q->orWhereRaw(
                    "CONCAT(guardian_first_name, ' ', COALESCE(guardian_middle_name,''), ' ', guardian_last_name) LIKE ?",
                    ["%{$search}%"]
                );

                $q->orWhereRaw(
                    "REPLACE(CONCAT(guardian_first_name, COALESCE(guardian_middle_name,''), guardian_last_name), ' ', '') LIKE ?",
                    ["%{$searchNoSpace}%"]
                );

                $q->orWhereHas('class', function ($classQuery) use ($search, $searchNoSpace) {
                    $classQuery->where('name', 'like', "%{$search}%")
                        ->orWhereRaw(
                            "REPLACE(name, ' ', '') LIKE ?",
                            ["%{$searchNoSpace}%"]
                        );
                });
            });
        })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('application.partials.rows', compact('applications'))->render(),
                'pagination' => view('application.partials.pagination', compact('applications'))->render(),
            ]);
        }

        $coutns = StudentApplication::selectRaw("
            SUM(CASE WHEN status = 'pending' THEN  1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = 'approved' THEN  1 ELSE 0 END) as approved,
            SUM(CASE WHEN status = 'rejected' THEN  1 ELSE 0 END) as rejected,
            SUM(CASE WHEN status = 'withdrawn' THEN  1 ELSE 0 END) as withdrawn
        ")->first();

        return view(
            'application.index',
            [
                'applications' => $applications,
                'pending_coutn' => $coutns->pending,
                'approved_coutn' => $coutns->approved,
                'rejected_coutn' => $coutns->rejected,
                'withdrawn_coutn' => $coutns->withdrawn,
            ]
        );
    }

    public function trackShow(StudentApplication $application)
    {
        return view('application.track-show', compact('application'));
    }

    public function trackSearchForm()
    {
        return view('application.track-search');
    }

    public function trackSearch(Request $request)
    {
        $validated = $request->validate([
            'application_number' => ['required', 'string'],
            'guardian_email' => ['required', 'email'],
        ]);

        try {

            $application = StudentApplication::where('application_number', $validated['application_number'])
                ->where(function ($query) use ($validated) {
                    $query->where('guardian_email',     $validated['guardian_email'])
                        ->orWhereHas('submittedBy', function ($q) use ($validated) {
                            $q->where('email', $validated['guardian_email']);
                        });
                })->first();

            if (!$application) {
                return response()->json(
                    [
                        'status' => 'field-error',
                        'message' => 'No application was found with the provided application number and email address.'
                    ]
                );
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Application tracked successfully',
                'redirect' => redirect()
                    ->intended(route('applications.track.show', $application))
                    ->with('success', 'Application tracked successfully!')
                    ->getTargetUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }

    public function approve(StudentApplication $application)
    {
        if ($application->status === 'approved') {
            return back()->with('info', 'Application already approved.');
        }

        try {
            DB::transaction(function () use ($application) {
                $guardian = null;
                if ($application->submitted_by_user_id) {
                    $guardian = Guardian::firstOrCreate(
                        ['user_id' => $application->submitted_by_user_id],
                        ['occupation' => $application->guardian_occupation ?? null]
                    );
                } else {
                    $guardian = Guardian::whereHas('user', function ($query) use ($application) {
                        $query->where('email', $application->guardian_email);
                    })->first();


                    if (!$guardian) {
                        $guardianUser = User::create([
                            'first_name' => $application->guardian_first_name,
                            'middle_name' => $application->guardian_middle_name,
                            'last_name' => $application->guardian_last_name,
                            'email' => $application->guardian_email,
                            'phone' => $application->guardian_phone,
                            'date_of_birth' => $application->guardian_date_of_birth,
                            'gender' => $application->guardian_gender,
                            'nationality' => $application->guardian_nationality,
                            'state' => $application->guardian_state,
                            'local_government' => $application->guardian_local_government,
                            'religion' => $application->guardian_religion,
                            'tribe' => $application->guardian_tribe,
                            'address' => $application->guardian_address,
                            'password' => bcrypt(str()->random(12)),
                        ]);

                        $guardian = Guardian::create([
                            'user_id' => $guardianUser->id,
                            'occupation' => $application->guardian_occupation,
                        ]);
                    }
                }



                $studentUser = User::create([
                    'first_name' => $application->student_first_name,
                    'middle_name' => $application->student_middle_name,
                    'last_name' => $application->student_last_name,
                    'date_of_birth' => $application->student_date_of_birth,
                    'gender' => $application->student_gender,
                    'nationality' => $application->student_nationality,
                    'state' => $application->student_state,
                    'local_government' => $application->student_local_government,
                    'religion' => $application->student_religion,
                    'tribe' => $application->student_tribe,
                    'address' => $application->student_address,
                    'password' => bcrypt(str()->random(12)),

                ]);


                $classArm = ClassArm::resolveClassArmForApplication($application);
                $student = Student::create([
                    'user_id' => $studentUser->id,
                    'admission_number' => Student::generateAdmissionNumber(),
                    'current_class_arm_id' => $classArm?->id,
                    'guardian_user_id' => $guardian->user_id,
                    'guardian_relationship' => $application->guardian_relationship,
                ]);
                $studentUser->update(['password' => bcrypt($student->admission_number)]);
                $application->update(['status' => 'approved']);
            });

            return back()->with('success', 'Application approved successfully.');
        } catch (\Throwable $e) {
            report($e);
            return back()->with('failure', 'Application approval failed: ' . $e->getMessage());
        }
    }

    public function reject(StudentApplication $application)
    {
        if ($application->status === 'rejected') {
            return back()->with('info', 'Application already rejected.');
        }

        $application->update(['status' => 'rejected']);

        return back()->with('success', 'Application rejected successfully.');
    }

    public function withdraw(StudentApplication $application)
    {
        if ($application->status === 'withdrawn') {
            return back()->with('info', 'Application already withdrawn.');
        }

        $application->update(['status' => 'withdrawn']);

        return back()->with('success', 'Application withdrawn successfully.');
    }

    // Auth user applications
    public function mine(Request $request)
    {
        $auth = Auth::user();
        $search = trim($request->get('search', ''));
        $searchNoSpace = str_replace(' ', '', $search);
        $applications = StudentApplication::when($search, function ($query) use ($search, $searchNoSpace) {
            $query->where(function ($q) use ($search, $searchNoSpace) {
                $q->where('student_first_name', 'like', "%{$search}%")
                    ->orWhere('student_middle_name', 'like', "%{$search}%")
                    ->orWhere('student_last_name', 'like', "%{$search}%")
                    ->orWhere('guardian_first_name', 'like', "%{$search}%")
                    ->orWhere('guardian_middle_name', 'like', "%{$search}%")
                    ->orWhere('guardian_last_name', 'like', "%{$search}%")
                    ->orWhere('guardian_phone', 'like', "%{$search}%")
                    ->orWhere('guardian_email', 'like', "%{$search}%");

                $q->orWhereRaw(
                    "CONCAT(student_first_name, ' ', COALESCE(student_middle_name,''), ' ', student_last_name) LIKE ?",
                    ["%{$search}%"]
                );

                $q->orWhereRaw(
                    "REPLACE(CONCAT(student_first_name, COALESCE(student_middle_name,''), student_last_name), ' ', '') LIKE ?",
                    ["%{$searchNoSpace}%"]
                );

                $q->orWhereRaw(
                    "CONCAT(guardian_first_name, ' ', COALESCE(guardian_middle_name,''), ' ', guardian_last_name) LIKE ?",
                    ["%{$search}%"]
                );

                $q->orWhereRaw(
                    "REPLACE(CONCAT(guardian_first_name, COALESCE(guardian_middle_name,''), guardian_last_name), ' ', '') LIKE ?",
                    ["%{$searchNoSpace}%"]
                );

                $q->orWhereHas('class', function ($classQuery) use ($search, $searchNoSpace) {
                    $classQuery->where('name', 'like', "%{$search}%")
                        ->orWhereRaw(
                            "REPLACE(name, ' ', '') LIKE ?",
                            ["%{$searchNoSpace}%"]
                        );
                });
            });
        })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('application.partials.rows', compact('applications'))->render(),
                'pagination' => view('application.partials.pagination', compact('applications'))->render(),
            ]);
        }

        $coutns = StudentApplication::selectRaw("
            SUM(CASE WHEN status = 'pending' THEN  1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = 'approved' THEN  1 ELSE 0 END) as approved,
            SUM(CASE WHEN status = 'rejected' THEN  1 ELSE 0 END) as rejected,
            SUM(CASE WHEN status = 'withdrawn' THEN  1 ELSE 0 END) as withdrawn
        ")->first();

        return view(
            'application.index',
            [
                'applications' => $applications,
                'pending_coutn' => $coutns->pending,
                'approved_coutn' => $coutns->approved,
                'rejected_coutn' => $coutns->rejected,
                'withdrawn_coutn' => $coutns->withdrawn,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = AcademicClass::orderdChain()->flatten();
        $programs = Program::orderBy('name')->get();
        return view('application.create', compact('classes', 'programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules =  [
            // STUDENT DATA
            'student_first_name' => 'required|string|max:255',
            'student_middle_name' => 'required|string|max:255',
            'student_last_name' => 'nullable|string|max:255',
            'student_date_of_birth' => 'required|date',
            'student_gender' => 'required|in:male,female',
            'student_nationality' => 'required|string|max:100',
            'student_state' => 'required|string|max:100',
            'student_local_government' => 'required|string|max:100',
            'student_religion' => 'required|string|max:100',
            'student_tribe' => 'required|string|max:100',
            'student_address' => 'required|string|max:2055',


            'previous_school_name' => 'nullable|string',
            'last_class_attended' => 'nullable|string',
            'stream' => 'nullable',

            'programs.*.program_id' => 'required|exists:programs,id',
            'programs.*.requested_class' => 'required|exists:classes,id',


            'guardian_relationship' => 'required|in:father,mother,brother,sister,grandfather,grandmother,uncle,aunt,other',
        ];

        $messages = [
            'programs.required' => 'You must choose atleats one program',
            'programs.*.requested_class.required' =>            'You must select a class to apply for',
        ];

        if (!Auth::check()) {
            $rules =  array_merge($rules, [
                // GUARDIAN DATA
                'guardian_first_name' => 'required|string|max:255',
                'guardian_middle_name' => 'required|string|max:255',
                'guardian_last_name' => 'nullable|string|max:255',
                'guardian_phone' => 'required|string|max:20',
                'guardian_email' => 'required|email|unique:users,email',
                'guardian_date_of_birth' => 'date',
                'guardian_gender' => 'required|in:male,female',
                'guardian_nationality' => 'required|string|max:100',
                'guardian_state' => 'required|string|max:100',
                'guardian_local_government' => 'required|string|max:100',
                'guardian_religion' => 'required|string|max:100',
                'guardian_tribe' => 'required|string|max:100',
                'guardian_address' => 'required|string|max:2055',
                'guardian_occupation' =>  'required|string|max:100',
            ],);

            $messages = array_merge($messages, [
                'guardian_email.unique' => 'An account already exists with this guardian email address. Please sign in using that account to submit an admission application'
            ]);
        }

        $validated = Validator::make($request->all(), $rules, $messages)->validate();
        $selectedPrograms = collect($request->programs ?? [])
            ->filter(fn($program) => !empty($program['program_id'] ?? null));

        if ($selectedPrograms->isEmpty()) {
            return response()->json([
                'status' => 'field-error',
                'message' => 'You must choose at least one program.'
            ]);
        }

        $session = Session::currentSession();
        if (!$session) {
            return response()->json(
                [
                    'status' => 'field-error',
                    'message' => 'No active academic session was found. Contact school management.'
                ]
            );
        }
        try {
            $app = DB::transaction(function () use ($validated, $session) {

                $validated['session_id'] = $session->id;
                $validated['application_number'] = StudentApplication::generateApplicationNumber();

                if (Auth::check()) {
                    $validated['submitted_by_user_id'] = Auth::id();
                }

                $app = StudentApplication::create($validated);

                foreach ($validated['programs'] as $program) {
                    ApplicationProgram::create([
                        'student_application_id' => $app->id,
                        'program_id' => $program['program_id'],
                        'requested_class_id' => $program['requested_class'],
                    ]);
                }

                return $app;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Application submitted successfully',
                'redirect' => redirect()
                    ->intended(route('applications.track.show', $app->id))
                    ->with('success', 'Application submitted successfully!')
                    ->getTargetUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentApplication $application)
    {
        if ($application->status === 'pending') {
            $application->update([
                'status' => 'processing'
            ]);
        }
        return view('application.show', [
            'app' => $application
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function decisionShow(StudentApplication $application)
    {
        if ($application->status === 'pending') {
            $application->update([
                'status' => 'processing'
            ]);
        }
        return view('application.decision-show', ['app' => $application]);
    }

    public function decisionMake(StudentApplication $application, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,awaiting_guardian_response',
            'decision_date' => 'required|date',
            'remarks' => 'nullable',

            'programs.*.id' => 'required|exists:application_programs,id',
            'programs.*.program_id' => 'required|exists:programs,id',
            'programs.*.requested_class_id' => "required|exists:classes,id",
            'programs.*.approved_class_id' => "required|exists:classes,id",
            'programs.*.status' => "required|in:approved,rejected,awaiting_guardian_response",
            'programs.*.approved_stream' => "nullable|exists:class_arms,id",
            'programs.*.remarks' => 'nullable',

        ], [
            'programs.*.approved_class_id.required' => 'Please select the approved class.',
            'programs.*.approved_class_id.exists' => 'The selected approved class is invalid.',

            'programs.*.status.required' => 'Please choose a decision for each program.',
            'programs.*.status.in' => 'The selected decision must be either Approved or Rejected.',

            'programs.*.approved_stream.exists' => 'The selected class stream is invalid.',
        ]);

        try {
            DB::transaction(function () use ($application, $validated) {
                $currentSession = Session::currentSession();
                if (empty($validated['remarks'])) {
                    if ($validated['status'] === 'approved') {
                        $validated['remarks'] = 'Congratulations! Your admission application has been approved.';
                    } elseif ($validated['status'] === 'rejected') {
                        $validated['remarks'] = 'We regret to inform you that your admission application was not approved. Thank you for your interest in our institution.';
                    } elseif ($validated['status'] === 'awaiting_guardian_response') {
                        $validated['remarks'] = 'Your application is awaiting your guardian\'s response before the admission process can continue.';
                    } else {
                        $validated['remarks'] = 'Your admission application is currently under review. You will be notified once there is an update.';
                    }
                }

                $application->update([
                    'status' => $validated['status'],
                    'decision_date' => $validated['decision_date'],
                    'decision_by' => Auth::id(),
                    'remarks' => $validated['remarks'],
                ]);


                $submittedProgrmas = (collect($validated['programs']));
                $nonRequestedClassesApproved = [];

                foreach ($submittedProgrmas as $program) {
                    if (
                        $program['status'] === 'approved' &&
                        $program['requested_class_id'] != $program['approved_class_id']
                    ) {
                        $nonRequestedClassesApproved[] = $program['id'];
                    }
                    if (!empty($program['id'])) {
                        if (empty($program['remarks'])) {
                            $program['remarks'] = $program['status'] === 'approved'
                                ? 'Your program has been approved.'
                                : 'Your program has been rejected.';
                        }
                        switch ($program['remarks']) {
                            case 'approved':
                                $program['remarks'] = 'Congratulations! Your application for this program has been approved.';
                                break;

                            case 'rejected':
                                $program['remarks'] = 'We regret to inform you that your application for this program was not approved.';
                                break;

                            case 'awaiting_guardian_response':
                                $program['remarks'] = 'The selected program could not be approved at this time. Your application is currently awaiting your guardian\'s response before further processing.';
                                break;

                            default:
                                $program['remarks'] = 'Your application is currently under review. You will be notified once there is an update.';
                                break;
                        }
                        $existingProgram = $application
                            ->programs()
                            ->findOrFail($program['id']);

                        $status = $program['status'];

                        if (
                            $status === 'approved' &&
                            $program['requested_class_id'] != $program['approved_class_id']
                        ) {
                            $status = 'awaiting_guardian_response';
                        }

                        $existingProgram->update([
                            'approved_class_id' => $program['approved_class_id'],
                            'status' => $status,
                            'remarks' => $program['remarks']
                        ]);
                    }
                }

                if (empty($nonRequestedClassesApproved)) {
                    if ($validated['status'] === 'approved') {
                        $guardian = null;
                        if ($application->submitted_by_user_id) {
                            $guardian = Guardian::firstOrCreate(
                                ['user_id' => $application->submitted_by_user_id],
                                ['occupation' => $application->guardian_occupation ?? null]
                            );
                        } else {
                            $guardian = Guardian::whereHas('user', function ($query) use ($application) {
                                $query->where('email', $application->guardian_email);
                            })->first();


                            if (!$guardian) {
                                $guardianUser = User::create([
                                    'first_name' => $application->guardian_first_name,
                                    'middle_name' => $application->guardian_middle_name,
                                    'last_name' => $application->guardian_last_name,
                                    'email' => $application->guardian_email,
                                    'phone' => $application->guardian_phone,
                                    'date_of_birth' => $application->guardian_date_of_birth,
                                    'gender' => $application->guardian_gender,
                                    'nationality' => $application->guardian_nationality,
                                    'state' => $application->guardian_state,
                                    'local_government' => $application->guardian_local_government,
                                    'religion' => $application->guardian_religion,
                                    'tribe' => $application->guardian_tribe,
                                    'address' => $application->guardian_address,
                                    'password' => bcrypt(str()->random(12)),
                                ]);

                                $guardian = Guardian::create([
                                    'user_id' => $guardianUser->id,
                                    'occupation' => $application->guardian_occupation,
                                ]);
                            }
                        }



                        $studentUser = User::create([
                            'first_name' => $application->student_first_name,
                            'middle_name' => $application->student_middle_name,
                            'last_name' => $application->student_last_name,
                            'date_of_birth' => $application->student_date_of_birth,
                            'gender' => $application->student_gender,
                            'nationality' => $application->student_nationality,
                            'state' => $application->student_state,
                            'local_government' => $application->student_local_government,
                            'religion' => $application->student_religion,
                            'tribe' => $application->student_tribe,
                            'address' => $application->student_address,
                            'password' => bcrypt(str()->random(12)),
                        ]);

                        $student = Student::create([
                            'user_id' => $studentUser->id,
                            'admission_number' => Student::generateAdmissionNumber(),
                            'guardian_user_id' => $guardian->user_id,
                            'guardian_relationship' => $application->guardian_relationship,
                        ]);
                        $studentUser->update(['password' => bcrypt($student->admission_number)]);
                        $application->update(['status' => 'approved']);

                        $approvedPrograms = collect($validated['programs'])
                            ->where('status', 'approved');
                        foreach ($approvedPrograms as $program) {
                            $enrolledProgram = StudentProgramEnrollment::create([
                                'student_id' => $student->user_id,
                                'program_id' => $program['program_id'],
                                'application_program_id' => $program['id'],
                                'admission_date' => now(),
                                'status' => 'active',
                            ]);


                            if (!empty($program['approved_stream'])) {
                                $classArm = ClassArm::find($program['approved_stream']);
                            } else {
                                $classArm = ClassArm::resolveClassArmForApplicationProgram($program['approved_class_id']);
                            }

                            $studentSessionRecord = StudentSessionRecord::create([
                                'student_program_enrollment_id' => $enrolledProgram->id,
                                'session_id' => $currentSession->id,
                                'class_id' => $program['approved_class_id'],
                                'class_arm_id' => $classArm->id,
                                'status' => 'active',
                                'started_at' => now(),
                            ]);

                            StudentTermRecord::create([
                                'student_session_record_id' => $studentSessionRecord->id,
                                'term_id' => Term::currentTerm()->id,
                                'started_at' => now(),
                            ]);
                        }
                    }
                } else {
                    $application->update([
                        'status' => 'awaiting_guardian_response'
                    ]);
                }
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Application decided successfully',
                'redirect' => redirect()
                    ->intended(route('applications.show', $application->id))
                    ->with('success', 'Application decided successfully!')
                    ->getTargetUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Something went wrong: " . $e->getMessage()
            ]);
        }
    }
}
