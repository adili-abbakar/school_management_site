<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use App\Models\Users\Student;
use App\Models\Users\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->latest()->take(10)->get();
        $teachersCount = Teacher::count();
        $studentsCount = Student::where(['current_status' => 'active'])->count();
        $recentApplications = StudentApplication::where(['status' => 'pending'])->count();
        return view('dashboard.index', compact('students', 'teachersCount', 'studentsCount', 'recentApplications'));
    }
    public function profile()
    {
        return view('dashboard.profile');
    }
    public function settings()
    {
        return view('dashboard.settings');
    }
}
