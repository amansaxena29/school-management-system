@extends('layouts.public')

@section('title', 'About Us — Arya Public Academy')

@section('extra_styles')
<style>
  .page-hero {
    background: linear-gradient(135deg, rgba(124,58,237,0.15), rgba(249,115,22,0.08));
    border: 1px solid rgba(124,58,237,0.2);
    border-radius: 24px;
    padding: 48px;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
  }

  .page-hero::before {
    content: '🏫';
    position: absolute;
    right: 40px; top: 50%;
    transform: translateY(-50%);
    font-size: 8rem;
    opacity: 0.07;
  }

  .page-eyebrow {
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #c4b5fd;
    margin-bottom: 12px;
  }

  .page-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 4vw, 3.2rem);
    font-weight: 900;
    color: #fff;
    line-height: 1.15;
    margin-bottom: 16px;
  }

  .page-subtitle {
    color: var(--muted);
    font-size: 1rem;
    max-width: 560px;
    line-height: 1.7;
  }

  /* About content */
  .about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 32px;
  }

  .about-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 20px;
    padding: 28px;
  }

  .about-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: #fff;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .about-card p {
    color: var(--muted);
    line-height: 1.8;
    font-size: 0.92rem;
  }

  /* Mission / Vision cards */
  .mv-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 32px;
  }

  .mv-card {
    border-radius: 20px;
    padding: 28px;
    position: relative;
    overflow: hidden;
  }

  .mv-card.mission {
    background: linear-gradient(135deg, rgba(124,58,237,0.2), rgba(124,58,237,0.05));
    border: 1px solid rgba(124,58,237,0.25);
  }

  .mv-card.vision {
    background: linear-gradient(135deg, rgba(249,115,22,0.15), rgba(249,115,22,0.04));
    border: 1px solid rgba(249,115,22,0.2);
  }

  .mv-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    color: #fff;
    margin-bottom: 12px;
  }

  .mv-card p {
    color: var(--muted);
    font-size: 0.9rem;
    line-height: 1.75;
  }

  /* Values */
  .values-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
  }

  .value-item {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 20px;
    text-align: center;
    transition: all 0.2s;
  }

  .value-item:hover {
    border-color: rgba(124,58,237,0.3);
    background: rgba(124,58,237,0.07);
    transform: translateY(-3px);
  }

  .value-emoji { font-size: 2rem; margin-bottom: 10px; }
  .value-title { font-weight: 700; color: #fff; font-size: 0.9rem; margin-bottom: 6px; }
  .value-desc { font-size: 0.78rem; color: var(--muted); line-height: 1.5; }

  .section-header {
    margin-bottom: 20px;
  }

  .section-header h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    font-weight: 900;
    color: #fff;
    margin-bottom: 4px;
  }

  .section-header p { color: var(--muted); font-size: 0.88rem; }

  @media (max-width: 768px) {
    .about-grid, .mv-grid { grid-template-columns: 1fr; }
    .values-grid { grid-template-columns: repeat(2, 1fr); }
    .page-hero { padding: 28px 24px; }
  }
</style>
@endsection

@section('content')

<div class="page-hero">
  <div class="page-eyebrow">✦ Who We Are</div>
  <h1 class="page-title">About Arya<br>Public Academy</h1>
  <p class="page-subtitle">A centre of academic excellence fostering growth, creativity, and character since 2010.</p>
</div>

<!-- Main About -->
<div class="about-grid">
  <div class="about-card">
    <h3>🎓 Our Story</h3>
    <p>{{ \App\Models\SiteSetting::get('about_text', 'Our school fosters academic excellence and personal growth with innovative teaching, modern infrastructure, and a focus on creativity and critical thinking. Join us to explore a world of opportunities.') }}</p>
  </div>
  <div class="about-card">
    <h3>📍 Our Location</h3>
    <p>Located in Kusmara, Jalaun (U.P), Arya Public Academy has been a cornerstone of quality education in the region. Our campus provides a safe, nurturing, and inspiring environment for students of all classes from 1 to 12.</p>
  </div>
</div>

<!-- Mission / Vision -->
<div class="section-header">
  <h2>Mission & Vision</h2>
  <p>What drives us every day</p>
</div>

<div class="mv-grid" style="margin-bottom:32px;">
  <div class="mv-card mission">
    <h3>🎯 Our Mission</h3>
    <p>To provide holistic education that nurtures intellectual curiosity, builds character, and prepares students to become responsible citizens and future leaders of tomorrow.</p>
  </div>
  <div class="mv-card vision">
    <h3>🔭 Our Vision</h3>
    <p>To be a beacon of educational excellence — where every child discovers their potential and graduates equipped with the knowledge, skills, and values for a successful life.</p>
  </div>
</div>

<!-- Values -->
<div class="section-header">
  <h2>Our Core Values</h2>
  <p>The principles that guide everything we do</p>
</div>

<div class="values-grid">
  <div class="value-item">
    <div class="value-emoji">📖</div>
    <div class="value-title">Academic Excellence</div>
    <div class="value-desc">Highest standards in learning and achievement</div>
  </div>
  <div class="value-item">
    <div class="value-emoji">🤝</div>
    <div class="value-title">Integrity</div>
    <div class="value-desc">Honesty and ethics in all we do</div>
  </div>
  <div class="value-item">
    <div class="value-emoji">🌱</div>
    <div class="value-title">Growth Mindset</div>
    <div class="value-desc">Continuous improvement and lifelong learning</div>
  </div>
  <div class="value-item">
    <div class="value-emoji">🎨</div>
    <div class="value-title">Creativity</div>
    <div class="value-desc">Encouraging innovation and original thinking</div>
  </div>
  <div class="value-item">
    <div class="value-emoji">🤲</div>
    <div class="value-title">Community</div>
    <div class="value-desc">Giving back and serving society</div>
  </div>
  <div class="value-item">
    <div class="value-emoji">⚖️</div>
    <div class="value-title">Inclusivity</div>
    <div class="value-desc">Equal opportunity for every student</div>
  </div>
</div>

@endsection
