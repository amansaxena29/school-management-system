@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap');

/* ═══════════════════════════════
   ROOT TOKENS
═══════════════════════════════ */
:root {
    --bg:        #070d1c;
    --surface:   rgba(14, 24, 52, 0.82);
    --edge:      rgba(15,244,198,0.14);
    --edge2:     rgba(255,255,255,0.08);
    --cyan:      #0ff4c6;
    --indigo:    #6470ff;
    --gold:      #f0c060;
    --rose:      #ff6b8a;
    --green:     #22d3a0;

    /* INPUT COLORS — high contrast so text is always visible */
    --input-bg:     #1a2540;
    --input-text:   #e8f0f8;
    --input-border: rgba(255,255,255,0.15);
    --input-focus:  rgba(15,244,198,0.5);

    --text-hi:   #eef4f8;
    --text-mid:  rgba(200,220,235,0.7);
    --text-lo:   rgba(180,200,220,0.4);
    --shadow:    0 24px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(15,244,198,0.06);
}

*, *::before, *::after { box-sizing: border-box; }

/* ═══════════════════════════════
   BACKGROUND
═══════════════════════════════ */
.cms-bg {
    position: fixed; inset: 0;
    z-index: -10;
    background: var(--bg);
    pointer-events: none;
    overflow: hidden;
}
.cms-bg-orb {
    position: absolute; border-radius: 50%;
    filter: blur(100px);
    animation: bgDrift ease-in-out infinite alternate;
}
.cms-bg-orb:nth-child(1) {
    width:700px; height:500px;
    background: radial-gradient(circle, rgba(100,112,255,0.2) 0%, transparent 70%);
    top:-150px; left:-100px; animation-duration:20s;
}
.cms-bg-orb:nth-child(2) {
    width:600px; height:450px;
    background: radial-gradient(circle, rgba(15,244,198,0.12) 0%, transparent 70%);
    bottom:-100px; right:-100px; animation-duration:24s; animation-delay:-8s;
}
.cms-bg-orb:nth-child(3) {
    width:400px; height:300px;
    background: radial-gradient(circle, rgba(240,192,96,0.07) 0%, transparent 70%);
    top:50%; left:50%; animation-duration:18s; animation-delay:-4s;
}
@keyframes bgDrift {
    0%   { transform: translate(0,0) scale(1); opacity:.7; }
    100% { transform: translate(40px,30px) scale(1.1); opacity:1; }
}
.cms-bg-grid {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(15,244,198,0.016) 1px, transparent 1px),
        linear-gradient(90deg, rgba(15,244,198,0.016) 1px, transparent 1px);
    background-size: 65px 65px;
}

/* ═══════════════════════════════
   PAGE WRAPPER
═══════════════════════════════ */
.cms-wrap {
    font-family: 'DM Sans', sans-serif;
    color: var(--text-hi);
    max-width: 960px;
    margin: 0 auto;
    padding: 44px 28px 80px;
}

/* ═══════════════════════════════
   PAGE HEADER
═══════════════════════════════ */
.cms-header {
    margin-bottom: 44px;
    opacity: 0;
    animation: slideDown 0.8s 0.1s cubic-bezier(0.16,1,0.3,1) forwards;
}
@keyframes slideDown {
    0%   { opacity:0; transform: translateY(-20px); }
    100% { opacity:1; transform: translateY(0); }
}
.cms-header-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(15,244,198,0.07);
    border: 1px solid rgba(15,244,198,0.2);
    border-radius: 99px;
    padding: 4px 14px 4px 8px;
    margin-bottom: 12px;
}
.cms-header-badge .dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: var(--cyan); box-shadow: 0 0 8px var(--cyan);
    animation: dotPulse 2s ease-in-out infinite;
}
@keyframes dotPulse {
    0%,100% { transform:scale(1); opacity:1; }
    50%      { transform:scale(1.5); opacity:0.5; }
}
.cms-header-badge span {
    font-size: 10px; font-weight: 500;
    letter-spacing: 0.18em; text-transform: uppercase; color: var(--cyan);
}
.cms-header h1 {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2rem, 4vw, 2.8rem);
    font-weight: 700; color: #ec930d;
    letter-spacing: -0.5px; margin-bottom: 6px;
}
.cms-header p { color: black; }

/* ═══════════════════════════════
   ALERTS
═══════════════════════════════ */
.cms-alert {
    display: flex; align-items: center; gap: 10px;
    padding: 13px 18px; border-radius: 10px;
    margin-bottom: 22px; font-size: 0.88rem; font-weight: 500;
    backdrop-filter: blur(12px);
}
.cms-alert-success {
    background: rgba(34,211,160,0.12);
    border: 1px solid rgba(34,211,160,0.35); color:black;
}
.cms-alert-error {
    background: rgba(255,107,138,0.12);
    border: 1px solid rgba(255,107,138,0.35); color: #ffaabe;
}

/* ═══════════════════════════════
   PANELS
═══════════════════════════════ */
.cms-panel {
    background: var(--surface);
    border: 1px solid var(--edge2);
    border-radius: 20px;
    padding: 30px 28px;
    backdrop-filter: blur(28px);
    -webkit-backdrop-filter: blur(28px);
    box-shadow: var(--shadow);
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
    opacity: 0;
    animation: panelRise 0.7s cubic-bezier(0.16,1,0.3,1) forwards;
}
.cms-panel:nth-child(1) { animation-delay:0.15s; }
.cms-panel:nth-child(2) { animation-delay:0.25s; }
.cms-panel:nth-child(3) { animation-delay:0.35s; }
.cms-panel:nth-child(4) { animation-delay:0.45s; }
.cms-panel:nth-child(5) { animation-delay:0.55s; }
@keyframes panelRise {
    0%   { opacity:0; transform: translateY(28px); }
    100% { opacity:1; transform: translateY(0); }
}
.cms-panel::before {
    content: '';
    position: absolute; top:0; left:8%; right:8%;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(15,244,198,0.3), transparent);
    pointer-events: none;
}

/* Panel header */
.cms-panel-header {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 24px; padding-bottom: 18px;
    border-bottom: 1px solid rgba(27, 93, 199, 0.07);
}
.cms-panel-icon {
    width: 42px; height: 42px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    background: rgba(15,244,198,0.08);
    border: 1px solid rgba(15,244,198,0.15);
    flex-shrink: 0;
}
.cms-panel-title { font-size: 1rem; font-weight: 600; color: var(--text-hi); }
.cms-panel-sub   { font-size: 0.77rem; color: var(--text-lo); margin-top: 2px; }

/* ═══════════════════════════════
   LABELS
═══════════════════════════════ */
.cms-label {
    display: block;
    font-size: 10px; font-weight: 500;
    letter-spacing: 0.16em; text-transform: uppercase;
    color: rgba(15,244,198,0.65);
    margin-bottom: 6px;
}

/* ═══════════════════════════════
   INPUTS — HIGH CONTRAST FIX
═══════════════════════════════ */
.cms-input,
.cms-textarea,
.cms-select {
    width: 100%;
    padding: 11px 14px;
    background: var(--input-bg);          /* solid dark blue — text always visible */
    border: 1px solid var(--input-border);
    border-radius: 10px;
    color: var(--input-text);             /* bright text */
    font-size: 0.88rem;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    line-height: 1.4;
}
.cms-input::placeholder,
.cms-textarea::placeholder { color: rgba(180,200,220,0.35); }

.cms-input:focus,
.cms-textarea:focus,
.cms-select:focus {
    border-color: var(--input-focus);
    box-shadow: 0 0 0 3px rgba(15,244,198,0.12);
    background: #1e2d4e;
}
.cms-textarea { resize: vertical; min-height: 90px; }

/* Select — custom arrow, readable text */
.cms-select {
    background-color: var(--input-bg);
    cursor: pointer;
    appearance: none; -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='7' viewBox='0 0 12 7'%3E%3Cpath stroke='rgba(15,244,198,0.7)' stroke-width='1.5' fill='none' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 13px center;
    padding-right: 36px;
}
.cms-select option {
    background: #1a2540;
    color: var(--input-text);
}

/* Date input — calendar icon visible */
.cms-input[type="date"] {
    color-scheme: dark;
    color: var(--input-text);
}

/* File input */
.cms-file-input {
    display: block; margin-top: 5px;
    font-size: 0.82rem; color: var(--text-mid);
}
.cms-file-input::-webkit-file-upload-button {
    background: rgba(15,244,198,0.1);
    border: 1px solid rgba(15,244,198,0.28);
    color: var(--cyan);
    padding: 7px 14px; border-radius: 7px;
    cursor: pointer; font-size: 0.8rem;
    font-family: 'DM Sans', sans-serif;
    transition: background 0.2s;
    margin-right: 8px;
}
.cms-file-input::-webkit-file-upload-button:hover { background: rgba(15,244,198,0.18); }

/* ═══════════════════════════════
   FIELD WRAPPER
═══════════════════════════════ */
.cms-field { margin-bottom: 16px; }

/* ═══════════════════════════════
   2-COLUMN GRID (settings / announcements)
═══════════════════════════════ */
.cms-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 0;
}
.cms-grid-2 .span-2 { grid-column: 1 / -1; }

/* ═══════════════════════════════
   COURSE / ACHIEVEMENT ADD ROW
   — label row + input row separated
═══════════════════════════════ */
.cms-add-row {
    display: grid;
    gap: 10px;
    margin-bottom: 20px;
    align-items: end;
}
/* courses: title | description | button */
.cms-add-row-courses {
    grid-template-columns: 1fr 2fr auto;
}
/* achievements: input | button */
.cms-add-row-ach {
    grid-template-columns: 1fr auto;
}
/* gallery-or row */
.cms-add-row-gallery {
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
}

.cms-or-divider {
    display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem; font-weight: 600;
    letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--text-lo);
    padding: 0 4px;
    padding-top: 22px; /* align with inputs (label height offset) */
}

/* Button aligns to bottom of its cell */
.cms-btn-cell {
    display: flex; align-items: flex-end;
}

/* ═══════════════════════════════
   BUTTONS
═══════════════════════════════ */
.cms-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 11px 20px; border: none; border-radius: 10px;
    font-size: 11px; font-weight: 500;
    font-family: 'DM Sans', sans-serif;
    letter-spacing: 0.12em; text-transform: uppercase;
    cursor: pointer; white-space: nowrap;
    transition: all 0.25s ease;
    position: relative; overflow: hidden;
    height: 42px; /* fixed height to match inputs */
}
.cms-btn::before {
    content: '';
    position: absolute; top:0; left:-100%;
    width:100%; height:100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
    transition: left 0.5s; pointer-events: none;
}
.cms-btn:hover::before { left: 100%; }

.cms-btn-primary {
    background: linear-gradient(135deg, var(--cyan), #00d4a8);
    color: #041020; box-shadow: 0 5px 18px rgba(15,244,198,0.28);
}
.cms-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 9px 28px rgba(15,244,198,0.4); }

.cms-btn-success {
    background: linear-gradient(135deg, #22d3a0, #16a34a);
    color: #fff; box-shadow: 0 5px 18px rgba(34,211,160,0.25);
}
.cms-btn-success:hover { transform: translateY(-2px); box-shadow: 0 9px 26px rgba(34,211,160,0.38); }

.cms-btn-info {
    background: linear-gradient(135deg, var(--indigo), #4f46e5);
    color: #fff; box-shadow: 0 5px 18px rgba(100,112,255,0.28);
}
.cms-btn-info:hover { transform: translateY(-2px); box-shadow: 0 9px 26px rgba(100,112,255,0.4); }

.cms-btn-danger {
    background: rgba(255,107,138,0.12);
    border: 1px solid rgba(255,107,138,0.28);
    color: #ff9aae;
}
.cms-btn-danger:hover { background: rgba(255,107,138,0.22); border-color: rgba(255,107,138,0.5); transform: translateY(-1px); }

.cms-btn-muted {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12); color: var(--text-mid);
}
.cms-btn-muted:hover { background: rgba(255,255,255,0.12); color: var(--text-hi); }

.cms-btn-show {
    background: rgba(34,211,160,0.1);
    border: 1px solid rgba(34,211,160,0.28); color: var(--green);
}
.cms-btn-show:hover { background: rgba(34,211,160,0.2); }

.cms-btn-sm { height: 36px; padding: 0 13px; font-size: 10px; }

/* ═══════════════════════════════
   COURSE / ACHIEVEMENT ITEM ROWS
═══════════════════════════════ */
.cms-item {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 12px;
    padding: 12px 14px;
    margin-bottom: 8px;
    transition: border-color 0.2s, background 0.2s;
}
.cms-item:hover {
    border-color: rgba(15,244,198,0.2);
    background: rgba(15,244,198,0.025);
}

/* Aligned flex row inside items */
.cms-item-flex {
    display: flex; gap: 10px; align-items: center; flex-wrap: wrap;
}
/* title + desc + update + delete all inline, same height */
.cms-item-flex .cms-input {
    flex: 1; min-width: 110px;
    height: 38px; padding: 0 12px;
}
.cms-item-flex .cms-input.wider { flex: 2; min-width: 160px; }
.cms-item-flex .cms-btn-sm { flex-shrink: 0; }

/* ═══════════════════════════════
   GALLERY
═══════════════════════════════ */
.cms-gallery-upload-box {
    background: rgba(255,255,255,0.02);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 20px;
}

/* Upload row: [file block] [OR] [url block] */
.cms-gallery-upload-row {
    display: grid;
    grid-template-columns: 1fr 32px 1fr;
    gap: 12px;
    align-items: center;
    margin-bottom: 14px;
}
.cms-gallery-or {
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 700;
    letter-spacing: 0.15em; color: var(--text-lo);
}

/* Caption + button row */
.cms-gallery-caption-row {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 12px;
    align-items: end;
}

.cms-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 12px;
    margin-top: 4px;
}
.cms-gallery-item {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 12px; overflow: hidden;
    transition: all 0.3s ease;
}
.cms-gallery-item:hover {
    border-color: rgba(15,244,198,0.3);
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.4);
}
.cms-gallery-item img {
    width: 100%; height: 110px; object-fit: cover;
    display: block; transition: transform 0.4s ease;
}
.cms-gallery-item:hover img { transform: scale(1.06); }
.cms-gallery-caption-text { font-size: 0.72rem; color: var(--text-mid); padding: 6px 9px 4px; }
.cms-gallery-del-wrap { padding: 0 8px 9px; }

/* ═══════════════════════════════
   ANNOUNCEMENTS
═══════════════════════════════ */
.cms-ann-form-box {
    background: rgba(255,255,255,0.025);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 22px;
}
.cms-ann {
    border-radius: 12px; padding: 15px 16px;
    margin-bottom: 10px; border: 1px solid;
    transition: transform 0.2s;
}
.cms-ann:hover { transform: translateX(4px); }
.cms-ann-info    { background: rgba(37,99,235,0.08);  border-color: rgba(37,99,235,0.22); }
.cms-ann-success { background: rgba(22,163,74,0.08);  border-color: rgba(22,163,74,0.22); }
.cms-ann-warning { background: rgba(234,88,12,0.08);  border-color: rgba(234,88,12,0.22); }
.cms-ann-urgent  { background: rgba(220,38,38,0.08);  border-color: rgba(220,38,38,0.22); }
.cms-ann-inactive { opacity: 0.5; }

.cms-ann-layout {
    display: flex; align-items: flex-start;
    justify-content: space-between; gap: 12px; flex-wrap: wrap;
}
.cms-ann-meta {
    display: flex; align-items: center;
    gap: 7px; flex-wrap: wrap; margin-bottom: 5px;
}
.cms-badge {
    font-size: 9px; font-weight: 700;
    letter-spacing: 0.1em; text-transform: uppercase;
    padding: 2px 9px; border-radius: 99px; border: 1px solid;
}
.badge-info    { background: rgba(37,99,235,0.2);  color: #93c5fd; border-color: rgba(37,99,235,0.35); }
.badge-success { background: rgba(22,163,74,0.2);  color: #86efac; border-color: rgba(22,163,74,0.35); }
.badge-warning { background: rgba(234,88,12,0.2);  color: #fdba74; border-color: rgba(234,88,12,0.35); }
.badge-urgent  { background: rgba(220,38,38,0.2);  color: #fca5a5; border-color: rgba(220,38,38,0.35); }
.badge-inactive { background: rgba(100,116,139,0.15); color: #94a3b8; border-color: rgba(100,116,139,0.3); }

.cms-ann-title  { font-weight: 600; color: var(--text-hi); font-size: 0.9rem; margin-bottom: 3px; }
.cms-ann-body   { font-size: 0.8rem; color: var(--text-mid); line-height: 1.5; }
.cms-ann-footer { font-size: 0.7rem; color: var(--text-lo); margin-top: 7px; }
.cms-ann-actions { display: flex; gap: 6px; flex-shrink: 0; align-self: flex-start; }

/* Empty state */
.cms-empty {
    text-align: center; padding: 36px 20px;
    background: rgba(255,255,255,0.02);
    border: 1px dashed rgba(255,255,255,0.08);
    border-radius: 12px; color: var(--text-lo);
}
.cms-empty .cms-empty-icon { font-size: 2rem; margin-bottom: 8px; }
.cms-empty p { font-size: 0.83rem; }

/* Gallery tabs */
.cms-gallery-tabs {
    display: flex; gap: 8px; margin-bottom: 20px;
}
.cms-gtab {
    padding: 9px 20px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.05); color: var(--text-mid);
    font-size: 12px; font-weight: 600; font-family: 'DM Sans', sans-serif;
    letter-spacing: 0.08em; cursor: pointer; transition: all 0.2s;
}
.cms-gtab.active {
    background: rgba(15,244,198,0.12);
    border-color: rgba(15,244,198,0.35);
    color: var(--cyan);
}
.cms-gtab:hover:not(.active) { background: rgba(255,255,255,0.08); color: var(--text-hi); }

/* Video item badge */
.cms-video-item { position: relative; }
.cms-video-play-badge {
    position: absolute; top: 8px; right: 8px;
    background: rgba(100,112,255,0.85);
    color: #fff; font-size: 9px; font-weight: 700;
    letter-spacing: 0.1em; padding: 3px 8px;
    border-radius: 99px;
}

/* Responsive */
@media(max-width: 700px) {
    .cms-wrap { padding: 28px 14px 60px; }
    .cms-panel { padding: 20px 16px; }
    .cms-grid-2, .cms-add-row-courses, .cms-gallery-upload-row { grid-template-columns: 1fr; }
    .cms-grid-2 .span-2 { grid-column: 1; }
    .cms-add-row-courses .cms-btn-cell,
    .cms-gallery-or { display: none; }
}
</style>

<!-- Background -->
<div class="cms-bg">
    <div class="cms-bg-orb"></div>
    <div class="cms-bg-orb"></div>
    <div class="cms-bg-orb"></div>
    <div class="cms-bg-grid"></div>
</div>

<div class="cms-wrap">

    <!-- Header -->
    <div class="cms-header">
        <div class="cms-header-badge">
            <div class="dot"></div>
            <span>Content Management System</span>
        </div>
        <h1>Website CMS</h1>
        <p>Manage your homepage content from one place.</p>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="cms-alert cms-alert-success">✅ &nbsp;{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="cms-alert cms-alert-error">❌ &nbsp;{{ $errors->first() }}</div>
    @endif

    {{-- ════════════════════════════════
         HERO & ABOUT SETTINGS
    ════════════════════════════════ --}}
    <div class="cms-panel">
        <div class="cms-panel-header">
            <div class="cms-panel-icon">⚙️</div>
            <div>
                <div class="cms-panel-title">Hero, About &amp; Footer Settings</div>
                <div class="cms-panel-sub">Configure your public homepage appearance</div>
            </div>
        </div>

        <form method="POST" action="{{ route('cms.settings.update') }}">
            @csrf

            <div class="cms-field">
                <label class="cms-label">Hero Title</label>
                <input class="cms-input" type="text" name="hero_title"
                       value="{{ \App\Models\SiteSetting::get('hero_title', 'Welcome to Your School') }}">
            </div>

            <div class="cms-field">
                <label class="cms-label">Hero Subtitle</label>
                <input class="cms-input" type="text" name="hero_subtitle"
                       value="{{ \App\Models\SiteSetting::get('hero_subtitle', 'Empowering students with creativity, knowledge, and confidence') }}">
            </div>

            <div class="cms-field">
                <label class="cms-label">About Us Text</label>
                <textarea class="cms-textarea" name="about_text" rows="4">{{ \App\Models\SiteSetting::get('about_text', 'Our school fosters academic excellence...') }}</textarea>
            </div>

            <div class="cms-grid-2" style="margin-bottom:20px;">
                <div>
                    <label class="cms-label">Footer Contact Number</label>
                    <input class="cms-input" type="text" name="footer_contact"
                           value="{{ \App\Models\SiteSetting::get('footer_contact', '8127515044') }}">
                </div>
                <div>
                    <label class="cms-label">Footer Address</label>
                    <input class="cms-input" type="text" name="footer_address"
                           value="{{ \App\Models\SiteSetting::get('footer_address', 'Kusmara, Jalaun (U.P)') }}">
                </div>
            </div>

            <button type="submit" class="cms-btn cms-btn-primary">💾 Save Settings</button>
        </form>
    </div>

    {{-- ════════════════════════════════
         COURSES
    ════════════════════════════════ --}}
    <div class="cms-panel">
        <div class="cms-panel-header">
            <div class="cms-panel-icon">📚</div>
            <div>
                <div class="cms-panel-title">Courses</div>
                <div class="cms-panel-sub">Add, edit or remove courses shown on the homepage</div>
            </div>
        </div>

        {{-- Add form: labels on top, inputs on bottom, button aligned --}}
        <form method="POST" action="{{ route('cms.courses.store') }}">
            @csrf
            <div class="cms-add-row cms-add-row-courses">
                <div>
                    <label class="cms-label">Course Title</label>
                    <input class="cms-input" type="text" name="title" placeholder="e.g. Science" required>
                </div>
                <div>
                    <label class="cms-label">Description</label>
                    <input class="cms-input" type="text" name="description" placeholder="Short description..." required>
                </div>
                <div class="cms-btn-cell">
                    <button type="submit" class="cms-btn cms-btn-success" style="width:100%;">+ Add</button>
                </div>
            </div>
        </form>

        @forelse($courses as $course)
            <div class="cms-item">
                <div class="cms-item-flex">
                    <form method="POST" action="{{ route('cms.courses.update', $course) }}"
                          style="display:contents;">
                        @csrf @method('PUT')
                        <input class="cms-input" type="text" name="title"
                               value="{{ $course->title }}" required>
                        <input class="cms-input wider" type="text" name="description"
                               value="{{ $course->description }}" required>
                        <button type="submit" class="cms-btn cms-btn-info cms-btn-sm">Update</button>
                    </form>
                    <form method="POST" action="{{ route('cms.courses.delete', $course) }}"
                          onsubmit="return confirm('Delete this course?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="cms-btn cms-btn-danger cms-btn-sm">🗑</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="cms-empty">
                <div class="cms-empty-icon">📚</div>
                <p>No courses yet. Add one above.</p>
            </div>
        @endforelse
    </div>

    {{-- ════════════════════════════════
     GALLERY
════════════════════════════════ --}}
<div class="cms-panel">
    <div class="cms-panel-header">
        <div class="cms-panel-icon">🖼️</div>
        <div>
            <div class="cms-panel-title">Gallery</div>
            <div class="cms-panel-sub">Upload images and videos for the public gallery</div>
        </div>
    </div>

    {{-- Tab switcher --}}
    <div class="cms-gallery-tabs">
        <button class="cms-gtab active" onclick="switchGalleryTab('images', this)">🖼️ Images</button>
        <button class="cms-gtab" onclick="switchGalleryTab('videos', this)">🎬 Videos</button>
    </div>

    {{-- IMAGE UPLOAD FORM --}}
    <div id="gallery-tab-images">
        <form method="POST" action="{{ route('cms.gallery.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="cms-gallery-upload-box">
                <div class="cms-gallery-upload-row">
                    <div>
                        <label class="cms-label">Upload Image File</label>
                        <input type="file" name="image_file" accept="image/*" class="cms-file-input">
                    </div>
                    <div class="cms-gallery-or">OR</div>
                    <div>
                        <label class="cms-label">Paste Image URL</label>
                        <input class="cms-input" type="url" name="image_url" placeholder="https://...">
                    </div>
                </div>
                <div class="cms-gallery-caption-row">
                    <div>
                        <label class="cms-label">Caption (Optional)</label>
                        <input class="cms-input" type="text" name="caption" placeholder="e.g. Sports Day">
                    </div>
                    <div class="cms-btn-cell">
                        <button type="submit" class="cms-btn cms-btn-success">+ Add Image</button>
                    </div>
                </div>
            </div>
        </form>

        {{-- IMAGE GRID --}}
        <div class="cms-gallery-grid">
            @php $images = $gallery->where('type', 'image'); @endphp
            @forelse($images as $img)
                <div class="cms-gallery-item">
                    <img src="{{ $img->is_url ? $img->image_path : asset('storage/'.$img->image_path) }}"
                         alt="{{ $img->caption }}">
                    @if($img->caption)
                        <div class="cms-gallery-caption-text">{{ $img->caption }}</div>
                    @endif
                    <div class="cms-gallery-del-wrap">
                        <form method="POST" action="{{ route('cms.gallery.delete', $img) }}"
                              onsubmit="return confirm('Delete this image?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-danger cms-btn-sm" style="width:100%;">🗑 Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="cms-empty" style="grid-column:1/-1;">
                    <div class="cms-empty-icon">🖼️</div>
                    <p>No images yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- VIDEO UPLOAD FORM --}}
    <div id="gallery-tab-videos" style="display:none;">
        <form method="POST" action="{{ route('cms.video.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="cms-gallery-upload-box">
                <div class="cms-gallery-upload-row">
                    <div>
                        <label class="cms-label">Upload Video File (MP4, max 50MB)</label>
                        <input type="file" name="video_file" accept="video/*" class="cms-file-input">
                    </div>
                    <div class="cms-gallery-or">OR</div>
                    <div>
                        <label class="cms-label">Paste YouTube / Video URL</label>
                        <input class="cms-input" type="url" name="video_url" placeholder="https://youtube.com/...">
                    </div>
                </div>
                <div class="cms-gallery-caption-row">
                    <div>
                        <label class="cms-label">Caption (Optional)</label>
                        <input class="cms-input" type="text" name="caption" placeholder="e.g. Annual Day 2025">
                    </div>
                    <div class="cms-btn-cell">
                        <button type="submit" class="cms-btn cms-btn-success">+ Add Video</button>
                    </div>
                </div>
            </div>
        </form>

        {{-- VIDEO GRID --}}
        <div class="cms-gallery-grid">
            @php $videos = $gallery->where('type', 'video'); @endphp
            @forelse($videos as $vid)
                <div class="cms-gallery-item cms-video-item">
                    @if($vid->is_url)
                        @php
                            // Convert YouTube watch URL to embed
                            $yUrl = $vid->image_path;
                            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $yUrl, $m);
                            $ytId = $m[1] ?? null;
                        @endphp
                        @if($ytId)
                            <img src="https://img.youtube.com/vi/{{ $ytId }}/hqdefault.jpg"
                                 alt="{{ $vid->caption }}" style="width:100%;height:110px;object-fit:cover;">
                            <div class="cms-video-play-badge">▶ YouTube</div>
                        @else
                            <div style="width:100%;height:110px;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.05);font-size:2rem;">🎬</div>
                            <div class="cms-video-play-badge">▶ Video URL</div>
                        @endif
                    @else
                        <div style="width:100%;height:110px;display:flex;align-items:center;justify-content:center;background:rgba(100,112,255,0.1);font-size:2.5rem;">🎬</div>
                        <div class="cms-video-play-badge">▶ Uploaded</div>
                    @endif

                    @if($vid->caption)
                        <div class="cms-gallery-caption-text">{{ $vid->caption }}</div>
                    @endif
                    <div class="cms-gallery-del-wrap">
                        <form method="POST" action="{{ route('cms.gallery.delete', $vid) }}"
                              onsubmit="return confirm('Delete this video?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-danger cms-btn-sm" style="width:100%;">🗑 Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="cms-empty" style="grid-column:1/-1;">
                    <div class="cms-empty-icon">🎬</div>
                    <p>No videos yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

    {{-- ════════════════════════════════
         ACHIEVEMENTS
    ════════════════════════════════ --}}
    <div class="cms-panel">
        <div class="cms-panel-header">
            <div class="cms-panel-icon">🏆</div>
            <div>
                <div class="cms-panel-title">Achievements</div>
                <div class="cms-panel-sub">Showcase your school's milestones</div>
            </div>
        </div>

        <form method="POST" action="{{ route('cms.achievements.store') }}">
            @csrf
            <div class="cms-add-row cms-add-row-ach">
                <div>
                    <label class="cms-label">Achievement Title</label>
                    <input class="cms-input" type="text" name="title"
                           placeholder="e.g. Won National Science Award 2025" required>
                </div>
                <div class="cms-btn-cell">
                    <button type="submit" class="cms-btn cms-btn-success" style="width:100%;">+ Add</button>
                </div>
            </div>
        </form>

        @forelse($achievements as $ach)
            <div class="cms-item">
                <div class="cms-item-flex">
                    <form method="POST" action="{{ route('cms.achievements.update', $ach) }}"
                          style="display:contents;">
                        @csrf @method('PUT')
                        <input class="cms-input" type="text" name="title"
                               value="{{ $ach->title }}" required>
                        <button type="submit" class="cms-btn cms-btn-info cms-btn-sm">Update</button>
                    </form>
                    <form method="POST" action="{{ route('cms.achievements.delete', $ach) }}"
                          onsubmit="return confirm('Delete this achievement?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="cms-btn cms-btn-danger cms-btn-sm">🗑</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="cms-empty">
                <div class="cms-empty-icon">🏆</div>
                <p>No achievements yet. Add one above.</p>
            </div>
        @endforelse
    </div>

    {{-- ════════════════════════════════
         ANNOUNCEMENTS
    ════════════════════════════════ --}}
    <div class="cms-panel">
        <div class="cms-panel-header">
            <div class="cms-panel-icon">📢</div>
            <div>
                <div class="cms-panel-title">Announcements</div>
                <div class="cms-panel-sub">These appear on the public website below Achievements</div>
            </div>
        </div>

        <div class="cms-ann-form-box">
            <form method="POST" action="{{ route('cms.announcements.store') }}">
                @csrf

                <div class="cms-field">
                    <label class="cms-label">Title <span style="color:var(--rose);">*</span></label>
                    <input class="cms-input" type="text" name="title" required
                           placeholder="e.g. Annual Sports Day – 15 March 2026">
                </div>

                <div class="cms-field">
                    <label class="cms-label">Details (Optional)</label>
                    <textarea class="cms-textarea" name="body" rows="2"
                              placeholder="Additional details about the announcement..."></textarea>
                </div>

                <div class="cms-grid-2" style="margin-bottom:18px;">
                    <div>
                        <label class="cms-label">Type <span style="color:var(--rose);">*</span></label>
                        <select class="cms-select" name="type" required>
                            <option value="info">📘 Info (Blue)</option>
                            <option value="success">📗 Success (Green)</option>
                            <option value="warning">📙 Warning (Orange)</option>
                            <option value="urgent">📕 Urgent (Red)</option>
                        </select>
                    </div>
                    <div>
                        <label class="cms-label">Expires On (Optional)</label>
                        <input class="cms-input" type="date" name="expires_at"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    </div>
                </div>

                <button type="submit" class="cms-btn cms-btn-primary">📢 Add Announcement</button>
            </form>
        </div>

        @php
            $typeMap = [
                'info'    => ['cls'=>'cms-ann-info',    'badge'=>'badge-info',    'label'=>'Info'],
                'success' => ['cls'=>'cms-ann-success', 'badge'=>'badge-success', 'label'=>'Success'],
                'warning' => ['cls'=>'cms-ann-warning', 'badge'=>'badge-warning', 'label'=>'Warning'],
                'urgent'  => ['cls'=>'cms-ann-urgent',  'badge'=>'badge-urgent',  'label'=>'Urgent'],
            ];
        @endphp

        @forelse($announcements as $ann)
            @php $t = $typeMap[$ann->type] ?? $typeMap['info']; @endphp
            <div class="cms-ann {{ $t['cls'] }} {{ !$ann->is_active ? 'cms-ann-inactive' : '' }}">
                <div class="cms-ann-layout">
                    <div style="flex:1; min-width:200px;">
                        <div class="cms-ann-meta">
                            <span class="cms-badge {{ $t['badge'] }}">{{ strtoupper($ann->type) }}</span>
                            @if(!$ann->is_active)
                                <span class="cms-badge badge-inactive">Inactive</span>
                            @endif
                            @if($ann->expires_at)
                                <span style="font-size:0.7rem; color:var(--text-lo);">⏳ {{ $ann->expires_at->format('d M Y') }}</span>
                            @endif
                        </div>
                        <div class="cms-ann-title">{{ $ann->title }}</div>
                        @if($ann->body)
                            <div class="cms-ann-body">{{ $ann->body }}</div>
                        @endif
                        <div class="cms-ann-footer">Added {{ $ann->created_at->format('d M Y') }}</div>
                    </div>

                    <div class="cms-ann-actions">
                        <form method="POST" action="{{ route('cms.announcements.toggle', $ann) }}">
                            @csrf @method('PATCH')
                            @if($ann->is_active)
                                <button type="submit" class="cms-btn cms-btn-muted cms-btn-sm">⏸ Hide</button>
                            @else
                                <button type="submit" class="cms-btn cms-btn-show cms-btn-sm">▶ Show</button>
                            @endif
                        </form>
                        <form method="POST" action="{{ route('cms.announcements.delete', $ann) }}"
                              onsubmit="return confirm('Delete this announcement?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-danger cms-btn-sm">🗑</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="cms-empty">
                <div class="cms-empty-icon">📢</div>
                <p>No announcements yet. Add one above.</p>
            </div>
        @endforelse
    </div>

</div>
<script>
function switchGalleryTab(tab, btn) {
    document.getElementById('gallery-tab-images').style.display = tab === 'images' ? 'block' : 'none';
    document.getElementById('gallery-tab-videos').style.display = tab === 'videos' ? 'block' : 'none';
    document.querySelectorAll('.cms-gtab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}
</script>
@endsection
