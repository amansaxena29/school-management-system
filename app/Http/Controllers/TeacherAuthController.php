<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Attendance;

class TeacherAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        if (Auth::guard('teacher')->check()) {
            return redirect()->route('teacher.dashboard');
        }
        return view('teacher.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->has('remember');

        if (Auth::guard('teacher')->attempt($credentials, $remember)) {
            return redirect()->route('teacher.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput($request->only('email'));
    }

    // Show dashboard
    public function dashboard()
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.dashboard', compact('teacher'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('teacher.login');
    }

    // ===================== ATTENDANCE =====================

    // STEP 1: Show class & date selection
    public function attendanceIndex()
    {
        $classes = range(1, 12);
        return view('teacher.attendance.index', compact('classes'));
    }

    // STEP 2: Show students for marking
    public function attendanceShow(Request $request)
    {
        $request->validate([
            'class' => 'required|numeric',
            'date'  => 'required|date',
        ]);

        $class = $request->class;
        $date  = $request->date;

        $students = Student::where('class', $class)
                    ->orderBy('roll_no')
                    ->get();

        $attendance = Attendance::where('date', $date)
                      ->get()->keyBy('student_id');

        return view('teacher.attendance.mark', compact(
            'students', 'class', 'date', 'attendance'
        ));
    }

    // STEP 3: Save attendance
    public function attendanceStore(Request $request)
    {
        foreach ($request->attendance as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'date'       => $request->date,
                ],
                ['status' => $status]
            );
        }

        return redirect()->route('teacher.attendance')
               ->with('success', 'Attendance saved successfully');
    }

    // STEP 4: View attendance form
    public function attendanceViewForm()
    {
        $classes = range(1, 12);
        return view('teacher.attendance.view', compact('classes'));
    }

    // STEP 5: Show attendance result
    public function attendanceView(Request $request)
    {
        $request->validate([
            'class' => 'required|numeric',
            'date'  => 'required|date',
        ]);

        $class = $request->class;
        $date  = $request->date;
        $today = now()->toDateString();
        $canEdit = (strtotime($today) - strtotime($date)) <= 3 * 86400;
        $classes = range(1, 12);

        $attendanceRecords = Attendance::join('students', 'students.id', '=', 'attendances.student_id')
            ->where('students.class', $class)
            ->where('attendances.date', $date)
            ->orderBy('students.roll_no')
            ->select(
                'students.name',
                'students.roll_no',
                'attendances.status',
                'attendances.id'
            )
            ->get();

        return view('teacher.attendance.view', compact(
            'attendanceRecords', 'class', 'date', 'classes', 'canEdit'
        ));
    }

    // STEP 6: Edit single attendance
    public function attendanceEdit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $today = now()->toDateString();
        $canEdit = (strtotime($today) - strtotime($attendance->date)) <= 3 * 86400;

        if (!$canEdit) {
            return redirect()->route('teacher.attendance.viewForm')
                ->with('error', 'Attendance cannot be edited after 3 days.');
        }

        return view('teacher.attendance.edit', compact('attendance'));
    }

    // STEP 7: Update single attendance
    public function attendanceUpdate(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->status = $request->status;
        $attendance->save();

        return redirect()->route('teacher.attendance.viewForm')
            ->with('success', 'Attendance updated successfully!');
    }
}
