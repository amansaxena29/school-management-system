<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;

class FeeController extends Controller
{
    // Show all fees
   public function index(Request $request)
{
    $search = $request->get('search'); // from input box

    $feesQuery = Fee::query()->orderBy('class');

    if (!empty($search)) {
        $feesQuery->where('student_name', 'like', '%' . $search . '%');
        // If you also want class search, uncomment below:
        // $feesQuery->orWhere('class', 'like', '%' . $search . '%');
    }

    $fees = $feesQuery->simplePaginate(10)->appends(['search' => $search]);

    return view('fees.index', compact('fees', 'search'));
}



    // Show form to add fee
    public function create(Request $request)
{
    $selectedClass = $request->get('class'); // class selected from dropdown
    return view('fees.create', compact('selectedClass'));
}


    // Store fee
    public function store(Request $request) {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|integer|between:1,12',
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,paid',
        ]);

        Fee::create($request->all());
        return redirect()->route('fees.index')->with('success', 'Fee added successfully!');
    }

    // Edit fee
    public function edit(Fee $fee) {
        return view('fees.edit', compact('fee'));
    }

    // Update fee
    public function update(Request $request, Fee $fee) {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class' => 'required|integer|between:1,12',
            'amount' => 'required|numeric',
            'status' => 'required|in:pending,paid',
        ]);

        $fee->update($request->all());
        return redirect()->route('fees.index')->with('success', 'Fee updated successfully!');
    }

    // Delete fee
    public function destroy(Fee $fee) {
        $fee->delete();
        return redirect()->route('fees.index')->with('success', 'Fee details deleted successfully!');
    }

    public function classWise($class)
{
    $fees = \App\Models\Fee::where('class', $class)->get();

    return view('fees.class', compact('fees', 'class'));
}

public function storeClassWise(Request $request, $class)
{
    $request->validate([
        'student_name' => 'required',
        'father_name'=>'required', 
        'amount' => 'required|numeric',
        'status' => 'required'
    ]);

    Fee::create([
        'class' => $class,
        'student_name' => $request->student_name,
        'father_name'  => $request->father_name,
        'amount' => $request->amount,
        'status' => $request->status
    ]);

    return redirect()
        ->route('fees.class', $class)
        ->with('success', 'Fees added successfully');
}

    public function editStatus(Fee $fee)
{
    return view('fees.edit-status', compact('fee'));
}

// update status
public function updateStatus(Request $request, Fee $fee)
{
    $request->validate([
        'status' => 'required'
    ]);

    $fee->update([
        'status' => $request->status
    ]);

    return redirect()
        ->back()
        ->with('success', 'Fee status updated successfully');
}

}
