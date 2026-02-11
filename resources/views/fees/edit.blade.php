@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="title">Edit Student Fee</h2>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert-danger">
            <strong>Please fix the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <span>Edit Fee Details</span>
            <a href="{{ route('fees.index') }}" class="btn-back">← Back</a>
        </div>

        <form method="POST" action="{{ route('fees.update', $fee->id) }}" class="fee-form">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label>Student Name</label>
                    <input
                        type="text"
                        name="student_name"
                        value="{{ old('student_name', $fee->student_name) }}"
                        placeholder="Enter student name"
                        required
                    />
                </div>

                <div class="form-group">
                    <label>Class</label>
                    <input
                        type="number"
                        name="class"
                        min="1"
                        max="12"
                        value="{{ old('class', $fee->class) }}"
                        placeholder="1 - 12"
                        required
                    />
                </div>

                <div class="form-group">
                    <label>Amount</label>
                    <input
                        type="number"
                        step="0.01"
                        name="amount"
                        value="{{ old('amount', $fee->amount) }}"
                        placeholder="5000.00"
                        required
                    />
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="pending" {{ old('status', $fee->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ old('status', $fee->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Update</button>
                <a href="{{ route('fees.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

<style>
/* Match fees/index.blade.php theme */
.container {
    max-width: 900px;
    margin: 30px auto;
    font-family: 'Poppins', sans-serif;
}

.title {
    text-align: center;
    font-size: 32px;
    margin-bottom: 20px;
    color: #333;
}

/* Alerts */
.alert {
    background: #d4edda;
    color: #155724;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}
.alert-danger {
    background: #f8d7da;
    color: #721c24;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 6px;
}
.alert-danger ul {
    margin: 8px 0 0;
    padding-left: 18px;
}

/* Card */
.card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.card-header {
    background: #4caf50;
    color: white;
    padding: 14px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
}

.btn-back {
    background: rgba(255,255,255,0.18);
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
}
.btn-back:hover {
    background: rgba(255,255,255,0.28);
}

/* Form */
.fee-form {
    padding: 18px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    color: #333;
    font-weight: 600;
    font-size: 14px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    font-size: 14px;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #4caf50;
    box-shadow: 0 0 0 3px rgba(76,175,80,0.15);
}

/* Actions */
.form-actions {
    margin-top: 18px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-save {
    background: #2196f3;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}
.btn-save:hover {
    background: #0b7dda;
}

.btn-cancel {
    background: #e5e7eb;
    color: #111827;
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
}
.btn-cancel:hover {
    background: #d1d5db;
}

/* Responsive */
@media (max-width: 700px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    .form-actions {
        flex-direction: column;
    }
    .btn-save, .btn-cancel {
        text-align: center;
        width: 100%;
    }
}
</style>
@endsection
