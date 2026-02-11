@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #eef2ff, #f8fafc);
    }

    .fee-card {
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        padding: 35px;
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 25px;
        color: #1f2937;
        text-align: center;
    }

    .info-box {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-item {
        background: #f9fafb;
        border-radius: 14px;
        padding: 18px;
        border-left: 6px solid #4f46e5;
    }

    .info-item span {
        display: block;
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .info-item strong {
        font-size: 16px;
        color: #111827;
    }

    .status-label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: #374151;
    }

    .status-select {
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        border: 1px solid #d1d5db;
        font-size: 15px;
        outline: none;
        transition: all 0.3s;
        background: #fff;
    }

    .status-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
    }

    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .btn-update {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: #ffffff;
        padding: 14px 30px;
        border-radius: 14px;
        border: none;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(34, 197, 94, 0.35);
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(34, 197, 94, 0.45);
    }

    .btn-cancel {
        background: #e5e7eb;
        color: #374151;
        padding: 14px 28px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        background: #d1d5db;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 10px;
    }

    .paid {
        background: #dcfce7;
        color: #166534;
    }

    .pending {
        background: #fee2e2;
        color: #991b1b;
    }

</style>

<div class="max-w-3xl mx-auto mt-12 mb-12">

    <div class="fee-card">

        <h2 class="page-title">
            Update Fee Status
        </h2>

        <div class="info-box">
            <div class="info-item">
                <span>Student Name</span>
                <strong>{{ $fee->student_name }}</strong>
            </div>

            <div class="info-item">
                <span>Father Name</span>
                <strong>{{ $fee->father_name }}</strong>
            </div>

            <div class="info-item">
                <span>Fees Amount</span>
                <strong>₹{{ $fee->amount }}</strong>
            </div>
        </div>

        <div class="mb-4">
            <span class="status-badge {{ $fee->status == 'Paid' ? 'paid' : 'pending' }}">
                Current Status: {{ $fee->status }}
            </span>
        </div>

        <form method="POST" action="{{ route('fees.updateStatus', $fee->id) }}">
            @csrf
            @method('PUT')

            <label class="status-label">Update Status</label>

            <select name="status" class="status-select">
                <option value="Paid" {{ $fee->status == 'Paid' ? 'selected' : '' }}>
                    Paid
                </option>
                <option value="Pending" {{ $fee->status == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>
            </select>

            <div class="button-group">
                <button type="submit" class="btn-update">
                    ✅ Update Status
                </button>

                

                <a href="{{ url()->previous() }}" class="btn-cancel">
                    ⬅ Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection
