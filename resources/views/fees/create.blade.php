@extends('layouts.app')

@section('header', 'Class-wise Fees Management')

@section('content')

<style>
    .class-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .class-card {
        padding: 25px;
        border-radius: 16px;
        color: white;
        text-decoration: none;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }

    .class-card:hover {
        transform: translateY(-6px);
    }

    .class-card h2 {
        margin: 0 0 8px;
        font-size: 22px;
    }

    .class-card p {
        margin: 0;
        font-size: 14px;
        opacity: 0.9;
    }

    /* COLORS */
    .c1 { background:#2563eb; }
    .c2 { background:#16a34a; }
    .c3 { background:#9333ea; }
    .c4 { background:#ea580c; }
    .c5 { background:#db2777; }
    .c6 { background:#0891b2; }
    .c7 { background:#dc2626; }
    .c8 { background:#4f46e5; }
    .c9 { background:#65a30d; }
    .c10 { background:#ca8a04; }
    .c11 { background:#0284c7; }
    .c12 { background:#334155; }
</style>

<h1 style="font-size:26px;font-weight:600;">
    Select Class to Manage Fees
</h1>

<div class="class-grid">
    @for($i = 1; $i <= 12; $i++)
        <a href="{{ route('fees.class', $i) }}"
           class="class-card c{{ $i }}">
            <h2>Class {{ $i }}</h2>
            <p>Manage fees for Class {{ $i }}</p>
        </a>
    @endfor
</div>

@endsection
