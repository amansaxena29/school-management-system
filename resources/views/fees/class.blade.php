@extends('layouts.app')

@section('header', 'Class ' . $class . ' Fees')

@section('content')

<style>
    :root {
        --primary: #2563eb;
        --success: #16a34a;
        --danger: #dc2626;
        --bg: #f8fafc;
    }

    .page-wrap {
        max-width: 1100px;
        margin: auto;
    }

    .card {
        background: linear-gradient(180deg, #ffffff, #f9fafb);
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 20px 45px rgba(0,0,0,0.12);
        margin-bottom: 32px;
    }

    .title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 20px;
    }

    input, select {
        padding: 14px 16px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        font-size: 15px;
        transition: 0.3s;
    }

    input:focus, select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        outline: none;
    }

    .btn {
        margin-top: 18px;
        padding: 14px 26px;
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: white;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(37,99,235,0.4);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 18px;
        border-radius: 12px;
        overflow: hidden;
    }

    th {
        background: linear-gradient(135deg, #91bb13, #6fa108);
        color: white;
        padding: 16px;
        font-size: 14px;
        text-align: center;
    }

    td {
        padding: 14px;
        text-align: center;
        font-size: 14px;
        border-bottom: 1px solid #e5e7eb;
    }

    tr:hover td {
        background: #f1f5f9;
    }

    .badge {
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }

    .paid {
        background: rgba(22,163,74,0.15);
        color: var(--success);
    }

    .pending {
        background: rgba(220,38,38,0.15);
        color: var(--danger);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
    }

    .empty {
        text-align: center;
        padding: 30px;
        color: #6b7280;
        font-size: 15px;
    }
</style>

<div class="page-wrap">

    <a href="{{ route('fees.create') }}" class="back-link">
        ← Back to Classes
    </a>

    <!-- ADD FEES -->
    <div class="card">
        <div class="title">Add Fees — Class {{ $class }}</div>

        <form method="POST" action="{{ route('fees.class.store', $class) }}">
            @csrf

            <div class="form-grid">
                <input name="student_name" placeholder="Student Name" required>
                <input type="text" name="father_name" placeholder="Father Name" class="form-control" requiredw>
                <input name="amount" placeholder="Fees Amount" required>



                <select name="status" required>
                    <option value="">Select Status</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <button class="btn">Add Fees</button>
        </form>
    </div>

    <!-- RECORDS -->
    <div class="card">
        <div class="title">Fees Records — Class {{ $class }}</div>

        @if($fees->count())
            <table>
                <tr>
                    <th>Student Name</th>
                    <th>Amount</th>
                    <th>Father Name</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

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
    <a href="{{ route('fees.editStatus', $fee->id) }}"
       class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
        Edit
    </a>
</td>

                </tr>
                @endforeach
            </table>
        @else
            <div class="empty">
                No fees added yet for this class.
            </div>
        @endif
    </div>

</div>

@endsection
