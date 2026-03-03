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

    // ===================== EXAMINATIONS =====================

public function examIndex()
{
    return view('teacher.exams.index');
}

public function examClasses($type)
{
    $classes = range(1, 12);
    return view('teacher.exams.classes', compact('type', 'classes'));
}

public function examStudents($type, $class)
{
    $year = request('year', date('Y'));

    $students = \App\Models\Student::where('class', $class)
                ->orderBy('roll_no')->get();

    $results = \App\Models\Result::where('exam_name', $type)
               ->where('year', $year)
               ->whereIn('student_id', $students->pluck('id'))
               ->get()->keyBy('student_id');

    $resultMap = $results;

    return view('teacher.exams.students', compact(
        'type', 'class', 'students', 'resultMap', 'year'
    ));
}

public function examEntry($type, $class, $studentId)
{
    $student = \App\Models\Student::findOrFail($studentId);
    $year    = request('year', date('Y'));

    $result = \App\Models\Result::where('student_id', $studentId)
              ->where('exam_name', $type)
              ->where('year', $year)
              ->first();

    $template = collect();

    return view('teacher.exams.entry', compact(
        'type', 'class', 'student', 'result', 'year', 'template'
    ));
}

    public function examStore(\Illuminate\Http\Request $request)
    {
        $studentId = $request->student_id;
        $examName  = $request->exam_name;
        $year      = $request->year;

        $result = \App\Models\Result::updateOrCreate(
            [
                'student_id' => $studentId,
                'exam_name'  => $examName,
                'year'       => $year,
            ],
            [
                'is_published' => $request->has('is_published') ? 1 : 0,
            ]
        );

        // Delete old subjects and re-insert
        $result->subjects()->delete();

        $total    = 0;
        $maxTotal = 0;

        if ($request->subjects) {
            foreach ($request->subjects as $sub) {
                if (!empty($sub['name'])) {
                    $marks    = (int)($sub['marks'] ?? 0);
                    $maxMarks = (int)($sub['max'] ?? 100);

                    $total    += $marks;
                    $maxTotal += $maxMarks;

                    $result->subjects()->create([
                        'subject'   => $sub['name'],
                        'marks'     => $marks,
                        'max_marks' => $maxMarks,
                        'grade'     => $sub['grade'] ?? null,
                    ]);
                }
            }
        }

        // ✅ Calculate and save percentage + status
        $percentage = $maxTotal > 0 ? round(($total / $maxTotal) * 100, 2) : 0;

        $result->update([
            'total_marks' => $total,
            'max_marks'   => $maxTotal,
            'percentage'  => $percentage,
            'status'      => $percentage >= 33 ? 'Pass' : 'Fail',
        ]);

        return redirect()
            ->route('teacher.exams.students', [$examName, $request->input('class', 1)])
            ->with('success', 'Marks saved successfully!');
    }
}
