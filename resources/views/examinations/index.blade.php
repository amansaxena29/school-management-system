@extends('layouts.app')

@section('content')
<style>
  :root{
    --bg1:#0b1020;
    --bg2:#0f172a;
    --card:#0b1224;
    --card2:#0a1020;
    --text:#e5e7eb;
    --muted:#9ca3af;
    --border:rgba(255,255,255,0.10);
    --glow:rgba(56,189,248,0.25);
    --blue:#38bdf8;
    --indigo:#818cf8;
    --green:#22c55e;
    --shadow: 0 25px 70px rgba(0,0,0,0.35);
  }

  .exam-wrap{
    max-width: 980px;
    margin: 0 auto;
    padding: 26px 18px;
  }

  /* Hero / Header */
  .exam-hero{
    position: relative;
    overflow: hidden;
    border-radius: 26px;
    padding: 26px 26px 22px;
    background:
      radial-gradient(900px 300px at 20% 10%, rgba(56,189,248,0.18), transparent 60%),
      radial-gradient(700px 260px at 85% 30%, rgba(129,140,248,0.20), transparent 55%),
      linear-gradient(180deg, rgba(15,23,42,0.92), rgba(2,6,23,0.92));
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
  }

  .exam-hero::after{
    content:"";
    position:absolute;
    inset:-2px;
    background: linear-gradient(135deg, rgba(56,189,248,0.35), rgba(129,140,248,0.25), transparent 55%);
    filter: blur(20px);
    opacity: .45;
    pointer-events:none;
  }

  .exam-head{
    position: relative;
    display:flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 14px;
    z-index: 1;
  }

  .exam-title{
    margin:0;
    font-size: 30px;
    font-weight: 900;
    letter-spacing: 0.3px;
    background: linear-gradient(90deg, var(--blue), var(--indigo));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .exam-sub{
    margin: 8px 0 0;
    color: rgba(229,231,235,0.78);
    font-weight: 700;
    line-height: 1.4;
  }

  .exam-badge{
    position: relative;
    z-index: 1;
    padding: 10px 14px;
    border-radius: 999px;
    border: 1px solid rgba(56,189,248,0.28);
    background: rgba(56,189,248,0.10);
    color: #c7f9ff;
    font-weight: 900;
    display:flex;
    align-items:center;
    gap:10px;
    white-space: nowrap;
    box-shadow: 0 12px 30px rgba(56,189,248,0.12);
  }

  .badge-dot{
    width:10px;height:10px;border-radius:50%;
    background: var(--green);
    box-shadow: 0 0 0 6px rgba(34,197,94,0.12);
  }

  /* Cards */
  .exam-grid{
    margin-top: 18px;
    display:grid;
    grid-template-columns: repeat(2, minmax(0,1fr));
    gap: 16px;
  }

  .exam-card{
    position: relative;
    text-decoration:none;
    border-radius: 22px;
    padding: 18px 18px 16px;
    border: 1px solid var(--border);
    background:
      radial-gradient(600px 220px at 15% 15%, rgba(56,189,248,0.12), transparent 55%),
      linear-gradient(180deg, rgba(11,18,36,0.92), rgba(2,6,23,0.92));
    box-shadow: 0 20px 60px rgba(0,0,0,0.35);
    color: var(--text);
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    overflow:hidden;
  }

  .exam-card::before{
    content:"";
    position:absolute;
    inset:0;
    background: linear-gradient(135deg, rgba(56,189,248,0.18), rgba(129,140,248,0.14), transparent 58%);
    opacity: 0;
    transition: opacity .25s ease;
    pointer-events:none;
  }

  .exam-card:hover{
    transform: translateY(-6px);
    border-color: rgba(56,189,248,0.35);
    box-shadow: 0 28px 85px rgba(0,0,0,0.45), 0 0 0 6px rgba(56,189,248,0.06);
  }

  .exam-card:hover::before{
    opacity: 1;
  }

  .exam-card-top{
    position: relative;
    display:flex;
    align-items:center;
    justify-content: space-between;
    gap: 10px;
    z-index:1;
  }

  .exam-left{
    display:flex;
    align-items:center;
    gap: 12px;
  }

  .exam-icon{
    width: 44px;
    height: 44px;
    border-radius: 14px;
    display:grid;
    place-items:center;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.10);
    box-shadow: 0 16px 40px rgba(0,0,0,0.25);
    font-size: 18px;
  }

  .exam-name{
    margin:0;
    font-size: 18px;
    font-weight: 900;
    color: #f1f5f9;
    letter-spacing: 0.2px;
  }

  .exam-arrow{
    font-size: 18px;
    font-weight: 900;
    color: rgba(229,231,235,0.85);
    transition: transform .25s ease;
  }

  .exam-card:hover .exam-arrow{
    transform: translateX(4px);
  }

  .exam-desc{
    position: relative;
    margin-top: 10px;
    color: rgba(229,231,235,0.72);
    font-weight: 700;
    line-height: 1.45;
    z-index:1;
  }

  .exam-meta{
    position: relative;
    margin-top: 14px;
    display:flex;
    gap: 10px;
    flex-wrap: wrap;
    z-index:1;
  }

  .pill{
    padding: 7px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 900;
    border: 1px solid rgba(255,255,255,0.10);
    background: rgba(255,255,255,0.06);
    color: rgba(229,231,235,0.88);
  }

  .pill.blue{
    border-color: rgba(56,189,248,0.22);
    background: rgba(56,189,248,0.10);
    color: #c7f9ff;
  }

  /* Responsive */
  @media (max-width: 820px){
    .exam-grid{ grid-template-columns: 1fr; }
    .exam-title{ font-size: 26px; }
    .exam-hero{ padding: 22px 18px 18px; }
  }
</style>

<div class="exam-wrap">
  <div class="exam-hero">
    <div class="exam-head">
      <div>
        <h2 class="exam-title">Examination</h2>
        <p class="exam-sub">Choose an exam type to enter marks, grades, and publish results.</p>
      </div>

      <div class="exam-badge">
        <span class="badge-dot"></span>
        Result Entry
      </div>
    </div>
  </div>

  <div class="exam-grid">
    <a class="exam-card" href="{{ route('exams.classes', 'Half-Yearly') }}">
      <div class="exam-card-top">
        <div class="exam-left">
          <div class="exam-icon">📝</div>
          <h3 class="exam-name">Half Yearly</h3>
        </div>
        <div class="exam-arrow">→</div>
      </div>

      <div class="exam-desc">Enter marks & grades for the mid-term assessment and keep progress updated.</div>

      <div class="exam-meta">
        <span class="pill blue">Marks + Grade</span>
        <span class="pill">Publish Result</span>
        <span class="pill">Class-wise</span>
      </div>
    </a>

    <a class="exam-card" href="{{ route('exams.classes', 'Annual') }}">
      <div class="exam-card-top">
        <div class="exam-left">
          <div class="exam-icon">🏁</div>
          <h3 class="exam-name">Annual</h3>
        </div>
        <div class="exam-arrow">→</div>
      </div>

      <div class="exam-desc">Final evaluation for the session. Add subjects, marks, grades and generate final performance.</div>

      <div class="exam-meta">
        <span class="pill blue">Final Result</span>
        <span class="pill">Marks + Grade</span>
        <span class="pill">Session Year</span>
      </div>
    </a>
  </div>
</div>
@endsection
