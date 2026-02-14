@extends('layouts.app')

@section('content')
<style>
  :root{
    --border: rgba(255,255,255,0.10);
    --blue:#38bdf8;
    --indigo:#818cf8;
    --green:#22c55e;
    --red:#ef4444;
    --shadow: 0 25px 70px rgba(0,0,0,0.35);
  }

  *{ box-sizing:border-box; }

  .t-wrap{
    max-width: 1180px;
    margin: 0 auto;
    padding: 26px 18px 60px;
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

  /* SEARCH */
  .t-search{
    margin-top: 14px;
    display:flex;
    justify-content:flex-end;
  }
  .t-search input{
    width: 420px;
    max-width: 100%;
    padding: 12px 14px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: #e5e7eb;
    outline:none;
    font-weight: 800;
    box-shadow: 0 18px 45px rgba(0,0,0,0.25);
    transition: box-shadow .15s ease, border-color .15s ease;
  }
  .t-search input::placeholder{ color: rgba(229,231,235,0.60); }
  .t-search input:focus{
    border-color: rgba(56,189,248,0.5);
    box-shadow: 0 0 0 5px rgba(56,189,248,0.10), 0 22px 55px rgba(0,0,0,0.32);
  }

  /* ALERTS */
  .alert{
    margin-top: 14px;
    display:flex;
    gap: 12px;
    align-items:flex-start;
    padding: 12px 14px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    box-shadow: 0 18px 45px rgba(0,0,0,0.25);
    color: rgba(229,231,235,0.92);
  }
  .alert .icon{ font-size: 18px; line-height: 1; margin-top: 2px; }
  .alert .ttl{ font-weight: 900; margin-bottom: 2px; }
  .alert .txt{ color: rgba(229,231,235,0.82); font-weight: 700; font-size: 13px; }

  .alert.success{
    border-color: rgba(34,197,94,0.25);
    background: rgba(34,197,94,0.12);
    color: #bbf7d0;
  }
  .alert.error{
    border-color: rgba(239,68,68,0.25);
    background: rgba(239,68,68,0.12);
    color: #fecaca;
  }

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

  .t-card-title{
    margin:0;
    font-size: 16px;
    font-weight: 900;
    color: rgba(219,234,254,0.95);
    letter-spacing: .2px;
  }

  .t-card-hint{
    color: rgba(229,231,235,0.65);
    font-size: 12px;
    font-weight: 700;
  }

  /* FORM */
  .form-grid{
    display:grid;
    grid-template-columns: repeat(2, minmax(0,1fr));
    gap: 16px 18px;
    align-items:start;
  }

  .field{ min-width:0; display:flex; flex-direction:column; gap:8px; }
  .field label{
    font-weight: 900;
    color: rgba(229,231,235,0.85);
    font-size: 12px;
    letter-spacing: .2px;
  }

  .field input{
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

  .field input:focus{
    border-color: rgba(56,189,248,0.5);
    box-shadow: 0 0 0 5px rgba(56,189,248,0.10), 0 18px 45px rgba(0,0,0,0.28);
  }

  .field.full{ grid-column: 1 / -1; }

  .btn-row{
    grid-column: 1 / -1;
    display:flex;
    justify-content:flex-end;
    margin-top: 6px;
  }

  /* MODAL */
  .modal-overlay{
    position: fixed;
    inset: 0;
    background: rgba(2,6,23,0.65);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 18px;
  }
  .modal-box{
    width: 420px;
    max-width: 100%;
    border-radius: 18px;
    padding: 18px 18px 16px;
    border: 1px solid rgba(255,255,255,0.12);
    background:
      radial-gradient(700px 260px at 15% 0%, rgba(56,189,248,0.10), transparent 55%),
      linear-gradient(180deg, rgba(11,18,36,0.98), rgba(2,6,23,0.98));
    box-shadow: 0 30px 90px rgba(0,0,0,0.55);
    text-align:center;
    color: rgba(229,231,235,0.92);
  }
  .modal-box h3{
    margin: 0 0 8px;
    font-size: 18px;
    font-weight: 900;
    color: rgba(219,234,254,0.95);
  }
  .modal-box p{
    margin: 0 0 14px;
    color: rgba(229,231,235,0.78);
    font-size: 14px;
    line-height: 1.5;
  }
  .modal-btn{
    border:none;
    cursor:pointer;
    padding: 10px 18px;
    border-radius: 14px;
    font-weight: 900;
    color: #020617;
    background: linear-gradient(90deg, rgba(56,189,248,0.92), rgba(129,140,248,0.92));
    box-shadow: 0 14px 30px rgba(56,189,248,0.22);
    min-width: 120px;
    transition: transform .2s ease, filter .2s ease;
  }
  .modal-btn:hover{ transform: translateY(-1px); filter: brightness(1.02); }

  @media (max-width: 980px){
    .t-search{ justify-content:flex-start; }
    .t-search input{ width: 100%; }
    .form-grid{ grid-template-columns: 1fr; }
    .btn-row{ justify-content: stretch; }
    .t-btn{ width: 100%; min-width: unset; }
    .t-title{ font-size: 24px; }
  }
</style>

<div class="t-wrap">

  <div class="t-hero">
    <div class="t-head">
      <div>
        <h2 class="t-title">Teacher Details</h2>
        <p class="t-sub">Add teacher details here. Use “View Teachers” to see the full list.</p>
      </div>

      <div class="t-actions">
        <a href="{{ route('teachers.list') }}" class="t-btn">View Teachers</a>
      </div>
    </div>

    <div class="t-search">
      <input type="text" id="teacherSearch" placeholder="Search Teacher..." onkeyup="searchTeacher()">
    </div>
  </div>

  {{-- Success Modal --}}
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

  {{-- Errors --}}
  @if ($errors->any())
    <div class="alert error">
      <span class="icon">⚠️</span>
      <div>
        <div class="ttl">Please fix the following</div>
        <div class="txt">
          <ul style="margin:8px 0 0; padding-left: 18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endif

  {{-- Card --}}
  <div class="t-card">
    <div class="t-card-head">
      <div>
        <h3 class="t-card-title">Add Teacher</h3>
        <div class="t-card-hint">Fill all details carefully</div>
      </div>
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
        <button type="submit" class="t-btn" style="min-width:220px;">Add Teacher</button>
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
@endsection
