<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;
use App\Models\Student;

class FeeController extends Controller
{
    /**
     * GET /fees
     * Show 12 class cards
     */
    public function index()
    {
        return view('fees.index');
    }

    /**
     * GET /fees/class/{class}
     * Show all students of a class with fee summary
     */
    public function classWise($class)
    {
        $students = Student::where('class', $class)
            ->orderBy('roll_no')
            ->get();

        $feesMap = Fee::whereIn('student_id', $students->pluck('id'))
            ->get()
            ->keyBy('student_id');

        return view('fees.class', compact('class', 'students', 'feesMap'));
    }

    /**
     * GET /fees/class/{class}/student/{student}
     * Show individual student fee page with 5 installments
     */
    public function studentFee($class, $studentId)
    {
        $student = Student::where('id', $studentId)
            ->where('class', $class)
            ->firstOrFail();

        $fee = Fee::firstOrCreate(
            ['student_id' => $student->id],
            [
                'class'        => $class,
                'inst1_status' => 'pending',
                'inst2_status' => 'pending',
                'inst3_status' => 'pending',
                'inst4_status' => 'pending',
                'inst5_status' => 'pending',
            ]
        );

        return view('fees.student', compact('student', 'fee', 'class'));
    }

    /**
     * POST /fees/class/{class}/student/{student}/update
     * Save all 5 installments
     */
    public function updateStudentFee(Request $request, $class, $studentId)
    {
        $student = Student::where('id', $studentId)
            ->where('class', $class)
            ->firstOrFail();

        $request->validate([
            'inst1_amount' => 'nullable|numeric|min:0',
            'inst1_date'   => 'nullable|date',
            'inst1_status' => 'required|in:paid,pending',
            'inst2_amount' => 'nullable|numeric|min:0',
            'inst2_date'   => 'nullable|date',
            'inst2_status' => 'required|in:paid,pending',
            'inst3_amount' => 'nullable|numeric|min:0',
            'inst3_date'   => 'nullable|date',
            'inst3_status' => 'required|in:paid,pending',
            'inst4_amount' => 'nullable|numeric|min:0',
            'inst4_date'   => 'nullable|date',
            'inst4_status' => 'required|in:paid,pending',
            'inst5_amount' => 'nullable|numeric|min:0',
            'inst5_date'   => 'nullable|date',
            'inst5_status' => 'required|in:paid,pending',
        ]);

        Fee::updateOrCreate(
            ['student_id' => $student->id],
            [
                'class'        => $class,
                'inst1_amount' => $request->inst1_amount ?: null,
                'inst1_date'   => $request->inst1_date ?: null,
                'inst1_status' => $request->inst1_status,
                'inst2_amount' => $request->inst2_amount ?: null,
                'inst2_date'   => $request->inst2_date ?: null,
                'inst2_status' => $request->inst2_status,
                'inst3_amount' => $request->inst3_amount ?: null,
                'inst3_date'   => $request->inst3_date ?: null,
                'inst3_status' => $request->inst3_status,
                'inst4_amount' => $request->inst4_amount ?: null,
                'inst4_date'   => $request->inst4_date ?: null,
                'inst4_status' => $request->inst4_status,
                'inst5_amount' => $request->inst5_amount ?: null,
                'inst5_date'   => $request->inst5_date ?: null,
                'inst5_status' => $request->inst5_status,
            ]
        );

        return redirect()
            ->route('fees.student', ['class' => $class, 'student' => $studentId])
            ->with('success', 'Fees updated successfully for ' . $student->name);
    }

    // ── Resource methods (required by Route::resource) ──────────

    public function create()
    {
        // Redirect to index — we no longer use this
        return redirect()->route('fees.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('fees.index');
    }

    public function show($id)
    {
        return redirect()->route('fees.index');
    }

    public function edit($id)
    {
        return redirect()->route('fees.index');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('fees.index');
    }

    public function destroy($id)
    {
        $fee = Fee::findOrFail($id);
        $fee->delete();
        return redirect()->route('fees.index')->with('success', 'Fee record deleted.');
    }

    // ── Old custom routes (kept so nothing breaks) ───────────────

    public function storeClassWise(Request $request, $class)
    {
        return redirect()->route('fees.class', $class);
    }

    public function editStatus(Fee $fee)
    {
        return redirect()->route('fees.index');
    }

    public function updateStatus(Request $request, Fee $fee)
    {
        return redirect()->route('fees.index');
    }
}
