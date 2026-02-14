@extends('layouts.app')

@section('content')
<style>
  :root{
    --sidebar:#4d3131;
    --bg1: rgba(15,23,42,0.88);
    --bg2: rgba(2,6,23,0.88);
    --border: rgba(255,255,255,0.10);
    --text: rgba(229,231,235,0.92);
    --muted: rgba(229,231,235,0.70);
    --blue:#38bdf8;
    --indigo:#818cf8;
    --green:#22c55e;
    --green2:#16a34a;
    --red:#ef4444;
    --shadow: 0 25px 70px rgba(0,0,0,0.35);
  }
  *{ box-sizing:border-box; }

  .fee-wrap{
    max-width: 1150px;
    margin: 0 auto;
    padding: 26px 18px 60px;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  }

  /* HERO */
  .fee-hero{
    position: relative;
    overflow: hidden;
    border-radius: 26px;
    padding: 22px 22px 18px;
    background:
      radial-gradient(900px 320px at 20% 10%, rgba(56,189,248,0.18), transparent 60%),
      radial-gradient(700px 280px at 85% 35%, rgba(129,140,248,0.20), transparent 55%),
      linear-gradient(180deg, var(--bg1), var(--bg2));
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
  }
  .fee-hero::after{
    content:"";
    position:absolute;
    inset:-2px;
    background: linear-gradient(135deg, rgba(56,189,248,0.35), rgba(129,140,248,0.25), transparent 55%);
    filter: blur(20px);
    opacity: .45;
    pointer-events:none;
  }

  .fee-head{
    position: relative;
    z-index: 1;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:12px;
    flex-wrap:wrap;
  }

  .fee-title{
    margin:0;
    font-size: 26px;
    font-weight: 900;
    letter-spacing: 0.3px;
    background: linear-gradient(90deg, var(--blue), var(--indigo));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .fee-sub{
    margin: 8px 0 0;
    color: var(--muted);
    font-weight: 700;
    font-size: 14px;
    line-height: 1.45;
    max-width: 760px;
  }

  .fee-actions{
    position: relative;
    z-index: 1;
    display:flex;
    gap: 10px;
    flex-wrap:wrap;
    align-items:center;
  }

  .btn-add{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding: 10px 14px;
    border-radius: 14px;
    text-decoration:none;
    font-weight: 900;
    color: #020617;
    background: linear-gradient(90deg, rgba(34,197,94,0.95), rgba(16,185,129,0.95));
    border: 1px solid rgba(255,255,255,0.14);
    box-shadow: 0 14px 30px rgba(34,197,94,0.18);
    transition: transform .2s ease, filter .2s ease;
    white-space: nowrap;
  }
  .btn-add:hover{ transform: translateY(-1px); filter: brightness(1.02); }

  /* Toolbar */
  .toolbar{
    margin-top: 14px;
    display:flex;
    justify-content: space-between;
    gap: 10px;
    flex-wrap:wrap;
    align-items:center;
  }

  .search-form{
    display:flex;
    gap: 10px;
    flex-wrap:wrap;
    align-items:center;
    justify-content:flex-end;
    width: 100%;
  }

  .search-input{
    width: 420px;
    max-width: 100%;
    padding: 12px 14px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: var(--text);
    outline:none;
    font-weight: 800;
    box-shadow: 0 12px 30px rgba(0,0,0,0.20);
    transition: box-shadow .15s ease, border-color .15s ease;
  }
  .search-input::placeholder{ color: rgba(229,231,235,0.65); }
  .search-input:focus{
    border-color: rgba(56,189,248,0.55);
    box-shadow: 0 0 0 5px rgba(56,189,248,0.10), 0 18px 45px rgba(0,0,0,0.28);
  }

  .btn-search{
    border:none;
    cursor:pointer;
    padding: 12px 14px;
    border-radius: 14px;
    font-weight: 900;
    color: #020617;
    background: linear-gradient(90deg, rgba(56,189,248,0.95), rgba(129,140,248,0.95));
    border: 1px solid rgba(255,255,255,0.14);
    box-shadow: 0 14px 30px rgba(56,189,248,0.16);
    transition: transform .2s ease, filter .2s ease;
    white-space: nowrap;
  }
  .btn-search:hover{ transform: translateY(-1px); filter: brightness(1.02); }

  .btn-clear{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding: 12px 14px;
    border-radius: 14px;
    font-weight: 900;
    text-decoration:none;
    color: rgba(229,231,235,0.92);
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.12);
    transition: transform .2s ease, background .2s ease;
    white-space: nowrap;
  }
  .btn-clear:hover{ transform: translateY(-1px); background: rgba(255,255,255,0.14); }

  /* TABLE CARD */
  .fee-card{
    margin-top: 14px;
    border-radius: 22px;
    overflow:hidden;
    border: 1px solid rgba(255,255,255,0.10);
    background:
      radial-gradient(700px 260px at 15% 0%, rgba(56,189,248,0.10), transparent 55%),
      linear-gradient(180deg, rgba(11,18,36,0.92), rgba(2,6,23,0.92));
    box-shadow: 0 18px 60px rgba(0,0,0,0.35);
  }

  .table-wrap{ overflow:auto; }

  table{
    width:100%;
    border-collapse: collapse;
    min-width: 900px;
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
    color: var(--text);
    font-weight: 700;
    font-size: 14px;
    vertical-align: middle;
  }

  tbody tr:hover td{ background: rgba(255,255,255,0.06); }

  .badge{
    display:inline-flex;
    align-items:center;
    gap: 6px;
    padding: 6px 10px;
    border-radius: 999px;
    font-weight: 900;
    font-size: 12px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: rgba(229,231,235,0.92);
    white-space: nowrap;
  }
  .badge.paid{
    background: rgba(34,197,94,0.14);
    border-color: rgba(34,197,94,0.28);
  }
  .badge.pending{
    background: rgba(251,191,36,0.14);
    border-color: rgba(251,191,36,0.28);
  }
  .badge.overdue{
    background: rgba(239,68,68,0.14);
    border-color: rgba(239,68,68,0.28);
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
    margin-left: 8px;
  }
  .btn-delete:hover{ transform: translateY(-1px); filter: brightness(1.02); }

  .empty{
    text-align:center;
    padding: 22px;
    color: rgba(229,231,235,0.75);
    font-weight: 800;
  }

  /* Pagination */
  .simple-pagination{
    margin-top: 16px;
    display:flex;
    justify-content:center;
    gap: 12px;
    flex-wrap:wrap;
  }
  .simple-pagination a,
  .simple-pagination span{
    padding: 10px 14px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.14);
    text-decoration:none;
    color: rgba(229,231,235,0.92);
    font-weight: 900;
    background: rgba(255,255,255,0.08);
    transition: transform .2s ease, background .2s ease;
  }
  .simple-pagination a:hover{
    transform: translateY(-1px);
    background: rgba(255,255,255,0.12);
  }
  .simple-pagination .disabled{
    opacity: 0.5;
    cursor:not-allowed;
  }

  /* Modal Popup */
  .modal-overlay{
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 18px;
  }
  .modal-box{
    width: 420px;
    max-width: 100%;
    background:
      radial-gradient(500px 180px at 20% 0%, rgba(56,189,248,0.18), transparent 55%),
      radial-gradient(420px 160px at 90% 15%, rgba(129,140,248,0.18), transparent 55%),
      linear-gradient(180deg, rgba(255,255,255,0.96), rgba(255,255,255,0.92));
    border-radius: 18px;
    padding: 18px 20px 16px;
    border: 1px solid rgba(255,255,255,0.30);
    box-shadow: 0 30px 90px rgba(0,0,0,0.35);
    text-align: center;
    animation: popIn 0.18s ease-out;
  }
  .modal-box h3{
    margin: 0 0 8px;
    font-size: 18px;
    font-weight: 900;
    color: #111827;
  }
  .modal-box p{
    margin: 0 0 14px;
    color: #374151;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 700;
  }
  .modal-btn{
    background: linear-gradient(90deg, rgba(34,197,94,0.95), rgba(16,185,129,0.95));
    color: #041007;
    border: none;
    padding: 10px 18px;
    border-radius: 14px;
    cursor: pointer;
    font-weight: 900;
    box-shadow: 0 14px 30px rgba(34,197,94,0.18);
  }
  .modal-btn:hover{ filter: brightness(1.02); transform: translateY(-1px); }

  @keyframes popIn{
    from{ transform: scale(0.96); opacity: 0; }
    to{ transform: scale(1); opacity: 1; }
  }

  @media (max-width: 900px){
    .fee-actions{ width:100%; }
    .btn-add{ width:100%; }
    .search-form{ justify-content: stretch; }
    .search-input{ width: 100%; }
    .btn-search, .btn-clear{ width: 100%; }
    table{ min-width: 820px; }
  }
</style>

<div class="fee-wrap">

  <div class="fee-hero">
    <div class="fee-head">
      <div>
        <h2 class="fee-title">Manage Student Fees</h2>
        <p class="fee-sub">Search student fees, edit records and manage payment status quickly.</p>
      </div>

      <div class="fee-actions">
        <a href="{{ route('fees.create') }}" class="btn-add">+ Add New Fee</a>
      </div>
    </div>

    <div class="toolbar">
      <form method="GET" action="{{ route('fees.index') }}" class="search-form">
        <input
          type="text"
          name="search"
          value="{{ request('search') }}"
          placeholder="Search student name..."
          class="search-input"
        />

        <button type="submit" class="btn-search">Search</button>

        @if(request('search'))
          <a href="{{ route('fees.index') }}" class="btn-clear">Clear</a>
        @endif
      </form>
    </div>
  </div>

  @if (session('success'))
    <div id="successModal" class="modal-overlay">
      <div class="modal-box">
        <h3>Success</h3>
        <p>{{ session('success') }}</p>
        <button id="closeModalBtn" class="modal-btn" type="button">OK</button>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("successModal");
        const btn = document.getElementById("closeModalBtn");

        modal.style.display = "flex";

        btn.addEventListener("click", function () {
          modal.style.display = "none";
        });

        modal.addEventListener("click", function (e) {
          if (e.target === modal) modal.style.display = "none";
        });
      });
    </script>
  @endif

  <div class="fee-card">
    <div class="table-wrap">
      <table class="fees-table">
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Class</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($fees as $fee)
            @php
              $st = strtolower((string)($fee->status ?? ''));
              $badgeClass = 'pending';
              if ($st === 'paid') $badgeClass = 'paid';
              if ($st === 'overdue') $badgeClass = 'overdue';
            @endphp

            <tr>
              <td>{{ $fee->student_name }}</td>
              <td>{{ $fee->class }}</td>
              <td>₹{{ $fee->amount }}</td>
              <td>
                <span class="badge {{ $badgeClass }}">{{ ucfirst($fee->status) }}</span>
              </td>

              <td class="action-col">
                <a href="{{ route('fees.edit', $fee->id) }}" class="btn-edit">Edit</a>

                <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" style="display:inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-delete">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="empty">No results found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination -->
  <div class="simple-pagination">
    @if ($fees->onFirstPage())
      <span class="disabled">« Previous</span>
    @else
      <a href="{{ $fees->previousPageUrl() }}">« Previous</a>
    @endif

    @if ($fees->hasMorePages())
      <a href="{{ $fees->nextPageUrl() }}">Next »</a>
    @else
      <span class="disabled">Next »</span>
    @endif
  </div>

</div>
@endsection
