<x-app-layout>

<style>
.page {
    padding: 5px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
}

.header h1 {
    font-size: 2rem;
    font-weight: 800;
    color: #38bdf8;
}

.add-btn {
    padding: 14px 28px;
    border-radius: 14px;
    background: linear-gradient(90deg, #38bdf8, #6366f1);
    color: #020617;
    font-weight: 700;
    text-decoration: none;
}

.class-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 24px;
}

.class-card {
    padding: 28px;
    border-radius: 20px;
    background: #554604;
    color: white;
    box-shadow: 0 25px 60px rgba(0,0,0,0.4);
    transition: transform 0.25s ease;
    text-decoration: none;

}

.class-card:hover {
    transform: translateY(-6px);
}

.class-card h2 {
    font-size: 1.4rem;
    margin-bottom: 8px;
}

.class-card p {
    color: #94a3b8;
}
</style>

<div class="page">

    <div class="header">
        <h1>🎓 Student Management</h1>
        <a href="{{ route('students.create') }}" class="add-btn">
            + Add New Student
        </a>
    </div>

    <div class="class-grid">
       @foreach(range(1,12) as $class)
            <a href="{{ route('students.class', $class) }}" class="class-card">
                <h2>Class {{ $class }}</h2>
                <p>View students of Class {{ $class }}</p>
            </a>
        @endforeach

    </div>

</div>

</x-app-layout>
