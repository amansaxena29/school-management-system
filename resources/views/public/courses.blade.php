@extends('layouts.public')

@section('title', 'Courses — Arya Public Academy')

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
  .page-hero::before { content:'📚'; position:absolute; right:40px; top:50%; transform:translateY(-50%); font-size:8rem; opacity:0.07; }
  .page-eyebrow { font-size:0.7rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:#c4b5fd; margin-bottom:12px; }
  .page-title { font-family:'Playfair Display',serif; font-size:clamp(2rem,4vw,3.2rem); font-weight:900; color:#fff; line-height:1.15; margin-bottom:16px; }
  .page-subtitle { color:var(--muted); font-size:1rem; max-width:560px; line-height:1.7; }

  .courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 16px;
  }

  .course-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 20px;
    padding: 28px;
    transition: all 0.25s;
    position: relative;
    overflow: hidden;
  }

  .course-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #7c3aed, #a855f7);
    opacity: 0;
    transition: opacity 0.2s;
  }

  .course-card:hover {
    border-color: rgba(124,58,237,0.3);
    background: rgba(124,58,237,0.07);
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.3);
  }

  .course-card:hover::before { opacity: 1; }

  .course-icon {
    width: 48px; height: 48px;
    border-radius: 14px;
    display: grid;
    place-items: center;
    font-size: 1.4rem;
    background: rgba(124,58,237,0.15);
    border: 1px solid rgba(124,58,237,0.25);
    margin-bottom: 16px;
  }

  .course-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 10px;
  }

  .course-desc {
    color: var(--muted);
    font-size: 0.88rem;
    line-height: 1.7;
  }

  .empty-state {
    grid-column: 1/-1;
    text-align: center;
    padding: 60px 20px;
    color: var(--muted);
    font-size: 0.9rem;
  }

  .empty-state .empty-icon { font-size: 3rem; margin-bottom: 12px; }

  @media (max-width: 768px) { .page-hero { padding: 28px 24px; } }
</style>
@endsection

@section('content')

<div class="page-hero">
  <div class="page-eyebrow">✦ What We Offer</div>
  <h1 class="page-title">Our Courses &<br>Curriculum</h1>
  <p class="page-subtitle">Comprehensive courses designed to build strong foundations and inspire a love for learning.</p>
</div>

<div class="courses-grid">
  @forelse(\App\Models\Course::all() as $i => $course)
    @php
      $icons = ['📐','🔬','📖','🌍','🎨','💻','🎵','⚗️','📊','🏃'];
    @endphp
    <div class="course-card">
      <div class="course-icon">{{ $icons[$i % count($icons)] }}</div>
      <div class="course-title">{{ $course->title }}</div>
      <div class="course-desc">{{ $course->description }}</div>
    </div>
  @empty
    <div class="empty-state">
      <div class="empty-icon">📚</div>
      <p>No courses have been added yet.</p>
    </div>
  @endforelse
</div>

@endsection
