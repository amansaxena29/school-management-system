<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Arya Public Academy</title>
     <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f5f9;
            display: flex;
            min-height: 100vh;
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            width: 240px;
            background: #7c2d12;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 24px 0;
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar-title {
            text-align: center;
            font-size: 1.2rem;
            font-weight: 700;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            margin-bottom: 16px;
        }

        .sidebar nav a {
            display: block;
            padding: 12px 24px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 0.95rem;
            transition: background 0.2s;
        }

        .sidebar nav a:hover,
        .sidebar nav a.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 24px;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.6);
            border-top: 1px solid rgba(255,255,255,0.15);
        }

        /* ===================== HAMBURGER ===================== */
        .hamburger {
            display: none;
            position: fixed;
            top: 14px;
            left: 14px;
            z-index: 1100;
            background: #7c2d12;
            border: none;
            border-radius: 8px;
            padding: 8px 10px;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 3px;
            background: #fff;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        /* Overlay when sidebar is open on mobile */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .overlay.active { display: block; }

        /* ===================== MAIN CONTENT ===================== */
        .main {
            margin-left: 240px;
            padding: 32px;
            flex: 1;
        }

        .welcome-banner {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: #fff;
            border-radius: 14px;
            padding: 28px 32px;
            margin-bottom: 28px;
        }

        .welcome-banner h1 { font-size: 1.6rem; margin-bottom: 6px; }
        .welcome-banner p  { font-size: 0.95rem; opacity: 0.85; }

        /* ===================== CARDS ===================== */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 22px 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            text-align: center;
        }

        .card .icon { font-size: 2rem; margin-bottom: 10px; }
        .card h3 { font-size: 1rem; color: #334155; margin-bottom: 4px; }
        .card p { font-size: 0.85rem; color: #64748b; }

        /* ===================== PROFILE TABLE ===================== */
        .profile-section {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        }

        .profile-section h2 {
            font-size: 1.1rem;
            color: #1e293b;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
        }

        table { width: 100%; border-collapse: collapse; }
        td { padding: 10px 14px; font-size: 0.9rem; border-bottom: 1px solid #f1f5f9; }
        td:first-child { color: #64748b; width: 160px; font-weight: 500; }
        td:last-child  { color: #1e293b; }

        /* ===================== LOGOUT ===================== */
        .logout-form { margin: 0; }
        .logout-btn {
            background: none; border: none;
            color: rgba(255,255,255,0.85);
            font-size: 0.95rem;
            cursor: pointer; padding: 12px 24px;
            width: 100%; text-align: left;
            transition: background 0.2s;
        }
        .logout-btn:hover { background: rgba(255,255,255,0.15); color: #fff; }

        /* ===================== MOBILE RESPONSIVE ===================== */
        @media (max-width: 768px) {

            /* Hide sidebar off screen by default */
            .sidebar {
                transform: translateX(-100%);
            }

            /* Show sidebar when active */
            .sidebar.open {
                transform: translateX(0);
            }

            /* Show hamburger button */
            .hamburger {
                display: flex;
            }

            /* Main takes full width on mobile */
            .main {
                margin-left: 0;
                padding: 20px 16px;
                padding-top: 64px; /* space for hamburger button */
            }

            .welcome-banner {
                padding: 20px;
            }

            .welcome-banner h1 {
                font-size: 1.2rem;
            }

            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .card {
                padding: 16px 12px;
            }

            .card .icon { font-size: 1.5rem; }
            .card h3 { font-size: 0.85rem; }
            .card p { font-size: 0.75rem; }

            table { font-size: 0.8rem; }
            td { padding: 8px 10px; }
            td:first-child { width: 120px; }
        }

        @media (max-width: 400px) {
            .cards-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>

<!-- Overlay (closes sidebar when clicked) -->
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<!-- Hamburger Button -->
<button class="hamburger" id="hamburger" onclick="toggleSidebar()">
    <span></span>
    <span></span>
    <span></span>
</button>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-title">Teacher Panel</div>
    <nav>
        <a href="{{ route('teacher.dashboard') }}" class="active">🏠 Dashboard</a>
        {{-- Add more links here later e.g. My Students, Attendance, etc. --}}
    </nav>
    <div class="sidebar-footer">
        <form class="logout-form" method="POST" action="{{ route('teacher.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">🚪 Logout</button>
        </form>
        <div style="margin-top:10px;">
            Logged in as<br>
            <strong style="color:#fff;">{{ $teacher->name }}</strong>
        </div>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <div class="welcome-banner">
        <h1>Welcome, {{ $teacher->name }}! 👋</h1>
        <p>Arya Public Academy — Teacher Dashboard</p>
    </div>

    <div class="cards-grid">
        <div class="card">
            <div class="icon">📚</div>
            <h3>Subject</h3>
            <p>{{ $teacher->subject }}</p>
        </div>
        <div class="card">
            <div class="icon">🎓</div>
            <h3>Qualification</h3>
            <p>{{ $teacher->qualification }}</p>
        </div>
        <div class="card">
            <div class="icon">⏳</div>
            <h3>Experience</h3>
            <p>{{ $teacher->experience }} Years</p>
        </div>
        <div class="card">
            <div class="icon">📅</div>
            <h3>Date of Joining</h3>
            <p>{{ $teacher->doj }}</p>
        </div>
    </div>

    <div class="profile-section">
        <h2>My Profile Details</h2>
        <table>
            <tr><td>Full Name</td><td>{{ $teacher->name }}</td></tr>
            <tr><td>Email</td><td>{{ $teacher->email }}</td></tr>
            <tr><td>Phone</td><td>{{ $teacher->phone }}</td></tr>
            <tr><td>Subject</td><td>{{ $teacher->subject }}</td></tr>
            <tr><td>Qualification</td><td>{{ $teacher->qualification }}</td></tr>
            <tr><td>Experience</td><td>{{ $teacher->experience }} Years</td></tr>
            <tr><td>Date of Joining</td><td>{{ $teacher->doj }}</td></tr>
        </table>
    </div>

</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    }

    function closeSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
    }
</script>

</body>
</html>
