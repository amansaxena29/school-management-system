<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    private array $allowed = ['Half Yearly', 'Annual'];

    private function normalizeType(string $type): string
    {
        $type = trim(str_replace('-', ' ', $type));
        $type = ucwords(strtolower($type));
        if ($type === 'Halfyearly') $type = 'Half Yearly';
        return $type;
    }

    private function ensureAllowed(string $type): void
    {
        if (!in_array($type, $this->allowed, true)) {
            abort(404);
        }
    }

    public function index()
    {
        return view('examinations.index');
    }

    public function classes($type)
    {
        $type = $this->normalizeType($type);
        $this->ensureAllowed($type);

        $classes = Student::query()
            ->select('class')
            ->distinct()
            ->orderByRaw("CAST(class AS UNSIGNED), class")
            ->pluck('class');

        return view('examinations.classes', compact('type', 'classes'));
    }

    public function students($type, $class, Request $request)
{
    $type = $this->normalizeType($type);
    $this->ensureAllowed($type);

    $year = $request->get('year', date('Y'));

    $students = Student::where('class', $class)
        ->orderByRaw("CAST(roll_no AS UNSIGNED), roll_no")
        ->get();

    // Fetch results for these students for this exam + year
    $resultMap = Result::whereIn('student_id', $students->pluck('id'))
        ->where('exam_name', $type)
        ->where('year', $year)
        ->get()
        ->keyBy('student_id');

    return view('examinations.students', compact('type', 'class', 'students', 'year', 'resultMap'));
}


    public function entry($type, $class, Student $student, Request $request)
    {
        $type = $this->normalizeType($type);
        $this->ensureAllowed($type);

        if ((string)$student->class !== (string)$class) {
            return back()->with('error', 'Student does not belong to this class.');
        }

        $year = $request->get('year', date('Y'));

        $result = Result::where('student_id', $student->id)
            ->where('exam_name', $type)
            ->where('year', $year)
            ->with('subjects')
            ->first();

        // subject template (optional auto preload)
        $template = ClassSubject::where('class', (string)$class)
            ->where('exam_type', $type)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('examinations.entry', compact('type', 'class', 'student', 'result', 'year', 'template'));
    }

    // Optional: manage subject template per class/exam
    public function editSubjects($type, $class)
    {
        $type = $this->normalizeType($type);
        $this->ensureAllowed($type);

        $subjects = ClassSubject::where('class', (string)$class)
            ->where('exam_type', $type)
            ->orderBy('sort_order')
            ->get();

        return view('examinations.subjects', compact('type', 'class', 'subjects'));
    }

    public function saveSubjects($type, $class, Request $request)
    {
        $type = $this->normalizeType($type);
        $this->ensureAllowed($type);

        $data = $request->validate([
            'subjects' => 'nullable|array',
            'subjects.*.subject' => 'required_with:subjects|string|max:100',
            'subjects.*.max_marks' => 'required_with:subjects|integer|min:1|max:1000',
        ]);

        ClassSubject::where('class', (string)$class)->where('exam_type', $type)->delete();

        $rows = $data['subjects'] ?? [];
        foreach ($rows as $i => $row) {
            ClassSubject::create([
                'class'      => (string)$class,
                'exam_type'  => $type,
                'subject'    => $row['subject'],
                'max_marks'  => (int)$row['max_marks'],
                'sort_order' => $i,
                'is_active'  => true,
            ]);
        }

        return redirect()
            ->route('exams.students', [$type, $class])
            ->with('success', 'Subjects saved for Class ' . $class . ' (' . $type . ')');
    }
}
