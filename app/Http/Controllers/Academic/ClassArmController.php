<?php

namespace App\Http\Controllers\Academic;

use App\Models\Academic\ClassArm as Arm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ClassArmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Arm $class_arm)
    {
        return view('academic.classes.show', [
            'arm' => $class_arm
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Arm $arm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Arm $arm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Arm $class_arm)
    {
        try {
            $class_arm->delete();
            $class_arm->class()->touch();


            return response()->json([
                'status' => 'success',
                'message' => 'Class Arm deleted successfully',
                'redirect' => redirect()
                    ->intended(route('sessions.index'))
                    ->with('success', 'Class Arm deleted successfully!')
                    ->getTargetUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Something went wrong: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function delete(Arm $class_arm)
    {
        $title = 'class arm';
        $data = $class_arm->load('class');
        $route = route('class-arms.destroy', $class_arm);

        $messages = [
            "This class arm will be deactivated. Its records will be hidden but can be restored later.",
            "All associated data and records will be reversibly removed from the system. They can be restored later if needed."
        ];
        return view('academic.classes.soft-delete', compact('data', 'title', 'route', 'messages'));
    }

}
