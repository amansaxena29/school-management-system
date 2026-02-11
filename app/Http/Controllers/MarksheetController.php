<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Result;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MarksheetExtra;

class MarksheetController extends Controller
{
    // 1) List all classes (from students table)
    public function index()
    {
        $classes = Student::query()
            ->select('class')
            ->distinct()
            ->orderByRaw("CAST(class AS UNSIGNED), class")
            ->pluck('class');

        return view('marksheets.index', compact('classes'));
    }

    // 2) List students of a class
    public function classWise($class)
    {
        $students = Student::where('class', $class)
            ->orderByRaw("CAST(roll_no AS UNSIGNED), roll_no")
            ->get();

        return view('marksheets.class', compact('class', 'students'));
    }

    // Helper: build session string from result year (2026 => 2025-2026)
    private function makeSessionFromResult(?Result $result): string
    {
        $year = $result?->year;

        if (is_numeric($year)) {
            $y = (int) $year;
            return ($y - 1) . '-' . $y;
        }

        // fallback (keep your existing default)
        return '2025-2026';
    }

    // 3) Edit extra fields
    public function editExtra(Student $student, $class)
    {
        // Always bind extras to the latest published result session (so it matches PDF)
        $result = Result::where('student_id', $student->id)
            ->where('is_published', true)
            ->latest()
            ->first();

        $session = $this->makeSessionFromResult($result);

        $extra = MarksheetExtra::where('student_id', $student->id)
            ->where('class', (string)$class)
            ->where('session', $session)
            ->first();

        return view('marksheets.edit-extra', compact('student', 'class', 'session', 'extra'));
    }

    // 4) Save extra fields
    public function saveExtra(Request $request, Student $student, $class)
    {
        // match session to latest published result (same logic as edit/pdf)
        $result = Result::where('student_id', $student->id)
            ->where('is_published', true)
            ->latest()
            ->first();

        $session = $this->makeSessionFromResult($result);

        $data = $request->validate([
            'attendance' => 'nullable|string|max:50',
            'promoted_to_class' => 'nullable|string|max:50',
            'class_teacher_remarks' => 'nullable|string|max:2000',
            'discipline_term1' => 'nullable|string|max:50',
            'discipline_term2' => 'nullable|string|max:50',
            'art_education_term1' => 'nullable|string|max:50',
            'art_education_term2' => 'nullable|string|max:50',
            'general_awareness_term1' => 'nullable|string|max:50',
            'general_awareness_term2' => 'nullable|string|max:50',
            'health_physical_term1' => 'nullable|string|max:50',
            'health_physical_term2' => 'nullable|string|max:50',
        ]);

        MarksheetExtra::updateOrCreate(
            [
                'student_id' => $student->id,
                'class'      => (string)$class,
                'session'    => $session,
            ],
            $data
        );

        return redirect()
            ->route('marksheets.class', $class)
            ->with('success', 'Extra marksheet details saved.');
    }

    // 5) Generate PDF (THIS is the only PDF logic to use everywhere)
    public function generatePdf(Student $student, $class, Request $request)
    {
        // Optional filters (if you want to pass exam_name/year later)
        $examName = $request->get('exam_name');
        $year     = $request->get('year');

        $resultQuery = Result::where('student_id', $student->id)
            ->where('is_published', true)
            ->with('subjects')
            ->latest();

        if (!empty($examName)) $resultQuery->where('exam_name', $examName);
        if (!empty($year))     $resultQuery->where('year', $year);

        $result = $resultQuery->first();

        if (!$result) {
            return back()->with('error', 'No published result found for this student.');
        }

        $session = $this->makeSessionFromResult($result);

        $extra = MarksheetExtra::where('student_id', $student->id)
            ->where('class', (string)$class)
            ->where('session', $session)
            ->first();

        // School object (same as public)
        $school = (object) [
            'name'    => 'Arya Public Academy',
            'address' => 'Kusmara, Jalaun, 205304',
            'phone'   => '8127515044',
            'website' => 'www.aryapublicacademy.com',
            'city'    => 'Kusmara',
        ];

        // ✅ Use ONLY your updated PDF view
        $pdf = Pdf::loadView('marksheets.result_pdf', [
            'student' => $student,
            'result'  => $result,
            'school'  => $school,
            'extra'   => $extra,
        ])->setPaper('A4', 'portrait');

        $fileName = ($student->name ?? 'Student') . "_Class-{$student->class}_Roll-{$student->roll_no}.pdf";
        $fileName = preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $fileName);

        return $pdf->download($fileName);
    }

    // Backward compatibility (if any old route/button still hits marksheets.generate with only {student})
    public function generate(Student $student, Request $request)
    {
        return $this->generatePdf($student, $student->class, $request);
    }
}
