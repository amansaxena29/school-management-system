<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examinations - Teacher Panel</title>
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

        /* EXAM STYLES */
        :root {
            --border: rgba(255,255,255,0.10);
            --blue: #38bdf8;
            --indigo: #818cf8;
            --green: #22c55e;
            --shadow: 0 25px 70px rgba(0,0,0,0.35);
        }

        .exam-wrap { max-width: 980px; margin: 0 auto; padding: 26px 18px; }

        .exam-hero { position: relative; overflow: hidden; border-radius: 26px; padding: 26px 26px 22px; background: radial-gradient(900px 300px at 20% 10%, rgba(56,189,248,0.18), transparent 60%), radial-gradient(700px 260px at 85% 30%, rgba(129,140,248,0.20), transparent 55%), linear-gradient(180deg, rgba(15,23,42,0.92), rgba(2,6,23,0.92)); border: 1px solid var(--border); box-shadow: var(--shadow); }
        .exam-head { position: relative; display: flex; justify-content: space-between; align-items: flex-start; gap: 14px; z-index: 1; }
        .exam-title { margin: 0; font-size: 30px; font-weight: 900; letter-spacing: 0.3px; background: linear-gradient(90deg, var(--blue), var(--indigo)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .exam-sub { margin: 8px 0 0; color: rgba(229,231,235,0.78); font-weight: 700; line-height: 1.4; }
        .exam-badge { position: relative; z-index: 1; padding: 10px 14px; border-radius: 999px; border: 1px solid rgba(56,189,248,0.28); background: rgba(56,189,248,0.10); color: #c7f9ff; font-weight: 900; display: flex; align-items: center; gap: 10px; white-space: nowrap; }
        .badge-dot { width: 10px; height: 10px; border-radius: 50%; background: var(--green); box-shadow: 0 0 0 6px rgba(34,197,94,0.12); }

        .exam-grid { margin-top: 18px; display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 16px; }
        .exam-card { position: relative; text-decoration: none; border-radius: 22px; padding: 18px 18px 16px; border: 1px solid var(--border); background: radial-gradient(600px 220px at 15% 15%, rgba(56,189,248,0.12), transparent 55%), linear-gradient(180deg, rgba(11,18,36,0.92), rgba(2,6,23,0.92)); box-shadow: 0 20px 60px rgba(0,0,0,0.35); color: rgba(229,231,235,0.9); transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease; overflow: hidden; }
        .exam-card:hover { transform: translateY(-6px); border-color: rgba(56,189,248,0.35); box-shadow: 0 28px 85px rgba(0,0,0,0.45); }
        .exam-card-top { position: relative; display: flex; align-items: center; justify-content: space-between; gap: 10px; z-index: 1; }
        .exam-left { display: flex; align-items: center; gap: 12px; }
        .exam-icon { width: 44px; height: 44px; border-radius: 14px; display: grid; place-items: center; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.10); font-size: 18px; }
        .exam-name { margin: 0; font-size: 18px; font-weight: 900; color: #f1f5f9; }
        .exam-arrow { font-size: 18px; font-weight: 900; color: rgba(229,231,235,0.85); transition: transform .25s ease; }
        .exam-card:hover .exam-arrow { transform: translateX(4px); }
        .exam-desc { position: relative; margin-top: 10px; color: rgba(229,231,235,0.72); font-weight: 700; line-height: 1.45; z-index: 1; }
        .exam-meta { position: relative; margin-top: 14px; display: flex; gap: 10px; flex-wrap: wrap; z-index: 1; }
        .pill { padding: 7px 10px; border-radius: 999px; font-size: 12px; font-weight: 900; border: 1px solid rgba(255,255,255,0.10); background: rgba(255,255,255,0.06); color: rgba(229,231,235,0.88); }
        .pill.blue { border-color: rgba(56,189,248,0.22); background: rgba(56,189,248,0.10); color: #c7f9ff; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .hamburger { display: flex; }
            .main { margin-left: 0; padding: 20px 16px; padding-top: 64px; }
            .exam-grid { grid-template-columns: 1fr; }
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
    <div class="exam-wrap">
        <div class="exam-hero">
            <div class="exam-head">
                <div>
                    <h2 class="exam-title">Examination</h2>
                    <p class="exam-sub">Choose an exam type to enter marks, grades, and publish results.</p>
                </div>
                <div class="exam-badge">
                    <span class="badge-dot"></span>
                    Result Entry
                </div>
            </div>
        </div>

        <div class="exam-grid">
            <a class="exam-card" href="{{ route('teacher.exams.classes', 'Half Yearly') }}">
                <div class="exam-card-top">
                    <div class="exam-left">
                        <div class="exam-icon">📝</div>
                        <h3 class="exam-name">Half Yearly</h3>
                    </div>
                    <div class="exam-arrow">→</div>
                </div>
                <div class="exam-desc">Enter marks & grades for the mid-term assessment and keep progress updated.</div>
                <div class="exam-meta">
                    <span class="pill blue">Marks + Grade</span>
                    <span class="pill">Publish Result</span>
                    <span class="pill">Class-wise</span>
                </div>
            </a>

            <a class="exam-card" href="{{ route('teacher.exams.classes', 'Annual') }}">
                <div class="exam-card-top">
                    <div class="exam-left">
                        <div class="exam-icon">🏁</div>
                        <h3 class="exam-name">Annual</h3>
                    </div>
                    <div class="exam-arrow">→</div>
                </div>
                <div class="exam-desc">Final evaluation for the session. Add subjects, marks, grades and generate final performance.</div>
                <div class="exam-meta">
                    <span class="pill blue">Final Result</span>
                    <span class="pill">Marks + Grade</span>
                    <span class="pill">Session Year</span>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); document.getElementById('overlay').classList.toggle('active'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('active'); }
</script>
</body>
</html>
