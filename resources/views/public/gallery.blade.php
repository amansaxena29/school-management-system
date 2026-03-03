@extends('layouts.public')
@section('title', 'Gallery — Arya Public Academy')
@section('extra_styles')
<style>
  .page-hero {
    background: linear-gradient(135deg,rgba(124,58,237,0.15),rgba(249,115,22,0.08));
    border: 1px solid rgba(124,58,237,0.2); border-radius: 24px;
    padding: 48px; margin-bottom: 40px; position: relative; overflow: hidden;
  }
  .page-hero::before {
    content: '🎞️'; position: absolute; right: 40px; top: 50%;
    transform: translateY(-50%); font-size: 8rem; opacity: 0.07;
  }
  .page-eyebrow { font-size:0.7rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:#c4b5fd; margin-bottom:12px; }
  .page-title { font-family:'Playfair Display',serif; font-size:clamp(2rem,4vw,3.2rem); font-weight:900; color:#fff; line-height:1.15; margin-bottom:16px; }
  .page-subtitle { color:var(--muted); font-size:1rem; max-width:560px; line-height:1.7; }

  /* ── Tabs ── */
  .gallery-tabs {
    display: flex; gap: 10px; margin-bottom: 28px;
  }
  .gtab {
    padding: 10px 24px; border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.05);
    color: rgba(255,255,255,0.6);
    font-size: 13px; font-weight: 600; cursor: pointer;
    transition: all 0.2s; letter-spacing: 0.05em;
  }
  .gtab.active {
    background: rgba(124,58,237,0.2);
    border-color: rgba(124,58,237,0.5);
    color: #c4b5fd;
  }
  .gtab:hover:not(.active) { background: rgba(255,255,255,0.08); color: #fff; }

  /* ── Image Grid ── */
  .gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 16px;
  }
  .gallery-item {
    border-radius: 16px; overflow: hidden;
    aspect-ratio: 4/3;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    position: relative; transition: all 0.3s; cursor: pointer;
  }
  .gallery-item:hover {
    transform: scale(1.02);
    box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    border-color: rgba(124,58,237,0.35); z-index: 2;
  }
  .gallery-item img {
    width: 100%; height: 100%; object-fit: cover;
    display: block; transition: transform 0.5s;
  }
  .gallery-item:hover img { transform: scale(1.08); }
  .gallery-caption {
    position: absolute; bottom:0; left:0; right:0; padding: 16px;
    background: linear-gradient(to top, rgba(15,10,30,0.9), transparent);
    color: #fff; font-size: 0.8rem; font-weight: 500;
    opacity: 0; transition: opacity 0.2s;
  }
  .gallery-item:hover .gallery-caption { opacity: 1; }

  /* ── Video Grid ── */
  .video-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
  }
  .video-card {
    border-radius: 16px; overflow: hidden;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    transition: all 0.3s; cursor: pointer; position: relative;
  }
  .video-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    border-color: rgba(124,58,237,0.35);
  }
  .video-thumb {
    width: 100%; aspect-ratio: 16/9;
    object-fit: cover; display: block;
    transition: transform 0.4s;
  }
  .video-card:hover .video-thumb { transform: scale(1.04); }
  .video-thumb-placeholder {
    width: 100%; aspect-ratio: 16/9;
    background: linear-gradient(135deg, rgba(100,112,255,0.15), rgba(124,58,237,0.1));
    display: flex; align-items: center; justify-content: center;
    font-size: 3rem;
  }
  .video-play-overlay {
    position: absolute;
    top: 0; left: 0; right: 0;
    aspect-ratio: 16/9;
    display: flex; align-items: center; justify-content: center;
    background: rgba(0,0,0,0.3);
    opacity: 0; transition: opacity 0.2s;
  }
  .video-card:hover .video-play-overlay { opacity: 1; }
  .play-btn {
    width: 56px; height: 56px; border-radius: 50%;
    background: rgba(124,58,237,0.9);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: #fff;
    box-shadow: 0 8px 24px rgba(124,58,237,0.5);
    transition: transform 0.2s;
  }
  .video-card:hover .play-btn { transform: scale(1.1); }
  .video-info { padding: 12px 16px 16px; }
  .video-caption { font-size: 0.85rem; font-weight: 500; color: rgba(255,255,255,0.8); }
  .video-type-badge {
    display: inline-block; margin-top: 6px;
    font-size: 9px; font-weight: 700; letter-spacing: 0.12em;
    text-transform: uppercase; padding: 2px 9px;
    border-radius: 99px; background: rgba(124,58,237,0.2);
    border: 1px solid rgba(124,58,237,0.35); color: #c4b5fd;
  }

  /* ── Lightbox Modal ── */
  .gl-modal {
    display: none; position: fixed; inset: 0; z-index: 9999;
    background: rgba(0,0,0,0.92);
    align-items: center; justify-content: center;
    padding: 20px;
    animation: modalIn 0.2s ease;
  }
  .gl-modal.open { display: flex; }
  @keyframes modalIn { from { opacity:0; } to { opacity:1; } }

  .gl-modal-inner {
    position: relative; max-width: 1000px; width: 100%;
    animation: zoomIn 0.25s cubic-bezier(0.16,1,0.3,1);
  }
  @keyframes zoomIn { from { transform: scale(0.88); opacity:0; } to { transform: scale(1); opacity:1; } }

  .gl-close {
    position: absolute; top: -44px; right: 0;
    width: 36px; height: 36px; border-radius: 50%;
    background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);
    color: #fff; font-size: 18px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.2s;
  }
  .gl-close:hover { background: rgba(255,255,255,0.22); }

  /* Image lightbox */
  .gl-modal-img {
    width: 100%; max-height: 80vh;
    object-fit: contain; border-radius: 12px;
    display: block;
  }

  /* Video lightbox */
  .gl-modal-video {
    width: 100%; border-radius: 12px;
    aspect-ratio: 16/9; background: #000;
  }
  .gl-modal-iframe {
    width: 100%; border-radius: 12px;
    aspect-ratio: 16/9; border: none;
  }
  .gl-caption {
    text-align: center; margin-top: 12px;
    color: rgba(255,255,255,0.6); font-size: 0.85rem;
  }

  .empty-state { text-align:center; padding:60px 20px; color:var(--muted); }
  .empty-icon { font-size:3rem; margin-bottom:12px; }

  @media(max-width:768px) { .page-hero { padding:28px 24px; } }
</style>
@endsection

@section('content')
<div class="page-hero">
  <div class="page-eyebrow">✦ Memories & Moments</div>
  <h1 class="page-title">School Gallery</h1>
  <p class="page-subtitle">Glimpses of life at Arya Public Academy — events, activities, and precious moments.</p>
</div>

@php
  $allItems = \App\Models\Gallery::all();
  $images   = $allItems->where('type', 'image');
  $videos   = $allItems->where('type', 'video');
@endphp

{{-- Tabs — only show if there are videos --}}
@if($videos->count() > 0)
<div class="gallery-tabs">
  <button class="gtab active" onclick="switchTab('images', this)">🖼️ Photos ({{ $images->count() }})</button>
  <button class="gtab" onclick="switchTab('videos', this)">🎬 Videos ({{ $videos->count() }})</button>
</div>
@endif

{{-- ── IMAGES TAB ── --}}
<div id="tab-images">
  <div class="gallery-grid">
    @forelse($images as $img)
      <div class="gallery-item"
           onclick="openImageModal('{{ $img->is_url ? $img->image_path : asset('storage/'.$img->image_path) }}', '{{ addslashes($img->caption ?? '') }}')">
        <img src="{{ $img->is_url ? $img->image_path : asset('storage/'.$img->image_path) }}"
             alt="{{ $img->caption ?? 'Gallery Image' }}"
             loading="lazy">
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
</div>

{{-- ── VIDEOS TAB ── --}}
<div id="tab-videos" style="display:none;">
  <div class="video-grid">
    @forelse($videos as $vid)
      @php
        $isYoutube = false;
        $ytId      = null;
        $embedUrl  = null;

        if ($vid->is_url) {
          preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $vid->image_path, $m);
          if (!empty($m[1])) {
            $isYoutube = true;
            $ytId      = $m[1];
            $embedUrl  = 'https://www.youtube.com/embed/' . $ytId . '?autoplay=1&rel=0';
          } else {
            $embedUrl = $vid->image_path;
          }
        } else {
          $embedUrl = asset('storage/' . $vid->video_path);
        }
      @endphp

      <div class="video-card"
           onclick="openVideoModal('{{ $embedUrl }}', '{{ $vid->is_url && $isYoutube ? 'youtube' : ($vid->is_url ? 'url' : 'file') }}', '{{ addslashes($vid->caption ?? '') }}')">

        {{-- Thumbnail --}}
        @if($isYoutube && $ytId)
          <img class="video-thumb"
               src="https://img.youtube.com/vi/{{ $ytId }}/hqdefault.jpg"
               alt="{{ $vid->caption ?? 'Video' }}"
               loading="lazy">
        @else
          <div class="video-thumb-placeholder">🎬</div>
        @endif

        {{-- Play overlay --}}
        <div class="video-play-overlay">
          <div class="play-btn">▶</div>
        </div>

        <div class="video-info">
          @if($vid->caption)
            <div class="video-caption">{{ $vid->caption }}</div>
          @endif
          <span class="video-type-badge">
            {{ $isYoutube ? 'YouTube' : ($vid->is_url ? 'Video' : 'Uploaded') }}
          </span>
        </div>
      </div>
    @empty
      <div class="empty-state" style="grid-column:1/-1;">
        <div class="empty-icon">🎬</div>
        <p>No videos have been added yet.</p>
      </div>
    @endforelse
  </div>
</div>

{{-- ── LIGHTBOX MODAL ── --}}
<div class="gl-modal" id="glModal" onclick="closeModal(event)">
  <div class="gl-modal-inner" id="glModalInner">
    <button class="gl-close" onclick="closeModalDirect()">✕</button>
    <div id="glModalContent"></div>
    <div class="gl-caption" id="glCaption"></div>
  </div>
</div>

@endsection

@section('extra_scripts')
<script>
// ── Tab switching ──
function switchTab(tab, btn) {
  document.getElementById('tab-images').style.display = tab === 'images' ? 'block' : 'none';
  document.getElementById('tab-videos').style.display = tab === 'videos' ? 'block' : 'none';
  document.querySelectorAll('.gtab').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
}

// ── Open image in lightbox ──
function openImageModal(src, caption) {
  const content = document.getElementById('glModalContent');
  content.innerHTML = `<img class="gl-modal-img" src="${src}" alt="${caption}">`;
  document.getElementById('glCaption').textContent = caption;
  document.getElementById('glModal').classList.add('open');
  document.body.style.overflow = 'hidden';
}

// ── Open video in lightbox ──
function openVideoModal(url, type, caption) {
  const content = document.getElementById('glModalContent');

  if (type === 'youtube') {
    // YouTube — embed with iframe
    content.innerHTML = `<iframe class="gl-modal-iframe" src="${url}" allowfullscreen allow="autoplay; encrypted-media"></iframe>`;
    document.getElementById('glCaption').textContent = caption;
    document.getElementById('glModal').classList.add('open');
    document.body.style.overflow = 'hidden';

  } else if (type === 'file') {
    // Uploaded MP4 — use video tag
    content.innerHTML = `<video class="gl-modal-video" controls autoplay>
      <source src="${url}" type="video/mp4">
      Your browser does not support the video tag.
    </video>`;
    document.getElementById('glCaption').textContent = caption;
    document.getElementById('glModal').classList.add('open');
    document.body.style.overflow = 'hidden';

  } else {
    // Facebook or any other URL — cannot be embedded, open in new tab
    window.open(url, '_blank');
  }
}

// ── Close modal by clicking backdrop ──
function closeModal(e) {
  if (e.target === document.getElementById('glModal')) {
    closeModalDirect();
  }
}

// ── Close modal ──
function closeModalDirect() {
  const modal = document.getElementById('glModal');
  modal.classList.remove('open');
  document.body.style.overflow = '';
  // Stop video/iframe when closing
  document.getElementById('glModalContent').innerHTML = '';
}

// ── Close on Escape key ──
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeModalDirect();
});
</script>
@endsection
