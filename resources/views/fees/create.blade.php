@extends('layouts.app')

@section('header', 'Class-wise Fees Management')

@section('content')
<style>
  :root{
    --primary:#38bdf8;
    --primary2:#818cf8;

    --glass1: rgba(15,23,42,0.88);
    --glass2: rgba(2,6,23,0.88);
    --border: rgba(255,255,255,0.12);

    --text: rgba(229,231,235,0.92);
    --muted: rgba(229,231,235,0.70);

    --shadow: 0 25px 70px rgba(0,0,0,0.35);
  }

  *{ box-sizing:border-box; }

  .page{
    max-width: 1150px;
    margin: 0 auto;
    padding: 26px 18px 60px;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    background:
      radial-gradient(900px 320px at 20% 10%, rgba(56,189,248,0.14), transparent 60%),
      radial-gradient(700px 280px at 85% 35%, rgba(129,140,248,0.16), transparent 55%),
      radial-gradient(650px 260px at 45% 110%, rgba(34,197,94,0.10), transparent 60%);
  }

  .head{
    display:flex;
    justify-content: space-between;
    align-items:flex-end;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 14px;
  }

  .title{
    margin:0;
    font-size: 26px;
    font-weight: 900;
    letter-spacing: .2px;
    background: linear-gradient(90deg, var(--primary), var(--primary2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .subtitle{
    margin: 8px 0 0;
    color: var(--muted);
    font-weight: 700;
    font-size: 14px;
    line-height: 1.45;
  }

  .pill{
    display:inline-flex;
    align-items:center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 999px;
    font-weight: 900;
    font-size: 12px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: rgba(229,231,235,0.90);
    white-space: nowrap;
    box-shadow: 0 14px 35px rgba(0,0,0,0.18);
  }

  .grid{
    display:grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px;
    margin-top: 14px;
  }

  .card{
    position: relative;
    border-radius: 22px;
    padding: 16px;
    text-decoration:none;
    border: 1px solid rgba(255,255,255,0.12);
    background:
      radial-gradient(700px 240px at 15% 0%, rgba(255,255,255,0.10), transparent 55%),
      linear-gradient(180deg, var(--glass1), var(--glass2));
    box-shadow: var(--shadow);
    overflow:hidden;
    transition: transform .2s ease, filter .2s ease, border-color .2s ease;
  }

  .card:hover{
    transform: translateY(-3px);
    filter: brightness(1.02);
    border-color: rgba(56,189,248,0.35);
  }

  .card::before{
    content:"";
    position:absolute;
    inset:-2px;
    background: radial-gradient(600px 160px at 20% 0%, rgba(56,189,248,0.22), transparent 55%);
    opacity: .55;
    pointer-events:none;
  }

  .card-top{
    position: relative;
    display:flex;
    align-items:center;
    justify-content: space-between;
    gap: 10px;
  }

  .class-no{
    width: 44px;
    height: 44px;
    border-radius: 16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight: 900;
    color: rgba(229,231,235,0.95);
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.14);
  }

  .card h2{
    position: relative;
    margin: 0;
    font-size: 18px;
    font-weight: 900;
    color: rgba(229,231,235,0.95);
    letter-spacing: .15px;
  }

  .card p{
    position: relative;
    margin: 10px 0 0;
    color: rgba(229,231,235,0.74);
    font-weight: 700;
    font-size: 13px;
    line-height: 1.45;
  }

  .go{
    position: relative;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width: 38px;
    height: 38px;
    border-radius: 14px;
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.14);
    color: rgba(229,231,235,0.92);
    font-weight: 900;
    transition: transform .2s ease, background .2s ease;
  }

  .card:hover .go{
    transform: translateX(2px);
    background: rgba(255,255,255,0.14);
  }

  /* small color accents per class (only accent strip, keeps dark theme same) */
  .accent{
    position:absolute;
    left: 0;
    top: 0;
    width: 6px;
    height: 100%;
    opacity: .9;
  }
  .a1{ background:#38bdf8; }
  .a2{ background:#22c55e; }
  .a3{ background:#a855f7; }
  .a4{ background:#f97316; }
  .a5{ background:#f472b6; }
  .a6{ background:#06b6d4; }
  .a7{ background:#ef4444; }
  .a8{ background:#6366f1; }
  .a9{ background:#84cc16; }
  .a10{ background:#eab308; }
  .a11{ background:#0ea5e9; }
  .a12{ background:#94a3b8; }

  @media (max-width: 1050px){
    .grid{ grid-template-columns: repeat(3, minmax(0, 1fr)); }
  }
  @media (max-width: 820px){
    .grid{ grid-template-columns: repeat(2, minmax(0, 1fr)); }
  }
  @media (max-width: 520px){
    .grid{ grid-template-columns: 1fr; }
  }
</style>

<div class="page">
  <div class="head">
    <div>
      <h1 class="title">Select Class to Manage Fees</h1>
      <p class="subtitle">Pick a class to add fees and update payment status.</p>
    </div>
    <span class="pill">Classes: 1 to 12</span>
  </div>

  <div class="grid">
    @for($i = 1; $i <= 12; $i++)
      <a href="{{ route('fees.class', $i) }}" class="card">
        <span class="accent a{{ $i }}"></span>

        <div class="card-top">
          <div style="display:flex;align-items:center;gap:12px;">
            <div class="class-no">{{ $i }}</div>
            <h2>Class {{ $i }}</h2>
          </div>

          <span class="go">→</span>
        </div>

        <p>Manage fees for Class {{ $i }} (add records, check paid/pending).</p>
      </a>
    @endfor
  </div>
</div>
@endsection
