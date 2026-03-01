@extends('layouts.public')
@section('title', 'Achievements — Arya Public Academy')
@section('extra_styles')
<style>
  .page-hero { background:linear-gradient(135deg,rgba(124,58,237,0.15),rgba(249,115,22,0.08)); border:1px solid rgba(124,58,237,0.2); border-radius:24px; padding:48px; margin-bottom:40px; position:relative; overflow:hidden; }
  .page-hero::before { content:'🏆'; position:absolute; right:40px; top:50%; transform:translateY(-50%); font-size:8rem; opacity:0.07; }
  .page-eyebrow { font-size:0.7rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:#c4b5fd; margin-bottom:12px; }
  .page-title { font-family:'Playfair Display',serif; font-size:clamp(2rem,4vw,3.2rem); font-weight:900; color:#fff; line-height:1.15; margin-bottom:16px; }
  .page-subtitle { color:var(--muted); font-size:1rem; max-width:560px; line-height:1.7; }

  .ach-list { display:flex; flex-direction:column; gap:12px; }

  .ach-item {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.2s;
  }

  .ach-item:hover {
    background: rgba(124,58,237,0.08);
    border-color: rgba(124,58,237,0.25);
    transform: translateX(4px);
  }

  .ach-num {
    width: 40px; height: 40px;
    border-radius: 12px;
    background: rgba(124,58,237,0.2);
    border: 1px solid rgba(124,58,237,0.3);
    display: grid;
    place-items: center;
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    color: #c4b5fd;
    font-size: 0.9rem;
    flex-shrink: 0;
  }

  .ach-text { color: var(--text); font-size: 0.95rem; line-height: 1.6; font-weight: 500; }

  .empty-state { text-align:center; padding:60px 20px; color:var(--muted); }

  @media (max-width:768px) { .page-hero { padding:28px 24px; } }
</style>
@endsection
@section('content')
<div class="page-hero">
  <div class="page-eyebrow">✦ Our Pride</div>
  <h1 class="page-title">Achievements &<br>Milestones</h1>
  <p class="page-subtitle">Celebrating the accomplishments of our students and institution over the years.</p>
</div>

<div class="ach-list">
  @forelse(\App\Models\Achievement::all() as $i => $ach)
    <div class="ach-item">
      <div class="ach-num">{{ $i + 1 }}</div>
      <div class="ach-text">{{ $ach->title }}</div>
    </div>
  @empty
    <div class="empty-state">
      <div style="font-size:3rem;margin-bottom:12px;">🏆</div>
      <p>No achievements have been added yet.</p>
    </div>
  @endforelse
</div>
@endsection
