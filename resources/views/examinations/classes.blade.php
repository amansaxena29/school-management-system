@extends('layouts.app')

@section('content')
<style>
  :root{
    --bg1:#0b1020;
    --bg2:#0f172a;
    --card:#0b1224;
    --text:#e5e7eb;
    --muted:#9ca3af;
    --border:rgba(255,255,255,0.10);
    --blue:#38bdf8;
    --indigo:#818cf8;
    --shadow: 0 25px 70px rgba(0,0,0,0.35);
  }

  .cls-wrap{
    max-width: 1100px;
    margin: 0 auto;
    padding: 26px 18px;
  }

  /* Hero */
  .cls-hero{
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

  .cls-hero::after{
    content:"";
    position:absolute;
    inset:-2px;
    background: linear-gradient(135deg, rgba(56,189,248,0.35), rgba(129,140,248,0.25), transparent 55%);
    filter: blur(20px);
    opacity: .45;
    pointer-events:none;
  }

  .cls-head{
    position: relative;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:12px;
    flex-wrap:wrap;
    z-index: 1;
  }

  .cls-title{
    margin:0;
    font-size: 28px;
    font-weight: 900;
    letter-spacing: 0.3px;
    background: linear-gradient(90deg, var(--blue), var(--indigo));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .cls-sub{
    margin: 8px 0 0;
    color: rgba(229,231,235,0.78);
    font-weight: 700;
  }

  .cls-back{
    position: relative;
    z-index: 1;
    display:inline-flex;
    align-items:center;
    gap:10px;
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
  .cls-back:hover{
    transform: translateY(-2px);
    border-color: rgba(56,189,248,0.35);
    background: rgba(56,189,248,0.10);
  }

  /* Grid */
  .cls-grid{
    margin-top: 16px;
    display:grid;
    grid-template-columns: repeat(4, minmax(0,1fr));
    gap: 14px;
  }

  .cls-card{
    position: relative;
    text-decoration:none;
    border-radius: 22px;
    padding: 16px;
    border: 1px solid var(--border);
    background:
      radial-gradient(600px 220px at 15% 15%, rgba(56,189,248,0.12), transparent 55%),
      linear-gradient(180deg, rgba(11,18,36,0.92), rgba(2,6,23,0.92));
    box-shadow: 0 18px 55px rgba(0,0,0,0.35);
    color: var(--text);
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    overflow:hidden;
  }

  .cls-card::before{
    content:"";
    position:absolute;
    inset:0;
    background: linear-gradient(135deg, rgba(56,189,248,0.18), rgba(129,140,248,0.14), transparent 58%);
    opacity: 0;
    transition: opacity .25s ease;
    pointer-events:none;
  }

  .cls-card:hover{
    transform: translateY(-6px);
    border-color: rgba(56,189,248,0.35);
    box-shadow: 0 26px 85px rgba(0,0,0,0.45), 0 0 0 6px rgba(56,189,248,0.06);
  }
  .cls-card:hover::before{ opacity: 1; }

  .cls-top{
    position: relative;
    display:flex;
    align-items:center;
    justify-content: space-between;
    gap: 10px;
    z-index: 1;
  }

  .cls-chip{
    width: 44px;
    height: 44px;
    border-radius: 14px;
    display:grid;
    place-items:center;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.10);
    box-shadow: 0 16px 40px rgba(0,0,0,0.25);
    font-size: 16px;
  }

  .cls-name{
    margin:0;
    font-size: 16px;
    font-weight: 900;
    letter-spacing: .2px;
    color: #f1f5f9;
  }

  .cls-open{
    position: relative;
    margin-top: 10px;
    color: rgba(229,231,235,0.72);
    font-weight: 700;
    display:flex;
    align-items:center;
    justify-content: space-between;
    z-index: 1;
  }

  .cls-arrow{
    font-weight: 900;
    color: rgba(229,231,235,0.9);
    transition: transform .25s ease;
  }
  .cls-card:hover .cls-arrow{
    transform: translateX(4px);
  }

  /* Responsive */
  @media (max-width: 1100px){
    .cls-grid{ grid-template-columns: repeat(3, minmax(0,1fr)); }
  }
  @media (max-width: 900px){
    .cls-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
  }
  @media (max-width: 520px){
    .cls-grid{ grid-template-columns: 1fr; }
    .cls-title{ font-size: 24px; }
    .cls-hero{ padding: 18px 16px 16px; }
  }
</style>

<div class="cls-wrap">
  <div class="cls-hero">
    <div class="cls-head">
      <div>
        <h2 class="cls-title">{{ $type }} — Classes</h2>
        <p class="cls-sub">Select class to open students list.</p>
      </div>

      <a class="cls-back" href="{{ route('exams.index') }}">
        ← Back
      </a>
    </div>
  </div>

  <div class="cls-grid">
    @foreach($classes as $c)
      <a class="cls-card" href="{{ route('exams.students', [$type, $c]) }}">
        <div class="cls-top">
          <div style="display:flex;align-items:center;gap:12px;">
            <div class="cls-chip">🏫</div>
            <h3 class="cls-name">Class {{ $c }}</h3>
          </div>
          <div class="cls-arrow">→</div>
        </div>

        <div class="cls-open">
          <span>Open students</span>
          <span style="opacity:.85;font-weight:900;">View</span>
        </div>
      </a>
    @endforeach
  </div>
</div>
@endsection
