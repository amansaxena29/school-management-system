<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arya Public Academy</title>
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* --- Global Styles --- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #e0f7fa, #e1bee7);
      color: #333;
      scroll-behavior: smooth;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    img {
      max-width: 100%;
      border-radius: 20px;
      display: block;
      transition: transform 0.5s, box-shadow 0.5s;
    }

    img:hover {
      transform: scale(1.05);
      box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    }

    /* --- Navbar --- */
    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 3rem;
      background: rgba(255,255,255,0.2);
      backdrop-filter: blur(15px);
      position: sticky;
      top: 0;
      z-index: 1000;
      border-bottom: 1px solid rgba(255,255,255,0.3);
    }

    nav .logo {
      font-size: 2rem;
      font-weight: 700;
      color: #333;
    }

    nav ul {
      display: flex;
      list-style: none;
    }

    nav ul li {
      margin-left: 2rem;
    }

    nav ul li a {
      font-weight: 500;
      padding: 5px 10px;
      border-radius: 10px;
      transition: 0.3s;
    }

    nav ul li a:hover {
      background: rgba(255, 255, 255, 0.3);
      color: #000;
    }

    /* --- Nav Buttons --- */
    .nav-buttons {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .nav-buttons a {
      padding: 8px 18px;
      border-radius: 14px;
      font-weight: 600;
      font-size: 0.9rem;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      white-space: nowrap;
    }

    .btn-admin {
      background: linear-gradient(135deg, #4a148c, #8e24aa);
      color: white !important;
    }

    .btn-teacher {
      background: #f97316;
      color: #fff !important;
      border-radius: 999px !important;
    }

    /* --- Hero Section --- */
    .hero {
      height: 100vh;
      background: url('https://images.unsplash.com/photo-1596496051084-8b98fc0d4c17?auto=format&fit=crop&w=1470&q=80') center/cover no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top:0;
      left:0;
      width:100%;
      height:100%;
      background: rgba(255,255,255,0.2);
      backdrop-filter: blur(10px);
    }

    .hero-content {
      position: relative;
      z-index: 1;
      color: #222;
      padding: 2rem;
    }

    .hero h1 {
      font-size: 4rem;
      font-weight: 700;
      color: #1a237e;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 10px rgba(255,255,255,0.3);
    }

    .hero p {
      font-size: 1.5rem;
      font-weight: 500;
      color: #3e2723;
      text-shadow: 1px 1px 6px rgba(255,255,255,0.3);
    }

    /* --- Sections --- */
    section {
      padding: 5rem 2rem;
      position: relative;
    }

    section h2 {
      text-align: center;
      font-size: 3rem;
      margin-bottom: 2rem;
      color: #1a237e;
      position: relative;
    }

    section h2::after {
      content: '';
      width: 120px;
      height: 4px;
      background: #8e24aa;
      display: block;
      margin: 10px auto 0 auto;
      border-radius: 2px;
    }

    .about p {
      text-align: center;
      max-width: 800px;
      margin: 0 auto;
      font-size: 1.2rem;
      line-height: 1.8;
      color: #333;
    }

    /* --- Courses Grid with Glass Effect --- */
    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      margin-top: 2rem;
    }

    .course-card {
      background: rgba(255,255,255,0.15);
      border-radius: 25px;
      padding: 2rem;
      text-align: center;
      transition: transform 0.5s, box-shadow 0.5s;
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255,255,255,0.3);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .course-card:hover {
      transform: translateY(-15px);
      box-shadow: 0 25px 50px rgba(0,0,0,0.2);
    }

    .course-card h3 {
      font-size: 1.6rem;
      margin-bottom: 1rem;
      color: #4a148c;
    }

    .course-card p {
      font-size: 1rem;
      color: #222;
    }

    /* --- Gallery Section --- */
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
    }

    /* ✅ Fixed: All gallery images same size */
    .gallery-grid .gallery-item {
      width: 100%;
      height: 260px;
      overflow: hidden;
      border-radius: 25px;
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255,255,255,0.2);
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .gallery-grid .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 25px;
      display: block;
      transition: transform 0.5s, box-shadow 0.5s;
    }

    .gallery-grid .gallery-item img:hover {
      transform: scale(1.05);
      box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    }

    /* --- Achievements --- */
    .achievements ul {
      list-style: disc inside;
      max-width: 800px;
      margin: 0 auto;
      font-size: 1.2rem;
      line-height: 1.8;
      color: #333;
    }

    /* --- Contact Form --- */
    .contact form {
      max-width: 600px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
    }

    .contact form input,
    .contact form textarea {
      padding: 1rem;
      margin-bottom: 1rem;
      border-radius: 25px;
      border: none;
      outline: none;
      background: rgba(255,255,255,0.2);
      color: #333;
      font-weight: 500;
      backdrop-filter: blur(15px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      transition: 0.3s;
    }

    .contact form input::placeholder,
    .contact form textarea::placeholder {
      color: #555;
    }

    .contact form button {
      padding: 1rem;
      border: none;
      background: linear-gradient(135deg, #8e24aa, #4a148c);
      color: #fff;
      font-size: 1.2rem;
      font-weight: 600;
      border-radius: 25px;
      cursor: pointer;
      transition: 0.3s;
    }

    .contact form button:hover {
      background: linear-gradient(135deg, #4a148c, #8e24aa);
      transform: scale(1.05);
    }

    /* --- Footer --- */
    footer {
      background: linear-gradient(to right, #2e1a47, #4a148c);
      color: #fff;
      text-align: center;
      padding: 2rem;
      font-size: 1rem;
    }

    /* --- Responsive --- */
    @media(max-width:768px){
      nav ul {
        flex-direction: column;
        background: rgba(255,255,255,0.25);
        position: absolute;
        top: 70px;
        right: 0;
        width: 100%;
        display: none;
      }
      nav ul li {
        margin: 1rem 0;
      }
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: inherit;
    }

    .brand-logo {
      width: 42px;
      height: 42px;
      object-fit: contain;
      border-radius: 10px;
    }

    .brand-text {
       font-weight: 900;
       font-size: 25px;
       line-height: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

    }

    /* Mobile */
    @media (max-width: 768px){
      .brand-text { font-size: 22px; }
      .brand-logo { width: 34px; height: 34px; }
    }

  </style>
</head>
<body>

  <!-- Navbar -->
  <nav>
    <a href="{{ url('/') }}" class="brand">
      <img src="{{ asset('images/school-logo.png') }}" alt="Arya Public Academy" class="brand-logo">
      <span class="brand-text">Arya Public Academy</span>
    </a>

    <ul>
      <li></li>
      <li><a href="#home">Home</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#courses">Courses</a></li>
      <li><a href="#gallery">Gallery</a></li>
      <li><a href="#achievements">Achievements</a></li>
      <li><a href="#contact">Contact</a></li>
      {{-- <li><a href="{{ url('/result') }}">Result</a></li> --}}
    </ul>

    {{-- ✅ Fixed: Both buttons properly aligned in a flex row --}}
    <div class="nav-buttons">
      <a href="/login" class="btn-admin">Login as Admin</a>
      <a href="{{ route('teacher.login') }}" class="btn-teacher">Login as Teacher</a>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero" id="home">
    <div class="hero-content">
      <h1>{{ \App\Models\SiteSetting::get('hero_title', 'Welcome to Your School') }}</h1>
      <p>{{ \App\Models\SiteSetting::get('hero_subtitle', 'Empowering students with creativity, knowledge, and confidence') }}</p>
    </div>
  </section>

  <!-- About -->
  <section class="about" id="about">
    <h2>About Us</h2>
    <p>{{ \App\Models\SiteSetting::get('about_text', 'Our school fosters academic excellence and personal growth with innovative teaching, modern infrastructure, and a focus on creativity and critical thinking. Join us to explore a world of opportunities.') }}</p>
  </section>

  <!-- Courses -->
  <section class="courses" id="courses">
    <h2>Our Courses</h2>
    <div class="courses-grid">
      @forelse(\App\Models\Course::all() as $course)
        <div class="course-card">
          <h3>{{ $course->title }}</h3>
          <p>{{ $course->description }}</p>
        </div>
      @empty
        <p style="text-align:center; color:#888;">No courses available yet.</p>
      @endforelse
    </div>
  </section>

  <!-- Gallery -->
  <section class="gallery" id="gallery">
    <h2>Gallery</h2>
    <div class="gallery-grid">
      {{-- ✅ Fixed: Wrapped in .gallery-item div for uniform size --}}
      @forelse(\App\Models\Gallery::all() as $img)
        <div class="gallery-item">
          <img
            src="{{ $img->is_url ? $img->image_path : asset('storage/' . $img->image_path) }}"
            alt="{{ $img->caption ?? 'Gallery Image' }}">
        </div>
      @empty
        <p style="text-align:center; color:#888;">No images in gallery yet.</p>
      @endforelse
    </div>
  </section>

  <!-- Achievements -->
  <section class="achievements" id="achievements">
    <h2>Achievements</h2>
    <ul>
      @forelse(\App\Models\Achievement::all() as $ach)
        <li>{{ $ach->title }}</li>
      @empty
        <li>No achievements added yet.</li>
      @endforelse
    </ul>
  </section>

  <!-- Contact -->
<section class="contact" id="contact">
    <h2>Contact Us</h2>

    {{-- Success Message --}}
    @if(session('message_sent'))
        <div style="max-width:600px; margin:0 auto 20px auto;
                    background:#d1fae5; border:1px solid #6ee7b7;
                    color:#065f46; padding:14px 20px;
                    border-radius:25px; text-align:center; font-weight:500;">
            ✅ {{ session('message_sent') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}">
        @csrf
        <input type="text" name="name"
               value="{{ old('name') }}"
               placeholder="Your Name" required>

        @error('name')
            <p style="color:red; font-size:0.8rem; margin:-10px 0 10px 14px;">{{ $message }}</p>
        @enderror

        <input type="email" name="email"
               value="{{ old('email') }}"
               placeholder="Your Email" required>

        @error('email')
            <p style="color:red; font-size:0.8rem; margin:-10px 0 10px 14px;">{{ $message }}</p>
        @enderror

        <textarea name="message" placeholder="Your Message"
                  rows="5" required>{{ old('message') }}</textarea>

        @error('message')
            <p style="color:red; font-size:0.8rem; margin:-10px 0 10px 14px;">{{ $message }}</p>
        @enderror

        <button type="submit">Send Message</button>
    </form>
</section>

  <!-- Footer -->
  <footer>
    <p>© 2025 Arya Public Academy. All rights reserved.</p> <br>
    <p>Contact Number : {{ \App\Models\SiteSetting::get('footer_contact', '8127515044') }}</p> <br>
    <p>{{ \App\Models\SiteSetting::get('footer_address', 'Kusmara, Jalaun (U.P)') }}</p>
  </footer>

</body>
</html>
