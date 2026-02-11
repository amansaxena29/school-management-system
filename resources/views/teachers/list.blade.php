@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-top">
        <h2 class="title">All Teachers</h2>
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


        <div class="actions">
            <a href="{{ route('teachers.index') }}" class="btn-back">← Back</a>
        </div>
    </div>

    <div class="search-row">
        <input type="text" id="searchTeacher" placeholder="Search teacher..." class="search-input">
    </div>

    <div class="table-wrap">
        <table class="teachers-table" id="teachersTable">
            <thead>
                <tr>
                    <th>Teacher Name</th>
                    <th>Subject</th>
                    <th>Qualification</th>
                    <th>Experience</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $t)
                    <tr>
                        <td>{{ $t->teacher_name ?? $t->name }}</td>
                        <td>{{ $t->subject ?? '-' }}</td>
                        <td>{{ $t->qualification ?? '-' }}</td>
                        <td>{{ $t->experience ?? '-' }}</td>
                        <td>{{ $t->phone ?? $t->phone_number ?? '-' }}</td>
                        <td>
                            @if(!empty($t->dob))
                                {{ \Carbon\Carbon::parse($t->dob)->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $t->email ?? '-' }}</td>
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
                        <td colspan="7" class="empty">No teachers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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

<style>

.container { max-width: 1100px; margin: 30px auto; font-family: 'Poppins', sans-serif; }

/* top header */
.page-top{
    display:flex;
    justify-content: space-between;
    align-items:center;
    gap: 12px;
    margin-bottom: 14px;
}

.title{
    font-size: 32px;
    margin: 0;
    color: #1f2937;
    font-weight: 800;
}

/* buttons */
.btn-back{
    background:#e5e7eb;
    color:#111827;
    padding:10px 14px;
    border-radius:10px;
    text-decoration:none;
    font-weight:700;
}
.btn-back:hover{ background:#d1d5db; }

/* search */
.search-row{
    display:flex;
    justify-content:flex-end;
    margin-bottom: 12px;
}
.search-input{
    width: 260px;
    max-width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 10px;
    outline:none;
}
.search-input:focus{
    border-color:#22c55e;
    box-shadow: 0 0 0 4px rgba(34,197,94,0.15);
}

/* table */
.table-wrap{
    background:#fff;
    border-radius: 14px;
    overflow:auto;
    box-shadow: 0 12px 28px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
}

.teachers-table{
    width:100%;
    border-collapse: collapse;
    min-width: 980px;
}

.teachers-table th{
    background:#16a34a;
    color:#fff;
    padding: 12px;
    text-align:left;
    font-size: 14px;
}
.teachers-table td{
    padding: 12px;
    border-top: 1px solid #e5e7eb;
    color:#111827;
    font-size: 14px;
}
.teachers-table tr:hover td{
    background:#f9fafb;
}

.empty{
    text-align:center;
    padding: 20px;
    color:#6b7280;
}

.btn-edit{
    background:#2563eb;
    color:#fff;
    padding:7px 12px;
    border-radius:8px;
    text-decoration:none;
    font-weight:700;
    display:inline-block;
}
.btn-edit:hover{ background:#1d4ed8; }


.toast{
    position: fixed;
    top: 18px;
    right: 18px;
    background: #16a34a;
    color: #fff;
    padding: 12px 16px;
    border-radius: 12px;
    font-weight: 800;
    box-shadow: 0 16px 35px rgba(0,0,0,0.18);
    opacity: 0;
    transform: translateY(-8px);
    transition: 0.25s ease;
    z-index: 9999;
}
.toast.show{
    opacity: 1;
    transform: translateY(0);
}

.action-col{
    white-space: nowrap;
}

.delete-form{
    display:inline-block;
    margin-left: 8px;
}

.btn-delete{
    background:#ef4444;
    color:#fff;
    padding:7px 12px;
    border-radius:8px;
    border:none;
    font-weight:700;
    cursor:pointer;
}
.btn-delete:hover{
    background:#dc2626;
}


</style>
@endsection
