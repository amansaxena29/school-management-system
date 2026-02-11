<x-app-layout>
<style>
/* Make sizing predictable */
*,
*::before,
*::after {
    box-sizing: border-box;
}

.page-wrap {
    padding: 50px;
    display: flex;
    justify-content: center;
}

.container {
    width: 100%;
    max-width: 980px; /* keeps form centered and aligned */
}

.glass-box {
    background: rgba(15,23,42,0.82);
    backdrop-filter: blur(20px);
    border-radius: 28px;
    padding: 45px;
    box-shadow: 0 40px 120px rgba(0,0,0,0.6);
    color: #e5e7eb;
}

.title {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 25px;
    background: linear-gradient(90deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.back-btn {
    display: inline-block;
    margin-bottom: 15px;
    color: #38bdf8;
    text-decoration: none;
    font-weight: 700;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px 18px; /* row gap, column gap */
    margin-top: 10px;
}

.field {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

label {
    font-size: 13px;
    font-weight: 600;
    color: rgba(229,231,235,0.85);
}

input, textarea {
    width: 100%;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    padding: 14px 18px;
    border-radius: 14px;
    color: white;
    outline: none;
}

input:focus, textarea:focus {
    border-color: rgba(56,189,248,0.7);
}

textarea {
    min-height: 110px;
    resize: vertical;
}

.full {
    grid-column: 1 / -1; /* spans full width */
}

.actions {
    margin-top: 18px;
    display: flex;
    justify-content: flex-end;
}

button {
    background: linear-gradient(90deg, #38bdf8, #6366f1);
    padding: 12px 28px;
    border-radius: 14px;
    font-weight: 700;
    color: #020617;
    border: none;
    cursor: pointer;
}

/* Responsive: on mobile make it single column */
@media (max-width: 760px) {
    .page-wrap { padding: 22px; }
    .glass-box { padding: 24px; border-radius: 20px; }
    .form-grid { grid-template-columns: 1fr; }
    .actions { justify-content: stretch; }
    button { width: 100%; }
}
</style>

<div class="page-wrap">
    <div class="container">
        <a class="back-btn" href="{{ route('students.class', $student->class) }}">← Back to Class {{ $student->class }}</a>

        <div class="glass-box">
            <h1 class="title">✏️ Edit Student</h1>

            <form method="POST" action="{{ route('students.update', $student) }}">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="field">
                        <label>Student Name</label>
                        <input name="name" value="{{ $student->name }}" placeholder="Student Name" required>
                    </div>

                    <div class="field">
                        <label>Class</label>
                        <input name="class" value="{{ $student->class }}" placeholder="Class" required>
                    </div>

                    <div class="field">
                        <label>Roll No</label>
                        <input name="roll_no" value="{{ $student->roll_no }}" placeholder="Roll No" required>
                    </div>

                    <div class="field">
                        <label>Phone Number</label>
                        <input name="phone" value="{{ $student->phone }}" placeholder="Phone Number" required>
                    </div>

                    <div class="field">
                        <label>Father's Name</label>
                        <input name="father_name" value="{{ $student->father_name }}" placeholder="Father's Name">
                    </div>

                    <div class="field">
                        <label>Mother's Name</label>
                        <input name="mother_name" value="{{ $student->mother_name }}" placeholder="Mother's Name">
                    </div>

                    <div class="field">
                        <label>Religion</label>
                        <input name="religion" value="{{ $student->religion }}" placeholder="Religion">
                    </div>

                    <div class="field">
                        <label>Citizenship</label>
                        <input name="citizenship" value="{{ $student->citizenship }}" placeholder="Citizenship">
                    </div>

                    <div class="field full">
                        <label>Address</label>
                        <textarea name="address" placeholder="Address">{{ $student->address }}</textarea>
                    </div>
                </div>

                <div class="actions">
                    <button type="submit">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
