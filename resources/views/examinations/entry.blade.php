@extends('layouts.app')

@section('content')
<style>
  :root{
    --border: rgba(255,255,255,0.10);
    --blue:#38bdf8;
    --indigo:#818cf8;
    --green:#22c55e;
    --red:#ef4444;
    --shadow: 0 25px 70px rgba(0,0,0,0.35);
  }

  .entry-wrap{
    max-width: 1100px;
    margin: 0 auto;
    padding: 26px 18px;
  }

  /* HERO */
  .entry-hero{
    position: relative;
    overflow: hidden;
    border-radius: 26px;
    padding: 22px 22px 18px;
    background:
      radial-gradient(900px 300px at 20% 10%, rgba(56,189,248,0.18), transparent 60%),
      radial-gradient(700px 260px at 85% 30%, rgba(129,140,248,0.20), transparent 55%),
      linear-gradient(180deg, rgba(15,23,42,0.92), rgba(2,6,23,0.92));
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
  }

  .entry-hero::after{
    content:"";
    position:absolute;
    inset:-2px;
    background: linear-gradient(135deg, rgba(56,189,248,0.35), rgba(129,140,248,0.25), transparent 55%);
    filter: blur(20px);
    opacity: .45;
    pointer-events:none;
  }

  .entry-head{
    position: relative;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:12px;
    flex-wrap:wrap;
    z-index: 1;
  }

  .entry-title{
    margin:0;
    font-size: 26px;
    font-weight: 900;
    letter-spacing: 0.3px;
    background: linear-gradient(90deg, var(--blue), var(--indigo));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .entry-sub{
    margin: 8px 0 0;
    color: rgba(229,231,235,0.78);
    font-weight: 700;
  }

  .back-btn{
    position: relative;
    z-index: 1;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding: 10px 14px;
    border-radius: 14px;
    text-decoration:none;
    font-weight: 900;
    color: #dbeafe;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    box-shadow: 0 12px 30px rgba(0,0,0,0.25);
    transition: transform .2s ease, border-color .2s ease, background .2s ease;
    white-space: nowrap;
  }
  .back-btn:hover{
    transform: translateY(-2px);
    border-color: rgba(56,189,248,0.35);
    background: rgba(56,189,248,0.10);
  }

  /* CARD */
  .card{
    margin-top: 16px;
    border-radius: 22px;
    overflow:hidden;
    border: 1px solid rgba(255,255,255,0.10);
    background:
      radial-gradient(700px 260px at 15% 0%, rgba(56,189,248,0.10), transparent 55%),
      linear-gradient(180deg, rgba(11,18,36,0.92), rgba(2,6,23,0.92));
    box-shadow: 0 18px 60px rgba(0,0,0,0.35);
    padding: 18px;
    color: rgba(229,231,235,0.92);
  }

  .grid{
    display:grid;
    grid-template-columns: repeat(2, minmax(0,1fr));
    gap: 14px;
    margin-top: 10px;
  }

  .field label{
    font-weight: 900;
    color: rgba(229,231,235,0.85);
    font-size: 12px;
    letter-spacing: .2px;
    display:block;
    margin-bottom: 6px;
  }

  .field input{
    width:100%;
    padding: 12px 12px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: #e5e7eb;
    outline:none;
    font-weight: 900;
  }

  .field input:focus{
    border-color: rgba(56,189,248,0.5);
    box-shadow: 0 0 0 5px rgba(56,189,248,0.10);
  }

  .field input[disabled]{
    opacity: .85;
    cursor:not-allowed;
  }

  .full{ grid-column: 1 / -1; }

  .publish{
    display:flex;
    align-items:center;
    gap:10px;
    padding: 12px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    font-weight: 900;
    color: rgba(229,231,235,0.9);
  }

  .publish input{
    width: 18px;
    height: 18px;
    accent-color: var(--green);
  }

  .sub{
    margin: 18px 0 10px;
    font-size: 14px;
    font-weight: 900;
    color: rgba(219,234,254,0.9);
    letter-spacing: .2px;
  }

  /* SUBJECT ROWS */
  .row{
    display:grid;
    grid-template-columns: 1.2fr .55fr .55fr .55fr 44px;
    gap: 10px;
    align-items:center;
    margin-bottom: 10px;
  }

  .row input{
    padding: 12px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: #e5e7eb;
    outline:none;
    font-weight: 900;
  }

  .row input:focus{
    border-color: rgba(56,189,248,0.5);
    box-shadow: 0 0 0 5px rgba(56,189,248,0.10);
  }

  .del{
    width:44px;
    height:44px;
    border:none;
    border-radius: 14px;
    background: rgba(239,68,68,0.18);
    border: 1px solid rgba(239,68,68,0.28);
    color: #fecaca;
    font-weight: 900;
    cursor:pointer;
    transition: transform .2s ease, background .2s ease, border-color .2s ease;
  }
  .del:hover{
    transform: translateY(-2px);
    background: rgba(239,68,68,0.22);
    border-color: rgba(239,68,68,0.40);
  }

  /* ACTIONS */
  .actions{
    display:flex;
    justify-content: space-between;
    gap: 12px;
    margin-top: 16px;
    flex-wrap: wrap;
  }

  .btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    padding: 12px 14px;
    border-radius: 14px;
    font-weight: 900;
    text-decoration:none;
    cursor:pointer;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    color: #e5e7eb;
    transition: transform .2s ease, border-color .2s ease, background .2s ease, box-shadow .2s ease;
    white-space: nowrap;
  }
  .btn:hover{
    transform: translateY(-2px);
    border-color: rgba(56,189,248,0.35);
    background: rgba(56,189,248,0.10);
    box-shadow: 0 16px 40px rgba(0,0,0,0.25);
  }

  .btn.blue{
    border: none;
    background: linear-gradient(90deg, rgba(56,189,248,0.85), rgba(129,140,248,0.85));
    color: #020617;
  }
  .btn.blue:hover{
    background: linear-gradient(90deg, rgba(56,189,248,0.92), rgba(129,140,248,0.92));
  }

  .btn.green{
    border: none;
    background: linear-gradient(90deg, rgba(34,197,94,0.92), rgba(16,185,129,0.92));
    color: #02170f;
  }

  /* Responsive */
  @media(max-width: 900px){
    .grid{ grid-template-columns: 1fr; }
    .row{ grid-template-columns: 1fr 1fr; }
    .del{ width:100%; grid-column: 1 / -1; }
  }
</style>

<div class="entry-wrap">
  <div class="entry-hero">
    <div class="entry-head">
      <div>
        <h2 class="entry-title">🧾 {{ $type }} Result Entry</h2>
        <p class="entry-sub">
          Class {{ $class }} | {{ $student->name }} (Roll: {{ $student->roll_no }})
        </p>
      </div>

      <a class="back-btn" href="{{ route('exams.students', [$type, $class]) }}">← Back</a>
    </div>
  </div>

  <div class="card">
    <form method="POST" action="{{ route('results.store') }}">
      @csrf

      <input type="hidden" name="student_id" value="{{ $student->id }}">
      <input type="hidden" name="exam_name" value="{{ $type }}">
      <input type="hidden" name="year" value="{{ $year }}">

      <div class="grid">
        <div class="field">
          <label>Exam Name</label>
          <input value="{{ $type }}" disabled>
        </div>

        <div class="field">
          <label>Year</label>
          <input value="{{ $year }}" disabled>
        </div>

        <div class="full publish">
          <input type="checkbox" id="pub" name="is_published" {{ ($result && $result->is_published) ? 'checked' : '' }}>
          <label for="pub">Publish result (make it live)</label>
        </div>
      </div>

      <h3 class="sub">Subjects (Marks + Grade)</h3>

      <div id="subjectsWrap">
        @php
          $rows = $result?->subjects;

          if (!$rows || $rows->count() === 0) {
              if (($template ?? collect())->count() > 0) {
                  $rows = $template->map(function($t){
                      return (object)[
                          'subject' => $t->subject,
                          'marks' => 0,
                          'max_marks' => $t->max_marks ?? 100,
                          'grade' => null,
                      ];
                  });
              } else {
                  $rows = collect([
                      (object)['subject'=>'Math','marks'=>0,'max_marks'=>100,'grade'=>null],
                      (object)['subject'=>'Science','marks'=>0,'max_marks'=>100,'grade'=>null],
                      (object)['subject'=>'English','marks'=>0,'max_marks'=>100,'grade'=>null],
                  ]);
              }
          }
        @endphp

        @foreach($rows as $i => $s)
          <div class="row">
            <input name="subjects[{{ $i }}][name]" value="{{ $s->subject }}" placeholder="Subject" required>
            <input name="subjects[{{ $i }}][marks]" value="{{ $s->marks }}" placeholder="Marks" type="number" min="0" required>
            <input name="subjects[{{ $i }}][max]" value="{{ $s->max_marks }}" placeholder="Max" type="number" min="1" required>
            {{-- <input name="subjects[{{ $i }}][grade]" value="{{ $s->grade ?? '' }}" placeholder="Grade (A1/A2...)" > --}}
            <button type="button" class="del" onclick="removeRow(this)">✕</button>
          </div>
        @endforeach
      </div>

      <div class="actions">
        <button type="button" class="btn blue" onclick="addRow()">+ Add Subject</button>
        <button type="submit" class="btn green">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
let idx = {{ $rows->count() ?? 0 }};

function addRow(){
  const wrap = document.getElementById('subjectsWrap');
  const div = document.createElement('div');
  div.className = 'row';
  div.innerHTML = `
    <input name="subjects[${idx}][name]" placeholder="Subject" required>
    <input name="subjects[${idx}][marks]" placeholder="Marks" type="number" min="0" required>
    <input name="subjects[${idx}][max]" placeholder="Max" type="number" min="1" value="100" required>
    <input name="subjects[${idx}][grade]" placeholder="Grade (A1/A2...)" >
    <button type="button" class="del" onclick="removeRow(this)">✕</button>
  `;
  wrap.appendChild(div);
  idx++;
}
function removeRow(btn){
  btn.closest('.row').remove();
}
</script>
@endsection
