@extends('layouts.app')

@section('content')
<div style="max-width:900px;margin:0 auto;padding:20px;">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
        <div>
            <h2 style="margin:0;">Edit Marksheet Fields</h2>
            <p style="margin:6px 0 0 0;color:#475569;">
                {{ $student->name }} (Roll: {{ $student->roll_no }}) | Class: {{ $class }} | Session: {{ $session }}
            </p>
        </div>
        <a href="{{ route('marksheets.class', $class) }}"
           style="background:#0f172a;color:#fff;padding:10px 14px;border-radius:12px;text-decoration:none;font-weight:600;">
           ← Back
        </a>
    </div>

    @if ($errors->any())
        <div style="margin-top:14px;padding:12px;border-radius:12px;background:#fee2e2;border:1px solid #fecaca;">
            <b>Please fix the following:</b>
            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('marksheets.extra.save', [$student->id, $class]) }}"
          style="margin-top:16px;background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:16px;">
        @csrf

        <div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;">

            <div>
                <label style="font-weight:600;">Attendance</label>
                <input name="attendance" value="{{ old('attendance', $extra->attendance ?? '-') }}"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">
            </div>

            <div>
                <label style="font-weight:600;">Promoted To Class</label>
                <input name="promoted_to_class" value="{{ old('promoted_to_class', $extra->promoted_to_class ?? '-') }}"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">
            </div>

            <div>
                <label style="font-weight:600;">Discipline (Term-I)</label>
                <input name="discipline_term1" value="{{ old('discipline_term1', $extra->discipline_term1 ?? '-') }}"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">
            </div>

            <div>
                <label style="font-weight:600;">Discipline (Term-II)</label>
                <input name="discipline_term2" value="{{ old('discipline_term2', $extra->discipline_term2 ?? '-') }}"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">
            </div>

            <div>
                <label style="font-weight:600;">Art Education (Term-I)</label>
                <input name="art_education_term1" value="{{ old('art_education_term1', $extra->art_education_term1 ?? '-') }}"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">
            </div>

            <div>
                <label style="font-weight:600;">Art Education (Term-II)</label>
                <input name="art_education_term2" value="{{ old('art_education_term2', $extra->art_education_term2 ?? '-') }}"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">
            </div>

            <div>
                <label style="font-weight:600;">General Awareness (Term-I)</label>
                <input name="general_awareness_term1" value="{{ old('general_awareness_term1', $extra->general_awareness_term1 ?? '-') }}"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">
            </div>

            <div>
                <label style="font-weight:600;">General Awareness (Term-II)</label>
                <input name="general_awareness_term2" value="{{ old('general_awareness_term2', $extra->general_awareness_term2 ?? '-') }}"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">
            </div>

            <div>
                <label style="font-weight:600;">Health & Physical Education (Term-I)</label>
                <input name="health_physical_term1" value="{{ old('health_physical_term1', $extra->health_physical_term1 ?? '-') }}"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">
            </div>

            <div>
                <label style="font-weight:600;">Health & Physical Education (Term-II)</label>
                <input name="health_physical_term2" value="{{ old('health_physical_term2', $extra->health_physical_term2 ?? '-') }}"
                       style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">
            </div>

            <div style="grid-column:1 / -1;">
                <label style="font-weight:600;">Class Teacher Remarks</label>
                <textarea name="class_teacher_remarks" rows="4"
                          style="width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:12px;margin-top:6px;">{{ old('class_teacher_remarks', $extra->class_teacher_remarks ?? '-') }}</textarea>
            </div>
        </div>

        <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap;">
            <button type="submit"
                    style="background:#16a34a;color:#fff;padding:10px 16px;border:none;border-radius:12px;font-weight:700;cursor:pointer;">
                Save
            </button>

            <a href="{{ route('marksheets.generate', [$student->id, $class]) }}"
               style="background:#6d28d9;color:#fff;padding:10px 16px;border-radius:12px;text-decoration:none;font-weight:700;">
                Generate PDF
            </a>
        </div>
    </form>
</div>
@endsection
