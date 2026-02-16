<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Validation\Rule;


class TeacherController extends Controller
{
    public function index()
    {
       $teachers = \App\Models\Teacher::orderBy('name', 'asc')->get();
        return view('teachers.index', compact('teachers'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|numeric|min:0',
            'phone' => 'required|digits:10',
            'doj' => 'nullable|date',
            'email' => 'nullable|email|unique:teachers,email',
        ]);

        Teacher::create([
            'name' => $request->name,
            'subject' => $request->subject,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'phone' => $request->phone,
            'doj' => $request->doj,
            'email' => $request->email,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');
    }



    public function destroy(\App\Models\Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.list')->with('success', 'Teacher deleted successfully!');
    }

    public function list()
    {
        $teachers = \App\Models\Teacher::orderBy('name', 'asc')->get(); // adjust if your column differs
        return view('teachers.list', compact('teachers'));
    }

    public function edit(\App\Models\Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|numeric|min:0',
            'phone' => 'required|string|max:20',
            'doj' => 'nullable|date', // ✅ DOJ (not dob)
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('teachers', 'email')->ignore($teacher->id),
            ],
        ]);

        $teacher->update([
            'name' => $request->name,
            'subject' => $request->subject,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'phone' => $request->phone,
            'doj' => $request->doj,   // ✅ save DOJ
            'email' => $request->email,
        ]);

        return redirect()->route('teachers.list')->with('success', 'Details updated successfully!');
    }

}
