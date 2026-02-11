@extends('layouts.app')

@section('content')
<div class="container">

    <div class="top">
        <h2>🧾 Result Entry</h2>
        <a class="back" href="{{ route('results.index') }}">← Back</a>
    </div>

    <div class="card">
        <div class="student">
            <div><b>Name:</b> {{ $student->name }}</div>
            <div><b>Class:</b> {{ $student->class }}</div>
            <div><b>Roll:</b> {{ $student->roll_no }}</div>
            <div><b>Father:</b> {{ $student->father_name ?? '-' }}</div>
            <div><b>Mother:</b> {{ $student->mother_name ?? '-' }}</div>

            {{-- ✅ DOB ADDED --}}
            <div>
                <b>DOB:</b>
                {{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d-m-Y') : '-' }}
            </div>
        </div>


        <form method="POST" action="{{ route('results.store') }}">
            @csrf

            <input type="hidden" name="student_id" value="{{ $student->id }}">

            <div class="grid">
                <div>
                    <label>Exam Name</label>
                    <input name="exam_name" value="{{ $result->exam_name ?? 'Final' }}" required>
                </div>

                <div>
                    <label>Year</label>
                    <input name="year" value="{{ $result->year ?? date('Y') }}" required>
                </div>

                <div class="full publish">
                    <input type="checkbox" id="pub" name="is_published" {{ ($result && $result->is_published) ? 'checked' : '' }}>
                    <label for="pub">Publish result (make it live)</label>
                </div>
            </div>

            <h3 class="sub">Subjects</h3>

            <div id="subjectsWrap">
                @php
                    $subjects = $result?->subjects ?? collect([
                        (object)['subject'=>'Math','marks'=>0,'max_marks'=>100],
                        (object)['subject'=>'Science','marks'=>0,'max_marks'=>100],
                        (object)['subject'=>'English','marks'=>0,'max_marks'=>100],
                    ]);
                @endphp

                @foreach($subjects as $i => $s)
                    <div class="row">
                        <input name="subjects[{{ $i }}][name]" value="{{ $s->subject }}" placeholder="Subject" required>
                        <input name="subjects[{{ $i }}][marks]" value="{{ $s->marks }}" placeholder="Marks" type="number" min="0" required>
                        <input name="subjects[{{ $i }}][max]" value="{{ $s->max_marks }}" placeholder="Max" type="number" min="1" required>
                        <button type="button" class="del" onclick="removeRow(this)">✕</button>
                    </div>
                @endforeach
            </div>

            <div class="actions">
                <button type="button" class="add" onclick="addRow()">+ Add Subject</button>
                <button type="submit" class="save">Save Result</button>
            </div>
        </form>
    </div>
</div>

<script>
let idx = {{ $subjects->count() ?? 0 }};

function addRow(){
    const wrap = document.getElementById('subjectsWrap');
    const div = document.createElement('div');
    div.className = 'row';
    div.innerHTML = `
        <input name="subjects[${idx}][name]" placeholder="Subject" required>
        <input name="subjects[${idx}][marks]" placeholder="Marks" type="number" min="0" required>
        <input name="subjects[${idx}][max]" placeholder="Max" type="number" min="1" value="100" required>
        <button type="button" class="del" onclick="removeRow(this)">✕</button>
    `;
    wrap.appendChild(div);
    idx++;
}
function removeRow(btn){
    btn.closest('.row').remove();
}
</script>

<style>
.container{max-width:1100px;margin:30px auto;padding:0 16px;}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;}
.back{text-decoration:none;background:#e5e7eb;color:#111827;padding:10px 14px;border-radius:12px;font-weight:800;}
.card{background:#fff;border:1px solid #e5e7eb;border-radius:18px;padding:20px;box-shadow:0 12px 30px rgba(0,0,0,.08);}
.student{display:flex;gap:18px;flex-wrap:wrap;margin-bottom:14px;color:#111827;}
.grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;margin-top:10px;}
.grid label{font-weight:800;color:#374151;font-size:14px;}
.grid input{width:100%;padding:12px;border-radius:12px;border:1px solid #ddd;outline:none;}
.full{grid-column:1/-1;}
.publish{display:flex;gap:10px;align-items:center;}
.sub{margin:18px 0 10px;}
.row{display:grid;grid-template-columns:1.2fr .6fr .6fr 44px;gap:10px;align-items:center;margin-bottom:10px;}
.row input{padding:12px;border-radius:12px;border:1px solid #ddd;}
.del{width:44px;height:44px;border:none;border-radius:12px;background:#fee2e2;color:#7f1d1d;font-weight:900;cursor:pointer;}
.actions{display:flex;justify-content:space-between;gap:12px;margin-top:16px;flex-wrap:wrap;}
.add{background:#2563eb;color:#fff;border:none;padding:12px 14px;border-radius:12px;font-weight:900;cursor:pointer;}
.save{background:#16a34a;color:#fff;border:none;padding:12px 14px;border-radius:12px;font-weight:900;cursor:pointer;}
@media(max-width:800px){
  .grid{grid-template-columns:1fr;}
  .row{grid-template-columns:1fr 1fr; }
  .del{width:100%;grid-column:1/-1;}
}
</style>
@endsection
