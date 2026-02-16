@extends('layouts.app')

@section('content')
<style>
  /* IMPORTANT: Do NOT style body here, otherwise sidebar layout breaks */
  .att-wrap{
    max-width: 980px;
    margin: 0 auto;
    padding: 22px 18px 60px;
  }

  .att-bg{
    border-radius: 26px;
    padding: 22px;
    background:
      radial-gradient(900px 340px at 18% 10%, rgba(56,189,248,0.18), transparent 60%),
      radial-gradient(700px 280px at 85% 30%, rgba(129,140,248,0.22), transparent 55%),
      linear-gradient(180deg, rgba(15,23,42,0.92), rgba(2,6,23,0.92));
    border: 1px solid rgba(255,255,255,0.10);
    box-shadow: 0 25px 70px rgba(0,0,0,0.30);
  }

  .attendance-card {
    background: rgba(255,255,255,0.95);
    border-radius: 18px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.18);
    padding: 26px;
    overflow: hidden;
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 18px;
  }

  .header h2 {
    margin: 0;
    font-size: 26px;
    color: #111827;
    font-weight: 900;
  }

  .header span {
    font-size: 14px;
    color: #4b5563;
    font-weight: 700;
  }

  .change-btn {
    padding: 10px 16px;
    border-radius: 14px;
    background: #f3f4f6;
    color: #4f46e5;
    font-weight: 800;
    text-decoration: none;
    border: 1px solid #d1d5db;
    transition: 0.2s;
    white-space: nowrap;
  }
  .change-btn:hover {
    background: #4f46e5;
    color: #fff;
  }

  .table-wrap{
    overflow:auto;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    min-width: 620px; /* helps on mobile, user can scroll */
    background: #fff;
  }

  table thead {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
  }

  table th, table td {
    padding: 14px;
    text-align: center;
    font-weight: 700;
  }

  table tbody tr {
    border-bottom: 1px solid #eee;
    transition: background 0.2s;
  }
  table tbody tr:hover {
    background: #f5f7ff;
  }

  select {
    padding: 8px 14px;
    border-radius: 999px;
    border: 1px solid #d1d5db;
    font-weight: 800;
    outline: none;
    cursor: pointer;
    background: #fff;
  }

  .save-btn {
    margin-top: 18px;
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 999px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    font-size: 16px;
    font-weight: 900;
    cursor: pointer;
    transition: 0.2s;
  }
  .save-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.18);
  }

  .footer {
    text-align: center;
    margin-top: 12px;
    font-size: 13px;
    color: #6b7280;
    font-weight: 700;
  }

  /* Responsive tweaks */
  @media (max-width: 600px) {
    .header h2 { font-size: 20px; }
    .attendance-card { padding: 18px; }
    table th, table td { padding: 10px; font-size: 13px; }
  }
</style>

<div class="att-wrap">
  <div class="att-bg">
    <div class="attendance-card">

      <div class="header">
        <div>
          <h2>📋 Attendance Sheet</h2>
          <span>Class: <strong>{{ $class }}</strong> | Date: <strong>{{ $date }}</strong></span>
        </div>

        <a href="{{ url('/attendance') }}" class="change-btn">
          🔄 Change Class
        </a>
      </div>

      <form method="POST" action="{{ url('/attendance/store') }}">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">

        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Roll No</th>
                <th>Student Name</th>
                <th>Status</th>
              </tr>
            </thead>

            <tbody>
              @foreach($students as $student)
                <tr>
                  <td>{{ $student->roll_no }}</td>
                  <td>{{ $student->name }}</td>
                  <td>
                    <select name="attendance[{{ $student->id }}]">
                      <option value="Present"
                        {{ isset($attendance[$student->id]) && $attendance[$student->id]->status == 'Present' ? 'selected' : '' }}>
                        ✅ Present
                      </option>

                      <option value="Absent"
                        {{ isset($attendance[$student->id]) && $attendance[$student->id]->status == 'Absent' ? 'selected' : '' }}>
                        ❌ Absent
                      </option>
                    </select>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <button type="submit" class="save-btn">💾 Save Attendance</button>
      </form>

      <div class="footer">
        Arya School Management System • Attendance Module
      </div>

    </div>
  </div>
</div>
@endsection
