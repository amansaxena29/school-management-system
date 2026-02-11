@extends('layouts.app')

@section('header', 'Edit Attendance')

@section('content')
<div class="attendance-wrapper">
    <div class="attendance-card">
        <h2>Edit Attendance</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Edit Attendance Form -->
        <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Status</label>
            <select name="status" required>
                <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
            </select>

            <button type="submit">Update Attendance</button>
        </form>
    </div>
</div>

<!-- Page Styling -->
<style>
    /* General Page Wrapper */
    .attendance-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #4E54C8, #8F94FB);
        font-family: 'Poppins', sans-serif;
    }

    /* Card Container */
    .attendance-card {
        background: #ffffff;
        width: 400px;
        padding: 40px 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .attendance-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    /* Heading Styling */
    h2 {
        text-align: center;
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 30px;
        letter-spacing: 1px;
    }

    /* Form Fields Styling */
    label {
        font-size: 16px;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    select {
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        border: 1px solid #ccc;
        font-size: 16px;
        margin-bottom: 25px;
        outline: none;
        transition: all 0.3s;
        background-color: #f5f7fb;
    }

    select:focus {
        border-color: #4E54C8;
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(78, 84, 200, 0.3);
    }

    /* Button Styling */
    button {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #4E54C8, #8F94FB);
        border: none;
        color: white;
        font-size: 18px;
        font-weight: 500;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s;
    }

    button:hover {
        background: linear-gradient(135deg, #8F94FB, #4E54C8);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Success Alert Styling */
    .alert {
        padding: 15px;
        background-color: #28a745;
        color: white;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 16px;
        text-align: center;
        animation: slideIn 0.5s ease-in-out;
    }

    /* Animation for Success Message */
    @keyframes slideIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
