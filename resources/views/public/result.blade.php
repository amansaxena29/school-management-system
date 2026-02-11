<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Result - Arya Public Academy</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    *{box-sizing:border-box;font-family:Poppins,sans-serif}
    body{margin:0;background:linear-gradient(135deg,#e0f7fa,#e1bee7);min-height:100vh;padding:22px}
    .wrap{max-width:980px;margin:0 auto}
    .card{background:rgba(255,255,255,0.35);backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,0.35);border-radius:22px;padding:18px;box-shadow:0 20px 50px rgba(0,0,0,.12)}
    .top{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:12px}
    .back{padding:10px 14px;border-radius:14px;background:rgba(255,255,255,0.35);text-decoration:none;font-weight:700}
    .grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-top:10px}
    input{width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,0.6);outline:none}
    button{grid-column:1/-1;padding:12px;border-radius:14px;border:none;background:linear-gradient(135deg,#4a148c,#8e24aa);color:#fff;font-weight:800;cursor:pointer}
    .msg{margin:10px 0;padding:12px;border-radius:14px;font-weight:700}
    .err{background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.35)}
    .ok{background:rgba(34,197,94,0.15);border:1px solid rgba(34,197,94,0.35)}
    table{width:100%;border-collapse:collapse;margin-top:12px}
    th,td{padding:12px;border-bottom:1px solid rgba(0,0,0,0.08);text-align:left}
    .summary{display:flex;gap:16px;flex-wrap:wrap;margin-top:14px}
    .pill{padding:10px 14px;border-radius:999px;background:rgba(255,255,255,0.45);font-weight:700}
    @media(max-width:760px){.grid{grid-template-columns:1fr}}
  </style>
</head>
<body>
<div class="wrap">
  <div class="top">
    <h2 style="margin:0">📄 Check Result</h2>
    <a class="back" href="{{ url('/') }}">← Back to Home</a>
  </div>

  <div class="card">
    @if(session('error'))
      <div class="msg err">❌ {{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('public.result.show') }}">
      @csrf
      <div class="grid">
        <input name="class" placeholder="Class (e.g. 7)" required>
        <input name="roll_no" placeholder="Roll No (e.g. 12)" required>
        <button type="submit">View Result</button>
      </div>
    </form>

    @isset($result)
      <div class="msg ok">✅ Result Found ({{ $result->exam_name }} - {{ $result->year }})</div>

      <div class="summary">
        <div class="pill"><b>Name:</b> {{ $student->name }}</div>
        <div class="pill"><b>Father Name:</b> {{ $student->father_name }}</div>
        <div class="pill"><b>Mother Name:</b> {{ $student->mother_name }}</div>
        {{-- <div class="pill">DOB: {{ \Carbon\Carbon::parse($student->dob)->format('d-m-Y') }}</div> --}}
        <div class="pill">
            <b>DOB:</b>
            {{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d-m-Y') : '-' }}
        </div>


        <div class="pill"><b>Class:</b> {{ $student->class }}</div>
        <div class="pill"><b>Roll:</b> {{ $student->roll_no }}</div>
        <div class="pill"><b>Status:</b> {{ $result->status }}</div>
        <div class="pill"><b>Percentage:</b> {{ $result->percentage }}%</div>
        <div style="margin-top:14px;">

</div>

      </div>

      <table>
        <thead>
          <tr>
            <th>Subject</th>
            <th>Marks</th>
            <th>Max</th>
          </tr>
        </thead>
        <tbody>
          @foreach($result->subjects as $s)
            <tr>
              <td>{{ $s->subject }}</td>
              <td>{{ $s->marks }}</td>
              <td>{{ $s->max_marks }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="summary">
        <div class="pill"><b>Total:</b> {{ $result->total_marks }} / {{ $result->max_marks }}</div>

        {{-- <a href="{{ route('public.result.download', ['class' => $student->class, 'roll_no' => $student->roll_no]) }}"
   style="display:inline-flex;padding:12px 14px;border-radius:14px;background:linear-gradient(135deg,#111827,#178123);color:#fff;text-decoration:none;font-weight:800;justify-content:space-between;margin-left:auto;">
   ⬇ Download Report Card
</a> --}}

      </div>
    @endisset
  </div>
</div>
</body>
</html>
