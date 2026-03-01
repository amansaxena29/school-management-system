@extends('layouts.public')
@section('title', 'Gallery — Arya Public Academy')
@section('extra_styles')
<style>
  .page-hero { background:linear-gradient(135deg,rgba(124,58,237,0.15),rgba(249,115,22,0.08)); border:1px solid rgba(124,58,237,0.2); border-radius:24px; padding:48px; margin-bottom:40px; position:relative; overflow:hidden; }
  .page-hero::before { content:'🖼️'; position:absolute; right:40px; top:50%; transform:translateY(-50%); font-size:8rem; opacity:0.07; }
  .page-eyebrow { font-size:0.7rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:#c4b5fd; margin-bottom:12px; }
  .page-title { font-family:'Playfair Display',serif; font-size:clamp(2rem,4vw,3.2rem); font-weight:900; color:#fff; line-height:1.15; margin-bottom:16px; }
  .page-subtitle { color:var(--muted); font-size:1rem; max-width:560px; line-height:1.7; }

  .gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 16px;
  }

  .gallery-item {
    border-radius: 16px;
    overflow: hidden;
    aspect-ratio: 4/3;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    position: relative;
    transition: all 0.3s;
    cursor: pointer;
  }

  .gallery-item:hover {
    transform: scale(1.02);
    box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    border-color: rgba(124,58,237,0.35);
    z-index: 2;
  }

  .gallery-item img {
    width: 100%; height: 100%;
    object-fit: cover;
    border-radius: 0;
    display: block;
    transition: transform 0.5s;
  }

  .gallery-item:hover img { transform: scale(1.08); }

  .gallery-caption {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 16px;
    background: linear-gradient(to top, rgba(15,10,30,0.9), transparent);
    color: #fff;
    font-size: 0.8rem;
    font-weight: 500;
    opacity: 0;
    transition: opacity 0.2s;
  }

  .gallery-item:hover .gallery-caption { opacity: 1; }

  .empty-state { text-align:center; padding:60px 20px; color:var(--muted); }
  .empty-icon { font-size:3rem; margin-bottom:12px; }

  @media (max-width: 768px) { .page-hero { padding:28px 24px; } }
</style>
@endsection
@section('content')
<div class="page-hero">
  <div class="page-eyebrow">✦ Memories & Moments</div>
  <h1 class="page-title">School Gallery</h1>
  <p class="page-subtitle">Glimpses of life at Arya Public Academy — events, activities, and precious moments.</p>
</div>

<div class="gallery-grid">
  @forelse(\App\Models\Gallery::all() as $img)
    <div class="gallery-item">
      <img src="{{ $img->is_url ? $img->image_path : asset('storage/' . $img->image_path) }}"
           alt="{{ $img->caption ?? 'Gallery Image' }}">
      @if($img->caption)
        <div class="gallery-caption">{{ $img->caption }}</div>
      @endif
    </div>
  @empty
    <div class="empty-state" style="grid-column:1/-1;">
      <div class="empty-icon">🖼️</div>
      <p>No gallery images have been added yet.</p>
    </div>
  @endforelse
</div>
@endsection
