<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance - Teacher Panel</title>
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

        /* VIEW ATTENDANCE */
        .attendance-wrapper { min-height: calc(100vh - 120px); display: flex; justify-content: center; align-items: flex-start; padding-top: 40px; }
        .attendance-card { background: #ffffff; width: 520px; padding: 30px; border-radius: 16px; box-shadow: 0 25px 50px rgba(0,0,0,0.2); }
        .attendance-card h2 { text-align: center; margin-bottom: 20px; color: #333; }
        label { font-weight: 600; color: #555; }
        select, input[type="date"] { width: 100%; padding: 10px; margin-top: 6px; border-radius: 8px; border: 1px solid #ccc; font-size: 14px; }
        button { width: 100%; margin-top: 16px; padding: 12px; background: linear-gradient(135deg, #667eea, #764ba2); border: none; color: #fff; font-weight: bold; border-radius: 10px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 22px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: center; font-size: 14px; }
        th { background: #f1f5f9; font-weight: 700; }
        .present { color: green; font-weight: bold; }
        .absent { color: red; font-weight: bold; }
        .edit-btn { background-color: #4CAF50; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px; display: inline-block; }

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
            <h2>📊 View Attendance</h2>

            @if(session('error'))
                <div style="background:#fee2e2; color:#991b1b; padding:10px 14px; border-radius:8px; margin-bottom:16px; text-align:center;">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('teacher.attendance.view') }}">
                @csrf
                <label>Select Class</label>
                <select name="class" required>
                    <option value="" disabled {{ empty($class ?? '') ? 'selected' : '' }}>-- Select Class --</option>
                    @foreach($classes as $cls)
                        <option value="{{ $cls }}" {{ isset($class) && $class == $cls ? 'selected' : '' }}>{{ $cls }}</option>
                    @endforeach
                </select>

                <label style="margin-top:12px;">Select Date</label>
                <input type="date" name="date" value="{{ isset($date) ? $date : date('Y-m-d') }}" required>

                <button type="submit">View Attendance</button>
            </form>

            @isset($attendanceRecords)
                <table>
                    <tr>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    @forelse($attendanceRecords as $row)
                        <tr>
                            <td>{{ $row->roll_no }}</td>
                            <td>{{ $row->name }}</td>
                            <td class="{{ strtolower($row->status) }}">{{ $row->status }}</td>
                            <td>
                                @if($canEdit)
                                    <a href="{{ route('teacher.attendance.edit', $row->id) }}" class="edit-btn">Edit</a>
                                @else
                                    <button disabled style="background:#ccc; padding:5px 10px; border:none; border-radius:5px; cursor:not-allowed;">Edit</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No attendance found</td></tr>
                    @endforelse
                </table>
            @endisset
        </div>
    </div>
</div>

<script>
    function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); document.getElementById('overlay').classList.toggle('active'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('active'); }
</script>
</body>
</html>
