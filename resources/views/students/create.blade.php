<x-app-layout>

<style>
.page-wrap {
    padding: 40px;
}

.header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.title {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(90deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* CLASS GRID */
.class-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.class-card {
    background: linear-gradient(145deg, #1e293b, #0f172a);
    border-radius: 20px;
    padding: 25px;
    color: #e5e7eb;
    box-shadow: 0 25px 60px rgba(0,0,0,0.45);
    cursor: pointer;
    transition: 0.3s ease;
}

.class-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 35px 80px rgba(56,189,248,0.35);
}

/* FORM */
.form-box {
    display: none;
    margin-top: 40px;
    background: rgba(15,23,42,0.85);
    backdrop-filter: blur(18px);
    padding: 35px;
    border-radius: 22px;
}

input {
    width: 100%;
    padding: 14px 18px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.08);
    color: white;
    margin-bottom: 16px;
}

/* ✅ small fix for file input in dark theme */
input[type="file"]{
    padding: 10px 12px;
    cursor: pointer;
}

button {
    background: linear-gradient(90deg, #38bdf8, #6366f1);
    padding: 14px 32px;
    border-radius: 16px;
    font-weight: 700;
    color: #020617;
    border: none;
    cursor: pointer;
}

textarea {
    width: 100%;
    padding: 14px 18px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.08);
    color: white;
    margin-bottom: 16px;
    min-height: 90px;
    resize: vertical;
}
</style>

<div class="page-wrap">

    <div class="header-row">
        <h1 class="title">➕ Add New Student</h1>

        <a href="{{ route('students.index') }}"
           style="padding:12px 22px;border-radius:14px;background:#22c55e;color:white;font-weight:700;text-decoration:none;">
            📋 View Students
        </a>
    </div>

    <!-- CLASS SELECTION -->
    <div class="class-grid">
        @foreach($classes as $class)
            <div class="class-card" onclick="selectClass('{{ $class }}')">
                <h2>Class {{ $class }}</h2>
                <p>Add student to Class {{ $class }}</p>
            </div>
        @endforeach
    </div>

    <!-- FORM -->
    <div class="form-box" id="studentForm">
        <!-- ✅ IMPORTANT: enctype added for file upload -->
        <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="class" id="classInput">

            <div>
                <label style="display:block;margin-bottom:8px;font-weight:700;color:#e5e7eb;">Student Photo</label>
                <input type="file" name="photo" accept="image/*">
            </div>

            <input name="name" placeholder="Student Name" required>
            <input name="roll_no" placeholder="Roll Number" required>
            <input name="phone" placeholder="Phone Number" required>

            <input name="father_name" placeholder="Father's Name">
            <input name="mother_name" placeholder="Mother's Name">
            <input type="date" name="dob" required>


            <input name="religion" placeholder="Religion">
            <input name="citizenship" placeholder="Citizenship">

            <input name="address" placeholder="Address">

            <button type="submit">Add Student</button>
        </form>
    </div>

</div>

<script>
function selectClass(cls) {
    document.getElementById('classInput').value = cls;
    document.getElementById('studentForm').style.display = 'block';
    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
}
</script>

</x-app-layout>
