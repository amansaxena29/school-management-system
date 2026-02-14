<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arya Director Login</title>

    <style>
        body { margin: 0; font-family: 'Segoe UI', sans-serif; }
        .layout { display: flex; min-height: 100vh; background: #f1f5f9; }

        .sidebar {
            width: 260px;
            background: #4d3131;
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; height: 100vh;
        }

        .sidebar-header {
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 1px solid #1e293b;
        }

        .sidebar a {
            color: #e5e7eb;
            text-decoration: none;
            padding: 14px 22px;
            display: block;
            font-size: 15px;
        }

        .sidebar a:hover,
        .sidebar a.active { background: #1e293b; color: #fff; }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px;
            font-size: 14px;
            border-top: 1px solid #481118;
        }

        .content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 24px;
        }

        .topbar {
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            padding: 0 24px;
            margin-bottom: 24px;
        }
    </style>

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">Arya Admin</div>

        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">Students</a>
        <a href="{{ route('teachers.index') }}" class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">Teachers</a>
        <a href="{{ route('fees.index') }}" class="{{ request()->routeIs('fees.*') ? 'active' : '' }}">Fees</a>
        <a href="{{ url('/attendance') }}" class="{{ request()->is('attendance*') ? 'active' : '' }}">Attendances</a>
        <a href="{{ route('exams.index') }}"class="{{ request()->routeIs('exams.*') ? 'active' : '' }}">Examinations</a>
        {{-- <a href="{{ route('results.index') }}" class="{{ request()->routeIs('results.*') ? 'active' : '' }}">Results</a> --}}
        <a href="{{ route('marksheets.index') }}" class="{{ request()->routeIs('marksheets.*') ? 'active' : '' }}">Marksheets</a>
        <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }} sidebar-link">Profile</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="all:unset;width:100%;cursor:pointer;">
                <span style="padding:14px 22px;display:block;color:rgb(255, 255, 255);">Logout</span>
            </button>
        </form>

        <div class="sidebar-footer">
            Logged in as <strong>{{ Auth::user()->name }}</strong>
        </div>
    </aside>

    <!-- CONTENT -->
    <div class="content">
        {{-- <div class="topbar">
            <!-- Show the header only on the dashboard page -->
            @if(request()->route()->getName() == 'dashboard')
                <h2>@yield('header', 'Dashboard')</h2>
            @endif
        </div> --}}

        {{-- FOR Jetstream / x-app-layout --}}
        {{ $slot ?? '' }}

        {{-- FOR Blade @extends --}}
        @yield('content')

    </div>

</div>

</body>
</html>
