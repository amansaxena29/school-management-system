@extends('layouts.app')

@section('content')
<div class="page">
    <!-- Top Header -->
    <div class="page-header">
        <div>
            <h2 class="page-title">Edit Teacher</h2>
            <p class="page-subtitle">Update teacher details and click <b>Update</b> to save changes.</p>
        </div>

        <div class="page-actions">
            <a href="{{ route('teachers.list') }}" class="btn btn-back">← Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert">
            <div class="alert-left">
                <div class="alert-icon">!</div>
                <div>
                    <div class="alert-title">Please fix the following:</div>
                    <ul class="alert-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card">
        <div class="card-head">
            <div class="card-head-left">
                <div class="chip">Teacher</div>
                <div class="card-title">Teacher Details</div>
            </div>
        </div>

        <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
            @csrf
            @method('PUT')

            <!-- Table-like Form Grid -->
            <div class="form-table">

                <div class="row">
                    <div class="cell label">Teacher Name</div>
                    <div class="cell input">
                        <input type="text" name="name"
                               value="{{ old('name', $teacher->name ?? $teacher->teacher_name) }}" required>
                    </div>

                    <div class="cell label">Subject</div>
                    <div class="cell input">
                        <input type="text" name="subject"
                               value="{{ old('subject', $teacher->subject) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="cell label">Qualification</div>
                    <div class="cell input">
                        <input type="text" name="qualification"
                               value="{{ old('qualification', $teacher->qualification) }}" required>
                    </div>

                    <div class="cell label">Experience (Years)</div>
                    <div class="cell input">
                        <input type="number" min="0" name="experience"
                               value="{{ old('experience', $teacher->experience) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="cell label">Phone</div>
                    <div class="cell input">
                        <input type="text" name="phone"
                               value="{{ old('phone', $teacher->phone ?? $teacher->phone_number) }}" required>
                    </div>

                    <div class="cell label">DOB</div>
                    <div class="cell input">
                        <input type="date" name="dob"
                               value="{{ old('dob', $teacher->dob) }}">
                    </div>
                </div>

                <div class="row row-full">
                    <div class="cell label">Email</div>
                    <div class="cell input">
                        <input type="email" name="email"
                               value="{{ old('email', $teacher->email) }}" required>
                    </div>
                </div>

            </div>

            <!-- Buttons -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('teachers.list') }}" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

<style>
/* ---------- Page spacing + layout ---------- */
.page{
    max-width: 1050px;
    margin: 28px auto;
    padding: 0 16px 40px;
    font-family: 'Poppins', sans-serif;
}

/* Header */
.page-header{
    display:flex;
    justify-content: space-between;
    align-items:flex-end;
    gap: 14px;
    margin-bottom: 14px;
}

.page-title{
    margin: 0;
    font-size: 34px;
    font-weight: 900;
    color:#111827;
    letter-spacing: 0.2px;
}

.page-subtitle{
    margin: 6px 0 0;
    color:#6b7280;
    font-size: 14px;
}

/* Buttons */
.btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap: 8px;
    padding: 10px 16px;
    border-radius: 12px;
    text-decoration:none;
    font-weight: 800;
    border: 1px solid transparent;
    cursor:pointer;
    transition: 0.2s ease;
}

.btn-back{
    background:#e5e7eb;
    color:#111827;
    border-color:#e5e7eb;
}
.btn-back:hover{ background:#d1d5db; border-color:#d1d5db; transform: translateY(-1px); }

/* Alert */
.alert{
    background:#fee2e2;
    border: 1px solid #fecaca;
    color:#7f1d1d;
    border-radius: 14px;
    padding: 12px 14px;
    margin-bottom: 14px;
    box-shadow: 0 10px 22px rgba(0,0,0,0.06);
}
.alert-left{
    display:flex;
    gap: 12px;
    align-items:flex-start;
}
.alert-icon{
    width: 32px;
    height: 32px;
    border-radius: 10px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#fecaca;
    font-weight: 900;
}
.alert-title{
    font-weight: 900;
    margin-bottom: 6px;
}
.alert-list{
    margin: 0;
    padding-left: 18px;
}

/* ---------- Card ---------- */
.card{
    background:#fff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    box-shadow: 0 16px 38px rgba(0,0,0,0.10);
    overflow:hidden;
}

.card-head{
    padding: 16px 18px;
    border-bottom: 1px solid #eef2f7;
    background: linear-gradient(180deg, #ffffff 0%, #fafafa 100%);
}

.card-head-left{
    display:flex;
    align-items:center;
    gap: 10px;
}

.chip{
    background: rgba(22,163,74,0.12);
    color:#166534;
    border: 1px solid rgba(22,163,74,0.22);
    padding: 6px 10px;
    border-radius: 999px;
    font-weight: 900;
    font-size: 12px;
}

.card-title{
    font-size: 16px;
    font-weight: 900;
    color:#111827;
}

/* ---------- Table-like form ---------- */
.form-table{
    padding: 18px;
}

/* Each row looks like a table row */
.row{
    display:grid;
    grid-template-columns: 160px 1fr 160px 1fr;
    gap: 12px;
    padding: 14px;
    border: 1px solid #eef2f7;
    border-radius: 14px;
    margin-bottom: 14px;
    background: #fcfcfc;
}

.row:hover{
    border-color: rgba(22,163,74,0.25);
    box-shadow: 0 10px 22px rgba(0,0,0,0.06);
}

/* Full width row (Email) */
.row-full{
    grid-template-columns: 160px 1fr;
}

/* Cells */
.cell{
    display:flex;
    align-items:center;
}

.cell.label{
    font-weight: 900;
    color:#374151;
    font-size: 13px;
}

.cell.input input{
    width: 100%;
    padding: 11px 12px;
    border: 1px solid #dbe3ef;
    border-radius: 12px;
    outline:none;
    background:#fff;
    font-size: 14px;
    transition: 0.15s ease;
}

.cell.input input:focus{
    border-color:#22c55e;
    box-shadow: 0 0 0 4px rgba(34,197,94,0.15);
}

/* Footer buttons */
.card-footer{
    display:flex;
    justify-content:flex-end;
    gap: 10px;
    padding: 16px 18px;
    border-top: 1px solid #eef2f7;
    background:#fff;
}

.btn-primary{
    background:#16a34a;
    color:#fff;
}
.btn-primary:hover{ background:#15803d; transform: translateY(-1px); }

.btn-cancel{
    background:#e5e7eb;
    color:#111827;
}
.btn-cancel:hover{ background:#d1d5db; transform: translateY(-1px); }

/* Responsive */
@media (max-width: 860px){
    .page-header{ flex-direction: column; align-items:flex-start; }
    .row{ grid-template-columns: 1fr; }
    .row-full{ grid-template-columns: 1fr; }
    .cell.label{ margin-bottom: 6px; }
    .card-footer{ flex-direction: column; }
    .btn{ width: 100%; }
}
</style>
@endsection
