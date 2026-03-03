<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Arya Public Academy')</title>
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
      --sidebar-w: 260px;
      --sidebar-collapsed: 64px;
      --accent: #7c3aed;
      --accent2: #f97316;
      --dark: #0f0a1e;
      --dark2: #1a1033;
      --text: #e8e4f0;
      --muted: #9c8fb5;
      --border: rgba(255,255,255,0.08);
      --glass: rgba(255,255,255,0.04);
      --transition: 0.32s cubic-bezier(0.4,0,0.2,1);
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--dark);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      overflow-x: hidden;
    }

    /* ===================== SIDEBAR ===================== */
    .sidebar {
      width: var(--sidebar-w);
      min-height: 100vh;
      background: var(--dark2);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0;
      z-index: 1000;
      transition: width var(--transition), transform var(--transition);
      overflow: hidden;
    }

    /* Collapsed state */
    body.sb-collapsed .sidebar { width: var(--sidebar-collapsed); }
    body.sb-collapsed .main-wrap { margin-left: var(--sidebar-collapsed); }

    /* ── Brand row ── */
    .sidebar-brand {
      padding: 0 14px;
      height: 64px;
      display: flex;
      align-items: center;
      gap: 12px;
      border-bottom: 1px solid var(--border);
      text-decoration: none;
      flex-shrink: 0;
      overflow: hidden;
      white-space: nowrap;
    }

    .sidebar-brand img {
      width: 36px; height: 36px;
      border-radius: 10px;
      object-fit: contain;
      background: rgba(124,58,237,0.15);
      border: 1px solid rgba(124,58,237,0.3);
      padding: 3px;
      flex-shrink: 0;
    }

    .brand-texts {
      overflow: hidden;
      transition: opacity var(--transition), max-width var(--transition);
      opacity: 1;
      max-width: 200px;
    }

    body.sb-collapsed .brand-texts { opacity: 0; max-width: 0; }

    .brand-name {
      font-family: 'Playfair Display', serif;
      font-size: 0.9rem;
      font-weight: 700;
      color: #fff;
      line-height: 1.3;
      white-space: nowrap;
    }

    .brand-tagline {
      font-size: 0.62rem;
      color: var(--muted);
      font-weight: 400;
      margin-top: 1px;
      white-space: nowrap;
    }

    /* ── Nav ── */
    .sidebar-nav {
      padding: 12px 8px;
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
    }

    .nav-label {
      font-size: 0.58rem;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--muted);
      padding: 0 10px;
      margin-bottom: 6px;
      margin-top: 10px;
      white-space: nowrap;
      transition: opacity var(--transition);
    }

    body.sb-collapsed .nav-label { opacity: 0; }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 10px;
      border-radius: 12px;
      text-decoration: none;
      color: var(--muted);
      font-size: 0.88rem;
      font-weight: 500;
      transition: all 0.2s ease;
      margin-bottom: 2px;
      position: relative;
      white-space: nowrap;
      overflow: visible;
    }

    .nav-icon {
      font-size: 1.1rem;
      width: 32px; min-width: 32px;
      height: 32px;
      display: grid;
      place-items: center;
      border-radius: 8px;
      flex-shrink: 0;
      transition: background 0.2s;
    }

    .nav-text {
      overflow: hidden;
      transition: opacity var(--transition), max-width var(--transition);
      opacity: 1;
      max-width: 180px;
    }

    body.sb-collapsed .nav-text { opacity: 0; max-width: 0; }

    .nav-link:hover { background: var(--glass); color: var(--text); }
    .nav-link:hover .nav-icon { background: rgba(124,58,237,0.15); }

    .nav-link.active {
      background: rgba(124,58,237,0.18);
      color: #c4b5fd;
      border: 1px solid rgba(124,58,237,0.25);
    }

    .nav-link.active .nav-icon { background: rgba(124,58,237,0.25); }

    .nav-link.active::before {
      content: '';
      position: absolute;
      left: 0; top: 50%;
      transform: translateY(-50%);
      width: 3px; height: 55%;
      background: var(--accent);
      border-radius: 0 3px 3px 0;
    }

    /* Tooltip on collapsed hover */
    .nav-tooltip {
      position: fixed;
      left: calc(var(--sidebar-collapsed) + 10px);
      background: #2d1f5e;
      border: 1px solid rgba(124,58,237,0.4);
      color: #fff;
      font-size: 0.78rem;
      font-weight: 600;
      padding: 6px 12px;
      border-radius: 8px;
      white-space: nowrap;
      pointer-events: none;
      opacity: 0;
      box-shadow: 0 8px 24px rgba(0,0,0,0.5);
      transition: opacity 0.15s;
      z-index: 9999;
      transform: translateY(-50%);
    }

    body.sb-collapsed .nav-link:hover .nav-tooltip { opacity: 1; }

    /* ── Footer login buttons ── */
    .sidebar-footer {
      padding: 10px 8px;
      border-top: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      gap: 6px;
      flex-shrink: 0;
    }

    .btn-login {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 10px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 0.82rem;
      text-decoration: none;
      color: #fff;
      transition: all 0.2s;
      position: relative;
    }

    .btn-icon {
      font-size: 1rem;
      width: 32px; min-width: 32px;
      height: 32px;
      display: grid;
      place-items: center;
      border-radius: 8px;
      flex-shrink: 0;
    }

    .btn-text {
      white-space: nowrap;
      overflow: hidden;
      transition: opacity var(--transition), max-width var(--transition);
      opacity: 1;
      max-width: 160px;
    }

    body.sb-collapsed .btn-text { opacity: 0; max-width: 0; }

    .btn-admin-login {
      background: linear-gradient(135deg, rgba(74,20,140,0.55), rgba(124,58,237,0.45));
      border: 1px solid rgba(124,58,237,0.35);
    }

    .btn-admin-login .btn-icon { background: rgba(124,58,237,0.3); }
    .btn-admin-login:hover {
      background: linear-gradient(135deg, rgba(74,20,140,0.8), rgba(124,58,237,0.7));
      box-shadow: 0 6px 20px rgba(124,58,237,0.35);
      transform: translateY(-1px);
    }

    .btn-teacher-login {
      background: linear-gradient(135deg, rgba(234,88,12,0.45), rgba(249,115,22,0.35));
      border: 1px solid rgba(249,115,22,0.3);
    }

    .btn-teacher-login .btn-icon { background: rgba(249,115,22,0.25); }
    .btn-teacher-login:hover {
      background: linear-gradient(135deg, rgba(234,88,12,0.7), rgba(249,115,22,0.6));
      box-shadow: 0 6px 20px rgba(249,115,22,0.3);
      transform: translateY(-1px);
    }

    .btn-tooltip {
      position: fixed;
      left: calc(var(--sidebar-collapsed) + 10px);
      background: #2d1f5e;
      border: 1px solid rgba(124,58,237,0.4);
      color: #fff;
      font-size: 0.75rem;
      font-weight: 600;
      padding: 5px 10px;
      border-radius: 8px;
      white-space: nowrap;
      pointer-events: none;
      opacity: 0;
      box-shadow: 0 8px 24px rgba(0,0,0,0.5);
      transition: opacity 0.15s;
      z-index: 9999;
      transform: translateY(-50%);
    }

    body.sb-collapsed .btn-login:hover .btn-tooltip { opacity: 1; }

    /* ===================== DESKTOP TOGGLE (floats on main content area) ===================== */
    .desktop-toggle {
      position: fixed;
      top: 14px;
      /* sits just after sidebar edge */
      left: calc(var(--sidebar-w) + 12px);
      z-index: 1100;
      width: 36px; height: 36px;
      border-radius: 10px;
      background: var(--dark2);
      border: 1px solid var(--border);
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 5px;
      padding: 0;
      transition: left var(--transition), background 0.2s, border-color 0.2s;
      box-shadow: 0 4px 16px rgba(0,0,0,0.35);
    }

    .desktop-toggle:hover {
      background: rgba(124,58,237,0.25);
      border-color: rgba(124,58,237,0.5);
    }

    .desktop-toggle span {
      display: block;
      height: 2px;
      border-radius: 2px;
      background: var(--text);
      transition: width 0.3s;
    }

    .desktop-toggle span:nth-child(1) { width: 14px; }
    .desktop-toggle span:nth-child(2) { width: 10px; }
    .desktop-toggle span:nth-child(3) { width: 14px; }

    body.sb-collapsed .desktop-toggle {
      left: calc(var(--sidebar-collapsed) + 12px);
    }

    /* ===================== MAIN WRAP ===================== */
    .main-wrap {
      margin-left: var(--sidebar-w);
      flex: 1;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      transition: margin-left var(--transition);
    }

    /* ===================== MOBILE TOPBAR ===================== */
    .topbar {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0;
      height: 60px;
      background: var(--dark2);
      border-bottom: 1px solid var(--border);
      align-items: center;
      justify-content: space-between;
      padding: 0 16px;
      z-index: 1100;
    }

    .topbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: #fff;
      font-family: 'Playfair Display', serif;
      font-size: 0.95rem;
      font-weight: 700;
    }

    .topbar-brand img {
      width: 34px; height: 34px;
      border-radius: 8px;
      object-fit: contain;
    }

    .mobile-hamburger {
      background: rgba(255,255,255,0.06);
      border: 1px solid var(--border);
      border-radius: 8px;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 5px;
      padding: 8px 10px;
      transition: all 0.2s;
    }

    .mobile-hamburger:hover { background: rgba(124,58,237,0.2); }

    .mobile-hamburger span {
      display: block;
      width: 20px; height: 2px;
      background: var(--text);
      border-radius: 2px;
      transition: all 0.3s;
    }

    .mobile-hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .mobile-hamburger.open span:nth-child(2) { opacity: 0; }
    .mobile-hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* Mobile overlay */
    .overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.6);
      z-index: 999;
      backdrop-filter: blur(2px);
    }
    .overlay.active { display: block; }

    /* ===================== RESPONSIVE ===================== */
    @media (max-width: 768px) {
      .sidebar {
        width: var(--sidebar-w) !important;
        transform: translateX(-100%);
      }
      .sidebar.mobile-open { transform: translateX(0); }
      .desktop-toggle { display: none; }
      .topbar { display: flex; }
      .main-wrap {
        margin-left: 0 !important;
        padding-top: 60px;
      }
    }

    /* ===================== PAGE CONTENT ===================== */
    .page-content {
      flex: 1;
      padding: 56px 48px 40px;
      width: 100%;
    }

    @media (max-width: 1024px) {
      .page-content { padding: 56px 24px 32px; }
    }

    @media (max-width: 768px) {
      .page-content { padding: 24px 16px; }
    }
  </style>
  @yield('extra_styles')
</head>
<body>

<!-- Mobile Overlay -->
<div class="overlay" id="overlay" onclick="closeMobile()"></div>

<!-- DESKTOP TOGGLE — floats just outside sidebar on main content area -->
<button class="desktop-toggle" id="desktopToggle" onclick="toggleDesktop()" title="Toggle sidebar">
  <span></span><span></span><span></span>
</button>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">

  <a href="{{ url('/') }}" class="sidebar-brand">
    <img src="{{ asset('images/school-logo.png') }}" alt="Logo">
    <div class="brand-texts">
      <div class="brand-name">Arya Public Academy</div>
      <div class="brand-tagline">Excellence in Education</div>
    </div>
  </a>

  <nav class="sidebar-nav">
    <div class="nav-label">Navigation</div>

    <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') || request()->is('home') ? 'active' : '' }}">
      <span class="nav-icon">🏠</span>
      <span class="nav-text">Home</span>
      <span class="nav-tooltip">Home</span>
    </a>

    <a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">
      <span class="nav-icon">🏫</span>
      <span class="nav-text">About Us</span>
      <span class="nav-tooltip">About Us</span>
    </a>

    <a href="{{ url('/courses') }}" class="nav-link {{ request()->is('courses') ? 'active' : '' }}">
      <span class="nav-icon">📚</span>
      <span class="nav-text">Courses</span>
      <span class="nav-tooltip">Courses</span>
    </a>

    <a href="{{ url('/gallery') }}" class="nav-link {{ request()->is('gallery') ? 'active' : '' }}">
      <span class="nav-icon">🖼️</span>
      <span class="nav-text">Gallery</span>
      <span class="nav-tooltip">Gallery</span>
    </a>

    <a href="{{ url('/achievements') }}" class="nav-link {{ request()->is('achievements') ? 'active' : '' }}">
      <span class="nav-icon">🏆</span>
      <span class="nav-text">Achievements</span>
      <span class="nav-tooltip">Achievements</span>
    </a>

    <a href="{{ url('/announcements') }}" class="nav-link {{ request()->is('announcements') ? 'active' : '' }}">
        <span class="nav-icon">📢</span>
        <span class="nav-text">Announcements</span>
        <span class="nav-tooltip">Announcements</span>
    </a>

    <a href="{{ url('/contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">
      <span class="nav-icon">✉️</span>
      <span class="nav-text">Contact</span>
      <span class="nav-tooltip">Contact</span>
    </a>
  </nav>

  <div class="sidebar-footer">
    <a href="/login" class="btn-login btn-admin-login">
      <span class="btn-icon">🔐</span>
      <span class="btn-text">Login as Admin</span>
      <span class="btn-tooltip">Login as Admin</span>
    </a>
    <a href="{{ route('teacher.login') }}" class="btn-login btn-teacher-login">
      <span class="btn-icon">👨‍🏫</span>
      <span class="btn-text">Login as Teacher</span>
      <span class="btn-tooltip">Login as Teacher</span>
    </a>
  </div>
</aside>

<!-- MOBILE TOPBAR -->
<div class="topbar">
  <a href="{{ url('/') }}" class="topbar-brand">
    <img src="{{ asset('images/school-logo.png') }}" alt="Logo">
    Arya Public Academy
  </a>
  <button class="mobile-hamburger" id="mobileHamburger" onclick="toggleMobile()">
    <span></span><span></span><span></span>
  </button>
</div>

<!-- MAIN CONTENT -->
<main class="main-wrap" id="mainWrap">
  <div class="page-content">
    @yield('content')
  </div>

  <footer style="border-top:1px solid rgba(255,255,255,0.08); padding:22px 48px; color:var(--muted); font-size:0.8rem; display:flex; justify-content:space-between; flex-wrap:wrap; gap:8px; margin-top:auto;">
    <span>© Arya Public Academy. All rights reserved.</span>
    <span>📞 {{ \App\Models\SiteSetting::get('footer_contact', '8127515044') }} &nbsp;|&nbsp; 📍 {{ \App\Models\SiteSetting::get('footer_address', 'Kusmara, Jalaun (U.P)') }}</span>
  </footer>
</main>

<script>
  const STORAGE_KEY = 'apa_sb';

  // Position tooltips vertically on hover
  document.querySelectorAll('.nav-link, .btn-login').forEach(el => {
    el.addEventListener('mouseenter', function() {
      const tip = this.querySelector('.nav-tooltip, .btn-tooltip');
      if (tip) {
        const rect = this.getBoundingClientRect();
        tip.style.top = (rect.top + rect.height / 2) + 'px';
      }
    });
  });

  // Desktop: toggle collapse
  function toggleDesktop() {
    document.body.classList.toggle('sb-collapsed');
    localStorage.setItem(STORAGE_KEY, document.body.classList.contains('sb-collapsed') ? '1' : '0');
  }

  // Mobile: open sidebar
  function toggleMobile() {
    document.getElementById('sidebar').classList.toggle('mobile-open');
    document.getElementById('mobileHamburger').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('active');
  }

  // Mobile: close sidebar
  function closeMobile() {
    document.getElementById('sidebar').classList.remove('mobile-open');
    document.getElementById('mobileHamburger').classList.remove('open');
    document.getElementById('overlay').classList.remove('active');
  }

  // Restore saved state on desktop
  (function() {
    if (window.innerWidth > 768 && localStorage.getItem(STORAGE_KEY) === '1') {
      document.body.classList.add('sb-collapsed');
    }
  })();
</script>
@yield('extra_scripts')
</body>
</html>
