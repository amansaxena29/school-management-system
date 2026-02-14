<x-app-layout>

<style>
.page-wrap {
    padding: 50px;
}

/* GLASS CONTAINER */
.glass-box {
    background: rgba(15,23,42,0.85);
    backdrop-filter: blur(18px);
    border-radius: 28px;
    padding: 45px;
    box-shadow: 0 40px 120px rgba(0,0,0,0.6);
    color: #e5e7eb;
}

/* TITLE */
.title {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 30px;
    background: linear-gradient(90deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 14px;
}

thead th {
    text-align: left;
    padding: 16px 22px;
    color: #93c5fd;
    font-weight: 700;
}

tbody tr {
    background: rgba(255,255,255,0.05);
    transition: all 0.25s ease;
}

tbody tr:hover {
    background: rgba(255,255,255,0.08);
}

tbody td {
    padding: 18px 22px;
    vertical-align: middle;
}

tbody tr td:first-child {
    border-radius: 16px 0 0 16px;
}

tbody tr td:last-child {
    border-radius: 0 16px 16px 0;
}

/* ✅ PHOTO + NAME CELL */
.name-cell{
    display:flex;
    align-items:center;
    gap:12px;
}

.avatar{
    width: 36px;
    height: 36px;
    border-radius: 50%;
    overflow:hidden;
    flex: 0 0 36px;
    border: 1px solid rgba(255,255,255,0.18);
    background: rgba(56,189,248,0.12);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight: 800;
    color: #93c5fd;
    text-transform: uppercase;
}

.avatar img{
    width:100%;
    height:100%;
    object-fit: cover;
    display:block;
}

.student-name{
    font-weight: 700;
    color: #e5e7eb;
}

/* ACTION BUTTONS */
.action-wrap {
    display: flex;
    gap: 10px;
}

.btn {
    padding: 8px 16px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.edit {
    background: #22c55e;
    color: #022c22;
    padding:5px 10px;
}

.delete {
    background: #ef4444;
    color: white;
}

/* BACK BUTTON */
.back-btn {
    background: #38bdf8;
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 20px;
    display: inline-block;
}

/* EMPTY STATE */
.empty-text {
    opacity: 0.7;
    font-size: 16px;
}

/* SEARCH */
.search-row{
    display:flex;
    justify-content:flex-end;
    margin: 12px 0 18px;
}

.search-input{
    width: 420px;
    max-width: 100%;
    padding: 12px 14px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.18);
    background: rgba(255,255,255,0.08);
    color: #e5e7eb;
    outline: none;
}

.search-input::placeholder{
    color: rgba(229,231,235,0.65);
}

.search-input:focus{
    border-color: rgba(56,189,248,0.7);
    box-shadow: 0 0 0 4px rgba(56,189,248,0.12);
}

.search-box{
    position: relative;
    width: 420px;
    max-width: 100%;
}

.clear-btn{
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.15);
    border: none;
    color: #e5e7eb;
    font-size: 14px;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    cursor: pointer;
    display: none;
}

.clear-btn:hover{
    background: rgba(239,68,68,0.35);
}
</style>

<div class="page-wrap">
    <!-- Back Button -->
    <a href="/students" class="back-btn">← Back to Students</a>

    <div class="glass-box">
        <h1 class="title">📘 Class {{ $class }} — Students</h1>

        <!-- SEARCH BAR -->
        <div class="search-row">
            <div class="search-box">
                <input
                    type="text"
                    id="studentSearch"
                    class="search-input"
                    placeholder="Search here"
                    onkeyup="searchStudents()"
                >

                <button
                    type="button"
                    class="clear-btn"
                    onclick="clearSearch()"
                    title="Clear search"
                >
                    ✕
                </button>
            </div>
        </div>

        @if(session('success'))
            <div style="
                margin: 18px 0 22px;
                padding: 14px 18px;
                border-radius: 14px;
                background: rgba(34,197,94,0.15);
                border: 1px solid rgba(34,197,94,0.35);
                color: #bbf7d0;
                font-weight: 700;
            ">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($students->isEmpty())
            <p class="empty-text">No students found in this class.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Phone</th>
                        <th>Father</th>
                        <th>Mother</th>
                        <th>Religion</th>
                        <th>Citizenship</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($students as $student)
                        @php
                            // ✅ photo_path DB column exists as per your table
                            $photoUrl = !empty($student->photo_path) ? asset($student->photo_path) : null;

                            // initials fallback
                            $initials = '';
                            if (!empty($student->name)) {
                                $parts = preg_split('/\s+/', trim($student->name));
                                $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                                $initials = trim($initials) ?: strtoupper(substr($student->name, 0, 1));
                            }
                        @endphp

                        <tr>
                            <td>
                                <div class="name-cell">
                                    <div class="avatar">
                                        @if($photoUrl)
                                            <img src="{{ $photoUrl }}" alt="Photo"
                                                 onerror="this.onerror=null; this.remove(); this.parentElement.innerText='{{ $initials ?: 'S' }}';">
                                        @else
                                            {{ $initials ?: 'S' }}
                                        @endif
                                    </div>

                                    <div class="student-name">{{ $student->name }}</div>
                                </div>
                            </td>

                            <td>{{ $student->roll_no }}</td>
                            <td>{{ $student->phone }}</td>

                            <td>{{ $student->father_name ?? '-' }}</td>
                            <td>{{ $student->mother_name ?? '-' }}</td>
                            <td>{{ $student->religion ?? '-' }}</td>
                            <td>{{ $student->citizenship ?? '-' }}</td>

                            <td style="max-width: 260px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $student->address ?? '-' }}
                            </td>

                            <td>
                                <div class="action-wrap">
                                    <a href="{{ route('students.edit', $student) }}" class="btn edit">Edit</a>

                                    <form method="POST" action="{{ route('students.destroy', $student) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<script>
function searchStudents() {
    const input = document.getElementById('studentSearch');
    const filter = input.value.toLowerCase();
    const clearBtn = document.querySelector('.clear-btn');

    const tbody = document.querySelector('table tbody');
    if (!tbody) return;

    const rows = tbody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const rowText = rows[i].innerText.toLowerCase();
        rows[i].style.display = rowText.includes(filter) ? '' : 'none';
    }

    clearBtn.style.display = filter ? 'flex' : 'none';
}

function clearSearch() {
    const input = document.getElementById('studentSearch');
    const clearBtn = document.querySelector('.clear-btn');

    input.value = '';
    clearBtn.style.display = 'none';

    const rows = document.querySelectorAll('table tbody tr');
    rows.forEach(row => row.style.display = '');
}
</script>

</x-app-layout>
