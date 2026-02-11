@extends('layouts.app')

@section('header', 'Attendance')

@section('content')

<style>
/* ===== Background enhancement ===== */
.attendance-wrapper{
    min-height: calc(100vh - 120px);
    display:flex;
    justify-content:center;
    align-items:center;
    position: relative;
    overflow: hidden;
}

/* subtle animated gradient blobs */
.attendance-wrapper::before,
.attendance-wrapper::after{
    content:'';
    position:absolute;
    width:420px;
    height:420px;
    background: radial-gradient(circle, rgba(102,126,234,0.35), transparent 70%);
    filter: blur(40px);
    animation: float 10s infinite alternate ease-in-out;
    z-index:0;
}

.attendance-wrapper::after{
    right:-120px;
    bottom:-120px;
    animation-delay: 3s;
}

.attendance-wrapper::before{
    left:-120px;
    top:-120px;
}

@keyframes float{
    from{ transform: translateY(0); }
    to{ transform: translateY(40px); }
}

/* ===== Card ===== */
.attendance-card {
    position: relative;
    z-index:1;
    background: linear-gradient(180deg, #ffffff, #f8fafc);
    width: 420px;
    padding: 36px 34px 40px;
    border-radius: 22px;
    box-shadow:
        0 30px 80px rgba(0,0,0,0.18),
        inset 0 1px 0 rgba(255,255,255,0.9);
    animation: cardIn .7s ease;
}

@keyframes cardIn{
    from{ opacity:0; transform: translateY(30px) scale(.97); }
    to{ opacity:1; transform: translateY(0) scale(1); }
}

/* ===== Title ===== */
.attendance-card h2{
    margin: 0 0 22px;
    text-align:center;
    font-size: 28px;
    font-weight: 800;
    letter-spacing:.5px;
    background: linear-gradient(90deg,#667eea,#764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ===== Success message ===== */
.success-message{
    background: linear-gradient(135deg,#dcfce7,#bbf7d0);
    color:#166534;
    padding:10px 14px;
    border-radius:12px;
    text-align:center;
    font-weight:600;
    margin-bottom:18px;
    box-shadow: 0 10px 30px rgba(34,197,94,.25);
}

/* ===== Labels ===== */
.attendance-card label{
    font-size:14px;
    font-weight:700;
    color:#374151;
    display:block;
    margin-bottom:6px;
}

/* ===== Inputs ===== */
.attendance-card select,
.attendance-card input[type="date"]{
    width:100%;
    padding:14px 16px;
    border-radius:14px;
    border:1px solid #e5e7eb;
    font-size:15px;
    outline:none;
    background:#ffffff;
    transition: all .25s ease;
    box-shadow: inset 0 1px 2px rgba(0,0,0,.04);
}

.attendance-card select:focus,
.attendance-card input[type="date"]:focus{
    border-color:#667eea;
    box-shadow:
        0 0 0 4px rgba(102,126,234,.2),
        inset 0 1px 2px rgba(0,0,0,.04);
}

/* ===== Button ===== */
.attendance-card button{
    width:100%;
    margin-top:18px;
    padding:15px;
    border-radius:16px;
    border:none;
    cursor:pointer;
    font-size:16px;
    font-weight:800;
    letter-spacing:.6px;
    color:white;
    background: linear-gradient(135deg,#667eea,#764ba2);
    box-shadow: 0 18px 40px rgba(102,126,234,.45);
    transition: all .25s ease;
}

.attendance-card button:hover{
    transform: translateY(-2px);
    box-shadow: 0 28px 60px rgba(102,126,234,.6);
}

.attendance-card button:active{
    transform: translateY(0);
}

/* ===== View Attendance link ===== */
.attendance-card a{
    position:relative;
    margin-top:16px;
    display:block;
    text-align:center;
    padding:14px;
    border-radius:16px;
    border:2px dashed rgba(102,126,234,.6);
    font-weight:700;
    color:#667eea;
    text-decoration:none;
    transition: all .25s ease;
    background: rgba(102,126,234,.04);
}

.attendance-card a:hover{
    background: rgba(102,126,234,.12);
    transform: translateY(-1px);
    box-shadow: 0 12px 30px rgba(102,126,234,.25);
}

/* ===== Small polish ===== */
.attendance-card select option{
    padding:8px;
}

</style>

<div class="attendance-wrapper">

<div class="attendance-card">

    <h2>📋 Mark Attendance</h2>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ url('/attendance/show') }}">
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

        <a href="{{ route('attendance.viewForm') }}">
            👀 View Attendance
        </a>
    </form>

</div>
</div>

@endsection
