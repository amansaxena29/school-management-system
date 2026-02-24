@extends('layouts.app')

@section('content')
<style>
  :root{
    /* Glass Dark Theme */
    --bg1:#050b18;
    --bg2:#0b1224;

    --glass: rgba(15,23,42,0.66);
    --glass2: rgba(15,23,42,0.48);
    --stroke: rgba(255,255,255,0.10);
    --stroke2: rgba(255,255,255,0.14);

    --text:#e5e7eb;
    --muted: rgba(229,231,235,0.72);

    --shadow: 0 30px 90px rgba(0,0,0,0.45);
    --shadow2: 0 18px 40px rgba(0,0,0,0.32);

    --radius: 22px;

    --accent1:#38bdf8;
    --accent2:#818cf8;
    --accent3:#fb7185;
  }

  .mk-wrap{
    position: relative;
    max-width: 1080px;
    margin: 0 auto;
    padding: 14px 10px 26px;
    color: var(--text);
  }

  /* full glass background inside content */
  .mk-bg{
    position:absolute;
    inset:-18px -18px -18px -18px;
    background:
      radial-gradient(1000px 520px at 10% 0%, rgba(56,189,248,.18), transparent 55%),
      radial-gradient(900px 520px at 95% 15%, rgba(129,140,248,.16), transparent 55%),
      radial-gradient(900px 620px at 45% 95%, rgba(251,113,133,.12), transparent 55%),
      linear-gradient(180deg, var(--bg1), var(--bg2));
    border-radius: 26px;
    z-index:-3;
  }

  /* floating accents */
  .mk-blob{
    position:absolute;
    width: 240px;
    height: 240px;
    border-radius: 999px;
    filter: blur(34px);
    opacity: .40;
    z-index: -2;
    animation: floaty 10s ease-in-out infinite;
  }
  .mk-blob.b1{ left: -70px; top: 30px; background: rgba(56,189,248,.45); animation-delay: 0s;}
  .mk-blob.b2{ right: -80px; top: 10px; background: rgba(129,140,248,.40); animation-delay: 1.3s;}
  .mk-blob.b3{ left: 35%; bottom: -85px; background: rgba(251,113,133,.32); animation-delay: 2.2s;}
  @keyframes floaty{
    0%,100%{ transform: translateY(0) translateX(0) scale(1); }
    50%{ transform: translateY(-16px) translateX(12px) scale(1.05); }
  }

  /* hero glass */
  .mk-hero{
    display:flex;
    gap: 18px;
    align-items:flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 20px 20px 16px;
    border-radius: var(--radius);
    background: linear-gradient(180deg, rgba(15,23,42,.72), rgba(15,23,42,.52));
    border: 1px solid var(--stroke);
    box-shadow: var(--shadow2);
    backdrop-filter: blur(14px);
  }

  .mk-title{
    margin:0;
    font-size: 28px;
    line-height: 1.15;
    font-weight: 950;
    letter-spacing: .2px;
    background: linear-gradient(90deg, var(--accent1), var(--accent2));
    -webkit-background-clip:text;
    -webkit-text-fill-color: transparent;
  }

  .mk-sub{
    margin: 8px 0 0;
    color: var(--muted);
    font-weight: 650;
    max-width: 720px;
  }

  .mk-badges{
    display:flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content:flex-end;
  }
  .mk-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding: 10px 12px;
    border-radius: 999px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.10);
    color: rgba(229,231,235,.88);
    font-weight: 900;
    font-size: 13px;
    box-shadow: 0 10px 22px rgba(0,0,0,.25);
    user-select:none;
    backdrop-filter: blur(10px);
  }
  .mk-dot{
    width: 10px; height: 10px; border-radius: 99px;
    background: linear-gradient(135deg, var(--accent1), var(--accent2));
    box-shadow: 0 0 0 6px rgba(56,189,248,.12);
  }

  /* tools */
  .mk-tools{
    margin-top: 14px;
    display:flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items:center;
    justify-content: space-between;
  }

  .mk-search{
    flex: 1;
    min-width: 280px;
    display:flex;
    gap: 10px;
    align-items:center;
    padding: 12px 14px;
    border-radius: 16px;
    background: rgba(15,23,42,.62);
    border: 1px solid var(--stroke);
    box-shadow: 0 12px 26px rgba(0,0,0,.25);
    backdrop-filter: blur(14px);
  }
  .mk-search svg{ opacity: .9; }
  .mk-search input{
    width: 100%;
    border: none;
    outline: none;
    background: transparent;
    color: var(--text);
    font-weight: 800;
    font-size: 14px;
  }
  .mk-search input::placeholder{ color: rgba(229,231,235,.58); font-weight: 700; }

  .mk-actions{
    display:flex;
    gap: 10px;
    flex-wrap: wrap;
  }
  .mk-btn{
    display:inline-flex;
    gap: 10px;
    align-items:center;
    padding: 12px 14px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,.12);
    background: rgba(15,23,42,.62);
    color: rgba(229,231,235,.92);
    font-weight: 950;
    text-decoration:none;
    box-shadow: 0 12px 26px rgba(0,0,0,.25);
    transition: transform .15s ease, background .2s ease, border-color .2s ease;
    user-select:none;
    backdrop-filter: blur(14px);
  }
  .mk-btn:hover{
    transform: translateY(-2px);
    background: rgba(15,23,42,.75);
    border-color: rgba(255,255,255,.18);
  }

  /* alert */
  .mk-alert{
    margin-top: 14px;
    padding: 12px 14px;
    border-radius: 16px;
    background: rgba(239,68,68,.14);
    border: 1px solid rgba(239,68,68,.28);
    color: #fecaca;
    font-weight: 900;
    box-shadow: 0 12px 24px rgba(0,0,0,.25);
    backdrop-filter: blur(12px);
  }

  /* cards grid */
  .mk-grid{
    margin-top: 16px;
    display:grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 12px;
  }

  .mk-card{
    grid-column: span 3;
    position: relative;
    overflow:hidden;
    border-radius: 20px;
    padding: 16px 16px;
    background: linear-gradient(180deg, rgba(15,23,42,.70), rgba(15,23,42,.52));
    border: 1px solid rgba(255,255,255,.10);
    box-shadow: var(--shadow2);
    text-decoration:none;
    color: var(--text);
    transition: transform .18s ease, box-shadow .18s ease, border-color .2s ease;
    min-height: 112px;
    backdrop-filter: blur(14px);
  }

  .mk-card::before{
    content:"";
    position:absolute;
    inset:-2px;
    background:
      radial-gradient(600px 220px at 10% 10%, rgba(56,189,248,.18), transparent 60%),
      radial-gradient(520px 260px at 80% 20%, rgba(129,140,248,.16), transparent 60%),
      radial-gradient(420px 260px at 40% 90%, rgba(251,113,133,.12), transparent 60%);
    opacity: 0;
    transition: opacity .2s ease;
    z-index: 0;
  }

  .mk-card:hover{
    transform: translateY(-3px);
    box-shadow: var(--shadow);
    border-color: rgba(255,255,255,.16);
  }
  .mk-card:hover::before{ opacity: 1; }

  .mk-card > *{ position: relative; z-index: 1; }

  .mk-cardTop{
    display:flex;
    align-items:flex-start;
    justify-content: space-between;
    gap: 10px;
  }
  .mk-class{
    font-size: 18px;
    font-weight: 950;
    margin: 0;
  }
  .mk-hint{
    margin: 8px 0 0;
    color: rgba(229,231,235,.70);
    font-weight: 700;
    font-size: 13px;
  }
  .mk-pill{
    padding: 8px 10px;
    border-radius: 999px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.10);
    font-weight: 950;
    font-size: 12px;
    color: rgba(229,231,235,.82);
    white-space: nowrap;
  }

  .mk-arrow{
    margin-top: 14px;
    display:flex;
    align-items:center;
    justify-content:flex-end;
    gap: 10px;
    color: rgba(229,231,235,.78);
    font-weight: 900;
    font-size: 13px;
  }
  .mk-arrow svg{ opacity:.95; transition: transform .18s ease; }
  .mk-card:hover .mk-arrow svg{ transform: translateX(3px); }

  .mk-empty{
    margin-top: 16px;
    padding: 18px;
    border-radius: var(--radius);
    background: rgba(15,23,42,.62);
    border: 1px solid rgba(255,255,255,.10);
    color: rgba(229,231,235,.78);
    font-weight: 900;
    backdrop-filter: blur(14px);
    box-shadow: 0 12px 26px rgba(0,0,0,.25);
  }

  @media (max-width: 1000px){ .mk-card{ grid-column: span 4; } }
  @media (max-width: 720px){
    .mk-title{ font-size: 24px; }
    .mk-card{ grid-column: span 6; }
  }
  @media (max-width: 520px){
    .mk-card{ grid-column: span 12; }
    .mk-hero{ padding: 16px; }
  }
</style>

<div class="mk-wrap">
  <div class="mk-bg"></div>
  <div class="mk-blob b1"></div>
  <div class="mk-blob b2"></div>
  <div class="mk-blob b3"></div>

  <div class="mk-hero">
    <div>
      <h2 class="mk-title">Marksheets</h2>
      <p class="mk-sub">
        Select a class to generate marksheets instantly. Only published results will generate a PDF.
      </p>
    </div>

    <div class="mk-badges">
      <div class="mk-badge"><span class="mk-dot"></span> Fast PDF</div>
      <div class="mk-badge">One-click Download</div>
      <div class="mk-badge">Class-wise</div>
    </div>
  </div>

  <div class="mk-tools">
    <div class="mk-search">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
        <path d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 11-14 0 7 7 0 0114 0z" stroke="rgba(229,231,235,.85)" stroke-width="2" stroke-linecap="round"/>
      </svg>
      <input id="classSearch" type="text" placeholder="Search class (example: 7, 10, 12)..." autocomplete="off">
    </div>

    <div class="mk-actions">
      <a class="mk-btn" href="{{ route('dashboard') }}">🏠 Dashboard</a>
    </div>
  </div>

  @if(session('error'))
    <div class="mk-alert">❌ {{ session('error') }}</div>
  @endif

  <div class="mk-grid" id="classGrid">
    @forelse($classes as $class)
      <a class="mk-card" data-class="{{ strtolower((string)$class) }}" href="{{ route('marksheets.class', $class) }}">
        <div class="mk-cardTop">
          <div>
            <p class="mk-class">Class {{ $class }}</p>
            <p class="mk-hint">Generate marksheets for students in this class</p>
          </div>
          <span class="mk-pill">Open</span>
        </div>

        <div class="mk-arrow">
          View Students
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
            <path d="M5 12h13m0 0l-5-5m5 5l-5 5" stroke="rgba(229,231,235,.78)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </a>
    @empty
      <div class="mk-empty">
        No classes found yet. Add students first, then classes will appear here automatically.
      </div>
    @endforelse
  </div>
</div>

<script>
  (function(){
    const input = document.getElementById('classSearch');
    const cards = document.querySelectorAll('#classGrid .mk-card');

    function filter(){
      const q = (input.value || '').trim().toLowerCase();
      cards.forEach(c => {
        const val = c.getAttribute('data-class') || '';
        c.style.display = val.includes(q) ? '' : 'none';
      });
    }

    if(input){
      input.addEventListener('input', filter);
    }
  })();
</script>
@endsection
