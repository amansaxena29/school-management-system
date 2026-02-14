@extends('layouts.app')

@section('header', 'Class ' . $class . ' Fees')

@section('content')
<style>
  :root{
    --primary:#38bdf8;
    --primary2:#818cf8;
    --success:#22c55e;
    --danger:#ef4444;

    --glass1: rgba(15,23,42,0.88);
    --glass2: rgba(2,6,23,0.88);
    --border: rgba(255,255,255,0.12);

    --text: rgba(229,231,235,0.92);
    --muted: rgba(229,231,235,0.70);

    --shadow: 0 25px 70px rgba(0,0,0,0.35);
  }

  *{ box-sizing:border-box; }

  .page{
    max-width: 1150px;
    margin: 0 auto;
    padding: 26px 18px 60px;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    background:
      radial-gradient(900px 320px at 20% 10%, rgba(56,189,248,0.14), transparent 60%),
      radial-gradient(700px 280px at 85% 35%, rgba(129,140,248,0.16), transparent 55%),
      radial-gradient(650px 260px at 45% 110%, rgba(34,197,94,0.10), transparent 60%);
  }

  /* Header row */
  .top{
    display:flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 14px;
  }

  .title{
    margin:0;
    font-size: 24px;
    font-weight: 900;
    letter-spacing: 0.25px;
    background: linear-gradient(90deg, var(--primary), var(--primary2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .subtitle{
    margin: 8px 0 0;
    color: var(--muted);
    font-weight: 700;
    font-size: 14px;
    line-height: 1.45;
  }

  .back-link{
    display:inline-flex;
    align-items:center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 14px;
    text-decoration:none;
    font-weight: 900;
    color: rgba(229,231,235,0.92);
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.14);
    box-shadow: 0 14px 35px rgba(0,0,0,0.22);
    transition: transform .2s ease, background .2s ease;
    white-space: nowrap;
  }
  .back-link:hover{
    transform: translateY(-1px);
    background: rgba(255,255,255,0.14);
  }

  /* Glass card */
  .card{
    background:
      radial-gradient(700px 240px at 15% 0%, rgba(56,189,248,0.12), transparent 55%),
      radial-gradient(520px 200px at 90% 15%, rgba(129,140,248,0.12), transparent 55%),
      linear-gradient(180deg, var(--glass1), var(--glass2));
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 18px;
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: 16px;
  }

  .card-head{
    display:flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 12px;
  }

  .card-title{
    margin:0;
    font-size: 16px;
    font-weight: 900;
    color: rgba(229,231,235,0.92);
  }

  .chip{
    display:inline-flex;
    align-items:center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 999px;
    font-weight: 900;
    font-size: 12px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: rgba(229,231,235,0.90);
    white-space: nowrap;
  }

  /* Form */
  .form-grid{
    display:grid;
    grid-template-columns: 2fr 2fr 1fr 1fr;
    gap: 12px;
    align-items: end;
  }

  .field{ min-width: 0; }
  .field label{
    display:block;
    margin: 0 0 8px;
    color: rgba(229,231,235,0.80);
    font-weight: 900;
    font-size: 12px;
    letter-spacing: .2px;
    text-transform: uppercase;
  }

  input, select{
    width: 100%;
    padding: 12px 14px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: rgba(229,231,235,0.92);
    outline: none;
    font-weight: 800;
    font-size: 14px;
    transition: box-shadow .15s ease, border-color .15s ease, background .15s ease;
  }

  input::placeholder{ color: rgba(229,231,235,0.60); }

  input:focus, select:focus{
    border-color: rgba(56,189,248,0.55);
    box-shadow: 0 0 0 5px rgba(56,189,248,0.10);
    background: rgba(255,255,255,0.10);
  }

  select option{ color:#111827; } /* for some browsers */

  .btn{
    border:none;
    cursor:pointer;
    padding: 12px 16px;
    border-radius: 16px;
    font-weight: 900;
    color: #020617;
    background: linear-gradient(90deg, rgba(34,197,94,0.95), rgba(16,185,129,0.95));
    border: 1px solid rgba(255,255,255,0.14);
    box-shadow: 0 14px 30px rgba(34,197,94,0.18);
    transition: transform .2s ease, filter .2s ease;
    white-space: nowrap;
  }
  .btn:hover{ transform: translateY(-1px); filter: brightness(1.02); }

  /* Table */
  .table-wrap{ overflow:auto; border-radius: 18px; border: 1px solid rgba(255,255,255,0.10); }
  table{
    width: 100%;
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
    color: rgba(229,231,235,0.92);
    font-weight: 800;
    font-size: 14px;
    vertical-align: middle;
  }
  tbody tr:hover td{ background: rgba(255,255,255,0.06); }

  .badge{
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 900;
    display: inline-flex;
    align-items:center;
    gap: 8px;
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    white-space: nowrap;
  }
  .badge.paid{
    background: rgba(34,197,94,0.14);
    border-color: rgba(34,197,94,0.26);
  }
  .badge.pending{
    background: rgba(239,68,68,0.14);
    border-color: rgba(239,68,68,0.26);
  }

  .btn-edit{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding: 8px 12px;
    border-radius: 14px;
    text-decoration:none;
    font-weight: 900;
    color: #020617;
    background: linear-gradient(90deg, rgba(56,189,248,0.92), rgba(129,140,248,0.92));
    border: 1px solid rgba(255,255,255,0.14);
    box-shadow: 0 12px 26px rgba(56,189,248,0.16);
    transition: transform .2s ease, filter .2s ease;
    white-space: nowrap;
  }
  .btn-edit:hover{ transform: translateY(-1px); filter: brightness(1.02); }

  .empty{
    text-align:center;
    padding: 22px;
    color: rgba(229,231,235,0.75);
    font-weight: 800;
  }

  @media (max-width: 980px){
    .form-grid{ grid-template-columns: 1fr; }
    table{ min-width: 820px; }
    .back-link{ width: 100%; justify-content:center; }
  }
</style>

<div class="page">

  <div class="top">
    <div>
      <h2 class="title">Class {{ $class }} Fees</h2>
      <p class="subtitle">Add new fees and manage fee records for this class.</p>
    </div>

    <a href="{{ route('fees.create') }}" class="back-link">← Back to Classes</a>
  </div>

  <!-- ADD FEES -->
  <div class="card">
    <div class="card-head">
      <h3 class="card-title">Add Fees — Class {{ $class }}</h3>
      <span class="chip">Fees Panel</span>
    </div>

    <form method="POST" action="{{ route('fees.class.store', $class) }}">
      @csrf

      <div class="form-grid">
        <div class="field">
          <label>Student Name</label>
          <input name="student_name" placeholder="Student Name" required>
        </div>

        <div class="field">
          <label>Father Name</label>
          <input type="text" name="father_name" placeholder="Father Name" required>
        </div>

        <div class="field">
          <label>Amount</label>
          <input name="amount" placeholder="Fees Amount" required>
        </div>

        <div class="field">
          <label>Status</label>
          <select name="status" required>
            <option value="">Select Status</option>
            <option value="paid">Paid</option>
            <option value="pending">Pending</option>
          </select>
        </div>
      </div>

      <div style="margin-top:12px; display:flex; justify-content:flex-end;">
        <button class="btn" type="submit">Add Fees</button>
      </div>
    </form>
  </div>

  <!-- RECORDS -->
  <div class="card">
    <div class="card-head">
      <h3 class="card-title">Fees Records — Class {{ $class }}</h3>
      <span class="chip">{{ $fees->count() }} Records</span>
    </div>

    @if($fees->count())
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Amount</th>
              <th>Father Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach($fees as $fee)
              <tr>
                <td>{{ $fee->student_name }}</td>
                <td>₹{{ $fee->amount }}</td>
                <td>{{ $fee->father_name }}</td>
                <td>
                  <span class="badge {{ $fee->status }}">
                    {{ ucfirst($fee->status) }}
                  </span>
                </td>
                <td>
                  <a href="{{ route('fees.editStatus', $fee->id) }}" class="btn-edit">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="empty">No fees added yet for this class.</div>
    @endif
  </div>

</div>
@endsection
