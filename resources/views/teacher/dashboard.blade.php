<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Arya Public Academy</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f5f9;
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #7c2d12;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 24px 0;
            position: fixed;
            height: 100vh;
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

        /* MAIN CONTENT */
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

        /* CARDS */
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

        /* PROFILE TABLE */
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

        /* LOGOUT FORM */
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
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
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
            <div class="icon">📅</div>
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

</body>
</html>
