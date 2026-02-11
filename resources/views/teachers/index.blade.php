@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Page top -->
    <div class="page-top">
        <div>
            <h2 class="title">Teacher Details</h2>
            <p class="subtitle">Add teacher details here. Use “View Teachers” to see the full list.</p>
        </div>

        <div class="actions">
            <a href="{{ route('teachers.list') }}" class="btn-primary">View Teachers</a>
        </div>
    </div>

    <!-- Search Teacher -->
    <div class="search-row">
        <input type="text" id="teacherSearch" placeholder="Search Teacher..." class="search-input" onkeyup="searchTeacher()">
    </div>

    <!-- Success Modal -->
    @if (session('success'))
        <div id="successModal" class="modal-overlay">
            <div class="modal-box">
                <h3>Success</h3>
                <p>{{ session('success') }}</p>
                <button type="button" id="closeModalBtn" class="modal-btn">OK</button>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modal = document.getElementById("successModal");
                const btn = document.getElementById("closeModalBtn");

                if (modal) modal.style.display = "flex";

                btn.addEventListener("click", function () {
                    modal.style.display = "none";
                });

                modal.addEventListener("click", function (e) {
                    if (e.target === modal) modal.style.display = "none";
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="error-box">
            <b>Please fix the following:</b>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card">
        <div class="card-head">
            <h3 class="card-title">Add Teacher</h3>
            <span class="card-hint">Fill all details carefully</span>
        </div>

        <form method="POST" action="{{ route('teachers.store') }}" class="form-grid">
            @csrf

            <div class="field">
                <label>Teacher Name</label>
                <input name="name" placeholder="Enter teacher name" value="{{ old('name') }}">
            </div>

            <div class="field">
                <label>Subject</label>
                <input name="subject" placeholder="Enter subject" value="{{ old('subject') }}">
            </div>

            <div class="field">
                <label>Qualification</label>
                <input name="qualification" placeholder="Enter qualification" value="{{ old('qualification') }}">
            </div>

            <div class="field">
                <label>Experience (Years)</label>
                <input name="experience" placeholder="Enter experience" value="{{ old('experience') }}">
            </div>

            <div class="field">
                <label>Phone Number</label>
                <input name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">
            </div>

            <div class="field">
                <label>Date of Joining</label>
                <input type="date" name="doj" id="doj" value="{{ old('doj') }}">
            </div>

            <div class="field full">
                <label>Email Address</label>
                <input name="email" placeholder="Enter email address" value="{{ old('email') }}">
            </div>

            <div class="btn-row">
                <button type="submit" class="btn-primary">Add Teacher</button>
            </div>
        </form>
    </div>
</div>

<script>
function searchTeacher() {
    let input = document.getElementById('teacherSearch').value.toLowerCase();
    let table = document.querySelector('table tbody');
    if(!table) return;

    let rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        let cells = rows[i].getElementsByTagName('td');
        let match = false;

        for (let j = 0; j < cells.length - 1; j++) {
            if (cells[j].innerText.toLowerCase().indexOf(input) > -1) {
                match = true;
                break;
            }
        }

        rows[i].style.display = match ? '' : 'none';
    }
}
</script>

<style>
/* ===== Same theme everywhere (matches sidebar) ===== */
:root{
    --sidebar: #4d3131;   /* same as sidebar */
    --navy: #1e293b;      /* active bg / hover */
    --bg: #f1f5f9;        /* layout background */
    --card: #ffffff;
    --text: #111827;
    --muted: #6b7280;
    --border: #e5e7eb;
    --shadow: rgba(0,0,0,0.10);
    --btn: #3b82f6;       /* similar to your blue button */
    --btn2: #2563eb;
}

/* predictable sizing */
*,
*::before,
*::after {
    box-sizing: border-box;
}

/* container aligned with your content area */
.container {
    max-width: 1180px;
    margin: 10px auto 26px;
    padding: 0 18px 44px;
    font-family: 'Segoe UI', sans-serif;
}

/* page header */
.page-top{
    display:flex;
    justify-content: space-between;
    align-items:center;
    gap: 16px;
    margin-bottom: 16px;
}

.title{
    font-size: 34px;
    margin: 0;
    color: var(--text);
    font-weight: 900;
    line-height: 1.15;
}

.subtitle{
    margin: 8px 0 0;
    color: var(--muted);
    font-size: 14px;
    line-height: 1.45;
    max-width: 680px;
}

/* actions */
.actions{
    display:flex;
    align-items:center;
    gap: 10px;
}

/* unified buttons like your “Add New Student” */
.btn-primary{
    background: var(--btn);
    color:#fff;
    padding:12px 18px;
    border-radius:14px;
    text-decoration:none;
    font-weight:800;
    border: none;
    cursor:pointer;
    box-shadow: 0 12px 26px rgba(37,99,235,0.22);
    transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width: 170px;
}
.btn-primary:hover{
    background: var(--btn2);
    transform: translateY(-1px);
    box-shadow: 0 16px 30px rgba(37,99,235,0.28);
}

/* search aligned right like dashboard */
.search-row{
    display:flex;
    justify-content:flex-end;
    margin: 10px 0 18px;
}

.search-input{
    width: 420px;
    max-width: 100%;
    padding: 12px 14px;
    border: 1px solid var(--border);
    border-radius: 14px;
    outline:none;
    font-size: 14px;
    background:#fff;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    transition: box-shadow .15s ease, border-color .15s ease;
}
.search-input:focus{
    border-color: var(--btn);
    box-shadow: 0 0 0 4px rgba(59,130,246,0.16), 0 16px 30px rgba(0,0,0,0.08);
}

/* errors */
.error-box{
    background:#fee2e2;
    border:1px solid #fecaca;
    color:#7f1d1d;
    padding: 14px 16px;
    border-radius: 14px;
    margin-bottom: 18px;
    box-shadow: 0 10px 20px rgba(239,68,68,0.08);
}
.error-box ul{ margin: 10px 0 0; padding-left: 18px; }

/* main card */
.card{
    background: var(--card);
    border-radius: 18px;
    border: 1px solid #eef2f7;
    padding: 22px;
    box-shadow: 0 18px 46px rgba(0,0,0,0.08);
}

/* card head */
.card-head{
    display:flex;
    justify-content: space-between;
    align-items:flex-end;
    gap: 12px;
    margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 1px solid #eef2f7;
}

.card-title{
    margin:0;
    font-size: 18px;
    font-weight: 900;
    color: var(--text);
    line-height: 1.2;
}

.card-hint{
    color: var(--muted);
    font-size: 13px;
    font-weight: 600;
}

/* form grid */
.form-grid{
    display:grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px 18px;
    margin-top: 10px;
}

.field{
    display:flex;
    flex-direction: column;
    gap: 8px;
}

.field label{
    font-weight:800;
    color:#374151;
    font-size: 13px;
}

.field input{
    width:100%;
    padding: 13px 14px;
    border: 1px solid var(--border);
    border-radius: 14px;
    outline:none;
    font-size: 14px;
    background:#fff;
    box-shadow: 0 8px 16px rgba(0,0,0,0.04);
    transition: box-shadow .15s ease, border-color .15s ease;
}

.field input:focus{
    border-color: var(--btn);
    box-shadow: 0 0 0 4px rgba(59,130,246,0.16), 0 16px 30px rgba(0,0,0,0.08);
}

.field.full{
    grid-column: 1 / -1;
}

.btn-row{
    grid-column: 1 / -1;
    display:flex;
    justify-content:flex-end;
    margin-top: 6px;
}

/* modal */
.modal-overlay{
    position: fixed;
    inset: 0;
    background: rgba(30,41,59,0.55); /* navy overlay */
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 18px;
}
.modal-box{
    width: 420px;
    max-width: 100%;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 18px 18px 16px;
    box-shadow: 0 30px 90px rgba(0,0,0,0.35);
    text-align: center;
}
.modal-box h3{
    margin: 0 0 8px;
    font-size: 18px;
    font-weight: 900;
    color: var(--text);
}
.modal-box p{
    margin: 0 0 14px;
    color:#374151;
    font-size: 14px;
    line-height: 1.5;
}
.modal-btn{
    background: var(--btn);
    border: none;
    padding: 10px 18px;
    border-radius: 12px;
    font-weight: 900;
    color: #fff;
    cursor: pointer;
    min-width: 120px;
}
.modal-btn:hover{
    background: var(--btn2);
}

/* responsive */
@media (max-width: 980px){
    .page-top{ flex-direction: column; align-items:flex-start; }
    .search-row{ justify-content:flex-start; }
    .search-input{ width: 100%; }
    .form-grid{ grid-template-columns: 1fr; }
    .btn-row{ justify-content: stretch; }
    .btn-primary{ width: 100%; }
    .title{ font-size: 30px; }
    .card{ padding: 18px; border-radius: 16px; }
}
</style>
@endsection
