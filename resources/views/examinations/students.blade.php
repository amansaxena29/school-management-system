@extends('layouts.app')

@section('content')
<style>
  :root{
    --border: rgba(255,255,255,0.10);
    --blue:#38bdf8;
    --indigo:#818cf8;
    --green:#22c55e;
    --amber:#f59e0b;
    --red:#ef4444;
    --shadow: 0 25px 70px rgba(0,0,0,0.35);
  }

  .stu-wrap{
    max-width: 1100px;
    margin: 0 auto;
    padding: 26px 18px;
  }

  /* HERO */
  .stu-hero{
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

  .stu-hero::after{
    content:"";
    position:absolute;
    inset:-2px;
    background: linear-gradient(135deg, rgba(56,189,248,0.35), rgba(129,140,248,0.25), transparent 55%);
    filter: blur(20px);
    opacity: .45;
    pointer-events:none;
  }

  .stu-head{
    position: relative;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:12px;
    flex-wrap:wrap;
    z-index: 1;
  }

  .stu-title{
    margin:0;
    font-size: 26px;
    font-weight: 900;
    letter-spacing: 0.3px;
    background: linear-gradient(90deg, var(--blue), var(--indigo));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .stu-sub{
    margin: 8px 0 0;
    color: rgba(229,231,235,0.78);
    font-weight: 700;
  }

  /* TOP ACTIONS */
  .top-actions{
    position: relative;
    z-index: 1;
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    align-items:flex-end;
  }

  .year-form{
    display:flex;
    gap:10px;
    align-items:flex-end;
    flex-wrap:wrap;
    margin:0;
    padding: 10px 12px;
    border-radius: 18px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    box-shadow: 0 12px 30px rgba(0,0,0,0.25);
  }

  .year-label{
    font-weight: 900;
    color: rgba(229,231,235,0.85);
    font-size: 12px;
    display:block;
    margin-bottom: 6px;
    letter-spacing: .2px;
  }

  .year-input{
    padding: 10px 12px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: #e5e7eb;
    outline: none;
    min-width: 130px;
    font-weight: 900;
  }
  .year-input:focus{
    border-color: rgba(56,189,248,0.5);
    box-shadow: 0 0 0 5px rgba(56,189,248,0.10);
  }

  .btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    padding: 10px 14px;
    border-radius: 14px;
    font-weight: 900;
    text-decoration:none;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    color: #e5e7eb;
    cursor:pointer;
    transition: transform .2s ease, border-color .2s ease, background .2s ease, box-shadow .2s ease;
    white-space: nowrap;
  }
  .btn:hover{
    transform: translateY(-2px);
    border-color: rgba(56,189,248,0.35);
    background: rgba(56,189,248,0.10);
    box-shadow: 0 16px 40px rgba(0,0,0,0.25);
  }

  .btn.primary{
    border-color: rgba(56,189,248,0.20);
    background: linear-gradient(90deg, rgba(56,189,248,0.20), rgba(129,140,248,0.16));
    color: #dbeafe;
  }

  .btn.purple{
    border-color: rgba(167,139,250,0.22);
    background: rgba(109,40,217,0.22);
    color: #f5f3ff;
  }

  .btn.green{
    border-color: rgba(34,197,94,0.22);
    background: rgba(34,197,94,0.18);
    color: #dcfce7;
  }

  /* ALERTS */
  .alert{
    margin-top: 14px;
    padding: 12px 14px;
    border-radius: 16px;
    font-weight: 900;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    color: rgba(229,231,235,0.9);
  }
  .alert.success{
    border-color: rgba(34,197,94,0.25);
    background: rgba(34,197,94,0.14);
    color: #bbf7d0;
  }
  .alert.error{
    border-color: rgba(239,68,68,0.25);
    background: rgba(239,68,68,0.14);
    color: #fecaca;
  }

  /* TABLE CARD */
  .table-card{
    margin-top: 16px;
    border-radius: 22px;
    overflow:hidden;
    border: 1px solid rgba(255,255,255,0.10);
    background:
      radial-gradient(700px 260px at 15% 0%, rgba(56,189,248,0.10), transparent 55%),
      linear-gradient(180deg, rgba(11,18,36,0.92), rgba(2,6,23,0.92));
    box-shadow: 0 18px 60px rgba(0,0,0,0.35);
  }

  table{
    width:100%;
    border-collapse: collapse;
  }

  thead th{
    text-align:left;
    padding: 14px 14px;
    font-size: 12px;
    font-weight: 900;
    letter-spacing: .3px;
    color: rgba(219,234,254,0.9);
    background: rgba(255,255,255,0.05);
    border-bottom: 1px solid rgba(255,255,255,0.08);
    text-transform: uppercase;
  }

  tbody td{
    padding: 14px 14px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    color: rgba(229,231,235,0.9);
    font-weight: 700;
  }

  tbody tr:hover{
    background: rgba(255,255,255,0.04);
  }

  /* STATUS PILL */
  .pill{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding: 6px 10px;
    border-radius: 999px;
    font-weight: 900;
    font-size: 12px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    color: rgba(229,231,235,0.9);
  }

  .dot{
    width:8px;height:8px;border-radius:50%;
    background: rgba(229,231,235,0.7);
  }

  .pill.warn{
    border-color: rgba(245,158,11,0.28);
    background: rgba(245,158,11,0.12);
    color: #ffedd5;
  }
  .pill.warn .dot{ background: var(--amber); }

  .pill.pub{
    border-color: rgba(34,197,94,0.28);
    background: rgba(34,197,94,0.12);
    color: #dcfce7;
  }
  .pill.pub .dot{ background: var(--green); }

  .pill.saved{
    border-color: rgba(56,189,248,0.28);
    background: rgba(56,189,248,0.12);
    color: #cffafe;
  }
  .pill.saved .dot{ background: var(--blue); }

  /* ENTER BTN */
  .enter-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    padding: 10px 14px;
    border-radius: 14px;
    font-weight: 900;
    text-decoration:none;
    border: 1px solid rgba(34,197,94,0.22);
    background: rgba(34,197,94,0.18);
    color: #dcfce7;
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease, background .2s ease;
    white-space: nowrap;
  }
  .enter-btn:hover{
    transform: translateY(-2px);
    border-color: rgba(34,197,94,0.35);
    box-shadow: 0 16px 40px rgba(0,0,0,0.25);
    background: rgba(34,197,94,0.22);
  }

  /* Responsive */
  @media(max-width: 900px){
    .year-form{ width: 100%; justify-content: space-between; }
  }
</style>

<div class="stu-wrap">

  <div class="stu-hero">
    <div class="stu-head">
      <div>
        <h2 class="stu-title">{{ $type }} — Class {{ $class }}</h2>
        <p class="stu-sub">Select a student to enter marks. (Year matters)</p>
      </div>

      <div class="top-actions">
        {{-- Year selector --}}
        <form method="GET" action="{{ route('exams.students', [$type, $class]) }}" class="year-form">
          <div>
            <span class="year-label">Year</span>
            <input name="year" value="{{ $year ?? date('Y') }}" class="year-input">
          </div>

          <button type="submit" class="btn primary" style="border:none;">
            Apply
          </button>
        </form>

        <a class="btn purple" href="{{ route('exams.subjects.edit', [$type, $class]) }}">
          ✏️ Edit Subjects
        </a>

        <a class="btn" href="{{ route('exams.classes', $type) }}">
          ← Back
        </a>
      </div>
    </div>
  </div>

  @if(session('success'))
    <div class="alert success">✅ {{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert error">⚠️ {{ session('error') }}</div>
  @endif

  <div class="table-card">
    <table>
      <thead>
        <tr>
          <th style="width:90px;">Roll</th>
          <th>Name</th>
          <th style="width:220px;">Status</th>
          <th style="width:220px;">Action</th>
        </tr>
      </thead>

      <tbody>
        @forelse($students as $st)
          @php $r = $resultMap[$st->id] ?? null; @endphp

          <tr>
            <td>{{ $st->roll_no }}</td>
            <td>{{ $st->name }}</td>

            <td>
              @if(!$r)
                <span class="pill warn"><span class="dot"></span> Not Saved</span>
              @else
                @if($r->is_published)
                  <span class="pill pub"><span class="dot"></span> Published</span>
                @else
                  <span class="pill saved"><span class="dot"></span> Saved (Not Published)</span>
                @endif
              @endif
            </td>

            <td>
              <a class="enter-btn" href="{{ route('exams.entry', [$type, $class, $st->id]) }}?year={{ $year }}">
                Enter Marks →
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" style="padding:16px;color:rgba(229,231,235,0.75);font-weight:800;">
              No students found in this class.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>
@endsection
