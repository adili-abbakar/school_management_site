<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Users\StudentController;
use App\Models\Academic\AcademicClass;
use App\Models\Academic\Session;
use App\Models\StudentApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = StudentApplication::latest()->get();

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

    public function approve(StudentApplication $application)
    {
        if ($application->status === 'approved') {
            return back()->with('info', 'Application already approved.');
        }

        $application->update(['status' => 'approved']);

        return back()->with('success', 'Application approved successfully.');
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
        $validated = $request->validate([
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

            // GUARDIAN DATA
            'guardian_first_name' => 'required|string|max:255',
            'guardian_middle_name' => 'required|string|max:255',
            'guardian_last_name' => 'nullable|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'guardian_email' => 'required|email|unique:users,email',
            'guardian_date_of_birth' => 'required|date',
            'guardian_gender' => 'required|in:male,female',
            'guardian_nationality' => 'required|string|max:100',
            'guardian_state' => 'required|string|max:100',
            'guardian_local_government' => 'required|string|max:100',
            'guardian_religion' => 'required|string|max:100',
            'guardian_tribe' => 'required|string|max:100',
            'guardian_address' => 'required|string|max:2055',
            'guardian_occupation' =>  'required|string|max:100',
            'guardian_relationship' => 'required|in:father,mother,brother,sister,grandfather,grandmother,uncle,aunt,other',
            'previous_school_name' => 'nullable|string',
            'last_class_attended' => 'nullable|string',
            'class_id' => 'required'

        ], [
            'class_id.required' => 'Class to apply for is required'
        ]);



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

            StudentApplication::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Application submitted successfully',
                'redirect' => redirect()
                    ->intended(route('home'))
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
