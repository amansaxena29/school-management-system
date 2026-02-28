@extends('layouts.app')

@section('content')
<style>
  :root{
    --bg:#0b1220;
    --glass: rgba(15,23,42,0.82);
    --glass2: rgba(15,23,42,0.70);
    --stroke: rgba(255,255,255,0.12);
    --stroke2: rgba(255,255,255,0.18);
    --text:#e5e7eb;
    --muted: rgba(229,231,235,0.72);
    --accent1:#38bdf8;
    --accent2:#818cf8;
    --danger:#ef4444;
    --success:#22c55e;
    --shadow: 0 30px 90px rgba(0,0,0,0.45);
    --shadow2: 0 14px 34px rgba(0,0,0,0.28);
    --radius: 22px;
  }

  *{ box-sizing:border-box; }

  .page-wrap{
    padding: 28px;
    max-width: 1150px;
    margin: 0 auto;
  }

  .glass-box{
    background: var(--glass);
    backdrop-filter: blur(18px);
    border-radius: 22px;
    padding: 22px;
    box-shadow: var(--shadow);
    color: var(--text);
    border: 1px solid var(--stroke);
    position: relative;
    overflow: hidden;
  }

  /* subtle premium glow */
  .glass-box::before{
    content:"";
    position:absolute;
    inset:-2px;
    background:
      radial-gradient(700px 260px at 10% 0%, rgba(56,189,248,.18), transparent 60%),
      radial-gradient(650px 280px at 90% 10%, rgba(129,140,248,.16), transparent 60%),
      radial-gradient(500px 260px at 45% 95%, rgba(34,197,94,.10), transparent 60%);
    opacity: .9;
    pointer-events: none;
    z-index: 0;
  }

  .glass-inner{ position: relative; z-index: 1; }

  .head-row{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap: 14px;
    flex-wrap:wrap;
    margin-bottom: 14px;
  }

  .title{
    margin:0;
    font-size: 26px;
    font-weight: 950;
    background: linear-gradient(90deg, var(--accent1), var(--accent2));
    -webkit-background-clip:text;
    -webkit-text-fill-color: transparent;
    line-height: 1.2;
  }
  .sub{
    margin: 6px 0 0;
    color: var(--muted);
    font-weight: 700;
    font-size: 14px;
  }

  .btn{
    text-decoration:none;
    padding:10px 14px;
    border-radius: 12px;
    font-weight: 900;
    display:inline-flex;
    align-items:center;
    gap:8px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    color: var(--text);
    box-shadow: 0 10px 22px rgba(0,0,0,.22);
    transition: transform .15s ease, background .2s ease, border-color .2s ease;
    cursor: pointer;
  }
  .btn:hover{
    transform: translateY(-2px);
    background: rgba(255,255,255,0.10);
    border-color: rgba(255,255,255,0.18);
  }

  .btn-dark{
    background: rgba(2,6,23,0.35);
  }

  .btn-purple{
    border: none;
    background: linear-gradient(135deg,#4a148c,#8e24aa);
    color:#fff;
  }
  .btn-purple:hover{
    background: linear-gradient(135deg,#5b1aa3,#9c2bbd);
  }

  .btn-edit{
    background: rgba(2,6,23,0.35);
    color:#fff;
  }

  .alert{
    margin-top: 12px;
    padding: 12px 14px;
    border-radius: 14px;
    font-weight: 800;
    border: 1px solid transparent;
    box-shadow: 0 10px 22px rgba(0,0,0,.18);
    backdrop-filter: blur(10px);
  }
  .alert-danger{
    background: rgba(239,68,68,0.16);
    border-color: rgba(239,68,68,0.28);
    color: #fecaca;
  }
  .alert-success{
    background: rgba(34,197,94,0.14);
    border-color: rgba(34,197,94,0.28);
    color: #bbf7d0;
  }

  .table-wrap{
    margin-top: 14px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.10);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: var(--shadow2);
  }

  table{
    width:100%;
    border-collapse: collapse;
  }

  thead tr{
    background: rgba(255,255,255,0.06);
  }

  th{
    text-align:left;
    padding: 14px 14px;
    border-bottom: 1px solid rgba(255,255,255,0.10);
    color: rgba(147,197,253,0.95);
    font-weight: 950;
    font-size: 13px;
    white-space: nowrap;
  }

  td{
    padding: 14px 14px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    color: rgba(229,231,235,0.92);
    font-weight: 750;
    font-size: 13px;
    vertical-align: middle;
  }

  tbody tr:hover{
    background: rgba(255,255,255,0.05);
  }

  .actions{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    align-items:center;
  }

  .year-select{
    padding: 10px 12px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    color: var(--text);
    font-weight: 900;
    outline: none;
  }
  .year-select:focus{
    border-color: rgba(56,189,248,0.65);
    box-shadow: 0 0 0 4px rgba(56,189,248,0.14);
  }
  .year-select option{
    color: #111827;
  }

  @media (max-width: 900px){
    .page-wrap{ padding: 18px; }
    .glass-box{ padding: 16px; border-radius: 18px; }
    .title{ font-size: 22px; }
    .actions form{ width:100%; }
    .year-select{ width: 100%; }
    .btn{ width: 100%; justify-content:center; }
  }
</style>

<div class="page-wrap">
  <div class="glass-box">
    <div class="glass-inner">

      <div class="head-row">
        <div>
          <h2 class="title">Marksheets - Class {{ $class }}</h2>
          <p class="sub">Click a student to generate their marksheet PDF (latest published).</p>
        </div>

        <a href="{{ route('marksheets.index') }}" class="btn btn-dark">
          ← Back
        </a>
      </div>

      @if(session('error'))
        <div class="alert alert-danger">
          ❌ {{ session('error') }}
        </div>
      @endif

      @if(session('success'))
        <div class="alert alert-success">
          ✅ {{ session('success') }}
        </div>
      @endif

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Roll</th>
              <th>Student Name</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @forelse($students as $st)
              <tr>
                <td>{{ $st->roll_no ?? '-' }}</td>
                <td>{{ $st->name ?? '-' }}</td>
                <td>
                  <div class="actions">

                    {{-- Generate PDF with year filter --}}
                    <form method="GET" action="{{ route('marksheets.generate', [$st->id, $class]) }}"
                          style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                      <select name="year" class="year-select">
                        <option value="">Latest</option>
                        {{-- <option value="2026">2025-2026</option>
                        <option vlue="2025">2024-2025</option>a --}}
                      </select>

                      <button type="submit" class="btn btn-purple" style="border:none;">
                        ⬇ Generate PDF
                      </button>
                    </form>

                    <a href="{{ route('marksheets.extra.edit', [$st->id, $class]) }}" class="btn btn-edit">
                      ✏️ Edit Extra Curriculam
                    </a>

                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" style="padding:16px;color:rgba(229,231,235,0.70);font-weight:800;">
                  No students found in this class.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection
