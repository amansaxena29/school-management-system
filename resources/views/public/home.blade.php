<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My School - Modern Landing Page</title>
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
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.5rem;
    }

    .gallery-grid img {
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255,255,255,0.2);
      border-radius: 25px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
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

  </style>
</head>
<body>

  <!-- Navbar -->
  <nav>
    <div class="logo">Arya Public Academy</div>
    <ul>
     <li>


  </li>
      <li><a href="#home">Home</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#courses">Courses</a></li>
      <li><a href="#gallery">Gallery</a></li>
      <li><a href="#achievements">Achievements</a></li>
      <li><a href="#contact">Contact</a></li>
      <li><a href="{{ url('/result') }}">Result</a></li>

    </ul>
    <a href="/login" style="
      background: linear-gradient(135deg, #4a148c, #8e24aa);
      color: white;
      padding: 6px 14px;
      border-radius: 14px;
      font-weight: 600;
    ">
    Login as Admin
  </a>
</nav>

  <!-- Hero -->
  <section class="hero" id="home">
    <div class="hero-content">
      <h1>Welcome to Your School</h1>
      <p>Empowering students with creativity, knowledge, and confidence</p>
    </div>
  </section>

  <!-- About -->
  <section class="about" id="about">
    <h2>About Us</h2>
    <p>Our school fosters academic excellence and personal growth with innovative teaching, modern infrastructure, and a focus on creativity and critical thinking. Join us to explore a world of opportunities.</p>
  </section>

  <!-- Courses -->
  <section class="courses" id="courses">
    <h2>Our Courses</h2>
    <div class="courses-grid">
      <div class="course-card">
        <h3>Mathematics</h3>
        <p>Master concepts from basics to advanced problem-solving techniques.</p>
      </div>
      <div class="course-card">
        <h3>Science</h3>
        <p>Engage in Physics, Chemistry, and Biology concepts.</p>
      </div>
      <div class="course-card">
        <h3>Computer Science</h3>
        <p>Learn modern technology skills for the future.</p>
      </div>
    </div>
  </section>

  <!-- Gallery -->
  <section class="gallery" id="gallery">
    <h2>Gallery</h2>
    <div class="gallery-grid">
      <img src="https://images.unsplash.com/photo-1765994898026-4fa84ade4a61?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0" alt="School">
      <img src="https://images.unsplash.com/photo-1490424660416-359912d314b3?w=600&auto=format&fit=crop&q=60" alt="Classroom">
      <img src="https://images.unsplash.com/photo-1764072970350-2ce4f354a483?w=600&auto=format&fit=crop&q=60" alt="Event">
      <img src="https://images.unsplash.com/photo-1660501602631-6b2b3f7c9b40?w=600&auto=format&fit=crop&q=60" alt="Sports">
    </div>
  </section>

  <!-- Achievements -->
  <section class="achievements" id="achievements">
    <h2>Achievements</h2>
    <ul>
      <li>Won National Science Award 2025</li>
      <li>100% Pass Rate in Board Exams</li>
      <li>Best Sports School Award 2024</li>
    </ul>
  </section>

  <!-- Contact -->
  <section class="contact" id="contact">
    <h2>Contact Us</h2>
    <form>
      <input type="text" placeholder="Your Name" required>
      <input type="email" placeholder="Your Email" required>
      <textarea placeholder="Your Message" rows="5" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </section>

  <!-- Footer -->
  <footer>
    <p>© 2025 Arya Public Academy. All rights reserved.</p>
  </footer>

</body>
</html>
