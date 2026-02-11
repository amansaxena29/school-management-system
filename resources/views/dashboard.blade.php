@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')

<style>
/* ================= ROOT TOKENS ================= */
:root {
    --bg-main: #050816;
    --glass-bg: rgba(15, 23, 42, 0.72);
    --glass-border: rgba(255,255,255,0.08);
    --accent-cyan: #22d3ee;
    --accent-indigo: #6366f1;
    --accent-gold: #ec930d;
    --text-main: #e5e7eb;
    --text-soft: #b6c2ff;
}

/* ================= GLOBAL BACKDROP ================= */
.bg-art {
    position: fixed;
    inset: 0;
    background:
        radial-gradient(circle at 20% 20%, rgba(99,102,241,0.45), transparent 45%),
        radial-gradient(circle at 80% 10%, rgba(34,211,238,0.35), transparent 40%),
        radial-gradient(circle at 50% 90%, rgba(14,165,233,0.35), transparent 45%);
    z-index: -3;
}

.noise {
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
    z-index: -2;
}

/* ================= HERO ================= */
.hero {
    min-height: 92vh;
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    align-items: center;
    padding: 90px 8%;
    gap: 80px;
}

.hero h1 {
    font-size: clamp(3.8rem, 5vw, 5.2rem);
    font-weight: 900;
    line-height: 1.03;
    color: var(--text-main);
    letter-spacing: -2px;
}

.hero h1 span {
    background: linear-gradient(90deg, var(--accent-cyan), var(--accent-indigo));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero p {
    font-size: 1.25rem;
    color: var(--text-soft);
    max-width: 560px;
    margin: 36px 0 44px;
}

/* ================= GLASS CARDS ================= */
.stack {
    display: grid;
    gap: 26px;
}

.stack-card {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    padding: 26px 30px;
    border-radius: 22px;
    backdrop-filter: blur(18px);
    box-shadow:
        0 30px 80px rgba(0,0,0,0.65),
        inset 0 1px 0 rgba(255,255,255,0.06);
    position: relative;
    overflow: hidden;
}

.stack-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,0.08),
        transparent
    );
    opacity: 0;
    transition: opacity .5s ease;
}

.stack-card:hover::before {
    opacity: 1;
}

.stack-card h3 {
    font-size: 1.5rem;
    color: #e0f2fe;
    margin-bottom: 8px;
}

.stack-card p {
    color: #bac6ff;
    line-height: 1.6;
}

/* ================= STATS ================= */
.stats {
    margin: 140px auto;
    max-width: 1200px;
    display: grid;
    grid-template-columns: repeat(4,1fr);
    gap: 36px;
}

.stat {
    background: linear-gradient(160deg, #020617, #0f172a);
    padding: 52px 30px;
    border-radius: 30px;
    text-align: center;
    box-shadow: 0 40px 110px rgba(0,0,0,0.75);
    border-top: 3px solid var(--accent-cyan);
    position: relative;
}

.stat h2 {
    font-size: 3.8rem;
    font-weight: 900;
    background: linear-gradient(90deg, var(--accent-cyan), var(--accent-indigo));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stat p {
    margin-top: 10px;
    color: #a5b4fc;
    letter-spacing: 2px;
    font-size: 0.9rem;
}

/* ================= QUOTE ================= */
.quote {
    max-width: 900px;
    margin: 0 auto 160px;
    padding: 70px;
    background: var(--glass-bg);
    border-radius: 46px;
    backdrop-filter: blur(20px);
    box-shadow: 0 40px 100px rgba(0,0,0,0.7);
    border: 1px solid var(--glass-border);
    text-align: center;
}

.quote p {
    font-size: 2.2rem;
    font-style: italic;
    color: #e0f2fe;
    line-height: 1.35;
}

.quote span {
    display: block;
    margin-top: 24px;
    font-size: 1.1rem;
    color: #94a3ff;
}

/* ================= RESPONSIVE ================= */
@media(max-width: 1100px) {
    .hero {
        grid-template-columns: 1fr;
        padding: 80px 6%;
    }

    .stats {
        grid-template-columns: repeat(2,1fr);
    }
}

@media(max-width: 600px) {
    .stats {
        grid-template-columns: 1fr;
    }

    .quote p {
        font-size: 1.6rem;
    }
}
</style>

<div class="bg-art"></div>
<div class="noise"></div>

<section class="hero">
    <div>
        <h1>
            The Future of <br>
            <span>School Education</span>
        </h1>

        <p>
            Arya Public Academy is a benchmark institution redefining
            learning through discipline, innovation, and excellence.
            We don’t educate students — we create leaders.
        </p>

        <div class="stack">
            <div class="stack-card">
                <h3>🏫 World-Class Infrastructure</h3>
                <p>Smart classrooms, digital labs, and a secure campus.</p>
            </div>

            <div class="stack-card">
                <h3>🎓 Academic Excellence</h3>
                <p>Outstanding results with holistic development.</p>
            </div>

            <div class="stack-card">
                <h3>🚀 Future-Ready Learning</h3>
                <p>Technology-driven education beyond textbooks.</p>
            </div>
        </div>
    </div>

    <div class="stack-card">
        <h3>📍 Established Legacy</h3>
        <p>
            Founded in 2005, Arya Public Academy stands as
            one of the most trusted institutions in the region.
        </p>
    </div>
</section>

<section class="stats">
    <div class="stat"><h2>1000+</h2><p>STUDENTS</p></div>
    <div class="stat"><h2>25+</h2><p>TEACHERS</p></div>
    <div class="stat"><h2>99%</h2><p>RESULTS</p></div>
    <div class="stat"><h2>15+</h2><p>YEARS</p></div>
</section>

<section class="quote">
    <p>“Education is the most powerful investment a society can make.”</p>
    <span>— Arya Public Academy Philosophy</span>
</section>

@endsection
