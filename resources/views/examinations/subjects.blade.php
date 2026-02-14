@extends('layouts.app')

@section('content')
<div style="max-width:900px;margin:0 auto;padding:20px;">
  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
    <div>
      <h2 style="margin:0;">Edit Subjects</h2>
      <p style="margin:6px 0 0;color:#475569;font-weight:700;">
        {{ $type }} | Class {{ $class }}
      </p>
    </div>
    <a href="{{ route('exams.students', [$type, $class]) }}"
       style="background:#0f172a;color:#fff;padding:10px 14px;border-radius:12px;text-decoration:none;font-weight:900;">
      ← Back
    </a>
  </div>

  <form method="POST" action="{{ route('exams.subjects.save', [$type, $class]) }}"
        style="margin-top:16px;background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:16px;">
    @csrf

    <div id="wrap">
      @foreach($subjects as $i => $s)
        <div class="row">
          <input name="subjects[{{ $i }}][subject]" value="{{ $s->subject }}" placeholder="Subject" required>
          <input name="subjects[{{ $i }}][max_marks]" value="{{ $s->max_marks }}" type="number" min="1" placeholder="Max" required>
          <button type="button" class="del" onclick="removeRow(this)">✕</button>
        </div>
      @endforeach
    </div>

    <div style="display:flex;gap:10px;margin-top:14px;flex-wrap:wrap;">
      <button type="button" onclick="addRow()"
              style="background:#2563eb;color:#fff;border:none;padding:10px 14px;border-radius:12px;font-weight:900;cursor:pointer;">
        + Add Subject
      </button>

      <button type="submit"
              style="background:#16a34a;color:#fff;border:none;padding:10px 14px;border-radius:12px;font-weight:900;cursor:pointer;">
        Save Subjects
      </button>
    </div>
  </form>
</div>

<script>
let idx = {{ $subjects->count() ?? 0 }};

function addRow(){
  const wrap = document.getElementById('wrap');
  const div = document.createElement('div');
  div.className = 'row';
  div.innerHTML = `
    <input name="subjects[${idx}][subject]" placeholder="Subject" required>
    <input name="subjects[${idx}][max_marks]" type="number" min="1" value="100" placeholder="Max" required>
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
.row{display:grid;grid-template-columns:1fr 160px 44px;gap:10px;align-items:center;margin-bottom:10px;}
.row input{padding:12px;border-radius:12px;border:1px solid #ddd;}
.del{width:44px;height:44px;border:none;border-radius:12px;background:#fee2e2;color:#7f1d1d;font-weight:900;cursor:pointer;}
@media(max-width:700px){ .row{grid-template-columns:1fr 1fr; } .del{grid-column:1/-1;width:100%;} }
</style>
@endsection
