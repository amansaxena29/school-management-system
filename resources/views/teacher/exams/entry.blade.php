<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Entry - Teacher Panel</title>
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
            --green: #22c55e; --red: #ef4444;
            --shadow: 0 25px 70px rgba(0,0,0,0.35);
        }

        .entry-wrap { max-width: 1100px; margin: 0 auto; padding: 26px 18px; }
        .entry-hero { position: relative; overflow: hidden; border-radius: 26px; padding: 22px 22px 18px; background: radial-gradient(900px 300px at 20% 10%, rgba(56,189,248,0.18), transparent 60%), radial-gradient(700px 260px at 85% 30%, rgba(129,140,248,0.20), transparent 55%), linear-gradient(180deg, rgba(15,23,42,0.92), rgba(2,6,23,0.92)); border: 1px solid var(--border); box-shadow: var(--shadow); }
        .entry-head { position: relative; display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; flex-wrap: wrap; z-index: 1; }
        .entry-title { margin: 0; font-size: 26px; font-weight: 900; background: linear-gradient(90deg, var(--blue), var(--indigo)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .entry-sub { margin: 8px 0 0; color: rgba(229,231,235,0.78); font-weight: 700; }
        .back-btn { position: relative; z-index: 1; display: inline-flex; align-items: center; padding: 10px 14px; border-radius: 14px; text-decoration: none; font-weight: 900; color: #dbeafe; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); transition: transform .2s ease; white-space: nowrap; }
        .back-btn:hover { transform: translateY(-2px); border-color: rgba(56,189,248,0.35); background: rgba(56,189,248,0.10); }

        .card { margin-top: 16px; border-radius: 22px; overflow: hidden; border: 1px solid rgba(255,255,255,0.10); background: radial-gradient(700px 260px at 15% 0%, rgba(56,189,248,0.10), transparent 55%), linear-gradient(180deg, rgba(11,18,36,0.92), rgba(2,6,23,0.92)); box-shadow: 0 18px 60px rgba(0,0,0,0.35); padding: 18px; color: rgba(229,231,235,0.92); }
        .grid { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 14px; margin-top: 10px; }
        .field label { font-weight: 900; color: rgba(229,231,235,0.85); font-size: 12px; display: block; margin-bottom: 6px; }
        .field input { width: 100%; padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.14); background: rgba(255,255,255,0.08); color: #e5e7eb; outline: none; font-weight: 900; }
        .field input:focus { border-color: rgba(56,189,248,0.5); box-shadow: 0 0 0 5px rgba(56,189,248,0.10); }
        .full { grid-column: 1 / -1; }
        .publish { display: flex; align-items: center; gap: 10px; padding: 12px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.06); font-weight: 900; color: rgba(229,231,235,0.9); }
        .publish input { width: 18px; height: 18px; accent-color: var(--green); }
        .sub { margin: 18px 0 10px; font-size: 14px; font-weight: 900; color: rgba(219,234,254,0.9); }

        .row { display: grid; grid-template-columns: 1.2fr .55fr .55fr 44px; gap: 10px; align-items: center; margin-bottom: 10px; }
        .row input { padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.14); background: rgba(255,255,255,0.08); color: #e5e7eb; outline: none; font-weight: 900; }
        .row input:focus { border-color: rgba(56,189,248,0.5); }
        .del { width: 44px; height: 44px; border: none; border-radius: 14px; background: rgba(239,68,68,0.18); border: 1px solid rgba(239,68,68,0.28); color: #fecaca; font-weight: 900; cursor: pointer; transition: transform .2s ease; }
        .del:hover { transform: translateY(-2px); }

        .actions { display: flex; justify-content: space-between; gap: 12px; margin-top: 16px; flex-wrap: wrap; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 12px 14px; border-radius: 14px; font-weight: 900; cursor: pointer; border: 1px solid rgba(255,255,255,0.12); background: rgba(255,255,255,0.06); color: #e5e7eb; transition: transform .2s ease; }
        .btn.blue { border: none; background: linear-gradient(90deg, rgba(56,189,248,0.85), rgba(129,140,248,0.85)); color: #020617; }
        .btn.green { border: none; background: linear-gradient(90deg, rgba(34,197,94,0.92), rgba(16,185,129,0.92)); color: #02170f; }
        .btn:hover { transform: translateY(-2px); }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .hamburger { display: flex; }
            .main { margin-left: 0; padding: 20px 16px; padding-top: 64px; }
            .grid { grid-template-columns: 1fr; }
            .row { grid-template-columns: 1fr 1fr; }
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
    <div class="entry-wrap">
        <div class="entry-hero">
            <div class="entry-head">
                <div>
                    <h2 class="entry-title">🧾 {{ $type }} Result Entry</h2>
                    <p class="entry-sub">Class {{ $class }} | {{ $student->name }} (Roll: {{ $student->roll_no }})</p>
                </div>
                <a class="back-btn" href="{{ route('teacher.exams.students', [$type, $class]) }}?year={{ $year }}">← Back</a>
            </div>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('teacher.results.store') }}">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <input type="hidden" name="exam_name" value="{{ $type }}">
                <input type="hidden" name="year" value="{{ $year }}">
                <input type="hidden" name="class" value="{{ $class }}">

                <div class="grid">
                    <div class="field">
                        <label>Exam Name</label>
                        <input value="{{ $type }}" disabled>
                    </div>
                    <div class="field">
                        <label>Year</label>
                        <input value="{{ $year }}" disabled>
                    </div>
                    <div class="full publish">
                        <input type="checkbox" id="pub" name="is_published"
                               {{ ($result && $result->is_published) ? 'checked' : '' }}>
                        <label for="pub">Publish result (make it live)</label>
                    </div>
                </div>

                <h3 class="sub">Subjects (Marks + Grade)</h3>

                <div id="subjectsWrap">
                    @php
                        $rows = $result?->subjects;
                        if (!$rows || $rows->count() === 0) {
                            $rows = collect([
                                (object)['subject'=>'Math','marks'=>0,'max_marks'=>100,'grade'=>null],
                                (object)['subject'=>'Science','marks'=>0,'max_marks'=>100,'grade'=>null],
                                (object)['subject'=>'English','marks'=>0,'max_marks'=>100,'grade'=>null],
                            ]);
                        }
                    @endphp

                    @foreach($rows as $i => $s)
                        <div class="row">
                            <input name="subjects[{{ $i }}][name]" value="{{ $s->subject }}" placeholder="Subject" required>
                            <input name="subjects[{{ $i }}][marks]" value="{{ $s->marks }}" placeholder="Marks" type="number" min="0" required>
                            <input name="subjects[{{ $i }}][max]" value="{{ $s->max_marks }}" placeholder="Max" type="number" min="1" required>
                            <button type="button" class="del" onclick="removeRow(this)">✕</button>
                        </div>
                    @endforeach
                </div>

                <div class="actions">
                    <button type="button" class="btn blue" onclick="addRow()">+ Add Subject</button>
                    <button type="submit" class="btn green">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let idx = {{ $rows->count() ?? 3 }};
    function addRow() {
        const wrap = document.getElementById('subjectsWrap');
        const div = document.createElement('div');
        div.className = 'row';
        div.innerHTML = `
            <input name="subjects[${idx}][name]" placeholder="Subject" required>
            <input name="subjects[${idx}][marks]" placeholder="Marks" type="number" min="0" required>
            <input name="subjects[${idx}][max]" placeholder="Max" type="number" min="1" value="100" required>
            <button type="button" class="del" onclick="removeRow(this)">✕</button>
        `;
        wrap.appendChild(div);
        idx++;
    }
    function removeRow(btn) { btn.closest('.row').remove(); }
    function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); document.getElementById('overlay').classList.toggle('active'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('overlay').classList.remove('active'); }
</script>
</body>
</html>
