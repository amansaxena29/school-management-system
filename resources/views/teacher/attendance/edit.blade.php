<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Attendance - Teacher Panel</title>
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

        /* EDIT FORM */
        .attendance-wrapper { display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 120px); background: linear-gradient(135deg, #4E54C8, #8F94FB); border-radius: 16px; }
        .attendance-card { background: #ffffff; width: 400px; padding: 40px 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .attendance-card:hover { transform: translateY(-10px); box-shadow: 0 15px 40px rgba(0,0,0,0.2); transition: all 0.3s ease-in-out; }
        h2 { text-align: center; font-size: 24px; font-weight: 600; color: #333; margin-bottom: 30px; letter-spacing: 1px; }
        label { font-size: 16px; font-weight: 500; color: #333; margin-bottom: 8px; display: block; }
        select { width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #ccc; font-size: 16px; margin-bottom: 25px; outline: none; background-color: #f5f7fb; }
        select:focus { border-color: #4E54C8; background-color: #ffffff; box-shadow: 0 2px 8px rgba(78,84,200,0.3); }
        button { width: 100%; padding: 14px; background: linear-gradient(135deg, #4E54C8, #8F94FB); border: none; color: white; font-size: 18px; font-weight: 500; border-radius: 12px; cursor: pointer; transition: all 0.3s; }
        button:hover { background: linear-gradient(135deg, #8F94FB, #4E54C8); box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .alert { padding: 15px; background-color: #28a745; color: white; border-radius: 8px; margin-bottom: 20px; font-size: 16px; text-align: center; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .hamburger { display: flex; }
            .main { margin-left: 0; padding: 20px 16px; padding-top: 64px; }
            .attendance-card { width: 100%; }
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
            <h2>✏️ Edit Attendance</h2>

            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            <form action="{{ route('teacher.attendance.update', $attendance->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label>Status</label>
                <select name="status" required>
                    <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>✅ Present</option>
                    <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>❌ Absent</option>
                </select>
                <button type="submit">Update Attendance</button>
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
