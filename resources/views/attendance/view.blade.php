@extends('layouts.app')

@section('header', 'View Attendance')

@section('content')
<style>
    /* Attendance page wrapper */
    .attendance-wrapper {
        min-height: calc(100vh - 120px);
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding-top: 40px;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .attendance-card {
        background: #ffffff;
        width: 520px;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    }

    .attendance-card h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    label {
        font-weight: 600;
        color: #555;
    }

    select,
    input[type="date"] {
        width: 100%;
        padding: 10px;
        margin-top: 6px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    button {
        width: 100%;
        margin-top: 16px;
        padding: 12px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        color: #fff;
        font-weight: bold;
        border-radius: 10px;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 22px;
    }

    th,
    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center;
        font-size: 14px;
    }

    th {
        background: #f1f5f9;
        font-weight: 700;
    }

    .present {
        color: green;
        font-weight: bold;
    }

    .absent {
        color: red;
        font-weight: bold;
    }

    .edit-btn {
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 10px;
    }

    .edit-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }
</style>

<div class="attendance-wrapper">
    <div class="attendance-card">

        <h2>📊 View Attendance</h2>

        <!-- FILTER FORM -->
        <form method="POST" action="{{ route('attendance.view') }}">
            @csrf

            <label>Select Class</label>
            <select name="class" required>
                <option value="" disabled {{ empty($class) ? 'selected' : '' }}>
                    -- Select Class --
                </option>
                @foreach($classes as $cls)
                    <option value="{{ $cls }}"
                        {{ isset($class) && $class == $cls ? 'selected' : '' }}>
                        {{ $cls }}
                    </option>
                @endforeach
            </select>

            <label style="margin-top:12px;">Select Date</label>
            <input
                type="date"
                name="date"
                value="{{ isset($date) ? $date : date('Y-m-d') }}"
                required
            >

            <button type="submit">View Attendance</button>
        </form>

        <!-- RESULT TABLE -->
        @isset($attendanceRecords)
            <table>
                <tr>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                @forelse($attendanceRecords as $row)
                    <tr>
                        <td>{{ $row->roll_no }}</td>
                        <td>{{ $row->name }}</td>
                        <td class="{{ strtolower($row->status) }}">
                            {{ $row->status }}
                        </td>
                        <td>
                            @if ($canEdit)
                                <a href="{{ route('attendance.edit', $row->id) }}" class="edit-btn">Edit</a>
                            @else
                                <button class="edit-btn" disabled>Edit</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No attendance found</td>
                    </tr>
                @endforelse
            </table>
        @endisset

    </div>
</div>
@endsection

