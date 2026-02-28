<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Teacher Panel</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f1f5f9; display: flex; min-height: 100vh; }

        .sidebar { width: 240px; background: #7c2d12; color: #fff; display: flex; flex-direction: column; padding: 24px 0; position: fixed; height: 100vh; top: 0; left: 0; z-index: 1000; transition: transform 0.3s ease; }
        .sidebar-title { text-align: center; font-size: 1.2rem; font-weight: 700; padding: 0 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.15); margin-bottom: 16px; }
        .sidebar nav a { display: block; padding: 12px 24px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.95rem; transition: background 0.2s; }
        .sidebar nav a:hover, .sidebar nav a.active { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar-footer { margin-top: auto; padding: 16px 24px; font-size: 0.8rem; color: rgba(255,255,255,0.6); border-top: 1px solid rgba(255,255,255,0.15); }
        .logout-form { margin: 0; }
        .logout-btn { background: none; border: none; color: rgba(255,255,255,0.85); font-size: 0.95rem; cursor: pointer; padding: 12px 24px; width: 100%; text-align: left; transition: background 0.2s; }
        .logout-btn:hover { background: rgba(255,255,255,0.15); color: #fff; }

        .hamburger { display: none; position: fixed; top: 14px; left: 14px; z-index: 1100; background: #7c2d12; border: none; border-radius: 8px; padding: 8px 10px; cursor: pointer; flex-direction: column; gap: 5px; }
        .hamburger span { display: block; width: 24px; height: 3px; background: #fff; border-radius: 3px; }
        .overlay-bg { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; }
        .overlay-bg.active { display: block; }

        .main { margin-left: 240px; padding: 32px; flex: 1; }

        :root {
            --border: rgba(255,255,255,0.10);
            --blue: #38bdf8; --indigo: #818cf8;
            --green: #22c55e; --amber: #f59e0b;
            --shadow: 0 25px 70px rgba(0,0,0,0.35);
        }

        .stu-wrap { max-width: 1100px; margin: 0 auto; padding: 26px 18px; }
        .stu-hero { position: relative; overflow: hidden; border-radius: 26px; padding: 22px 22px 18px; background: radial-gradient(900px 300px at 20% 10%, rgba(56,189,248,0.18), transparent 60%), radial-gradient(700px 260px at 85% 30%, rgba(129,140,248,0.20), transparent 55%), linear-gradient(180deg, rgba(15,23,42,0.92), rgba(2,6,23,0.92)); border: 1px solid var(--border); box-shadow: var(--shadow); }
        .stu-head { position: relative; display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; flex-wrap: wrap; z-index: 1; }
        .stu-title { margin: 0; font-size: 26px; font-weight: 900; background: linear-gradient(90deg, var(--blue), var(--indigo)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .stu-sub { margin: 8px 0 0; color: rgba(229,231,235,0.78); font-weight: 700; }

        .top-actions { position: relative; z-index: 1; display: flex; gap: 10px; flex-wrap: wrap; align-items: flex-end; }
        .year-form { display: flex; gap: 10px; align-items: flex-end; flex-wrap: wrap; margin: 0; padding: 10px 12px; border-radius: 18px; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.06); }
        .year-label { font-weight: 900; color: rgba(229,231,235,0.85); font-size: 12px; display: block; margin-bottom: 6px; }
        .year-input { padding: 10px 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.14); background: rgba(255,255,255,0.08); color: #e5e7eb; outline: none; min-width: 130px; font-weight: 900; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 10px 14px; border-radius: 14px; font-weight: 900; text-decoration: none; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.06); color: #e5e7eb; cursor: pointer; transition: transform .2s ease, border-color .2s ease; white-space: nowrap; }
        .btn:hover { transform: translateY(-2px); border-color: rgba(56,189,248,0.35); background: rgba(56,189,248,0.10); }
        .btn.primary { border-color: rgba(56,189,248,0.20); background: linear-gradient(90deg, rgba(56,189,248,0.20), rgba(129,140,248,0.16)); color: #dbeafe; }

        .alert { margin-top: 14px; padding: 12px 14px; border-radius: 16px; font-weight: 900; }
        .alert.success { border: 1px solid rgba(34,197,94,0.25); background: rgba(34,197,94,0.14); color:black; }
        .alert.error { border: 1px solid rgba(239,68,68,0.25); background: rgba(239,68,68,0.14); color: #fecaca; }

        .table-card { margin-top: 16px; border-radius: 22px; overflow: hidden; border: 1px solid rgba(255,255,255,0.10); background: radial-gradient(700px 260px at 15% 0%, rgba(56,189,248,0.10), transparent 55%), linear-gradient(180deg, rgba(11,18,36,0.92), rgba(2,6,23,0.92)); box-shadow: 0 18px 60px rgba(0,0,0,0.35); }
        table { width: 100%; border-collapse: collapse; }
        thead th { text-align: left; padding: 14px; font-size: 12px; font-weight: 900; letter-spacing: .3px; color: rgba(219,234,254,0.9); background: rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.08); text-transform: uppercase; }
        tbody td { padding: 14px; border-bottom: 1px solid rgba(255,255,255,0.06); color: rgba(229,231,235,0.9); font-weight: 700; }
        tbody tr:hover { background: rgba(255,255,255,0.04); }

        .pill { display: inline-flex; align-items: center; gap: 8px; padding: 6px 10px; border-radius: 999px; font-weight: 900; font-size: 12px; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.06); color: rgba(229,231,235,0.9); }
        .dot { width: 8px; height: 8px; border-radius: 50%; }
        .pill.warn { border-color: rgba(245,158,11,0.28); background: rgba(245,158,11,0.12); color: #ffedd5; }
        .pill.warn .dot { background: var(--amber); }
        .pill.pub { border-color: rgba(34,197,94,0.28); background: rgba(34,197,94,0.12); color: #dcfce7; }
        .pill.pub .dot { background: var(--green); }
        .pill.saved { border-color: rgba(56,189,248,0.28); background: rgba(56,189,248,0.12); color: #cffafe; }
        .pill.saved .dot { background: var(--blue); }

        .enter-btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 10px 14px; border-radius: 14px; font-weight: 900; text-decoration: none; border: 1px solid rgba(34,197,94,0.22); background: rgba(34,197,94,0.18); color: #dcfce7; transition: transform .2s ease; white-space: nowrap; }
        .enter-btn:hover { transform: translateY(-2px); border-color: rgba(34,197,94,0.35); background: rgba(34,197,94,0.22); }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .hamburger { display: flex; }
            .main { margin-left: 0; padding: 20px 16px; padding-top: 64px; }
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
        <a href="{{ route('teacher.attendance') }}">📋 Attendance</a>
        <a href="{{ route('teacher.exams.index') }}" class="active">📝 Examinations</a>
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
    <div class="stu-wrap">
        <div class="stu-hero">
            <div class="stu-head">
                <div>
                    <h2 class="stu-title">{{ $type }} — Class {{ $class }}</h2>
                    <p class="stu-sub">Select a student to enter marks. (Year matters)</p>
                </div>
                <div class="top-actions">
                    <form method="GET" action="{{ route('teacher.exams.students', [$type, $class]) }}" class="year-form">
                        <div>
                            <span class="year-label">Year</span>
                            <input name="year" value="{{ $year ?? date('Y') }}" class="year-input">
                        </div>
                        <button type="submit" class="btn primary" style="border:none;">Apply</button>
                    </form>
                    <a class="btn" href="{{ route('teacher.exams.classes', $type) }}">← Back</a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert success">✅ {{ session('success') }}</div>
        @endif

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th style="width:90px;">Roll</th>
                        <th>Name</th>
                        <th style="width:220px;">Status</th>
                        <th style="width:220px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $st)
                        @php $r = $resultMap[$st->id] ?? null; @endphp
                        <tr>
                            <td>{{ $st->roll_no }}</td>
                            <td>{{ $st->name }}</td>
                            <td>
                                @if(!$r)
                                    <span class="pill warn"><span class="dot"></span> Not Saved</span>
                                @elseif($r->is_published)
                                    <span class="pill pub"><span class="dot"></span> Published</span>
                                @else
                                    <span class="pill saved"><span class="dot"></span> Saved</span>
                                @endif
                            </td>
                            <td>
                                <a class="enter-btn" href="{{ route('teacher.exams.entry', [$type, $class, $st->id]) }}?year={{ $year }}">
                                    Enter Marks →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="padding:16px;color:rgba(229,231,235,0.75);">No students found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); document.getElementById('overlay').classList.toggle('active'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('active'); }
</script>
</body>
</html>
