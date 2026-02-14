@extends('layouts.app')

@section('content')
<style>
  :root{
    --border: rgba(255,255,255,0.10);
    --blue:#38bdf8;
    --indigo:#818cf8;
    --green:#22c55e;
    --green2:#16a34a;
    --red:#ef4444;
    --shadow: 0 25px 70px rgba(0,0,0,0.35);
  }

  *{ box-sizing:border-box; }

  .t-wrap{
    max-width: 1100px;
    margin: 0 auto;
    padding: 26px 18px 60px;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  }

  /* HERO */
  .t-hero{
    position: relative;
    overflow: hidden;
    border-radius: 26px;
    padding: 22px 22px 18px;
    background:
      radial-gradient(900px 300px at 20% 10%, rgba(56,189,248,0.18), transparent 60%),
      radial-gradient(700px 260px at 85% 30%, rgba(129,140,248,0.20), transparent 55%),
      linear-gradient(180deg, rgba(15,23,42,0.92), rgba(2,6,23,0.92));
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
  }
  .t-hero::after{
    content:"";
    position:absolute;
    inset:-2px;
    background: linear-gradient(135deg, rgba(56,189,248,0.35), rgba(129,140,248,0.25), transparent 55%);
    filter: blur(20px);
    opacity: .45;
    pointer-events:none;
  }

  .t-head{
    position: relative;
    z-index: 1;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:12px;
    flex-wrap:wrap;
  }

  .t-title{
    margin:0;
    font-size: 26px;
    font-weight: 900;
    letter-spacing: 0.3px;
    background: linear-gradient(90deg, var(--blue), var(--indigo));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .t-sub{
    margin: 8px 0 0;
    color: rgba(229,231,235,0.78);
    font-weight: 700;
    font-size: 14px;
    line-height: 1.45;
    max-width: 760px;
  }

  .t-actions{
    position: relative;
    z-index: 1;
    display:flex;
    gap: 10px;
    flex-wrap:wrap;
    align-items:center;
  }

  .t-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding: 10px 14px;
    border-radius: 14px;
    text-decoration:none;
    font-weight: 900;
    color: #020617;
    background: linear-gradient(90deg, rgba(56,189,248,0.92), rgba(129,140,248,0.92));
    box-shadow: 0 14px 30px rgba(56,189,248,0.22);
    transition: transform .2s ease, filter .2s ease;
    white-space: nowrap;
    border: none;
    cursor:pointer;
    min-width: 170px;
  }
  .t-btn:hover{ transform: translateY(-1px); filter: brightness(1.02); }
  .t-btn:active{ transform: translateY(0); }

  /* ALERT */
  .alert{
    margin-top: 14px;
    display:flex;
    gap: 12px;
    align-items:flex-start;
    padding: 12px 14px;
    border-radius: 16px;
    border: 1px solid rgba(239,68,68,0.25);
    background: rgba(239,68,68,0.12);
    box-shadow: 0 18px 45px rgba(0,0,0,0.25);
    color: #fecaca;
  }
  .alert .icon{
    width: 34px;
    height: 34px;
    border-radius: 12px;
    display:flex;
    align-items:center;
    justify-content:center;
    background: rgba(239,68,68,0.22);
    font-weight: 900;
    color: #fff;
    line-height: 1;
    margin-top: 1px;
  }
  .alert .ttl{ font-weight: 900; margin-bottom: 4px; }
  .alert ul{ margin: 6px 0 0; padding-left: 18px; color: rgba(254,202,202,0.92); font-weight: 700; }

  /* CARD */
  .t-card{
    margin-top: 16px;
    border-radius: 22px;
    overflow:hidden;
    border: 1px solid rgba(255,255,255,0.10);
    background:
      radial-gradient(700px 260px at 15% 0%, rgba(56,189,248,0.10), transparent 55%),
      linear-gradient(180deg, rgba(11,18,36,0.92), rgba(2,6,23,0.92));
    box-shadow: 0 18px 60px rgba(0,0,0,0.35);
    padding: 18px;
    color: rgba(229,231,235,0.92);
  }

  .t-card-head{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap: 12px;
    flex-wrap:wrap;
    padding-bottom: 12px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    margin-bottom: 16px;
  }

  .chip{
    display:inline-flex;
    align-items:center;
    gap: 8px;
    padding: 6px 10px;
    border-radius: 999px;
    border: 1px solid rgba(34,197,94,0.22);
    background: rgba(34,197,94,0.12);
    color: rgba(187,247,208,0.95);
    font-weight: 900;
    font-size: 12px;
    letter-spacing: .2px;
  }

  .t-card-title{
    margin: 10px 0 0;
    font-size: 16px;
    font-weight: 900;
    color: rgba(219,234,254,0.95);
    letter-spacing: .2px;
  }

  /* TABLE-LIKE FORM */
  .form-table{
    display:flex;
    flex-direction:column;
    gap: 12px;
  }

  .row{
    display:grid;
    grid-template-columns: 170px 1fr 170px 1fr;
    gap: 12px;
    padding: 14px;
    border: 1px solid rgba(255,255,255,0.10);
    border-radius: 18px;
    background: rgba(255,255,255,0.06);
    box-shadow: 0 12px 30px rgba(0,0,0,0.18);
    transition: transform .15s ease, border-color .15s ease, box-shadow .15s ease;
  }
  .row:hover{
    transform: translateY(-1px);
    border-color: rgba(56,189,248,0.22);
    box-shadow: 0 18px 45px rgba(0,0,0,0.24);
  }

  .row-full{
    grid-template-columns: 170px 1fr;
  }

  .cell{
    display:flex;
    align-items:center;
    min-width:0;
  }

  .cell.label{
    font-weight: 900;
    color: rgba(229,231,235,0.85);
    font-size: 12px;
    letter-spacing: .2px;
  }

  .cell.input input{
    width:100%;
    padding: 12px 14px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: #e5e7eb;
    outline:none;
    font-size: 14px;
    font-weight: 800;
    box-shadow: 0 12px 30px rgba(0,0,0,0.20);
    transition: box-shadow .15s ease, border-color .15s ease;
  }

  .cell.input input:focus{
    border-color: rgba(56,189,248,0.55);
    box-shadow: 0 0 0 5px rgba(56,189,248,0.10), 0 18px 45px rgba(0,0,0,0.28);
  }

  /* FOOTER BUTTONS */
  .card-footer{
    display:flex;
    justify-content:flex-end;
    gap: 10px;
    padding-top: 14px;
    margin-top: 14px;
    border-top: 1px solid rgba(255,255,255,0.08);
    flex-wrap:wrap;
  }

  .btn-soft{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding: 10px 14px;
    border-radius: 14px;
    text-decoration:none;
    font-weight: 900;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.10);
    color: rgba(229,231,235,0.92);
    cursor:pointer;
    transition: transform .2s ease, filter .2s ease, background .2s ease;
    min-width: 140px;
  }
  .btn-soft:hover{ transform: translateY(-1px); background: rgba(255,255,255,0.14); }

  .btn-primary{
    border:none;
    color: #041007;
    background: linear-gradient(90deg, rgba(34,197,94,0.95), rgba(16,185,129,0.95));
    box-shadow: 0 14px 30px rgba(34,197,94,0.20);
  }
  .btn-primary:hover{ filter: brightness(1.02); }

  @media (max-width: 900px){
    .t-actions{ width: 100%; }
    .t-btn{ width: 100%; min-width: unset; }
    .row{ grid-template-columns: 1fr; }
    .row-full{ grid-template-columns: 1fr; }
    .cell.label{ margin-bottom: 6px; }
    .card-footer{ flex-direction:column; }
    .btn-soft{ width:100%; }
  }
</style>

<div class="t-wrap">

  <div class="t-hero">
    <div class="t-head">
      <div>
        <h2 class="t-title">Edit Teacher</h2>
        <p class="t-sub">Update teacher details and click <b>Update</b> to save changes.</p>
      </div>

      <div class="t-actions">
        <a href="{{ route('teachers.list') }}" class="t-btn">← Back</a>
      </div>
    </div>
  </div>

  @if ($errors->any())
    <div class="alert">
      <div class="icon">!</div>
      <div>
        <div class="ttl">Please fix the following:</div>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif

  <div class="t-card">
    <div class="t-card-head">
      <div>
        <div class="chip">Teacher</div>
        <div class="t-card-title">Teacher Details</div>
      </div>
    </div>

    <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
      @csrf
      @method('PUT')

      <div class="form-table">

        <div class="row">
          <div class="cell label">Teacher Name</div>
          <div class="cell input">
            <input type="text" name="name" value="{{ old('name', $teacher->name ?? $teacher->teacher_name) }}" required>
          </div>

          <div class="cell label">Subject</div>
          <div class="cell input">
            <input type="text" name="subject" value="{{ old('subject', $teacher->subject) }}" required>
          </div>
        </div>

        <div class="row">
          <div class="cell label">Qualification</div>
          <div class="cell input">
            <input type="text" name="qualification" value="{{ old('qualification', $teacher->qualification) }}" required>
          </div>

          <div class="cell label">Experience (Years)</div>
          <div class="cell input">
            <input type="number" min="0" name="experience" value="{{ old('experience', $teacher->experience) }}" required>
          </div>
        </div>

        <div class="row">
          <div class="cell label">Phone</div>
          <div class="cell input">
            <input type="text" name="phone" value="{{ old('phone', $teacher->phone ?? $teacher->phone_number) }}" required>
          </div>

          <div class="cell label">DOB</div>
          <div class="cell input">
            <input type="date" name="dob" value="{{ old('dob', $teacher->dob) }}">
          </div>
        </div>

        <div class="row row-full">
          <div class="cell label">Email</div>
          <div class="cell input">
            <input type="email" name="email" value="{{ old('email', $teacher->email) }}" required>
          </div>
        </div>

      </div>

      <div class="card-footer">
        <button type="submit" class="btn-soft btn-primary">Update</button>
        <a href="{{ route('teachers.list') }}" class="btn-soft">Cancel</a>
      </div>
    </form>
  </div>

</div>
@endsection
