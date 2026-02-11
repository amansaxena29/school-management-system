<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use App\Models\MarksheetExtra;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class PublicResultController extends Controller
{
    private function resolveSession($result): string
    {
        // If Result table has session column
        if (!empty($result->session)) {
            return (string) $result->session;
        }

        // If year is numeric like 2026 -> "2025-2026"
        if (is_numeric($result->year ?? null)) {
            $y = (int) $result->year;
            return ($y - 1) . '-' . $y;
        }

        // fallback
        return '2025-2026';
    }

    private function schoolObject()
    {
        return (object) [
            'name' => 'Arya Public Academy',
            'address' => 'Kusmara, Jalaun, 205304',
            'phone' => '8127515044',
            'website' => 'www.aryapublicacademy.com',
            'city' => 'Kusmara',
        ];
    }

    public function index()
    {
        return view('public.result');
    }

    public function show(Request $request)
    {
        $request->validate([
            'class' => 'required',
            'roll_no' => 'required',
        ]);

        $student = Student::where('class', $request->class)
            ->where('roll_no', $request->roll_no)
            ->first();

        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        $result = Result::where('student_id', $student->id)
            ->where('is_published', true)
            ->latest()
            ->with('subjects')
            ->first();

        if (!$result) {
            return back()->with('error', 'Result not published yet.');
        }

        $school = $this->schoolObject();
        $session = $this->resolveSession($result);

        // ✅ Fetch saved extra fields (attendance/promoted/remarks/discipline)
        $extra = MarksheetExtra::where('student_id', $student->id)
            ->where('class', (string)$student->class)
            ->where('session', $session)
            ->first();

        // If your public.result page shows any of these fields, pass extra too
        return view('public.result', compact('student', 'result', 'school', 'extra'));
    }

    public function download(Request $request)
{
    $request->validate([
        'class' => 'required',
        'roll_no' => 'required',
    ]);

    $student = Student::where('class', $request->class)
        ->where('roll_no', $request->roll_no)
        ->first();

    if (!$student) {
        return back()->with('error', 'Student not found.');
    }

    $result = Result::where('student_id', $student->id)
        ->where('is_published', true)
        ->latest()
        ->with('subjects')
        ->first();

    if (!$result) {
        return back()->with('error', 'Result not published yet.');
    }

    $school = (object) [
        'name' => 'Arya Public Academy',
        'address' => 'Kusmara, Jalaun, 205304',
        'phone' => '8127515044',
        'website' => 'www.aryapublicacademy.com',
        'city' => 'Kusmara',
    ];

    // session same rule as marksheet
    $year = $result->year;
    $session = is_numeric($year) ? ((int)$year - 1) . '-' . (int)$year : '2025-2026';

    $extra = \App\Models\MarksheetExtra::where('student_id', $student->id)
        ->where('class', (string)$student->class)
        ->where('session', $session)
        ->first();

    // ✅ use SAME PDF view as admin marksheet
    $pdf = Pdf::loadView('marksheets.result_pdf', compact('student', 'result', 'school', 'extra'))
        ->setPaper('A4', 'portrait');

    $studentName = $student->name ?: 'Student';
    $cleanName = \Illuminate\Support\Str::slug($studentName, '_');
    $fileName = "{$cleanName}_Class-{$student->class}_Roll-{$student->roll_no}.pdf";

    return $pdf->download($fileName);
}

}
