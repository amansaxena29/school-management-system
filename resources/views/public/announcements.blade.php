@extends('layouts.public')

@section('title', 'Announcements — Arya Public Academy')

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
    content: '📢';
    position: absolute;
    right: 40px; top: 50%;
    transform: translateY(-50%);
    font-size: 8rem;
    opacity: 0.07;
  }
  .page-eyebrow {
    font-size: 0.7rem; font-weight: 700;
    letter-spacing: 3px; text-transform: uppercase;
    color: #c4b5fd; margin-bottom: 12px;
  }
  .page-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 4vw, 3.2rem);
    font-weight: 900; color: #fff;
    line-height: 1.15; margin-bottom: 16px;
  }
  .page-subtitle { color: var(--muted); font-size: 1rem; max-width: 560px; line-height: 1.7; }

  /* ── Type colors (dark theme) ── */
  .ann-info    { --ann-glow: rgba(59,130,246,0.15);  --ann-border: rgba(59,130,246,0.25);  --ann-badge: #3b82f6;  --ann-icon: '📘'; }
  .ann-success { --ann-glow: rgba(34,197,94,0.12);   --ann-border: rgba(34,197,94,0.22);   --ann-badge: #22c55e;  --ann-icon: '📗'; }
  .ann-warning { --ann-glow: rgba(249,115,22,0.13);  --ann-border: rgba(249,115,22,0.25);  --ann-badge: #f97316;  --ann-icon: '📙'; }
  .ann-urgent  { --ann-glow: rgba(239,68,68,0.15);   --ann-border: rgba(239,68,68,0.25);   --ann-badge: #ef4444;  --ann-icon: '📕'; }

  .ann-card {
    background: var(--ann-glow);
    border: 1px solid var(--ann-border);
    border-radius: 20px;
    padding: 22px 24px;
    margin-bottom: 14px;
    display: flex;
    gap: 18px;
    align-items: flex-start;
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
    overflow: hidden;
  }

  .ann-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 4px;
    background: var(--ann-badge);
    border-radius: 4px 0 0 4px;
  }

  .ann-card:hover {
    transform: translateX(4px);
    box-shadow: 0 8px 32px rgba(0,0,0,0.25);
  }

  .ann-icon-wrap {
    width: 48px; height: 48px;
    border-radius: 14px;
    display: grid;
    place-items: center;
    font-size: 1.4rem;
    background: var(--ann-glow);
    border: 1px solid var(--ann-border);
    flex-shrink: 0;
  }

  .ann-body { flex: 1; min-width: 0; }

  .ann-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 8px;
  }

  .ann-badge {
    background: var(--ann-badge);
    color: #fff;
    font-size: 0.65rem;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 999px;
  }

  .ann-date {
    font-size: 0.75rem;
    color: var(--muted);
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .ann-expires {
    font-size: 0.72rem;
    color: var(--muted);
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    padding: 3px 8px;
    border-radius: 6px;
  }

  .ann-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem;
    font-weight: 700;
    color: #fff;
    line-height: 1.4;
    margin-bottom: 6px;
  }

  .ann-desc {
    font-size: 0.88rem;
    color: var(--muted);
    line-height: 1.7;
  }

  /* Urgent pulse */
  .ann-urgent .ann-card {
    animation: urgentPulse 3s ease-in-out infinite;
  }

  @keyframes urgentPulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(239,68,68,0); }
    50%       { box-shadow: 0 0 0 6px rgba(239,68,68,0.08); }
  }

  /* Empty state */
  .empty-state {
    text-align: center;
    padding: 60px 20px;
    background: rgba(255,255,255,0.02);
    border: 1px dashed rgba(255,255,255,0.1);
    border-radius: 20px;
    color: var(--muted);
  }
  .empty-state .empty-icon { font-size: 3rem; margin-bottom: 12px; }

  @media (max-width: 768px) {
    .page-hero { padding: 28px 24px; }
    .ann-card { flex-direction: column; gap: 12px; }
    .ann-icon-wrap { width: 38px; height: 38px; font-size: 1.1rem; }
  }
</style>
@endsection

@section('content')

<div class="page-hero">
  <div class="page-eyebrow">✦ Stay Updated</div>
  <h1 class="page-title">Announcements</h1>
  <p class="page-subtitle">Important notices, events, and updates from Arya Public Academy.</p>
</div>

@php $announcements = \App\Models\Announcement::active(); @endphp

@if($announcements->isEmpty())
  <div class="empty-state">
    <div class="empty-icon">📢</div>
    <p>No announcements at the moment. Check back soon!</p>
  </div>
@else
  @foreach($announcements as $ann)
    <div class="ann-{{ $ann->type }}">
      <div class="ann-card">
        <div class="ann-icon-wrap">
          @php
            $icons = ['info'=>'📘','success'=>'📗','warning'=>'📙','urgent'=>'📕'];
          @endphp
          {{ $icons[$ann->type] ?? '📢' }}
        </div>
        <div class="ann-body">
          <div class="ann-meta">
            <span class="ann-badge">{{ strtoupper($ann->type) }}</span>
            <span class="ann-date">🕐 {{ $ann->created_at->format('d M Y') }}</span>
            @if($ann->expires_at)
              {{-- <span class="ann-expires">⏳ Until {{ $ann->expires_at->format('d M Y') }}</span> --}}
            @endif
          </div>
          <div class="ann-title">{{ $ann->title }}</div>
          @if($ann->body)
            <div class="ann-desc">{{ $ann->body }}</div>
          @endif
        </div>
      </div>
    </div>
  @endforeach
@endif

@endsection
