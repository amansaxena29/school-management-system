@extends('layouts.app')

@section('content')
<div class="page">
    <div class="wrap">

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert success">
                <span class="icon">✅</span>
                <div>
                    <div class="ttl">Success</div>
                    <div class="txt">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert error">
                <span class="icon">⚠️</span>
                <div>
                    <div class="ttl">Error</div>
                    <div class="txt">{{ session('error') }}</div>
                </div>
            </div>
        @endif

        {{-- Card --}}
        <div class="card">
            <div class="card-head">
                <div>
                    <h2 class="title">📌 Upload / Update Result</h2>
                    <p class="hint">Enter <b>Class</b> + <b>Roll No</b> to open the result form.</p>
                </div>

                <div class="badge">Result Panel</div>
            </div>

            <div class="divider"></div>

            <form method="POST" action="{{ route('results.create') }}" class="form-grid">
                @csrf

                <div class="field">
                    <label>Class</label>
                    <input name="class" placeholder="e.g. 7" required>
                    <small>Example: 1, 7, 10</small>
                </div>

                <div class="field">
                    <label>Roll No</label>
                    <input name="roll_no" placeholder="e.g. 12" required>
                    <small>Example: 12, 31</small>
                </div>

                <div class="field">
                    <label>Exam Name</label>
                    <input name="exam_name" value="Final" required>
                    <small>Example: Final / Mid-Term</small>
                </div>

                <div class="field">
                    <label>Year</label>
                    <input name="year" value="{{ date('Y') }}" required>
                    <small>Example: {{ date('Y') }}</small>
                </div>

                <div class="actions">
                    <button type="submit" class="btn">
                        Open Result Form →
                    </button>
                </div>
            </form>
        </div>

        <div class="foot-note">
            Tip: If student is not found, re-check <b>Class</b> and <b>Roll No</b>.
        </div>

    </div>
</div>

<style>
/* IMPORTANT: this prevents overflow issues */
*{ box-sizing:border-box; }

/* Page background */
.page{
    min-height: calc(100vh - 40px);
    padding: 26px 18px 60px;
    background:
        radial-gradient(circle at 15% 10%, rgba(34,211,238,0.14), transparent 45%),
        radial-gradient(circle at 90% 15%, rgba(99,102,241,0.14), transparent 45%),
        radial-gradient(circle at 55% 100%, rgba(16,185,129,0.10), transparent 55%);
}

/* Container */
.wrap{
    max-width: 980px;
    margin: 0 auto;
}

/* Alerts */
.alert{
    display:flex;
    gap: 12px;
    align-items:flex-start;
    padding: 12px 14px;
    border-radius: 14px;
    margin-bottom: 14px;
    border: 1px solid transparent;
    box-shadow: 0 12px 28px rgba(0,0,0,0.08);
    background: rgba(255,255,255,0.92);
}
.alert .icon{ font-size: 18px; line-height: 1; margin-top: 2px; }
.alert .ttl{ font-weight: 900; margin-bottom: 2px; }
.alert .txt{ color: #374151; font-weight: 600; font-size: 14px; }
.alert.success{ border-color:#86efac; }
.alert.error{ border-color:#fecaca; }

/* Card */
.card{
    background: rgba(255,255,255,0.92);
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 18px 50px rgba(0,0,0,0.10);
    backdrop-filter: blur(10px);
}

/* Header */
.card-head{
    display:flex;
    justify-content: space-between;
    align-items:flex-start;
    gap: 14px;
}
.title{
    margin: 0;
    font-size: 22px;
    font-weight: 900;
    color:#111827;
}
.hint{
    margin: 6px 0 0;
    color:#6b7280;
    font-weight: 600;
    font-size: 14px;
}
.badge{
    padding: 8px 12px;
    border-radius: 999px;
    border: 1px solid rgba(99,102,241,0.25);
    background: rgba(99,102,241,0.10);
    color:#3730a3;
    font-weight: 900;
    font-size: 12px;
    white-space: nowrap;
}

.divider{
    height: 1px;
    background: #e5e7eb;
    margin: 14px 0 18px;
}

/* ✅ FIXED FORM GRID ALIGNMENT */
.form-grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px 18px; /* row gap, column gap */
    align-items: start;
}

/* Field */
.field{ min-width: 0; } /* ✅ allows inputs to shrink properly */
.field label{
    display:block;
    font-weight: 900;
    color:#374151;
    font-size: 14px;
    margin-bottom: 8px;
}
.field input{
    width: 100%;
    max-width: 100%;
    display:block;
    padding: 12px 14px;
    border-radius: 14px;
    border: 1px solid #d1d5db;
    outline: none;
    background: rgba(255,255,255,0.98);
    font-size: 14px;
}
.field input:focus{
    border-color:#6366f1;
    box-shadow: 0 0 0 4px rgba(99,102,241,0.18);
}
.field small{
    display:block;
    margin-top: 7px;
    color:#9ca3af;
    font-size: 12px;
    font-weight: 700;
}

/* Actions row */
.actions{
    grid-column: 1 / -1;
    display:flex;
    justify-content:flex-end;
    margin-top: 8px;
}
.btn{
    border: none;
    cursor: pointer;
    padding: 12px 18px;
    border-radius: 14px;
    font-weight: 900;
    color: #fff;
    background: linear-gradient(90deg, #16a34a, #22c55e);
    box-shadow: 0 14px 30px rgba(34,197,94,0.25);
    min-width: 240px;
}
.btn:hover{ transform: translateY(-1px); filter: brightness(0.98); }
.btn:active{ transform: translateY(0px); }

.foot-note{
    margin-top: 12px;
    color:#6b7280;
    font-weight: 600;
    font-size: 13px;
    text-align: center;
}

/* Responsive */
@media(max-width: 820px){
    .card-head{ flex-direction: column; }
    .form-grid{ grid-template-columns: 1fr; }
    .actions{ justify-content: stretch; }
    .btn{ width: 100%; min-width: unset; }
}
</style>
@endsection
