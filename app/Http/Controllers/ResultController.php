<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ResultSubjectMark;
use App\Models\Student;
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
            'exam_name' => 'required',
            'year' => 'required',
            'subjects' => 'required|array',
            'subjects.*.name' => 'required|string',
            'subjects.*.marks' => 'required|integer|min:0',
            'subjects.*.max' => 'required|integer|min:1',
        ]);

        $studentId = $request->student_id;

        $result = Result::updateOrCreate(
            [
                'student_id' => $studentId,
                'exam_name' => $request->exam_name,
                'year' => $request->year,
            ],
            [
                'is_published' => $request->boolean('is_published'),
            ]
        );

        // Clear old subjects then re-add (simple + reliable)
        ResultSubjectMark::where('result_id', $result->id)->delete();

        $total = 0;
        $maxTotal = 0;

        foreach ($request->subjects as $s) {
            $total += (int)$s['marks'];
            $maxTotal += (int)$s['max'];

            ResultSubjectMark::create([
                'result_id' => $result->id,
                'subject' => $s['name'],
                'marks' => (int)$s['marks'],
                'max_marks' => (int)$s['max'],
            ]);
        }

        $percentage = $maxTotal > 0 ? round(($total / $maxTotal) * 100, 2) : 0;

        $result->update([
            'total_marks' => $total,
            'max_marks' => $maxTotal,
            'percentage' => $percentage,
            'status' => $percentage >= 33 ? 'Pass' : 'Fail',
        ]);

        return redirect()
            ->route('results.index')
            ->with('success', 'Result saved and updated successfully!');
    }
}
