<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;


class AttendanceController extends Controller
{
    // STEP 1: Show class & date selection
    public function index()
{
    $classes = range(1, 12);
    return view('attendance.index', compact('classes'));
}



    // STEP 2: Show students class-wise
    public function show(Request $request)
    {
        $request->validate([
            'class' => 'required|numeric',
            'date'  => 'required|date'
        ]);

        $class = $request->class;
        $date  = $request->date;

        $students = Student::where('class', $class)
                    ->orderBy('roll_no')
                    ->get();

        $attendance = Attendance::where('date', $date)->get()->keyBy('student_id');

        return view('attendance.mark', compact(
            'students',
            'class',
            'date',
            'attendance'
        ));
    }

    // STEP 3: Save / Update attendance
    public function store(Request $request)
    {
        foreach ($request->attendance as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'date' => $request->date
                ],
                [
                    'status' => $status
                ]
            );
        }

        return redirect('/attendance')
               ->with('success', 'Attendance saved successfully');
    }


    // STEP 4: View Attendance Form
public function viewForm()
{
    $classes = range(1, 12);
    return view('attendance.view', compact('classes'));
}


// STEP 5: Show Attendance Result
public function viewAttendance(Request $request)
{
    $request->validate([
        'class' => 'required|numeric',
        'date'  => 'required|date'
    ]);

    $class = $request->class;
    $date  = $request->date;

    // Get today's date
    $today = now()->toDateString();

    // Check if attendance date is more than 3 days ago
    $canEdit = (strtotime($today) - strtotime($date)) <= 3 * 86400; // 3 days in seconds

    // SAME classes list (needed again for blade)
    $classes = range(1, 12);

    $attendanceRecords = Attendance::join('students', 'students.id', '=', 'attendances.student_id')
        ->where('students.class', $class)
        ->where('attendances.date', $date)
        ->orderBy('students.roll_no')
        ->select(
            'students.name',
            'students.roll_no',
            'attendances.status',
            'attendances.id' // Add the attendance record id for editing
        )
        ->get();

    return view('attendance.view', compact(
        'attendanceRecords',
        'class',
        'date',
        'classes',
        'canEdit' // Pass the canEdit flag to the view
    ));
}

public function editAttendance($id)
{
    $attendance = Attendance::findOrFail($id);

    // Check if the date is within 3 days
    $today = now()->toDateString();
    $canEdit = (strtotime($today) - strtotime($attendance->date)) <= 3 * 86400;

    if (!$canEdit) {
        return redirect()->route('attendance.view')
            ->with('error', 'Attendance cannot be edited after 3 days.');
    }

    return view('attendance.edit', compact('attendance'));
}

public function updateAttendance(Request $request, $id)
{
    $attendance = Attendance::findOrFail($id);
    $attendance->status = $request->status;
    $attendance->save();

    return redirect()->route('attendance.view', ['class' => $attendance->class_id, 'date' => $attendance->date])
        ->with('success', 'Attendance updated successfully!');
}












}
