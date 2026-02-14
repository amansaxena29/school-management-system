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
    max-width: 1200px;
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

  .btn-back{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding: 10px 14px;
    border-radius: 14px;
    text-decoration:none;
    font-weight: 900;
    color: rgba(229,231,235,0.92);
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.12);
    transition: transform .2s ease, background .2s ease, filter .2s ease;
    white-space: nowrap;
    min-width: 150px;
  }
  .btn-back:hover{ transform: translateY(-1px); background: rgba(255,255,255,0.14); }

  /* TOOLBAR */
  .toolbar{
    margin-top: 14px;
    display:flex;
    justify-content:flex-end;
    gap: 10px;
    flex-wrap:wrap;
  }

  .search-box{
    position: relative;
    width: 420px;
    max-width: 100%;
  }
  .search-input{
    width: 100%;
    padding: 12px 42px 12px 14px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: #e5e7eb;
    outline: none;
    font-weight: 800;
    box-shadow: 0 12px 30px rgba(0,0,0,0.20);
    transition: box-shadow .15s ease, border-color .15s ease;
  }
  .search-input::placeholder{ color: rgba(229,231,235,0.65); }
  .search-input:focus{
    border-color: rgba(56,189,248,0.55);
    box-shadow: 0 0 0 5px rgba(56,189,248,0.10), 0 18px 45px rgba(0,0,0,0.28);
  }
  .search-ico{
    position:absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    width: 28px;
    height: 28px;
    border-radius: 12px;
    display:flex;
    align-items:center;
    justify-content:center;
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.12);
    color: rgba(229,231,235,0.9);
    font-weight: 900;
    pointer-events:none;
  }

  /* TABLE CARD */
  .t-card{
    margin-top: 14px;
    border-radius: 22px;
    overflow:hidden;
    border: 1px solid rgba(255,255,255,0.10);
    background:
      radial-gradient(700px 260px at 15% 0%, rgba(56,189,248,0.10), transparent 55%),
      linear-gradient(180deg, rgba(11,18,36,0.92), rgba(2,6,23,0.92));
    box-shadow: 0 18px 60px rgba(0,0,0,0.35);
  }

  .table-wrap{
    overflow:auto;
  }

  table{
    width:100%;
    border-collapse: collapse;
    min-width: 1050px;
  }

  thead th{
    text-align:left;
    padding: 14px 14px;
    font-size: 12px;
    letter-spacing: .25px;
    text-transform: uppercase;
    color: rgba(219,234,254,0.92);
    background: rgba(255,255,255,0.08);
    border-bottom: 1px solid rgba(255,255,255,0.10);
    white-space: nowrap;
  }

  tbody td{
    padding: 14px 14px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    color: rgba(229,231,235,0.92);
    font-weight: 700;
    font-size: 14px;
    vertical-align: middle;
  }

  tbody tr:hover td{
    background: rgba(255,255,255,0.06);
  }

  .muted{
    color: rgba(229,231,235,0.68);
    font-weight: 700;
  }

  .action-col{ white-space: nowrap; }

  .btn-edit{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding: 8px 12px;
    border-radius: 12px;
    text-decoration:none;
    font-weight: 900;
    color: #020617;
    background: linear-gradient(90deg, rgba(56,189,248,0.92), rgba(129,140,248,0.92));
    box-shadow: 0 12px 26px rgba(56,189,248,0.18);
    transition: transform .2s ease, filter .2s ease;
  }
  .btn-edit:hover{ transform: translateY(-1px); filter: brightness(1.02); }

  .delete-form{
    display:inline-block;
    margin-left: 8px;
  }
  .btn-delete{
    border:none;
    cursor:pointer;
    padding: 8px 12px;
    border-radius: 12px;
    font-weight: 900;
    color: #fff;
    background: linear-gradient(90deg, rgba(239,68,68,0.95), rgba(220,38,38,0.95));
    box-shadow: 0 12px 26px rgba(239,68,68,0.18);
    transition: transform .2s ease, filter .2s ease;
  }
  .btn-delete:hover{ transform: translateY(-1px); filter: brightness(1.02); }

  .empty{
    text-align:center;
    padding: 22px;
    color: rgba(229,231,235,0.75);
    font-weight: 800;
  }

  /* TOAST */
  .toast{
    position: fixed;
    top: 18px;
    right: 18px;
    background: linear-gradient(90deg, rgba(34,197,94,0.95), rgba(16,185,129,0.95));
    color: #041007;
    padding: 12px 16px;
    border-radius: 14px;
    font-weight: 900;
    box-shadow: 0 18px 55px rgba(0,0,0,0.28);
    opacity: 0;
    transform: translateY(-10px);
    transition: 0.25s ease;
    z-index: 9999;
    border: 1px solid rgba(255,255,255,0.14);
  }
  .toast.show{
    opacity: 1;
    transform: translateY(0);
  }

  @media (max-width: 900px){
    .toolbar{ justify-content: stretch; }
    .search-box{ width: 100%; }
    .btn-back{ width: 100%; min-width: unset; }
  }
</style>

<div class="t-wrap">

  <div class="t-hero">
    <div class="t-head">
      <div>
        <h2 class="t-title">All Teachers</h2>
        <p class="t-sub">Search, edit or delete teacher records from here.</p>
      </div>

      <div class="t-actions">
        <a href="{{ route('teachers.index') }}" class="btn-back">← Back</a>
      </div>
    </div>

    <div class="toolbar">
      <div class="search-box">
        <input type="text" id="searchTeacher" placeholder="Search teacher..." class="search-input">
        <div class="search-ico">⌕</div>
      </div>
    </div>
  </div>

  @if(session('success'))
    <div id="toast" class="toast">{{ session('success') }}</div>

    <script>
      document.addEventListener("DOMContentLoaded", function(){
        const toast = document.getElementById("toast");
        setTimeout(() => toast.classList.add("show"), 50);
        setTimeout(() => toast.classList.remove("show"), 2500);
        setTimeout(() => toast.remove(), 3200);
      });
    </script>
  @endif

  <div class="t-card">
    <div class="table-wrap">
      <table class="teachers-table" id="teachersTable">
        <thead>
          <tr>
            <th>Teacher Name</th>
            <th>Subject</th>
            <th>Qualification</th>
            <th>Experience</th>
            <th>Phone</th>
            <th>DOJ</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @forelse($teachers as $t)
            <tr>
              <td>{{ $t->teacher_name ?? $t->name }}</td>
              <td class="muted">{{ $t->subject ?? '-' }}</td>
              <td class="muted">{{ $t->qualification ?? '-' }}</td>
              <td class="muted">{{ $t->experience ?? '-' }}</td>
              <td class="muted">{{ $t->phone ?? $t->phone_number ?? '-' }}</td>

              <td class="muted">
                @if(!empty($t->dob))
                  {{ \Carbon\Carbon::parse($t->dob)->format('d/m/Y') }}
                @else
                  -
                @endif
              </td>

              <td class="muted">{{ $t->email ?? '-' }}</td>

              <td class="action-col">
                <a href="{{ route('teachers.edit', $t->id) }}" class="btn-edit">Edit</a>

                <form action="{{ route('teachers.destroy', $t->id) }}" method="POST" class="delete-form"
                      onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-delete">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="empty">No teachers found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function(){
  const input = document.getElementById("searchTeacher");
  const rows = document.querySelectorAll("#teachersTable tbody tr");

  input.addEventListener("input", function(){
    const term = input.value.toLowerCase();
    rows.forEach(row => {
      row.style.display = row.innerText.toLowerCase().includes(term) ? "" : "none";
    });
  });
});
</script>
@endsection
