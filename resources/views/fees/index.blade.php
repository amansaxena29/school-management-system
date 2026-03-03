@extends('layouts.app')
@section('header', 'Fees')
@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap');
:root{--bg:#070d1c;--cyan:#0ff4c6;--indigo:#6470ff;--glass:rgba(12,22,48,0.75);--edge:rgba(255,255,255,0.08);--text:#eef4f8;--muted:rgba(200,220,235,0.6);}
*,*::before,*::after{box-sizing:border-box;}
.fi-bg{position:fixed;inset:0;z-index:-10;background:var(--bg);pointer-events:none;overflow:hidden;}
.fi-orb{position:absolute;border-radius:50%;filter:blur(90px);animation:orbD ease-in-out infinite alternate;}
.fi-orb:nth-child(1){width:700px;height:500px;background:radial-gradient(circle,rgba(100,112,255,0.22) 0%,transparent 70%);top:-150px;left:-100px;animation-duration:18s;}
.fi-orb:nth-child(2){width:600px;height:400px;background:radial-gradient(circle,rgba(15,244,198,0.14) 0%,transparent 70%);bottom:-100px;right:-100px;animation-duration:22s;animation-delay:-6s;}
@keyframes orbD{0%{transform:translate(0,0) scale(1);}100%{transform:translate(40px,30px) scale(1.1);}}
.fi-gridlines{position:fixed;inset:0;z-index:-9;pointer-events:none;
background-image:linear-gradient(rgba(15,244,198,0.018) 1px,transparent 1px),linear-gradient(90deg,rgba(15,244,198,0.018) 1px,transparent 1px);
background-size:65px 65px;}
.fi-wrap{font-family:'DM Sans',sans-serif;max-width:1140px;margin:0 auto;padding:40px 24px 80px;color:var(--text);}
.fi-head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;margin-bottom:40px;
opacity:0;animation:fadeUp 0.7s 0.1s cubic-bezier(0.16,1,0.3,1) forwards;}
@keyframes fadeUp{0%{opacity:0;transform:translateY(20px);}100%{opacity:1;transform:translateY(0);}}
.fi-badge{display:inline-flex;align-items:center;gap:7px;background:rgba(15,244,198,0.07);border:1px solid rgba(15,244,198,0.2);border-radius:99px;padding:4px 14px 4px 8px;margin-bottom:12px;}
.fi-badge .dot{width:7px;height:7px;border-radius:50%;background:var(--cyan);box-shadow:0 0 8px var(--cyan);animation:pulse 2s ease-in-out infinite;}
@keyframes pulse{0%,100%{transform:scale(1);opacity:1;}50%{transform:scale(1.5);opacity:0.5;}}
.fi-badge span{font-size:10px;font-weight:500;letter-spacing:.18em;text-transform:uppercase;color:var(--cyan);}
.fi-title{font-size:clamp(1.8rem,3vw,2.4rem);font-weight:700;margin:0 0 6px;
background:linear-gradient(90deg,var(--cyan),var(--indigo));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.fi-sub{color:var(--muted);font-size:0.9rem;margin:0;}
.fi-chip{background:rgba(15,244,198,0.07);border:1px solid rgba(15,244,198,0.2);border-radius:99px;padding:7px 18px;
font-size:12px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:var(--cyan);white-space:nowrap;align-self:center;}
.fi-cards{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
.fi-card{background:var(--glass);border:1px solid var(--edge);border-radius:20px;padding:28px 24px 22px;
text-decoration:none;color:var(--text);display:flex;flex-direction:column;position:relative;overflow:hidden;
backdrop-filter:blur(20px);box-shadow:0 20px 60px rgba(0,0,0,0.45);opacity:0;
transition:transform 0.3s ease,box-shadow 0.3s ease,border-color 0.3s ease;}
.fi-card:nth-child(1){animation:cardIn 0.6s 0.15s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(2){animation:cardIn 0.6s 0.22s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(3){animation:cardIn 0.6s 0.29s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(4){animation:cardIn 0.6s 0.36s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(5){animation:cardIn 0.6s 0.43s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(6){animation:cardIn 0.6s 0.50s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(7){animation:cardIn 0.6s 0.57s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(8){animation:cardIn 0.6s 0.64s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(9){animation:cardIn 0.6s 0.71s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(10){animation:cardIn 0.6s 0.78s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(11){animation:cardIn 0.6s 0.85s cubic-bezier(0.16,1,0.3,1) forwards;}
.fi-card:nth-child(12){animation:cardIn 0.6s 0.92s cubic-bezier(0.16,1,0.3,1) forwards;}
@keyframes cardIn{0%{opacity:0;transform:translateY(30px) scale(0.95);}100%{opacity:1;transform:translateY(0) scale(1);}}
.fi-card:hover{transform:translateY(-6px);box-shadow:0 28px 70px rgba(0,0,0,0.55),0 0 30px rgba(15,244,198,0.08);}
.fi-card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:3.5px;border-radius:20px 0 0 20px;}
.fi-card:nth-child(1)::before{background:#0ff4c6;}.fi-card:nth-child(2)::before{background:#22c55e;}
.fi-card:nth-child(3)::before{background:#a855f7;}.fi-card:nth-child(4)::before{background:#f97316;}
.fi-card:nth-child(5)::before{background:#ec4899;}.fi-card:nth-child(6)::before{background:#06b6d4;}
.fi-card:nth-child(7)::before{background:#ef4444;}.fi-card:nth-child(8)::before{background:#6470ff;}
.fi-card:nth-child(9)::before{background:#84cc16;}.fi-card:nth-child(10)::before{background:#f0c060;}
.fi-card:nth-child(11)::before{background:#38bdf8;}.fi-card:nth-child(12)::before{background:#fb923c;}
.fi-card:nth-child(1):hover{border-color:rgba(15,244,198,0.3);}
.fi-card:nth-child(2):hover{border-color:rgba(34,197,94,0.3);}
.fi-card:nth-child(3):hover{border-color:rgba(168,85,247,0.3);}
.fi-card:nth-child(4):hover{border-color:rgba(249,115,22,0.3);}
.fi-card:nth-child(5):hover{border-color:rgba(236,72,153,0.3);}
.fi-card:nth-child(6):hover{border-color:rgba(6,182,212,0.3);}
.fi-card:nth-child(7):hover{border-color:rgba(239,68,68,0.3);}
.fi-card:nth-child(8):hover{border-color:rgba(100,112,255,0.3);}
.fi-card:nth-child(9):hover{border-color:rgba(132,204,22,0.3);}
.fi-card:nth-child(10):hover{border-color:rgba(240,192,96,0.3);}
.fi-card:nth-child(11):hover{border-color:rgba(56,189,248,0.3);}
.fi-card:nth-child(12):hover{border-color:rgba(251,146,60,0.3);}
.fi-arrow{position:absolute;top:22px;right:20px;width:30px;height:30px;border-radius:50%;
background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);
display:flex;align-items:center;justify-content:center;font-size:13px;color:rgba(255,255,255,0.6);transition:all 0.2s;}
.fi-card:hover .fi-arrow{background:rgba(15,244,198,0.15);color:var(--cyan);border-color:rgba(15,244,198,0.3);}
.fi-card-num{font-size:13px;font-weight:700;letter-spacing:0.08em;margin-bottom:8px;opacity:0.7;}
.fi-card-name{font-size:1.25rem;font-weight:700;margin-bottom:12px;}
.fi-card-desc{font-size:0.78rem;color:var(--muted);line-height:1.55;margin-top:auto;}
@media(max-width:900px){.fi-cards{grid-template-columns:repeat(3,1fr);}}
@media(max-width:640px){.fi-cards{grid-template-columns:repeat(2,1fr);}}
@media(max-width:420px){.fi-cards{grid-template-columns:1fr;}}
</style>

<div class="fi-bg"><div class="fi-orb"></div><div class="fi-orb"></div></div>
<div class="fi-gridlines"></div>

<div class="fi-wrap">
    <div class="fi-head">
        <div>
            <div class="fi-badge"><div class="dot"></div><span>Fee Management</span></div>
            <h1 class="fi-title">Select Class to Manage Fees</h1>
            <p class="fi-sub">Click on a class to view students and manage their fee installments.</p>
        </div>
        <div class="fi-chip">Classes: 1 to 12</div>
    </div>

    <div class="fi-cards">
        @for($i = 1; $i <= 12; $i++)
        <a href="{{ route('fees.class', $i) }}" class="fi-card">
            <div class="fi-arrow">→</div>
            <div class="fi-card-num">CLASS {{ $i }}</div>
            <div class="fi-card-name">Class {{ $i }}</div>
            <div class="fi-card-desc">View students, log installments and track fee status.</div>
        </a>
        @endfor
    </div>
</div>
@endsection
