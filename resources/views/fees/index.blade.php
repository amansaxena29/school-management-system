@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="title">Manage Student Fees</h2>

    {{-- @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif --}}

    @if (session('success'))
    <!-- Popup Modal -->
    <div id="successModal" class="modal-overlay">
        <div class="modal-box">
            <h3>Success</h3>
            <p>{{ session('success') }}</p>
            <button id="closeModalBtn" class="modal-btn">OK</button>
        </div>
    </div>

    <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modal = document.getElementById("successModal");
                const btn = document.getElementById("closeModalBtn");

                // Show modal
                modal.style.display = "flex";

                // Close modal on button click
                btn.addEventListener("click", function () {
                    modal.style.display = "none";
                });

                // Optional: close modal when clicking outside the box
                modal.addEventListener("click", function (e) {
                    if (e.target === modal) modal.style.display = "none";
                });
            });
    </script>
    @endif


    <!-- Top Actions Row -->
    <div class="top-actions">
        <a href="{{ route('fees.create') }}" class="btn-add">Add New Fee</a>

        <!-- Search Form -->
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
            <tr>
                <td>{{ $fee->student_name }}</td>
                <td>{{ $fee->class }}</td>
                <td>₹{{ $fee->amount }}</td>
                <td>{{ ucfirst($fee->status) }}</td>
                <td>
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
                <td colspan="5" style="padding: 20px; color:#666;">No results found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination (keeps search query in URL) -->
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

<style>
.container { max-width: 900px; margin: 30px auto; font-family: 'Poppins', sans-serif; }
.title { text-align: center; font-size: 32px; margin-bottom: 20px; color: #333; }
.alert { background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px; }

.top-actions{
    display:flex;
    justify-content: space-between;
    align-items:center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 15px;
}

.btn-add { display: inline-block; background: #4d3131; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; transition: 0.3s; }
.btn-add:hover { background: #45a049; }

.search-form{
    display:flex;
    align-items:center;
    gap: 8px;
}

.search-input{
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    outline: none;
    width: 220px;
}

.search-input:focus{
    border-color: #4caf50;
    box-shadow: 0 0 0 3px rgba(76,175,80,0.15);
}

.btn-search{
    background: #2196f3;
    color: #fff;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
}
.btn-search:hover{
    background: #0b7dda;
}

.btn-clear{
    background: #e5e7eb;
    color: #111827;
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration:none;
}
.btn-clear:hover{
    background:#d1d5db;
}

.fees-table { width: 100%; border-collapse: collapse; }
.fees-table th, .fees-table td { border: 1px solid #ddd; padding: 10px; text-align: center; }
.fees-table th { background: #4d3131; color: white; }

.btn-edit { background: #2196f3; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none; }
.btn-edit:hover { background: #0b7dda; }

.btn-delete { background: #f44336; color: white; padding: 5px 10px; border-radius: 5px; border: none; cursor: pointer; }
.btn-delete:hover { background: #da190b; }

/* Pagination */
.simple-pagination {
    margin-top: 25px;
    display: flex;
    justify-content: center;
    gap: 12px;
}

.simple-pagination a,
.simple-pagination span {
    padding: 8px 14px;
    border-radius: 6px;
    border: 1px solid #4caf50;
    text-decoration: none;
    color: #4caf50;
    font-weight: 500;
}

.simple-pagination a:hover {
    background: #4caf50;
    color: white;
}

.simple-pagination .disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Modal Popup */
.modal-overlay{
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: none; /* JS will set it to flex */
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.modal-box{
    width: 380px;
    max-width: 90%;
    background: #fff;
    border-radius: 10px;
    padding: 18px 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    text-align: center;
    animation: popIn 0.18s ease-out;
}

.modal-box h3{
    margin: 0 0 10px;
    font-size: 20px;
    color: #111;
}

.modal-box p{
    margin: 0 0 16px;
    color: #333;
    font-size: 15px;
}

.modal-btn{
    background: #4caf50;
    color: white;
    border: none;
    padding: 9px 18px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}
.modal-btn:hover{ background:#45a049; }

@keyframes popIn{
    from{ transform: scale(0.95); opacity: 0; }
    to{ transform: scale(1); opacity: 1; }
}

</style>
