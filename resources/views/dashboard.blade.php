@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap');

/* ═══════════════════════════════════════
   ROOT TOKENS
═══════════════════════════════════════ */
:root {
    --bg:           #020510;
    --cyan:         #0ff4c6;
    --cyan-dim:     rgba(15,244,198,0.15);
    --cyan-glow:    rgba(15,244,198,0.08);
    --indigo:       #6470ff;
    --gold:         #f0c060;
    --gold-dim:     rgba(240,192,96,0.12);
    --rose:         #ff6b8a;
    --text-hi:      #eef4f8;
    --text-mid:     rgba(200,220,235,0.65);
    --text-lo:      rgba(180,200,220,0.35);
    --glass:        rgba(8,18,42,0.65);
    --glass-edge:   rgba(15,244,198,0.12);
    --glass-edge2:  rgba(255,255,255,0.06);
    --card-shadow:  0 40px 100px rgba(0,0,0,0.7), 0 0 0 1px rgba(15,244,198,0.06);
}

/* ═══════════════════════════════════════
   BASE RESET
═══════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; }

/* ═══════════════════════════════════════
   ANIMATED BACKGROUND SYSTEM
═══════════════════════════════════════ */
.bg-scene {
    position: fixed;
    inset: 0;
    z-index: -10;
    background: var(--bg);
    overflow: hidden;
    pointer-events: none;
}

/* Star field */
.bg-stars {
    position: absolute;
    inset: 0;
}

/* Aurora mesh */
.bg-aurora {
    position: absolute;
    inset: 0;
}

.aurora-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(90px);
    animation: orbDrift ease-in-out infinite alternate;
}

.aurora-orb:nth-child(1) {
    width: 800px; height: 600px;
    background: radial-gradient(circle, rgba(99,112,255,0.28) 0%, transparent 70%);
    top: -15%; left: -10%;
    animation-duration: 18s;
}
.aurora-orb:nth-child(2) {
    width: 700px; height: 500px;
    background: radial-gradient(circle, rgba(15,244,198,0.18) 0%, transparent 70%);
    top: 10%; right: -10%;
    animation-duration: 22s;
    animation-delay: -6s;
}
.aurora-orb:nth-child(3) {
    width: 600px; height: 400px;
    background: radial-gradient(circle, rgba(240,192,96,0.10) 0%, transparent 70%);
    bottom: 5%; left: 30%;
    animation-duration: 26s;
    animation-delay: -12s;
}
.aurora-orb:nth-child(4) {
    width: 500px; height: 350px;
    background: radial-gradient(circle, rgba(255,107,138,0.10) 0%, transparent 70%);
    top: 50%; right: 20%;
    animation-duration: 20s;
    animation-delay: -4s;
}

@keyframes orbDrift {
    0%   { transform: translate(0, 0) scale(1); opacity: 0.7; }
    100% { transform: translate(50px, 40px) scale(1.12); opacity: 1; }
}

/* Fine grid */
.bg-grid {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(15,244,198,0.022) 1px, transparent 1px),
        linear-gradient(90deg, rgba(15,244,198,0.022) 1px, transparent 1px);
    background-size: 70px 70px;
}

/* Scan line */
.bg-scanline {
    position: absolute;
    left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(15,244,198,0.35), transparent);
    animation: scan 8s linear infinite;
}

@keyframes scan {
    0%   { top: -2px; opacity: 0; }
    5%   { opacity: 1; }
    95%  { opacity: 0.5; }
    100% { top: 100%; opacity: 0; }
}

/* ═══════════════════════════════════════
   PAGE WRAPPER
═══════════════════════════════════════ */
.page-wrap {
    font-family: 'DM Sans', sans-serif;
    color: var(--text-hi);
    padding: 0 6%;
    max-width: 1400px;
    margin: 0 auto;
}

/* ═══════════════════════════════════════
   HERO SECTION
═══════════════════════════════════════ */
.hero {
    min-height: 90vh;
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    align-items: center;
    gap: 70px;
    padding: 100px 0 80px;
}

/* Hero left */
.hero-left {
    opacity: 0;
    animation: heroLeft 1s 0.2s cubic-bezier(0.16,1,0.3,1) forwards;
}

@keyframes heroLeft {
    0%   { opacity:0; transform: translateX(-50px) skewX(2deg); }
    100% { opacity:1; transform: translateX(0)     skewX(0); }
}

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(15,244,198,0.07);
    border: 1px solid rgba(15,244,198,0.2);
    border-radius: 99px;
    padding: 5px 16px 5px 10px;
    margin-bottom: 28px;
}

.hero-eyebrow .dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--cyan);
    box-shadow: 0 0 10px var(--cyan);
    animation: blink 2.2s ease-in-out infinite;
}

@keyframes blink {
    0%,100% { opacity:1; transform: scale(1); }
    50%     { opacity:0.4; transform: scale(0.7); }
}

.hero-eyebrow span {
    font-size: 10px;
    font-weight: 500;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--cyan);
}

.hero-h1 {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(3.6rem, 5vw, 5.4rem);
    font-weight: 700;
    line-height: 1.0;
    letter-spacing: -1px;
    color: #ec930d;
    margin-bottom: 10px;
}

.hero-h1 .line-accent {
    display: block;
    background: linear-gradient(100deg, var(--cyan) 0%, var(--indigo) 50%, var(--gold) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    background-size: 200% 100%;
    animation: gradShift 5s ease-in-out infinite alternate;
}

@keyframes gradShift {
    0%   { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
}

.hero-sub {
    font-size: 1.15rem;
    color: #024b6d;
    line-height: 1.75;
    max-width: 520px;
    margin: 28px 0 48px;
}

/* Hero cards stack */
.hero-stack {
    display: grid;
    gap: 18px;
}

.h-card {
    background: var(--glass);
    border: 1px solid var(--glass-edge2);
    border-radius: 20px;
    padding: 22px 26px;
    backdrop-filter: blur(20px);
    box-shadow: var(--card-shadow);
    display: flex;
    align-items: center;
    gap: 18px;
    position: relative;
    overflow: hidden;
    opacity: 0;
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    cursor: default;
}

.h-card:nth-child(1) { animation: cardIn 0.7s 0.7s  cubic-bezier(0.16,1,0.3,1) forwards; }
.h-card:nth-child(2) { animation: cardIn 0.7s 0.85s cubic-bezier(0.16,1,0.3,1) forwards; }
.h-card:nth-child(3) { animation: cardIn 0.7s 1.0s  cubic-bezier(0.16,1,0.3,1) forwards; }

@keyframes cardIn {
    0%   { opacity:0; transform: translateX(-30px); }
    100% { opacity:1; transform: translateX(0); }
}

.h-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(110deg, transparent 30%, rgba(15,244,198,0.04) 60%, transparent 90%);
    opacity: 0;
    transition: opacity 0.4s;
    pointer-events: none;
}

.h-card:hover {
    transform: translateX(6px);
    border-color: rgba(15,244,198,0.25);
    box-shadow: var(--card-shadow), 0 0 30px rgba(15,244,198,0.08);
}

.h-card:hover::before { opacity: 1; }

.h-card-icon {
    font-size: 26px;
    flex-shrink: 0;
    width: 52px; height: 52px;
    display: flex; align-items: center; justify-content: center;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 14px;
}

.h-card-text h3 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-hi);
    margin-bottom: 3px;
}

.h-card-text p {
    font-size: 0.83rem;
    color: var(--text-mid);
    line-height: 1.5;
}

/* Left edge accent */
.h-card::after {
    content: '';
    position: absolute;
    left: 0; top: 15%; bottom: 15%;
    width: 2.5px;
    border-radius: 99px;
    background: linear-gradient(180deg, var(--cyan), var(--indigo));
    opacity: 0;
    transition: opacity 0.3s;
}

.h-card:hover::after { opacity: 1; }

/* ── Hero right (legacy card) ── */
.hero-right {
    opacity: 0;
    animation: heroRight 1s 0.4s cubic-bezier(0.16,1,0.3,1) forwards;
}

@keyframes heroRight {
    0%   { opacity:0; transform: translateX(50px) rotateY(-8deg); filter: blur(6px); }
    100% { opacity:1; transform: translateX(0)    rotateY(0deg);  filter: blur(0); }
}

.legacy-card {
    background: var(--glass);
    border: 1px solid var(--glass-edge);
    border-radius: 28px;
    padding: 44px 38px;
    backdrop-filter: blur(28px);
    box-shadow: var(--card-shadow), 0 0 60px rgba(15,244,198,0.06);
    position: relative;
    overflow: hidden;
    text-align: center;
}

.legacy-card::before {
    content: '';
    position: absolute;
    top: 0; left: 10%; right: 10%;
    height: 1.5px;
    background: linear-gradient(90deg, transparent, var(--cyan), transparent);
    animation: lineShimmer 3.5s ease-in-out infinite;
    pointer-events: none;
}

@keyframes lineShimmer {
    0%,100% { opacity: 0.4; }
    50%      { opacity: 1; box-shadow: 0 0 12px var(--cyan); }
}

.legacy-year {
    font-family: 'Cormorant Garamond', serif;
    font-size: 5.5rem;
    font-weight: 700;
    line-height: 1;
    background: linear-gradient(135deg, var(--gold) 0%, var(--cyan) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 4px;
}

.legacy-card h3 {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--text-hi);
    margin-bottom: 14px;
}

.legacy-card p {
    color: var(--text-mid);
    font-size: 0.9rem;
    line-height: 1.75;
    margin-bottom: 28px;
}

.legacy-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
}

.tag {
    background: rgba(15,244,198,0.06);
    border: 1px solid rgba(15,244,198,0.18);
    border-radius: 99px;
    padding: 4px 14px;
    font-size: 10px;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--cyan);
}

/* ═══════════════════════════════════════
   STATS SECTION
═══════════════════════════════════════ */
.stats-section {
    padding: 80px 0 100px;
}

.section-label {
    text-align: center;
    margin-bottom: 60px;
    opacity: 0;
}

.section-label.visible {
    animation: fadeUp 0.8s cubic-bezier(0.16,1,0.3,1) forwards;
}

@keyframes fadeUp {
    0%   { opacity:0; transform: translateY(30px); }
    100% { opacity:1; transform: translateY(0); }
}

.section-label .over {
    font-size: 10px;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--cyan);
    margin-bottom: 10px;
}

.section-label h2 {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.4rem, 3.5vw, 3.2rem);
    font-weight: 600;
    color: #ec930d;
    line-height: 1.1;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px;
}

.stat-card {
    background: var(--glass);
    border: 1px solid var(--glass-edge2);
    border-radius: 26px;
    padding: 48px 28px 36px;
    text-align: center;
    backdrop-filter: blur(24px);
    box-shadow: var(--card-shadow);
    position: relative;
    overflow: hidden;
    opacity: 0;
    transition: transform 0.35s ease, box-shadow 0.35s ease;
    cursor: default;
}

.stat-card:nth-child(1) { animation: statPop 0.7s 0.1s cubic-bezier(0.16,1,0.3,1) forwards; }
.stat-card:nth-child(2) { animation: statPop 0.7s 0.25s cubic-bezier(0.16,1,0.3,1) forwards; }
.stat-card:nth-child(3) { animation: statPop 0.7s 0.4s  cubic-bezier(0.16,1,0.3,1) forwards; }
.stat-card:nth-child(4) { animation: statPop 0.7s 0.55s cubic-bezier(0.16,1,0.3,1) forwards; }

@keyframes statPop {
    0%   { opacity:0; transform: translateY(40px) scale(0.92); }
    100% { opacity:1; transform: translateY(0)    scale(1); }
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--card-shadow), 0 0 50px rgba(15,244,198,0.1);
}

/* Top colored stripe */
.stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: 26px 26px 0 0;
}

.stat-card:nth-child(1)::before { background: linear-gradient(90deg, var(--cyan), var(--indigo)); }
.stat-card:nth-child(2)::before { background: linear-gradient(90deg, var(--indigo), var(--rose)); }
.stat-card:nth-child(3)::before { background: linear-gradient(90deg, var(--gold), var(--cyan)); }
.stat-card:nth-child(4)::before { background: linear-gradient(90deg, var(--rose), var(--gold)); }

/* Corner glow per card */
.stat-card::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 100px;
    border-radius: 26px;
    opacity: 0.5;
    pointer-events: none;
}

.stat-card:nth-child(1)::after { background: radial-gradient(ellipse at 50% 0%, rgba(15,244,198,0.08), transparent); }
.stat-card:nth-child(2)::after { background: radial-gradient(ellipse at 50% 0%, rgba(100,112,255,0.08), transparent); }
.stat-card:nth-child(3)::after { background: radial-gradient(ellipse at 50% 0%, rgba(240,192,96,0.08), transparent); }
.stat-card:nth-child(4)::after { background: radial-gradient(ellipse at 50% 0%, rgba(255,107,138,0.08), transparent); }

.stat-icon {
    font-size: 2rem;
    margin-bottom: 16px;
    display: block;
}

.stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 4rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 10px;
    display: block;
}

.stat-card:nth-child(1) .stat-num { background: linear-gradient(135deg, var(--cyan), var(--indigo)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.stat-card:nth-child(2) .stat-num { background: linear-gradient(135deg, var(--indigo), var(--rose)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.stat-card:nth-child(3) .stat-num { background: linear-gradient(135deg, var(--gold), var(--cyan)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.stat-card:nth-child(4) .stat-num { background: linear-gradient(135deg, var(--rose), var(--gold)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

.stat-label {
    font-size: 10px;
    font-weight: 500;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--text-lo);
}

/* ═══════════════════════════════════════
   QUOTE SECTION
═══════════════════════════════════════ */
.quote-section {
    padding: 0 0 120px;
}

.quote-block {
    background: var(--glass);
    border: 1px solid var(--glass-edge);
    border-radius: 40px;
    padding: 80px 80px 70px;
    backdrop-filter: blur(28px);
    box-shadow: var(--card-shadow), 0 0 100px rgba(15,244,198,0.04);
    text-align: center;
    position: relative;
    overflow: hidden;
    opacity: 0;
}

.quote-block.visible {
    animation: fadeUp 1s cubic-bezier(0.16,1,0.3,1) forwards;
}

/* Big decorative quote mark */
.quote-block::before {
    content: '\201C';
    font-family: 'Cormorant Garamond', serif;
    font-size: 22rem;
    line-height: 0;
    position: absolute;
    top: 80px; left: 30px;
    color: rgba(15,244,198,0.04);
    pointer-events: none;
    user-select: none;
}

.quote-ornament {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-bottom: 36px;
}

.quote-ornament .line {
    width: 60px; height: 1px;
    background: linear-gradient(90deg, transparent, var(--cyan));
}

.quote-ornament .line:last-child {
    background: linear-gradient(90deg, var(--cyan), transparent);
}

.quote-ornament .diamond {
    width: 7px; height: 7px;
    background: var(--cyan);
    transform: rotate(45deg);
    box-shadow: 0 0 12px var(--cyan);
}

.quote-text {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(1.8rem, 3vw, 2.8rem);
    font-style: italic;
    color: var(--text-hi);
    line-height: 1.45;
    max-width: 780px;
    margin: 0 auto 32px;
    position: relative;
}

.quote-author {
    font-size: 0.85rem;
    color: var(--text-lo);
    letter-spacing: 0.18em;
    text-transform: uppercase;
}

.quote-author strong {
    display: block;
    font-size: 0.95rem;
    color: var(--cyan);
    letter-spacing: 0.1em;
    font-weight: 500;
    margin-bottom: 4px;
    font-style: normal;
}

/* ═══════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════ */
@media(max-width: 1100px) {
    .hero { grid-template-columns: 1fr; padding: 80px 0 60px; gap: 50px; }
    .stats-grid { grid-template-columns: repeat(2,1fr); }
    .quote-block { padding: 60px 40px; }
}

@media(max-width: 600px) {
    .stats-grid { grid-template-columns: 1fr; }
    .quote-block { padding: 50px 28px; border-radius: 28px; }
    .hero-h1 { font-size: 3.2rem; }
}
</style>

<!-- ══ BACKGROUND SCENE ══ -->
<div class="bg-scene">
    <div class="bg-stars" id="bgStars"></div>
    <div class="bg-aurora">
        <div class="aurora-orb"></div>
        <div class="aurora-orb"></div>
        <div class="aurora-orb"></div>
        <div class="aurora-orb"></div>
    </div>
    <div class="bg-grid"></div>
    <div class="bg-scanline"></div>
</div>

<div class="page-wrap">

    <!-- ══════════════════════════════
         HERO
    ══════════════════════════════ -->
    <section class="hero">
        <div class="hero-left">
            <div class="hero-eyebrow">
                <div class="dot"></div>
                <span>Arya Public Academy — Est. 2005</span>
            </div>

            <h1 class="hero-h1">
                The Future of<br>
                <span class="line-accent">School Education</span>
            </h1>

            <p class="hero-sub">
                A benchmark institution redefining learning through discipline,
                innovation, and excellence. We don't educate students —
                we create leaders.
            </p>

            <div class="hero-stack">
                <div class="h-card">
                    <div class="h-card-icon">🏫</div>
                    <div class="h-card-text">
                        <h3>World-Class Infrastructure</h3>
                        <p>Smart classrooms, digital labs, and a secure campus.</p>
                    </div>
                </div>
                <div class="h-card">
                    <div class="h-card-icon">🎓</div>
                    <div class="h-card-text">
                        <h3>Academic Excellence</h3>
                        <p>Outstanding results with holistic development.</p>
                    </div>
                </div>
                <div class="h-card">
                    <div class="h-card-icon">🚀</div>
                    <div class="h-card-text">
                        <h3>Future-Ready Learning</h3>
                        <p>Technology-driven education beyond textbooks.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-right">
            <div class="legacy-card">
                <div class="legacy-year">2005</div>
                <h3>📍 Established Legacy</h3>
                <p>
                    Founded with a vision of excellence, Arya Public Academy stands
                    as one of the most trusted and respected institutions in the region,
                    shaping generations of achievers.
                </p>
                <div class="legacy-tags">
                    <span class="tag">Award Winning</span>
                    <span class="tag">Trusted</span>
                    <span class="tag">20 Years Strong</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════
         STATS
    ══════════════════════════════ -->
    <section class="stats-section" id="statsSection">
        <div class="section-label" id="statsLabel">
            <p class="over">By the numbers</p>
            <h2>Our Impact at a Glance</h2>
        </div>

        <div class="stats-grid" id="statsGrid">
            <div class="stat-card">
                <span class="stat-icon">👨‍🎓</span>
                <span class="stat-num" data-target="200">0</span>
                <span class="stat-label">Students</span>
            </div>
            <div class="stat-card">
                <span class="stat-icon">👩‍🏫</span>
                <span class="stat-num" data-target=15">0</span>
                <span class="stat-label">Teachers</span>
            </div>
            <div class="stat-card">
                <span class="stat-icon">🏆</span>
                <span class="stat-num" data-target="99" data-suffix="%">0</span>
                <span class="stat-label">Results</span>
            </div>
            <div class="stat-card">
                <span class="stat-icon">📅</span>
                <span class="stat-num" data-target="20">0</span>
                <span class="stat-label">Years of Excellence</span>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════
         QUOTE
    ══════════════════════════════ -->
    <section class="quote-section">
        <div class="quote-block" id="quoteBlock">
            <div class="quote-ornament">
                <div class="line"></div>
                <div class="diamond"></div>
                <div class="line"></div>
            </div>

            <p class="quote-text">
                "Education is the most powerful investment
                a society can make in its future."
            </p>

            <div class="quote-author">
                <strong>Arya Public Academy</strong>
                Our guiding philosophy since 2005
            </div>
        </div>
    </section>

</div>

<script>
/* ── Star field generator ── */
(function() {
    const sf = document.getElementById('bgStars');
    if (!sf) return;
    for (let i = 0; i < 140; i++) {
        const s = document.createElement('div');
        const sz = Math.random() * 2 + 0.4;
        Object.assign(s.style, {
            position: 'absolute',
            borderRadius: '50%',
            background: '#fff',
            width:  sz + 'px',
            height: sz + 'px',
            top:  Math.random()*100 + '%',
            left: Math.random()*100 + '%',
            animation: `twinkle ${2+Math.random()*5}s ${Math.random()*6}s ease-in-out infinite`,
            opacity: Math.random() * 0.5 + 0.1,
        });
        sf.appendChild(s);
    }
})();

/* Inject twinkle keyframe */
const ks = document.createElement('style');
ks.textContent = `
@keyframes twinkle {
    0%,100% { opacity:0.1; transform:scale(1); }
    50%      { opacity:0.8; transform:scale(1.6); }
}`;
document.head.appendChild(ks);

/* ── Intersection Observer for scroll reveals ── */
const revealTargets = [
    { id: 'statsLabel',  cls: 'visible' },
    { id: 'quoteBlock',  cls: 'visible' },
];

const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.classList.add('visible');
            observer.unobserve(e.target);
        }
    });
}, { threshold: 0.2 });

revealTargets.forEach(({ id, cls }) => {
    const el = document.getElementById(id);
    if (el) observer.observe(el);
});

/* Stats grid scroll trigger */
const statsGrid = document.getElementById('statsGrid');
if (statsGrid) {
    const sgObs = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            statsGrid.querySelectorAll('.stat-card').forEach(c => {
                c.style.animationPlayState = 'running';
            });
            startCounters();
            sgObs.disconnect();
        }
    }, { threshold: 0.15 });
    sgObs.observe(statsGrid);

    /* Pause animations until visible */
    statsGrid.querySelectorAll('.stat-card').forEach(c => {
        c.style.animationPlayState = 'paused';
    });
}

/* ── Animated number counters ── */
function startCounters() {
    document.querySelectorAll('.stat-num[data-target]').forEach(el => {
        const target = parseInt(el.dataset.target);
        const suffix = el.dataset.suffix || '+';
        const dur    = 1800;
        const start  = performance.now();

        function tick(now) {
            const p = Math.min((now - start) / dur, 1);
            const ease = 1 - Math.pow(1 - p, 4); // easeOutQuart
            el.textContent = Math.round(ease * target) + suffix;
            if (p < 1) requestAnimationFrame(tick);
        }

        requestAnimationFrame(tick);
    });
}
</script>

@endsection
