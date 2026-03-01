@extends('layouts.public')

@section('title', 'Home — Arya Public Academy')

@section('extra_styles')
<style>
  /* Hero */
  .hero-section {
    position: relative;
    min-height: 88vh;
    border-radius: 24px;
    overflow: hidden;
    display: flex;
    align-items: flex-end;
    margin-bottom: 48px;
  }

  .hero-bg {
    position: absolute;
    inset: 0;
    background: url('https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat;
  }

  .hero-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
      to top,
      rgba(15,10,30,0.97) 0%,
      rgba(15,10,30,0.7) 40%,
      rgba(15,10,30,0.2) 100%
    );
  }

  .hero-text {
    position: relative;
    z-index: 1;
    padding: 56px 48px;
    max-width: 780px;
  }

  .hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #c4b5fd;
    background: rgba(124,58,237,0.2);
    border: 1px solid rgba(124,58,237,0.3);
    padding: 6px 14px;
    border-radius: 999px;
    margin-bottom: 20px;
  }

  .hero-h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.4rem, 5vw, 4.2rem);
    font-weight: 900;
    line-height: 1.1;
    color: #fff;
    margin-bottom: 20px;
  }

  .hero-h1 em {
    font-style: normal;
    background: linear-gradient(90deg, #a78bfa, #f97316);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .hero-sub {
    font-size: 1.1rem;
    color: rgba(232,228,240,0.75);
    line-height: 1.7;
    max-width: 520px;
    margin-bottom: 32px;
  }

  .hero-ctas {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }

  .cta-primary {
    padding: 13px 28px;
    background: linear-gradient(135deg, #7c3aed, #a855f7);
    color: #fff;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 8px 24px rgba(124,58,237,0.4);
  }

  .cta-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 36px rgba(124,58,237,0.55);
  }

  .cta-secondary {
    padding: 13px 28px;
    background: rgba(255,255,255,0.08);
    color: var(--text);
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.9rem;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.15);
    transition: all 0.2s;
  }

  .cta-secondary:hover {
    background: rgba(255,255,255,0.12);
    transform: translateY(-2px);
  }

  /* Stats bar */
  .stats-bar {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 48px;
  }

  .stat-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 18px;
    padding: 20px;
    text-align: center;
    transition: all 0.2s;
  }

  .stat-card:hover {
    border-color: rgba(124,58,237,0.3);
    background: rgba(124,58,237,0.07);
    transform: translateY(-3px);
  }

  .stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 900;
    color: #c4b5fd;
    line-height: 1;
    margin-bottom: 6px;
  }

  .stat-label {
    font-size: 0.78rem;
    color: var(--muted);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  /* Quick links */
  .section-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    font-weight: 900;
    color: #fff;
    margin-bottom: 6px;
  }

  .section-sub {
    color: var(--muted);
    font-size: 0.9rem;
    margin-bottom: 24px;
  }

  .quick-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 48px;
  }

  .quick-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 18px;
    padding: 22px;
    text-decoration: none;
    color: var(--text);
    transition: all 0.25s;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .quick-card:hover {
    background: rgba(124,58,237,0.1);
    border-color: rgba(124,58,237,0.3);
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.3);
  }

  .quick-icon {
    font-size: 1.8rem;
    width: 48px; height: 48px;
    display: grid;
    place-items: center;
    background: rgba(255,255,255,0.06);
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.1);
  }

  .quick-title {
    font-weight: 700;
    font-size: 1rem;
    color: #fff;
  }

  .quick-desc {
    font-size: 0.82rem;
    color: var(--muted);
    line-height: 1.5;
  }

  .quick-arrow {
    font-size: 1rem;
    color: var(--muted);
    margin-top: auto;
    transition: transform 0.2s;
  }

  .quick-card:hover .quick-arrow {
    transform: translateX(4px);
    color: #c4b5fd;
  }

  /* Notice strip */
  .notice-strip {
    background: linear-gradient(135deg, rgba(124,58,237,0.15), rgba(249,115,22,0.1));
    border: 1px solid rgba(124,58,237,0.25);
    border-radius: 16px;
    padding: 18px 24px;
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 48px;
    flex-wrap: wrap;
  }

  .notice-badge {
    background: linear-gradient(135deg, #7c3aed, #a855f7);
    color: #fff;
    font-size: 0.7rem;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: 999px;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .notice-text {
    font-size: 0.88rem;
    color: var(--text);
    line-height: 1.6;
    flex: 1;
  }

  @media (max-width: 900px) {
    .stats-bar { grid-template-columns: repeat(2, 1fr); }
    .quick-grid { grid-template-columns: repeat(2, 1fr); }
  }

  @media (max-width: 560px) {
    .stats-bar { grid-template-columns: repeat(2, 1fr); }
    .quick-grid { grid-template-columns: 1fr; }
    .hero-text { padding: 32px 24px; }
  }
</style>
@endsection

@section('content')

<!-- HERO -->
<div class="hero-section">
  <div class="hero-bg"></div>
  <div class="hero-text">
    <div class="hero-eyebrow">✦ Est. 2010 · Kusmara, Jalaun</div>
    <h1 class="hero-h1">
      {{ \App\Models\SiteSetting::get('hero_title', 'Welcome to') }}<br>
      <em>Arya Public Academy</em>
    </h1>
    <p class="hero-sub">
      {{ \App\Models\SiteSetting::get('hero_subtitle', 'Empowering students with creativity, knowledge, and confidence') }}
    </p>
    <div class="hero-ctas">
      <a href="{{ url('/about') }}" class="cta-primary">Discover Our School →</a>
      <a href="{{ url('/contact') }}" class="cta-secondary">Get in Touch</a>
    </div>
  </div>
</div>

{{-- <!-- STATS -->
<div class="stats-bar">
  <div class="stat-card">
    <div class="stat-num">12+</div>
    <div class="stat-label">Classes</div>
  </div>
  <div class="stat-card">
    <div class="stat-num">500+</div>
    <div class="stat-label">Students</div>
  </div>
  <div class="stat-card">
    <div class="stat-num">30+</div>
    <div class="stat-label">Teachers</div>
  </div>
  <div class="stat-card">
    <div class="stat-num">15+</div>
    <div class="stat-label">Years</div>
  </div>
</div> --}}

<!-- NOTICE -->
{{-- <div class="notice-strip">
  <span class="notice-badge">📢 Notice</span>
  <span class="notice-text">Results & marksheets for Half Yearly and Annual exams are now available online. Students can check their results through the portal.</span>
</div> --}}

<!-- QUICK LINKS -->
<div class="section-title">Explore</div>
<div class="section-sub">Everything you need, one click away</div>

<div class="quick-grid">
  <a href="{{ url('/about') }}" class="quick-card">
    <div class="quick-icon">🏫</div>
    <div class="quick-title">About Us</div>
    <div class="quick-desc">Learn about our history, values, and our commitment to excellence in education.</div>
    <div class="quick-arrow">→</div>
  </a>
  <a href="{{ url('/courses') }}" class="quick-card">
    <div class="quick-icon">📚</div>
    <div class="quick-title">Our Courses</div>
    <div class="quick-desc">Explore our comprehensive curriculum designed to bring out the best in every student.</div>
    <div class="quick-arrow">→</div>
  </a>
  <a href="{{ url('/gallery') }}" class="quick-card">
    <div class="quick-icon">🖼️</div>
    <div class="quick-title">Gallery</div>
    <div class="quick-desc">Memories, events, and moments from our vibrant school life and activities.</div>
    <div class="quick-arrow">→</div>
  </a>
  <a href="{{ url('/achievements') }}" class="quick-card">
    <div class="quick-icon">🏆</div>
    <div class="quick-title">Achievements</div>
    <div class="quick-desc">Celebrating our students' and institution's milestones and accomplishments.</div>
    <div class="quick-arrow">→</div>
  </a>
  <a href="{{ url('/contact') }}" class="quick-card">
    <div class="quick-icon">✉️</div>
    <div class="quick-title">Contact Us</div>
    <div class="quick-desc">Reach out to us for admissions, queries, or any information you need.</div>
    <div class="quick-arrow">→</div>
  </a>
  {{-- <a href="{{ url('/result') }}" class="quick-card">
    <div class="quick-icon">📋</div>
    <div class="quick-title">Check Results</div>
    <div class="quick-desc">Students can view their exam results and download marksheets online.</div>
    <div class="quick-arrow">→</div>
  </a> --}}
</div>

@endsection
