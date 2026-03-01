@extends('layouts.public')
@section('title', 'Contact Us — Arya Public Academy')
@section('extra_styles')
<style>
  .page-hero { background:linear-gradient(135deg,rgba(124,58,237,0.15),rgba(249,115,22,0.08)); border:1px solid rgba(124,58,237,0.2); border-radius:24px; padding:48px; margin-bottom:40px; position:relative; overflow:hidden; }
  .page-hero::before { content:'✉️'; position:absolute; right:40px; top:50%; transform:translateY(-50%); font-size:8rem; opacity:0.07; }
  .page-eyebrow { font-size:0.7rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:#c4b5fd; margin-bottom:12px; }
  .page-title { font-family:'Playfair Display',serif; font-size:clamp(2rem,4vw,3.2rem); font-weight:900; color:#fff; line-height:1.15; margin-bottom:16px; }
  .page-subtitle { color:var(--muted); font-size:1rem; max-width:560px; line-height:1.7; }

  .contact-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 24px;
  }

  /* Info cards */
  .info-cards { display:flex; flex-direction:column; gap:12px; }

  .info-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    transition: all 0.2s;
  }

  .info-card:hover {
    border-color: rgba(124,58,237,0.3);
    background: rgba(124,58,237,0.07);
  }

  .info-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    display: grid;
    place-items: center;
    font-size: 1.2rem;
    background: rgba(124,58,237,0.15);
    border: 1px solid rgba(124,58,237,0.25);
    flex-shrink: 0;
  }

  .info-label { font-size:0.7rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--muted); margin-bottom:4px; }
  .info-value { font-size:0.92rem; color:var(--text); font-weight:500; }

  /* Form */
  .form-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 20px;
    padding: 32px;
  }

  .form-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: #fff;
    margin-bottom: 24px;
  }

  .form-group { margin-bottom: 16px; }

  .form-group label {
    display: block;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: var(--muted);
    text-transform: uppercase;
    margin-bottom: 8px;
  }

  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 12px 16px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    color: var(--text);
    font-size: 0.9rem;
    font-family: 'DM Sans', sans-serif;
    outline: none;
    transition: all 0.2s;
  }

  .form-group input::placeholder,
  .form-group textarea::placeholder { color: rgba(156,143,181,0.6); }

  .form-group input:focus,
  .form-group textarea:focus {
    border-color: rgba(124,58,237,0.5);
    background: rgba(124,58,237,0.07);
    box-shadow: 0 0 0 4px rgba(124,58,237,0.12);
  }

  .form-group textarea { resize: vertical; min-height: 110px; }

  .submit-btn {
    width: 100%;
    padding: 13px;
    background: linear-gradient(135deg, #7c3aed, #a855f7);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 700;
    font-family: 'DM Sans', sans-serif;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 8px 24px rgba(124,58,237,0.35);
    letter-spacing: 0.5px;
  }

  .submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 36px rgba(124,58,237,0.5);
  }

  .success-msg {
    background: rgba(34,197,94,0.12);
    border: 1px solid rgba(34,197,94,0.25);
    color: #86efac;
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 20px;
    font-size: 0.88rem;
    font-weight: 500;
  }

  .error-msg {
    color: #fca5a5;
    font-size: 0.75rem;
    margin-top: 4px;
  }

  @media (max-width: 768px) {
    .contact-grid { grid-template-columns: 1fr; }
    .page-hero { padding: 28px 24px; }
  }
</style>
@endsection
@section('content')
<div class="page-hero">
  <div class="page-eyebrow">✦ Get In Touch</div>
  <h1 class="page-title">Contact<br>Arya Public Academy</h1>
  <p class="page-subtitle">We'd love to hear from you. Reach out for admissions, queries, or any information.</p>
</div>

<div class="contact-grid">
  <!-- Info -->
  <div class="info-cards">
    <div class="info-card">
      <div class="info-icon">📞</div>
      <div>
        <div class="info-label">Phone</div>
        <div class="info-value">{{ \App\Models\SiteSetting::get('footer_contact', '8127515044') }}</div>
      </div>
    </div>
    <div class="info-card">
      <div class="info-icon">📍</div>
      <div>
        <div class="info-label">Address</div>
        <div class="info-value">{{ \App\Models\SiteSetting::get('footer_address', 'Kusmara, Jalaun (U.P)') }}</div>
      </div>
    </div>
    <div class="info-card">
      <div class="info-icon">🕐</div>
      <div>
        <div class="info-label">School Hours</div>
        <div class="info-value">Mon – Sat: 7:30 AM – 2:30 PM</div>
      </div>
    </div>
    <div class="info-card">
      <div class="info-icon">🎓</div>
      <div>
        <div class="info-label">Admissions</div>
        <div class="info-value">Open Now!, Contact us for details.</div>
      </div>
    </div>
  </div>

  <!-- Form -->
  <div class="form-card">
    <h3>📨 Send us a Message</h3>

    @if(session('message_sent'))
      <div class="success-msg">✅ {{ session('message_sent') }}</div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}">
      @csrf
      <div class="form-group">
        <label>Your Name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
        @error('name')<div class="error-msg">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required>
        @error('email')<div class="error-msg">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Message</label>
        <textarea name="message" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
        @error('message')<div class="error-msg">{{ $message }}</div>@enderror
      </div>
      <button type="submit" class="submit-btn">Send Message →</button>
    </form>
  </div>
</div>
@endsection
