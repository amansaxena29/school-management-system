<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        // $students = Student::latest()->get();
       $students = Student::orderBy('created_at', 'asc')->get();
        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'roll_no' => 'required|string|max:50',
            'phone' => 'required|string|max:20',

            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',

            'dob' => 'required|date',

            'address' => 'nullable|string|max:1000',
            'religion' => 'nullable|string|max:100',
            'citizenship' => 'nullable|string|max:100',

            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:512',
        ]);

        $data = $request->only([
            'name',
            'class',
            'roll_no',
            'phone',
            'father_name',
            'mother_name',
            'dob',
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
        $student = Student::findOrFail($id);
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

        // ✅ allow photo update
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:512',
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

    // ✅ Photo upload handling
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');

        $dir = public_path('uploads/students');
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        // delete old photo (optional but recommended)
        if (!empty($student->photo_path)) {
            $old = public_path($student->photo_path);
            if (file_exists($old)) {
                @unlink($old);
            }
        }

        $filename = time() . '_' . \Illuminate\Support\Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $filename);

        $data['photo_path'] = 'uploads/students/' . $filename;
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

    // ✅ UPDATED: Class-wise list with pagination + search
    public function classWise(Request $request, $class)
    {
        $q = trim((string) $request->get('q', '')); // search query

        $students = Student::where('class', $class)
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('name', 'like', "%{$q}%")
                        ->orWhere('roll_no', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%")
                        ->orWhere('father_name', 'like', "%{$q}%")
                        ->orWhere('mother_name', 'like', "%{$q}%")
                        ->orWhere('religion', 'like', "%{$q}%")
                        ->orWhere('citizenship', 'like', "%{$q}%")
                        ->orWhere('address', 'like', "%{$q}%");
                });
            })
            ->orderByRaw("CAST(roll_no AS UNSIGNED) ASC, roll_no ASC")
            ->paginate(4)          // ✅ set per-page here
            ->withQueryString();    // ✅ keeps ?q= when paging

        return view('students.class', compact('students', 'class', 'q'));
    }
}
