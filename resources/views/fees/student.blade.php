@extends('layouts.app')
@section('header', $student->name . ' — Fees')
@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap');
:root{--bg:#070d1c;--cyan:#0ff4c6;--indigo:#6470ff;--gold:#f0c060;--green:#22d3a0;--rose:#ff6b8a;
--glass:rgba(12,22,48,0.78);--edge:rgba(255,255,255,0.08);--text:#eef4f8;--muted:rgba(200,220,235,0.6);--input:#1a2540;}
*,*::before,*::after{box-sizing:border-box;}
.fs-bg{position:fixed;inset:0;z-index:-10;background:var(--bg);pointer-events:none;overflow:hidden;}
.fs-orb{position:absolute;border-radius:50%;filter:blur(90px);animation:orbD ease-in-out infinite alternate;}
.fs-orb:nth-child(1){width:600px;height:450px;background:radial-gradient(circle,rgba(100,112,255,0.2) 0%,transparent 70%);top:-100px;left:-80px;animation-duration:18s;}
.fs-orb:nth-child(2){width:500px;height:380px;background:radial-gradient(circle,rgba(15,244,198,0.12) 0%,transparent 70%);bottom:-80px;right:-80px;animation-duration:22s;animation-delay:-6s;}
@keyframes orbD{0%{transform:translate(0,0) scale(1);}100%{transform:translate(30px,20px) scale(1.08);}}
.fs-gridlines{position:fixed;inset:0;z-index:-9;pointer-events:none;
background-image:linear-gradient(rgba(15,244,198,0.016) 1px,transparent 1px),linear-gradient(90deg,rgba(15,244,198,0.016) 1px,transparent 1px);
background-size:65px 65px;}
.fs-wrap{font-family:'DM Sans',sans-serif;max-width:980px;margin:0 auto;padding:36px 24px 80px;color:var(--text);}
.fs-top{display:flex;justify-content:space-between;align-items:flex-start;gap:14px;flex-wrap:wrap;margin-bottom:24px;
opacity:0;animation:fadeUp 0.7s 0.1s cubic-bezier(0.16,1,0.3,1) forwards;}
@keyframes fadeUp{0%{opacity:0;transform:translateY(18px);}100%{opacity:1;transform:translateY(0);}}
.fs-title{font-size:clamp(1.5rem,3vw,2rem);font-weight:700;margin:0 0 4px;
background:linear-gradient(90deg,var(--cyan),var(--indigo));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.fs-sub{color:black;font-size:0.85rem;margin:0;}
.fs-back{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:12px;
text-decoration:none;font-weight:600;font-size:13px;color:var(--text);
background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);transition:all 0.2s;align-self:center;}
.fs-back:hover{background:rgba(255,255,255,0.12);transform:translateY(-1px);}
.fs-alert{display:flex;align-items:center;gap:10px;padding:13px 18px;border-radius:10px;margin-bottom:20px;
font-size:0.88rem;font-weight:500;background:rgba(34,211,160,0.1);border:1px solid rgba(34,211,160,0.3);color:black;}
.fs-profile{background:var(--glass);border:1px solid var(--edge);border-radius:20px;padding:26px 28px;
backdrop-filter:blur(24px);box-shadow:0 24px 60px rgba(0,0,0,0.45);margin-bottom:20px;
display:grid;grid-template-columns:auto 1fr;gap:24px;align-items:start;
position:relative;overflow:hidden;opacity:0;animation:fadeUp 0.7s 0.2s cubic-bezier(0.16,1,0.3,1) forwards;}
.fs-profile::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;
background:linear-gradient(90deg,transparent,var(--cyan),transparent);pointer-events:none;}
.fs-avatar{width:72px;height:72px;border-radius:50%;
background:linear-gradient(135deg,rgba(15,244,198,0.2),rgba(100,112,255,0.2));
border:2px solid rgba(15,244,198,0.3);
display:flex;align-items:center;justify-content:center;
font-size:1.8rem;font-weight:700;color:var(--cyan);flex-shrink:0;overflow:hidden;}
.fs-avatar img{width:72px;height:72px;border-radius:50%;object-fit:cover;}
.fs-info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.fs-info-label{font-size:10px;font-weight:500;letter-spacing:0.16em;text-transform:uppercase;color:rgba(15,244,198,0.6);margin-bottom:4px;}
.fs-info-val{font-size:0.9rem;font-weight:600;color:var(--text);}
.fs-summary{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px;
opacity:0;animation:fadeUp 0.7s 0.3s cubic-bezier(0.16,1,0.3,1) forwards;}
.fs-sum-card{background:var(--glass);border:1px solid var(--edge);border-radius:14px;padding:18px 16px;
backdrop-filter:blur(20px);text-align:center;position:relative;overflow:hidden;}
.fs-sum-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;}
.fs-sum-card:nth-child(1)::before{background:linear-gradient(90deg,transparent,var(--cyan),transparent);}
.fs-sum-card:nth-child(2)::before{background:linear-gradient(90deg,transparent,var(--green),transparent);}
.fs-sum-card:nth-child(3)::before{background:linear-gradient(90deg,transparent,var(--rose),transparent);}
.fs-sum-card:nth-child(4)::before{background:linear-gradient(90deg,transparent,var(--gold),transparent);}
.fs-sum-num{font-size:1.5rem;font-weight:700;margin-bottom:4px;}
.fs-sum-card:nth-child(1) .fs-sum-num{color:var(--cyan);}
.fs-sum-card:nth-child(2) .fs-sum-num{color:var(--green);}
.fs-sum-card:nth-child(3) .fs-sum-num{color:var(--rose);}
.fs-sum-card:nth-child(4) .fs-sum-num{color:var(--gold);}
.fs-sum-label{font-size:10px;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);font-weight:500;}
.fs-inst-card{background:var(--glass);border:1px solid var(--edge);border-radius:20px;padding:28px;
backdrop-filter:blur(24px);box-shadow:0 24px 60px rgba(0,0,0,0.45);
opacity:0;animation:fadeUp 0.7s 0.4s cubic-bezier(0.16,1,0.3,1) forwards;}
.fs-inst-header{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;
margin-bottom:22px;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,0.07);}
.fs-inst-title{font-size:1rem;font-weight:700;color:var(--text);}
.fs-inst-chip{background:rgba(15,244,198,0.07);border:1px solid rgba(15,244,198,0.2);
border-radius:99px;padding:5px 14px;font-size:10px;font-weight:600;letter-spacing:0.15em;text-transform:uppercase;color:var(--cyan);}
.inst-row{display:grid;grid-template-columns:80px 1fr 1fr 160px;gap:14px;align-items:end;
padding:18px 0;border-bottom:1px solid rgba(255,255,255,0.05);}
.inst-row:last-of-type{border-bottom:none;padding-bottom:0;}
.inst-num{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:5px;padding-bottom:2px;}
.inst-circle{width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;border:2px solid;}
.inst-circle-1{background:rgba(15,244,198,0.1);border-color:rgba(15,244,198,0.4);color:var(--cyan);}
.inst-circle-2{background:rgba(100,112,255,0.1);border-color:rgba(100,112,255,0.4);color:var(--indigo);}
.inst-circle-3{background:rgba(240,192,96,0.1);border-color:rgba(240,192,96,0.4);color:var(--gold);}
.inst-circle-4{background:rgba(34,211,160,0.1);border-color:rgba(34,211,160,0.4);color:var(--green);}
.inst-circle-5{background:rgba(255,107,138,0.1);border-color:rgba(255,107,138,0.4);color:var(--rose);}
.inst-lbl{font-size:9px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:var(--muted);}
.inst-field label{display:block;font-size:10px;font-weight:500;letter-spacing:0.16em;text-transform:uppercase;
color:rgba(15,244,198,0.55);margin-bottom:6px;}
.inst-field input{width:100%;padding:11px 14px;background:var(--input);
border:1px solid rgba(255,255,255,0.12);border-radius:10px;color:var(--text);
font-size:0.88rem;font-family:'DM Sans',sans-serif;outline:none;transition:border-color 0.2s,box-shadow 0.2s;}
.inst-field input::placeholder{color:rgba(180,200,220,0.3);}
.inst-field input:focus{border-color:rgba(15,244,198,0.45);box-shadow:0 0 0 3px rgba(15,244,198,0.1);}
.inst-field input[type="date"]{color-scheme:dark;}
.inst-status-wrap{}
.inst-status-lbl{display:block;font-size:10px;font-weight:500;letter-spacing:0.16em;text-transform:uppercase;
color:rgba(15,244,198,0.55);margin-bottom:6px;}
.status-toggle{display:flex;gap:8px;}
input[type="radio"].st-radio{display:none;}
.st-btn{flex:1;padding:11px 6px;border-radius:10px;border:1px solid;font-size:11px;font-weight:600;
letter-spacing:0.06em;text-transform:uppercase;cursor:pointer;text-align:center;transition:all 0.2s;background:transparent;display:block;}
.st-btn-paid{border-color:rgba(34,211,160,0.3);color:rgba(34,211,160,0.5);}
.st-btn-paid.active{background:rgba(34,211,160,0.15);border-color:rgba(34,211,160,0.6);color:var(--green);}
.st-btn-pending{border-color:rgba(255,107,138,0.3);color:rgba(255,107,138,0.5);}
.st-btn-pending.active{background:rgba(255,107,138,0.15);border-color:rgba(255,107,138,0.6);color:var(--rose);}
.fs-save-row{display:flex;justify-content:flex-end;margin-top:24px;}
.fs-btn-save{display:inline-flex;align-items:center;gap:8px;padding:13px 32px;border-radius:12px;
border:none;cursor:pointer;font-size:13px;font-weight:600;font-family:'DM Sans',sans-serif;
letter-spacing:0.1em;text-transform:uppercase;
background:linear-gradient(135deg,var(--cyan),#00d4a8);color:#041020;
box-shadow:0 6px 20px rgba(15,244,198,0.28);transition:all 0.25s;position:relative;overflow:hidden;}
.fs-btn-save::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;
background:linear-gradient(90deg,transparent,rgba(255,255,255,0.18),transparent);transition:left 0.5s;pointer-events:none;}
.fs-btn-save:hover::before{left:100%;}
.fs-btn-save:hover{transform:translateY(-2px);box-shadow:0 10px 30px rgba(15,244,198,0.4);}
@media(max-width:700px){
.inst-row{grid-template-columns:1fr;}
.inst-num{flex-direction:row;justify-content:flex-start;}
.fs-info-grid{grid-template-columns:1fr 1fr;}
.fs-summary{grid-template-columns:1fr 1fr;}
.fs-profile{grid-template-columns:1fr;}}
</style>

<div class="fs-bg"><div class="fs-orb"></div><div class="fs-orb"></div></div>
<div class="fs-gridlines"></div>

<div class="fs-wrap">
    <div class="fs-top">
        <div>
            <h1 class="fs-title">{{ $student->name }}</h1>
            <p class="fs-sub">Class {{ $class }} &nbsp;·&nbsp; Roll No: {{ $student->roll_no }} &nbsp;·&nbsp; Fee Management</p>
        </div>
        <a href="{{ route('fees.class', $class) }}" class="fs-back">← Back to Class {{ $class }}</a>
    </div>

    @if(session('success'))
        <div class="fs-alert">✅ &nbsp;{{ session('success') }}</div>
    @endif

    {{-- Student Profile --}}
    <div class="fs-profile">
        <div class="fs-avatar">
            @if($student->photo_path)
                <img src="{{ asset($student->photo_path) }}" alt="{{ $student->name }}">
            @else
                {{ strtoupper(substr($student->name, 0, 1)) }}
            @endif
        </div>
        <div class="fs-info-grid">
            <div>
                <div class="fs-info-label">Full Name</div>
                <div class="fs-info-val">{{ $student->name }}</div>
            </div>
            <div>
                <div class="fs-info-label">Roll No</div>
                <div class="fs-info-val">{{ $student->roll_no }}</div>
            </div>
            <div>
                <div class="fs-info-label">Class</div>
                <div class="fs-info-val">Class {{ $class }}</div>
            </div>
            <div>
                <div class="fs-info-label">Father's Name</div>
                <div class="fs-info-val">{{ $student->father_name ?? '—' }}</div>
            </div>
            <div>
                <div class="fs-info-label">Mother's Name</div>
                <div class="fs-info-val">{{ $student->mother_name ?? '—' }}</div>
            </div>
            <div>
                <div class="fs-info-label">Date of Birth</div>
                <div class="fs-info-val">{{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d M Y') : '—' }}</div>
            </div>
        </div>
    </div>

    {{-- Summary --}}
    @php
        $totalLogged  = $fee->totalLogged();
        $totalPaid    = $fee->totalPaid();
        $totalPending = $totalLogged - $totalPaid;
        $paidCount = 0;
        for ($i = 1; $i <= 5; $i++) {
            if ($fee->{"inst{$i}_amount"} && $fee->{"inst{$i}_status"} === 'paid') $paidCount++;
        }
    @endphp
    <div class="fs-summary">
        <div class="fs-sum-card">
            <div class="fs-sum-num">₹{{ number_format($totalLogged, 0) }}</div>
            <div class="fs-sum-label">Total Logged</div>
        </div>
        <div class="fs-sum-card">
            <div class="fs-sum-num">₹{{ number_format($totalPaid, 0) }}</div>
            <div class="fs-sum-label">Total Paid</div>
        </div>
        <div class="fs-sum-card">
            <div class="fs-sum-num">₹{{ number_format($totalPending, 0) }}</div>
            <div class="fs-sum-label">Pending Amount</div>
        </div>
        <div class="fs-sum-card">
            <div class="fs-sum-num">{{ $paidCount }}/5</div>
            <div class="fs-sum-label">Installments Paid</div>
        </div>
    </div>

    {{-- Installments Form --}}
    <div class="fs-inst-card">
        <div class="fs-inst-header">
            <div class="fs-inst-title">📋 Fee Installments</div>
            <div class="fs-inst-chip">5 Installments</div>
        </div>

        <form method="POST"
              action="{{ route('fees.student.update', ['class' => $class, 'student' => $student->id]) }}">
            @csrf

            @for($i = 1; $i <= 5; $i++)
            @php
                $amt = $fee->{"inst{$i}_amount"};
                $dt  = $fee->{"inst{$i}_date"};
                $st  = $fee->{"inst{$i}_status"};
            @endphp
            <div class="inst-row">
                <div class="inst-num">
                    <div class="inst-circle inst-circle-{{ $i }}">{{ $i }}</div>
                    <div class="inst-lbl">Inst {{ $i }}</div>
                </div>

                <div class="inst-field">
                    <label>Amount (₹)</label>
                    <input type="number"
                           name="inst{{ $i }}_amount"
                           value="{{ old('inst'.$i.'_amount', $amt) }}"
                           placeholder="0.00" min="0" step="0.01">
                </div>

                <div class="inst-field">
                    <label>Date Paid</label>
                    <input type="date"
                           name="inst{{ $i }}_date"
                           value="{{ old('inst'.$i.'_date', $dt ? $dt->format('Y-m-d') : '') }}">
                </div>

                <div class="inst-status-wrap">
                    <label class="inst-status-lbl">Status</label>
                    <div class="status-toggle">
                        <label class="st-btn st-btn-paid {{ $st === 'paid' ? 'active' : '' }}"
                               for="paid-{{ $i }}">✓ Paid</label>
                        <input type="radio" class="st-radio"
                               name="inst{{ $i }}_status"
                               id="paid-{{ $i }}"
                               value="paid"
                               {{ $st === 'paid' ? 'checked' : '' }}>

                        <label class="st-btn st-btn-pending {{ $st !== 'paid' ? 'active' : '' }}"
                               for="pending-{{ $i }}">⏳ Pending</label>
                        <input type="radio" class="st-radio"
                               name="inst{{ $i }}_status"
                               id="pending-{{ $i }}"
                               value="pending"
                               {{ $st !== 'paid' ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
            @endfor

            <div class="fs-save-row">
                <button type="submit" class="fs-btn-save">💾 Save All Installments</button>
            </div>
        </form>
    </div>
</div>

<script>
// Clicking a label activates it visually
document.querySelectorAll('.status-toggle').forEach(function (toggle) {
    toggle.querySelectorAll('input[type="radio"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            const t = this.closest('.status-toggle');
            t.querySelectorAll('.st-btn').forEach(function (b) { b.classList.remove('active'); });
            this.previousElementSibling.classList.add('active');
        });
    });
});
</script>
@endsection
