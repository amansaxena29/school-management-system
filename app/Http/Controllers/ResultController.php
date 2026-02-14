<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ResultSubjectMark;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    // Admin page
    public function index()
    {
        return view('results.index');
    }

    // Find student + show form
    public function create(Request $request)
    {
        $request->validate([
            'class' => 'required',
            'roll_no' => 'required',
        ]);

        $student = Student::where('class', $request->class)
            ->where('roll_no', $request->roll_no)
            ->first();

        if (!$student) {
            return back()->with('error', 'Student not found for this class and roll number.');
        }

        $result = Result::where('student_id', $student->id)
            ->where('exam_name', $request->exam_name ?? 'Final')
            ->where('year', $request->year ?? date('Y'))
            ->with('subjects')
            ->first();

        return view('results.create', compact('student', 'result'));
    }

    // Save/Update result
    public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'exam_name' => 'required|string|max:50',
        'year' => 'required|string|max:20',
        'subjects' => 'required|array|min:1',
        'subjects.*.name' => 'required|string|max:100',
        'subjects.*.marks' => 'required|integer|min:0',
        'subjects.*.max' => 'required|integer|min:1',
        'subjects.*.grade' => 'nullable|string|max:10', // ✅
    ]);

    $studentId = $request->student_id;

    $result = Result::updateOrCreate(
        [
            'student_id' => $studentId,
            'exam_name'  => $request->exam_name,
            'year'       => $request->year,
        ],
        [
            'is_published' => $request->boolean('is_published'),
        ]
    );

    ResultSubjectMark::where('result_id', $result->id)->delete();

    $total = 0;
    $maxTotal = 0;

    foreach ($request->subjects as $s) {
        $m = (int)$s['marks'];
        $mx = (int)$s['max'];

        $total += $m;
        $maxTotal += $mx;

        ResultSubjectMark::create([
            'result_id'  => $result->id,
            'subject'    => $s['name'],
            'marks'      => $m,
            'max_marks'  => $mx,
            'grade'      => $s['grade'] ?? null, // ✅
        ]);
    }

    $percentage = $maxTotal > 0 ? round(($total / $maxTotal) * 100, 2) : 0;

    $result->update([
        'total_marks' => $total,
        'max_marks'   => $maxTotal,
        'percentage'  => $percentage,
        'status'      => $percentage >= 33 ? 'Pass' : 'Fail',
    ]);

    return redirect()
        ->route('results.index')
        ->with('success', 'Result saved and updated successfully!');
}

}
