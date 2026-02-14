@extends('layouts.app')

@section('content')

<style>
/* ✅ VERY IMPORTANT: prevents width overflow */
*,
*::before,
*::after{ box-sizing: border-box; }

.page-wrap{
    padding: 40px 18px 60px;
    max-width: 1100px;
    margin: 0 auto;
    font-family: ui-sans-serif, system-ui, -apple-system;
}

/* Glass container */
.glass-box{
    width: 100%;
    max-width: 100%;
    overflow: hidden; /* ✅ stop children from going out */
    background: rgba(15,23,42,0.85);
    backdrop-filter: blur(18px);
    border-radius: 28px;
    padding: 28px;
    box-shadow: 0 40px 120px rgba(0,0,0,0.60);
    color: #e5e7eb;
    border: 1px solid rgba(255,255,255,0.08);
}

/* Header row */
.top{
    display:flex;
    justify-content: space-between;
    align-items:flex-start;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 18px;
}

.title{
    margin:0;
    font-size: 26px;
    font-weight: 900;
    background: linear-gradient(90deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.sub{
    margin: 6px 0 0;
    color: rgba(229,231,235,0.75);
    font-weight: 700;
    font-size: 14px;
}

/* Buttons */
.btn-back{
    background: rgba(255,255,255,0.10);
    color: #fff;
    padding: 10px 16px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 900;
    border: 1px solid rgba(255,255,255,0.14);
    transition: .2s ease;
    display:inline-flex;
    align-items:center;
    gap: 8px;
    white-space: nowrap;
}
.btn-back:hover{
    background: rgba(255,255,255,0.16);
    transform: translateY(-1px);
}

/* Alerts */
.alert{
    margin-bottom: 16px;
    padding: 14px 16px;
    border-radius: 16px;
    border: 1px solid rgba(239,68,68,0.35);
    background: rgba(239,68,68,0.12);
    color: #fecaca;
    font-weight: 700;
}
.alert ul{ margin: 8px 0 0 18px; }

/* Form card inside glass */
.form-card{
    width: 100%;
    max-width: 100%;
    overflow: hidden; /* ✅ important */
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.10);
    border-radius: 18px;
    padding: 18px;
}

/* ✅ GRID FIX */
.form-grid{
    display:grid;
    grid-template-columns: repeat(2, minmax(0, 1fr)); /* ✅ minmax(0,1fr) avoids overflow */
    gap: 16px 18px;
}

/* ✅ allow grid items to shrink */
.field{
    min-width: 0;          /* ✅ key fix */
    max-width: 100%;
    display:flex;
    flex-direction: column;
    gap: 8px;
}

.field label{
    font-weight: 900;
    font-size: 13px;
    color: rgba(229,231,235,0.92);
}

/* ✅ INPUTS MUST NOT EXCEED WIDTH */
.field input,
.field textarea{
    width: 100%;
    max-width: 100%;
    display:block;
    padding: 12px 14px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.16);
    background: rgba(255,255,255,0.08);
    color: #e5e7eb;
    outline: none;
    font-size: 14px;
    transition: .15s ease;
}

.field textarea{
    resize: vertical;
}

.field input::placeholder,
.field textarea::placeholder{
    color: rgba(229,231,235,0.55);
}

.field input:focus,
.field textarea:focus{
    border-color: rgba(56,189,248,0.75);
    box-shadow: 0 0 0 4px rgba(56,189,248,0.12);
}

.full{
    grid-column: 1 / -1;
}

/* Actions */
.actions{
    margin-top: 16px;
    display:flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-save{
    background: linear-gradient(90deg, #22c55e, #16a34a);
    color: #04150b;
    padding: 11px 18px;
    border: none;
    border-radius: 14px;
    font-weight: 900;
    cursor: pointer;
    transition: .2s ease;
}
.btn-save:hover{
    filter: brightness(0.98);
    transform: translateY(-1px);
}

.btn-pdf{
    background: linear-gradient(90deg, #a855f7, #6366f1);
    color: #fff;
    padding: 11px 18px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 900;
    transition: .2s ease;
    display:inline-flex;
    align-items:center;
    gap: 8px;
}
.btn-pdf:hover{
    filter: brightness(0.98);
    transform: translateY(-1px);
}

/* ✅ Responsive */
@media(max-width: 860px){
    .form-grid{ grid-template-columns: 1fr; }
}
</style>

<div class="page-wrap">
    <div class="glass-box">

        <div class="top">
            <div>
                <h2 class="title">Edit Marksheet Fields</h2>
                <p class="sub">
                    {{ $student->name }} (Roll: {{ $student->roll_no }}) | Class: {{ $class }} | Session: {{ $session }}
                </p>
            </div>

            <a href="{{ route('marksheets.class', $class) }}" class="btn-back">← Back</a>
        </div>

        @if ($errors->any())
            <div class="alert">
                <b>Please fix the following:</b>
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('marksheets.extra.save', [$student->id, $class]) }}">
                @csrf

                <div class="form-grid">
                    <div class="field">
                        <label>Attendance</label>
                        <input id="attendanceInput" name="attendance"
                               value="{{ old('attendance', $extra->attendance ?? '') }}"
                               placeholder="e.g. 87/100">
                    </div>

                    <div class="field">
                        <label>Promoted To Class</label>
                        <input name="promoted_to_class"
                               value="{{ old('promoted_to_class', $extra->promoted_to_class ?? '-') }}"
                               placeholder="e.g. 8">
                    </div>

                    <div class="field">
                        <label>Discipline (Term-I)</label>
                        <input name="discipline_term1"
                               value="{{ old('discipline_term1', $extra->discipline_term1 ?? '-') }}"
                               placeholder="A / B / C">
                    </div>

                    <div class="field">
                        <label>Discipline (Term-II)</label>
                        <input name="discipline_term2"
                               value="{{ old('discipline_term2', $extra->discipline_term2 ?? '-') }}"
                               placeholder="A / B / C">
                    </div>

                    <div class="field">
                        <label>Art Education (Term-I)</label>
                        <input name="art_education_term1"
                               value="{{ old('art_education_term1', $extra->art_education_term1 ?? '-') }}"
                               placeholder="A / B / C">
                    </div>

                    <div class="field">
                        <label>Art Education (Term-II)</label>
                        <input name="art_education_term2"
                               value="{{ old('art_education_term2', $extra->art_education_term2 ?? '-') }}"
                               placeholder="A / B / C">
                    </div>

                    <div class="field">
                        <label>General Awareness (Term-I)</label>
                        <input name="general_awareness_term1"
                               value="{{ old('general_awareness_term1', $extra->general_awareness_term1 ?? '-') }}"
                               placeholder="A / B / C">
                    </div>

                    <div class="field">
                        <label>General Awareness (Term-II)</label>
                        <input name="general_awareness_term2"
                               value="{{ old('general_awareness_term2', $extra->general_awareness_term2 ?? '-') }}"
                               placeholder="A / B / C">
                    </div>

                    <div class="field">
                        <label>Health & Physical Education (Term-I)</label>
                        <input name="health_physical_term1"
                               value="{{ old('health_physical_term1', $extra->health_physical_term1 ?? '-') }}"
                               placeholder="A / B / C">
                    </div>

                    <div class="field">
                        <label>Health & Physical Education (Term-II)</label>
                        <input name="health_physical_term2"
                               value="{{ old('health_physical_term2', $extra->health_physical_term2 ?? '-') }}"
                               placeholder="A / B / C">
                    </div>

                    <div class="field full">
                        <label>Class Teacher Remarks</label>
                        <textarea name="class_teacher_remarks" rows="4" placeholder="Write remarks...">{{ old('class_teacher_remarks', $extra->class_teacher_remarks ?? '-') }}</textarea>
                    </div>
                </div>

                <div class="actions">
                    <button type="submit" class="btn-save">Save</button>

                    <a href="{{ route('marksheets.generate', [$student->id, $class]) }}" class="btn-pdf">
                        Generate PDF
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const attendanceInput = document.getElementById('attendanceInput');
    if (!attendanceInput) return;

    const studentId = "{{ $student->id }}";
    const classId = "{{ $class }}";
    const session = "{{ $session }}";

    try {
        const url = `/marksheets/${studentId}/attendance-summary/${classId}?session=${encodeURIComponent(session)}`;
        const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
        if (!res.ok) return;

        const data = await res.json();

        if (!attendanceInput.value || attendanceInput.value.trim() === '' || attendanceInput.value.trim() === '-') {
            attendanceInput.value = data.display;
        }
    } catch (err) {
        console.log("Attendance fetch error:", err);
    }
});
</script>

@endsection
