<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login - Arya Public Academy</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/   css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 40%, #0f3460 70%, #533483 100%);
            position: relative;
            overflow: hidden;
        }

        /* ── Animated background blobs ── */
        body::before {
            content: '';
            position: fixed;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(83,52,131,0.5) 0%, transparent 70%);
            top: -200px; left: -200px;
            animation: blobMove 12s infinite alternate ease-in-out;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(15,52,96,0.6) 0%, transparent 70%);
            bottom: -150px; right: -150px;
            animation: blobMove 15s infinite alternate-reverse ease-in-out;
            z-index: 0;
        }

        @keyframes blobMove {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(60px, 40px) scale(1.15); }
        }

        /* ── Floating particles ── */
        .particles {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            animation: floatUp linear infinite;
        }

        .particle:nth-child(1)  { width:6px;  height:6px;  left:10%; animation-duration:8s;  animation-delay:0s;   }
        .particle:nth-child(2)  { width:4px;  height:4px;  left:25%; animation-duration:11s; animation-delay:2s;   }
        .particle:nth-child(3)  { width:8px;  height:8px;  left:40%; animation-duration:9s;  animation-delay:1s;   }
        .particle:nth-child(4)  { width:3px;  height:3px;  left:55%; animation-duration:13s; animation-delay:3s;   }
        .particle:nth-child(5)  { width:5px;  height:5px;  left:70%; animation-duration:10s; animation-delay:0.5s; }
        .particle:nth-child(6)  { width:7px;  height:7px;  left:85%; animation-duration:7s;  animation-delay:1.5s; }
        .particle:nth-child(7)  { width:4px;  height:4px;  left:15%; animation-duration:14s; animation-delay:4s;   }
        .particle:nth-child(8)  { width:6px;  height:6px;  left:60%; animation-duration:12s; animation-delay:2.5s; }

        @keyframes floatUp {
            0%   { transform: translateY(110vh) rotate(0deg);   opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 1; }
            100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
        }

        /* ── Card ── */
        .card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            margin: 20px;
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 24px;
            padding: 44px 40px 40px;
            box-shadow:
                0 32px 80px rgba(0,0,0,0.5),
                inset 0 1px 0 rgba(255,255,255,0.15);
            animation: cardAppear 0.8s cubic-bezier(0.16,1,0.3,1) both;
        }

        @keyframes cardAppear {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0)    scale(1);    }
        }

        /* ── Avatar ── */
        .avatar-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .avatar {
            width: 90px; height: 90px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            border: 3px solid rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
            overflow: hidden;
            padding: 6px;
        }

        .avatar svg {
            width: 44px; height: 44px;
            fill: rgba(255,255,255,0.7);
        }

        /* ── Logo / Title ── */
        .logo {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo h2 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .logo p {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.45);
            font-weight: 400;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            margin-bottom: 28px;
        }

        /* ── Form groups ── */
        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: rgba(255,255,255,0.4);
            font-size: 1rem;
            pointer-events: none;
            z-index: 1;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 12px;
            background: rgba(255,255,255,0.08);
            color: #ffffff59;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: all 0.3s ease;
        }

        input::placeholder {
            color: #ffffff59;
            font-size: 0.875rem;
        }

        input:focus {
            border-color: rgba(139,92,246,0.7);
            background: rgba(255,255,255,0.12);
            box-shadow: 0 0 0 3px rgba(139,92,246,0.2);
        }

        .toggle-eye {
            position: absolute;
            right: 14px;
            cursor: pointer;
            color: rgba(255,255,255,0.35);
            font-size: 0.95rem;
            transition: color 0.2s;
            user-select: none;
        }

        .toggle-eye:hover { color: rgba(255,255,255,0.7); }

        /* ── Remember row ── */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .remember-row input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: #8b5cf6;
            cursor: pointer;
            padding: 0;
            border-radius: 4px;
        }

        .remember-row label {
            color: rgba(255,255,255,0.5);
            font-size: 0.8rem;
            cursor: pointer;
            user-select: none;
        }

        /* ── Login Button ── */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(124,58,237,0.45);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(124,58,237,0.6);
        }

        .btn-login:hover::before { opacity: 1; }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(124,58,237,0.4);
        }

        /* ── Error message ── */
        .error-msg {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.4);
            color: #fca5a5;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.8rem;
            margin-bottom: 18px;
            text-align: center;
        }

        /* ── Back link ── */
        .back-link {
            text-align: center;
            margin-top: 22px;
        }

        .back-link a {
            color: rgba(255,255,255,0.3);
            font-size: 0.775rem;
            text-decoration: none;
            letter-spacing: 0.5px;
            transition: color 0.2s;
        }

        .back-link a:hover { color: rgba(255,255,255,0.7); }

        /* ── Mobile ── */
        @media (max-width: 480px) {
            .card { padding: 36px 24px 32px; margin: 16px; }
            .logo h2 { font-size: 1.2rem; }
        }
    </style>
</head>
<body>

<!-- Floating particles -->
<div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
</div>

<!-- Card -->
<div class="card">

    <!-- Avatar -->
   <!-- Avatar -->
<div class="avatar-wrapper">
    <div class="avatar">
        <img src="{{ asset('images/school-logo.png') }}"
             alt="Arya Public Academy"
             style="width:64px; height:64px; object-fit:contain; border-radius:50%;">
    </div>
</div>

    <!-- Logo -->
    <div class="logo">
        <h2>Arya Public Academy</h2>
        <p>Teacher Portal</p>
    </div>

    <div class="divider"></div>

    <!-- Errors -->
    @if ($errors->any())
        <div class="error-msg">{{ $errors->first() }}</div>
    @endif

    @if(session('error'))
        <div class="error-msg">{{ session('error') }}</div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('teacher.login.post') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <div class="input-wrapper">
                <span class="input-icon">✉️</span>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="Email ID" required>
            </div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <div class="input-wrapper">
                <span class="input-icon">🔒</span>
                <input type="password" name="password"
                       id="pass" placeholder="Password" required>
                <span class="toggle-eye" onclick="togglePass()">👁</span>
            </div>
        </div>

        <!-- Remember me -->
        <div class="remember-row">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn-login">Login</button>
    </form>

    <div class="back-link">
        <a href="{{ url('/') }}">← Back to Website</a>
    </div>

</div>

<script>
    function togglePass() {
        const p = document.getElementById('pass');
        p.type = p.type === 'password' ? 'text' : 'password';
    }
</script>
</body>
</html>
