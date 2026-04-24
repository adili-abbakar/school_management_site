<?php

namespace App\Http\Controllers;

use App\Models\Academic\AcademicClass;
use App\Models\Academic\ClassArm;
use App\Models\Academic\Session;
use App\Models\StudentApplication;
use App\Models\Users\Guardian;
use App\Models\Users\Student;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

                $guardian = Guardian::where('relationship', $application->guardian_relationship)
                    ->whereHas('user', function ($q) use ($application) {
                        $q->where(function ($qq) use ($application) {
                            if ($application->guardian_phone) {
                                $qq->where('phone', $application->guardian_phone);
                            }

                            if ($application->guardian_email) {
                                $qq->orWhere('email', $application->guardian_email);
                            }

                            $qq->orWhere(function ($q2) use ($application) {
                                $q2->where('first_name', $application->guardian_first_name)
                                    ->where('middle_name', $application->guardian_middle_name)
                                    ->where('last_name', $application->guardian_last_name)
                                    ->where('date_of_birth', $application->guardian_date_of_birth);
                            });
                        });
                    })
                    ->first();

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
                        'type' => 'guardian',
                        'password' => bcrypt(str()->random(12)),
                    ]);

                    $guardian = Guardian::create([
                        'user_id' => $guardianUser->id,
                        'occupation' => $application->guardian_occupation,
                        'relationship' => $application->guardian_relationship,
                    ]);
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
                    'type' => 'student',
                    'password' => bcrypt(str()->random(12)),
                ]);

                $classArm = ClassArm::resolveClassArmForApplication($application);

                Student::create([
                    'user_id' => $studentUser->id,
                    'admission_number' => Student::generateAdmissionNumber(),
                    'current_class_arm_id' => $classArm?->id,
                    'guardian_id' => $guardian->user_id,
                    'current_status' => 'active',
                    'admission_date' => now()->toDateString(),
                ]);

                $application->status = 'approved';
                $application->save();
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
        return view('application.create', compact('classes'));
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
            'class_id' => 'required|exists:classes,id',


            'guardian_relationship' => 'required|in:father,mother,brother,sister,grandfather,grandmother,uncle,aunt,other',
        ];


        $messages = [
            'class_id.required' => 'Class to apply for is required',
        ];
        $class = AcademicClass::find($request->class_id);
        if ($class) {
            $class_rules = [];
            $class_message = [];
            if ($class->level === 'sss') {
                $class_rules = [
                    'stream' => 'required|in:science,arts'
                ];
                $class_message = [
                    'stream.in' => 'Only Science or Arts is allowed for SS classes.'
                ];
            } else {
                $class_rules = [
                    'stream' => 'required|in:general'
                ];
                $class_message = [
                    'stream.in' => 'Only General stream is allowed for Nursery, Primary and JSS classes.',
                ];
            }
            $rules = array_merge($rules, $class_rules);
            $messages = array_merge($messages, $class_message);
        }
        if (!auth()->check()) {
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
        }


        $validated = Validator::make($request->all(), $rules, $messages)->validate();

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
            $validated['session_id'] = $session->id;
            $validated['application_number']  = StudentApplication::generateApplicationNumber($session->id);
            if (auth()->check()) {
                $validated['submitted_by_user_id'] = auth()->user()->id;
            }

            $app = StudentApplication::create($validated);

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
}
