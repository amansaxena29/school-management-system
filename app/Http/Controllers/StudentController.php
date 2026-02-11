<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Str;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();
        return view('students.index', compact('students'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'class' => 'required|numeric',
        'roll_no' => 'required|string|max:50',
        'phone' => 'required|string|max:20',

        'father_name' => 'nullable|string|max:255',
        'mother_name' => 'nullable|string|max:255',

        // dob must be a valid date
        'dob' => 'required|date',

        'address' => 'nullable|string|max:1000',
        'religion' => 'nullable|string|max:100',
        'citizenship' => 'nullable|string|max:100',

        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:512',
    ]);

    $data = $request->only([
        'name',
        'class',
        'roll_no',
        'phone',
        'father_name',
        'mother_name',
        'dob',              // ✅ IMPORTANT (YOU MISSED THIS)
        'address',
        'religion',
        'citizenship',
    ]);

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');

        $dir = public_path('uploads/students');
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        $data['photo_path'] = 'uploads/students/' . $filename;
    }

    Student::create($data);

    return redirect()
        ->route('students.class', $request->class)
        ->with('success', 'Student added successfully');
}






    public function destroy(Student $student)
    {
        $student->delete();
        return back();
    }

    public function edit($id)
{
    // Find the student by id
    $student = \App\Models\Student::findOrFail($id);

    // Return the edit view with the student data
    return view('students.edit', compact('student'));
}


public function update(Request $request, Student $student)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'class' => 'required|string|max:50',
        'roll_no' => 'required|string|max:50',
        'phone' => 'nullable|string|max:20',
        'father_name' => 'nullable|string|max:255',
        'mother_name' => 'nullable|string|max:255',
        'religion' => 'nullable|string|max:100',
        'citizenship' => 'nullable|string|max:100',
        'address' => 'nullable|string|max:2000',
    ]);

    // Optional: prevent duplicate roll number in same class (recommended)
    $exists = Student::where('class', $data['class'])
        ->where('roll_no', $data['roll_no'])
        ->where('id', '!=', $student->id)
        ->exists();

    if ($exists) {
        return back()
            ->withErrors(['roll_no' => 'This roll number already exists in this class.'])
            ->withInput();
    }

    // Save
    $student->update($data);

    return redirect()
        ->route('students.class', $student->class)
        ->with('success', 'Student updated successfully.');
}

        public function create()
    {
        $classes = range(1, 12);
        return view('students.create', compact('classes'));
    }


    public function classWise($class)
    {
        $students = Student::where('class', $class)
            ->orderBy('roll_no')
            ->get();

        return view('students.class', compact('students', 'class'));
    }




}
