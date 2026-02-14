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

  *{ box-sizing:border-box; }

  .rp-wrap{
    max-width: 980px;
    margin: 0 auto;
    padding: 26px 18px 60px;
  }

  /* HERO */
  .rp-hero{
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
  .rp-hero::after{
    content:"";
    position:absolute;
    inset:-2px;
    background: linear-gradient(135deg, rgba(56,189,248,0.35), rgba(129,140,248,0.25), transparent 55%);
    filter: blur(20px);
    opacity: .45;
    pointer-events:none;
  }

  .rp-head{
    position: relative;
    z-index: 1;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:12px;
    flex-wrap:wrap;
  }

  .rp-title{
    margin:0;
    font-size: 26px;
    font-weight: 900;
    letter-spacing: 0.3px;
    background: linear-gradient(90deg, var(--blue), var(--indigo));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .rp-sub{
    margin: 8px 0 0;
    color: rgba(229,231,235,0.78);
    font-weight: 700;
    font-size: 14px;
  }

  .rp-badge{
    position: relative;
    z-index: 1;
    padding: 8px 12px;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.06);
    color: rgba(229,231,235,0.92);
    font-weight: 900;
    font-size: 12px;
    white-space: nowrap;
    box-shadow: 0 12px 30px rgba(0,0,0,0.25);
  }

  /* ALERTS */
  .alert{
    margin-top: 14px;
    display:flex;
    gap: 12px;
    align-items:flex-start;
    padding: 12px 14px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    box-shadow: 0 18px 45px rgba(0,0,0,0.25);
    color: rgba(229,231,235,0.92);
  }
  .alert .icon{ font-size: 18px; line-height: 1; margin-top: 2px; }
  .alert .ttl{ font-weight: 900; margin-bottom: 2px; }
  .alert .txt{ color: rgba(229,231,235,0.82); font-weight: 700; font-size: 13px; }

  .alert.success{
    border-color: rgba(34,197,94,0.25);
    background: rgba(34,197,94,0.12);
    color: #bbf7d0;
  }
  .alert.error{
    border-color: rgba(239,68,68,0.25);
    background: rgba(239,68,68,0.12);
    color: #fecaca;
  }

  /* CARD */
  .rp-card{
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

  .rp-card-head{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:14px;
    flex-wrap:wrap;
  }

  .rp-card-title{
    margin:0;
    font-size: 18px;
    font-weight: 900;
    color: rgba(219,234,254,0.95);
    letter-spacing: .2px;
  }

  .rp-card-hint{
    margin: 6px 0 0;
    color: rgba(229,231,235,0.72);
    font-weight: 700;
    font-size: 13px;
  }

  .divider{
    height: 1px;
    background: rgba(255,255,255,0.08);
    margin: 14px 0 18px;
  }

  /* FORM */
  .form-grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px 18px;
    align-items:start;
  }

  .field{ min-width:0; }

  .field label{
    display:block;
    font-weight: 900;
    color: rgba(229,231,235,0.85);
    font-size: 12px;
    letter-spacing: .2px;
    margin-bottom: 8px;
  }

  .field input{
    width: 100%;
    max-width: 100%;
    display:block;
    padding: 12px 14px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: #e5e7eb;
    outline:none;
    font-size: 14px;
    font-weight: 900;
  }
  .field input:focus{
    border-color: rgba(56,189,248,0.5);
    box-shadow: 0 0 0 5px rgba(56,189,248,0.10);
  }

  .field small{
    display:block;
    margin-top: 7px;
    color: rgba(229,231,235,0.60);
    font-size: 12px;
    font-weight: 700;
  }

  .actions{
    grid-column: 1 / -1;
    display:flex;
    justify-content:flex-end;
    margin-top: 6px;
  }

  .btn{
    border:none;
    cursor:pointer;
    padding: 12px 18px;
    border-radius: 14px;
    font-weight: 900;
    color: #020617;
    background: linear-gradient(90deg, rgba(56,189,248,0.92), rgba(129,140,248,0.92));
    box-shadow: 0 14px 30px rgba(56,189,248,0.22);
    min-width: 260px;
    transition: transform .2s ease, filter .2s ease;
    white-space: nowrap;
  }
  .btn:hover{ transform: translateY(-1px); filter: brightness(1.02); }
  .btn:active{ transform: translateY(0px); }

  .foot-note{
    margin-top: 12px;
    color: rgba(229,231,235,0.72);
    font-weight: 700;
    font-size: 13px;
    text-align:center;
  }

  @media(max-width: 820px){
    .rp-card-head{ flex-direction: column; }
    .form-grid{ grid-template-columns: 1fr; }
    .actions{ justify-content: stretch; }
    .btn{ width:100%; min-width: unset; }
  }
</style>

<div class="rp-wrap">

  <div class="rp-hero">
    <div class="rp-head">
      <div>
        <h2 class="rp-title">📌 Upload / Update Result</h2>
        <p class="rp-sub">Enter <b style="color:#e5e7eb;">Class</b> + <b style="color:#e5e7eb;">Roll No</b> to open the result form.</p>
      </div>
      <div class="rp-badge">Result Panel</div>
    </div>
  </div>

  {{-- Alerts --}}
  @if(session('success'))
    <div class="alert success">
      <span class="icon">✅</span>
      <div>
        <div class="ttl">Success</div>
        <div class="txt">{{ session('success') }}</div>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="alert error">
      <span class="icon">⚠️</span>
      <div>
        <div class="ttl">Error</div>
        <div class="txt">{{ session('error') }}</div>
      </div>
    </div>
  @endif

  <div class="rp-card">
    <div class="rp-card-head">
      <div>
        <h3 class="rp-card-title">Result Details</h3>
        <p class="rp-card-hint">Class + Roll No match hona chahiye, tabhi student ka form open hoga.</p>
      </div>
    </div>

    <div class="divider"></div>

    <form method="POST" action="{{ route('results.create') }}" class="form-grid">
      @csrf

      <div class="field">
        <label>Class</label>
        <input name="class" placeholder="e.g. 7" required>
        <small>Example: 1, 7, 10</small>
      </div>

      <div class="field">
        <label>Roll No</label>
        <input name="roll_no" placeholder="e.g. 12" required>
        <small>Example: 12, 31</small>
      </div>

      <div class="field">
        <label>Exam Name</label>
        <input name="exam_name" value="Final" required>
        <small>Example: Final / Mid-Term</small>
      </div>

      <div class="field">
        <label>Year</label>
        <input name="year" value="{{ date('Y') }}" required>
        <small>Example: {{ date('Y') }}</small>
      </div>

      <div class="actions">
        <button type="submit" class="btn">Open Result Form →</button>
      </div>
    </form>
  </div>

  <div class="foot-note">
    Tip: If student not found, Class aur Roll No re-check karo.
  </div>

</div>
@endsection
