<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance - Teacher Panel</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f1f5f9; display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar { width: 240px; background: #7c2d12; color: #fff; display: flex; flex-direction: column; padding: 24px 0; position: fixed; height: 100vh; top: 0; left: 0; z-index: 1000; transition: transform 0.3s ease; }
        .sidebar-title { text-align: center; font-size: 1.2rem; font-weight: 700; padding: 0 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.15); margin-bottom: 16px; }
        .sidebar nav a { display: block; padding: 12px 24px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.95rem; transition: background 0.2s; }
        .sidebar nav a:hover, .sidebar nav a.active { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar-footer { margin-top: auto; padding: 16px 24px; font-size: 0.8rem; color: rgba(255,255,255,0.6); border-top: 1px solid rgba(255,255,255,0.15); }
        .logout-form { margin: 0; }
        .logout-btn { background: none; border: none; color: rgba(255,255,255,0.85); font-size: 0.95rem; cursor: pointer; padding: 12px 24px; width: 100%; text-align: left; transition: background 0.2s; }
        .logout-btn:hover { background: rgba(255,255,255,0.15); color: #fff; }

        /* HAMBURGER */
        .hamburger { display: none; position: fixed; top: 14px; left: 14px; z-index: 1100; background: #7c2d12; border: none; border-radius: 8px; padding: 8px 10px; cursor: pointer; flex-direction: column; gap: 5px; }
        .hamburger span { display: block; width: 24px; height: 3px; background: #fff; border-radius: 3px; }
        .overlay-bg { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; }
        .overlay-bg.active { display: block; }

        /* MAIN */
        .main { margin-left: 240px; padding: 32px; flex: 1; }

        /* ATTENDANCE CARD */
        .attendance-wrapper { min-height: calc(100vh - 120px); display: flex; justify-content: center; align-items: center; position: relative; overflow: hidden; }
        .attendance-wrapper::before, .attendance-wrapper::after { content: ''; position: absolute; width: 420px; height: 420px; background: radial-gradient(circle, rgba(102,126,234,0.35), transparent 70%); filter: blur(40px); animation: float 10s infinite alternate ease-in-out; z-index: 0; }
        .attendance-wrapper::after { right: -120px; bottom: -120px; animation-delay: 3s; }
        .attendance-wrapper::before { left: -120px; top: -120px; }
        @keyframes float { from { transform: translateY(0); } to { transform: translateY(40px); } }

        .attendance-card { position: relative; z-index: 1; background: linear-gradient(180deg, #ffffff, #f8fafc); width: 420px; padding: 36px 34px 40px; border-radius: 22px; box-shadow: 0 30px 80px rgba(0,0,0,0.18), inset 0 1px 0 rgba(255,255,255,0.9); animation: cardIn .7s ease; }
        @keyframes cardIn { from { opacity: 0; transform: translateY(30px) scale(.97); } to { opacity: 1; transform: translateY(0) scale(1); } }
        .attendance-card h2 { margin: 0 0 22px; text-align: center; font-size: 28px; font-weight: 800; letter-spacing: .5px; background: linear-gradient(90deg,#667eea,#764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .success-message { background: linear-gradient(135deg,#dcfce7,#bbf7d0); color: #166534; padding: 10px 14px; border-radius: 12px; text-align: center; font-weight: 600; margin-bottom: 18px; box-shadow: 0 10px 30px rgba(34,197,94,.25); }
        .attendance-card label { font-size: 14px; font-weight: 700; color: #374151; display: block; margin-bottom: 6px; }
        .attendance-card select, .attendance-card input[type="date"] { width: 100%; padding: 14px 16px; border-radius: 14px; border: 1px solid #e5e7eb; font-size: 15px; outline: none; background: #ffffff; transition: all .25s ease; box-shadow: inset 0 1px 2px rgba(0,0,0,.04); }
        .attendance-card select:focus, .attendance-card input[type="date"]:focus { border-color: #667eea; box-shadow: 0 0 0 4px rgba(102,126,234,.2), inset 0 1px 2px rgba(0,0,0,.04); }
        .attendance-card button { width: 100%; margin-top: 18px; padding: 15px; border-radius: 16px; border: none; cursor: pointer; font-size: 16px; font-weight: 800; letter-spacing: .6px; color: white; background: linear-gradient(135deg,#667eea,#764ba2); box-shadow: 0 18px 40px rgba(102,126,234,.45); transition: all .25s ease; }
        .attendance-card button:hover { transform: translateY(-2px); box-shadow: 0 28px 60px rgba(102,126,234,.6); }
        .attendance-card a { position: relative; margin-top: 16px; display: block; text-align: center; padding: 14px; border-radius: 16px; border: 2px dashed rgba(102,126,234,.6); font-weight: 700; color: #667eea; text-decoration: none; transition: all .25s ease; background: rgba(102,126,234,.04); }
        .attendance-card a:hover { background: rgba(102,126,234,.12); transform: translateY(-1px); box-shadow: 0 12px 30px rgba(102,126,234,.25); }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .hamburger { display: flex; }
            .main { margin-left: 0; padding: 20px 16px; padding-top: 64px; }
            .attendance-card { width: 100%; padding: 24px 20px; }
        }
    </style>
</head>
<body>

<div class="overlay-bg" id="overlay" onclick="closeSidebar()"></div>
<button class="hamburger" onclick="toggleSidebar()"><span></span><span></span><span></span></button>

<div class="sidebar" id="sidebar">
    <div class="sidebar-title">Teacher Panel</div>
    <nav>
        <a href="{{ route('teacher.dashboard') }}">🏠 Dashboard</a>
        <a href="{{ route('teacher.attendance') }}" class="active">📋 Attendance</a>
        <a href="{{ route('teacher.exams.index') }}">📝 Examinations</a>

    </nav>
    <div class="sidebar-footer">
        <form class="logout-form" method="POST" action="{{ route('teacher.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">🚪 Logout</button>
        </form>
        <div style="margin-top:10px;">Logged in as<br><strong style="color:#fff;">{{ Auth::guard('teacher')->user()->name }}</strong></div>
    </div>
</div>

<div class="main">
    <div class="attendance-wrapper">
        <div class="attendance-card">
            <h2>📋 Mark Attendance</h2>

            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('teacher.attendance.show') }}">
                @csrf
                <label>Select Class</label>
                <select name="class" required>
                    <option value="">-- Select Class --</option>
                    @foreach($classes as $class)
                        <option value="{{ $class }}">Class {{ $class }}</option>
                    @endforeach
                </select>

                <label style="margin-top:12px;">Select Date</label>
                <input type="date" name="date" value="{{ date('Y-m-d') }}" required>

                <button type="submit">Proceed to Attendance →</button>

                <a href="{{ route('teacher.attendance.viewForm') }}">👀 View Attendance</a>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); document.getElementById('overlay').classList.toggle('active'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('active'); }
</script>
</body>
</html>
