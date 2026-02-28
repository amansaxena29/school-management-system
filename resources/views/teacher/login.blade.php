<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login - Arya Public Academy</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('/images/school-bg.jpg') center/cover no-repeat fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 0;
        }

        .card {
            position: relative; z-index: 1;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 16px;
            padding: 40px 36px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }

        .logo { text-align: center; margin-bottom: 6px; }
        .logo h2 { color: #f97316; font-size: 1.6rem; font-weight: 700; }
        .logo p  { color: #fcd34d; font-size: 0.9rem; margin-top: 4px; }

        .divider {
            height: 1px;
            background: rgba(255,255,255,0.2);
            margin: 18px 0;
        }

        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            color: #e2e8f0;
            font-size: 0.875rem;
            margin-bottom: 6px;
            font-weight: 500;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 8px;
            background: rgba(255,255,255,0.15);
            color: #fff;
            font-size: 0.95rem;
            outline: none;
            transition: border 0.2s;
        }

        input::placeholder { color: rgba(255,255,255,0.5); }
        input:focus { border-color: #f97316; }

        .password-wrapper { position: relative; }
        .toggle-eye {
            position: absolute; right: 12px; top: 50%;
            transform: translateY(-50%);
            cursor: pointer; color: rgba(255,255,255,0.6);
            font-size: 1rem;
        }

        .remember-row {
            display: flex; align-items: center; gap: 8px;
            color: #f97316; font-size: 0.875rem; margin-bottom: 20px;
        }
        .remember-row input { width: auto; }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-login:hover { background: #1d4ed8; }

        .forgot {
            text-align: center;
            margin-top: 14px;
        }
        .forgot a {
            color: #f97316;
            font-size: 0.875rem;
            text-decoration: none;
        }
        .forgot a:hover { text-decoration: underline; }

        .error-msg {
            background: rgba(239,68,68,0.2);
            border: 1px solid #ef4444;
            color: #fca5a5;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-bottom: 16px;
        }

        .back-link {
            text-align: center;
            margin-top: 16px;
        }
        .back-link a {
            color: #94a3b8;
            font-size: 0.8rem;
            text-decoration: none;
        }
        .back-link a:hover { color: #fff; }
    </style>
</head>
<body>
<div class="overlay"></div>

<div class="card">
    <div class="logo">
        <h2>Arya Public Academy</h2>
        <p>Teacher Login Portal</p>
    </div>
    <div class="divider"></div>

    @if ($errors->any())
        <div class="error-msg">
            {{ $errors->first() }}
        </div>
    @endif

    @if(session('error'))
        <div class="error-msg">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('teacher.login.post') }}">
        @csrf

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email"
                   value="{{ old('email') }}"
                   placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="pass"
                       placeholder="Enter your password" required>
                <span class="toggle-eye" onclick="togglePass()">👁</span>
            </div>
        </div>

        <div class="remember-row">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" style="margin:0; cursor:pointer;">Remember me</label>
        </div>

        <button type="submit" class="btn-login">Log in</button>
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
