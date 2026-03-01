<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500&display=swap');

        :root {
            --gold: #c9a84c;
            --gold-light: #e8c97a;
            --glass-bg: rgba(10, 5, 5, 0.58);
            --glass-border: rgba(201, 168, 76, 0.25);
            --input-bg: rgba(255, 255, 255, 0.92);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: url("{{ asset('images/banner.jpg') }}") center/cover no-repeat fixed;

            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 30px 16px;
            position: relative;
        }

        /* ─── Overlays as real divs with pointer-events:none — NEVER block clicks ─── */
        .bg-overlay {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(118,4,4,0.55) 0%, rgba(0,0,0,0.72) 60%, rgba(10,10,30,0.82) 100%);
            pointer-events: none;
            z-index: 1;
        }

        .bg-orbs {
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 600px 400px at 15% 80%, rgba(201,168,76,0.10) 0%, transparent 70%),
                radial-gradient(ellipse 500px 350px at 85% 20%, rgba(118,4,4,0.18) 0%, transparent 70%);
            pointer-events: none;
            z-index: 1;
            animation: ambientPulse 8s ease-in-out infinite alternate;
        }

        @keyframes ambientPulse {
            0%   { opacity: 0.6; transform: scale(1); }
            100% { opacity: 1;   transform: scale(1.08); }
        }

        /* ─── Floating particles ─── */
        .particles {
            position: fixed;
            inset: 0;
            z-index: 1;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(201, 168, 76, 0.18);
            animation: floatUp linear infinite;
        }

        .particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-duration: 12s; animation-delay: 0s;  }
        .particle:nth-child(2) { width: 6px; height: 6px; left: 25%; animation-duration: 18s; animation-delay: 2s;  }
        .particle:nth-child(3) { width: 3px; height: 3px; left: 40%; animation-duration: 14s; animation-delay: 4s;  }
        .particle:nth-child(4) { width: 5px; height: 5px; left: 60%; animation-duration: 20s; animation-delay: 1s;  }
        .particle:nth-child(5) { width: 4px; height: 4px; left: 75%; animation-duration: 16s; animation-delay: 3s;  }
        .particle:nth-child(6) { width: 7px; height: 7px; left: 88%; animation-duration: 22s; animation-delay: 5s;  }

        @keyframes floatUp {
            0%   { transform: translateY(110vh) rotate(0deg);   opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 0.6; }
            100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
        }

        /* ─── Card — z-index 10, clearly above all z-index:1 overlays ─── */
        .login-card {
            position: relative;
            z-index: 10;
            background: var(--glass-bg);
            backdrop-filter: blur(24px) saturate(160%);
            -webkit-backdrop-filter: blur(24px) saturate(160%);
            border-radius: 20px;
            padding: 44px 40px 38px;
            width: 100%;
            max-width: 430px;
            border: 1px solid var(--glass-border);
            box-shadow:
                0 0 0 0.5px rgba(201,168,76,0.12),
                0 32px 64px rgba(0,0,0,0.6),
                0 8px 24px rgba(118,4,4,0.25),
                inset 0 1px 0 rgba(255,255,255,0.06);
            animation: cardReveal 0.9s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes cardReveal {
            0%   { opacity: 0; transform: translateY(30px) scale(0.97); }
            100% { opacity: 1; transform: translateY(0)    scale(1); }
        }

        /* Gold shimmer top line */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            border-radius: 20px 20px 0 0;
            background: linear-gradient(90deg,
                transparent 0%,
                var(--gold) 30%,
                var(--gold-light) 50%,
                var(--gold) 70%,
                transparent 100%);
            animation: shimmerLine 3s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes shimmerLine {
            0%, 100% { opacity: 0.6; }
            50%       { opacity: 1; }
        }

        /* Inner glow */
        .login-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            background: radial-gradient(ellipse 200px 120px at 50% 0%, rgba(201,168,76,0.07) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ─── Title ─── */
        .login-title {
            text-align: center;
            margin-bottom: 32px;
            animation: fadeUp 0.8s 0.2s cubic-bezier(0.16,1,0.3,1) both;
        }

        @keyframes fadeUp {
            0%   { opacity: 0; transform: translateY(16px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .school-emblem {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            border: 1.5px solid var(--gold);
            background: rgba(201,168,76,0.08);
            margin-bottom: 14px;
            box-shadow: 0 0 20px rgba(201,168,76,0.2), inset 0 0 12px rgba(201,168,76,0.06);
        }

        .school-emblem svg {
            width: 28px;
            height: 28px;
            fill: var(--gold);
            filter: drop-shadow(0 0 4px rgba(201,168,76,0.5));
        }

        .login-title h1 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            color: #fff;
            margin: 0 0 6px;
            letter-spacing: 0.02em;
            text-shadow: 0 2px 12px rgba(0,0,0,0.4);
        }

        .login-title p {
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--gold);
            opacity: 0.85;
        }

        /* ─── Divider ─── */
        .title-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 auto 28px;
            width: 80%;
            animation: fadeUp 0.8s 0.3s cubic-bezier(0.16,1,0.3,1) both;
        }

        .title-divider::before,
        .title-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(201,168,76,0.4));
        }

        .title-divider::after {
            background: linear-gradient(to left, transparent, rgba(201,168,76,0.4));
        }

        .title-divider span {
            color: var(--gold);
            font-size: 14px;
            opacity: 0.7;
        }

        /* ─── Labels ─── */
        .login-card label {
            color: rgba(240, 220, 160, 0.85) !important;
            font-size: 11px !important;
            font-weight: 500 !important;
            letter-spacing: 0.12em !important;
            text-transform: uppercase !important;
            display: block;
            margin-bottom: 6px;
        }

        /* ─── Inputs ─── */
        .login-card input[type="email"],
        .login-card input[type="password"],
        .login-card input[type="text"] {
            background: var(--input-bg) !important;
            border: 1.5px solid transparent !important;
            border-radius: 10px !important;
            color: #1a1a1a !important;
            padding: 13px 44px 13px 16px !important;
            font-size: 14px !important;
            font-family: 'DM Sans', sans-serif !important;
            width: 100% !important;
            display: block !important;
            position: relative !important;
            z-index: 2 !important;
            transition: border-color 0.25s ease, box-shadow 0.25s ease !important;
            outline: none !important;
        }

        .login-card input[type="email"]:focus,
        .login-card input[type="password"]:focus,
        .login-card input[type="text"]:focus {
            border-color: var(--gold) !important;
            box-shadow: 0 0 0 3px rgba(201,168,76,0.15), 0 2px 8px rgba(0,0,0,0.15) !important;
            background: #fff !important;
        }

        /* ─── Password wrapper ─── */
        .password-wrapper {
            position: relative;
            display: block;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            cursor: pointer !important;
            color: #6b7280;
            font-size: 16px;
            user-select: none;
            line-height: 1;
            padding: 6px;
            z-index: 20;
            pointer-events: all !important;
            transition: color 0.2s;
        }

        .toggle-password:hover { color: #1a1a1a; }

        /* ─── Form field stagger ─── */
        .form-field:nth-child(1) { animation: fadeUp 0.7s 0.35s cubic-bezier(0.16,1,0.3,1) both; }
        .form-field:nth-child(2) { animation: fadeUp 0.7s 0.45s cubic-bezier(0.16,1,0.3,1) both; }
        .form-field:nth-child(3) { animation: fadeUp 0.7s 0.50s cubic-bezier(0.16,1,0.3,1) both; }

        /* ─── Remember me ─── */
        .remember {
            margin-top: 16px;
            display: flex;
            align-items: center;
        }

        .login-card input[type="checkbox"] {
            width: 16px !important;
            height: 16px !important;
            accent-color: var(--gold);
            cursor: pointer;
            position: relative !important;
            z-index: 2 !important;
            flex-shrink: 0;
        }

        .remember span {
            color: rgba(220,200,160,0.75);
            font-size: 13px;
            margin-left: 8px;
        }

        /* ─── Login button ─── */
        .login-btn {
            position: relative;
            z-index: 2;
            width: 100%;
            margin-top: 22px;
            padding: 14px;
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            border-radius: 10px;
            border: none;
            color: #fff;
            cursor: pointer;
            overflow: hidden;
            background: linear-gradient(135deg, #b8860b 0%, #c9a84c 40%, #d4af37 60%, #9a6f0e 100%);
            box-shadow: 0 4px 20px rgba(201,168,76,0.35), 0 1px 4px rgba(0,0,0,0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            animation: fadeUp 0.7s 0.55s cubic-bezier(0.16,1,0.3,1) both;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
            transition: left 0.5s ease;
            pointer-events: none;
        }

        .login-btn:hover::before { left: 100%; }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(201,168,76,0.45), 0 2px 8px rgba(0,0,0,0.3);
        }
        .login-btn:active { transform: translateY(0); }

        /* ─── Links ─── */
        .login-card a {
            color: rgba(201, 168, 76, 0.75);
            font-size: 12px;
            letter-spacing: 0.04em;
            text-decoration: none;
            transition: color 0.2s;
            position: relative;
            z-index: 2;
        }
        .login-card a:hover { color: var(--gold-light); }

        .forgot-row {
            text-align: center;
            margin-top: 18px;
            animation: fadeUp 0.7s 0.6s cubic-bezier(0.16,1,0.3,1) both;
        }

        /* ─── Errors ─── */
        .login-card [class*="error"],
        .login-card .text-red-600 {
            color: #fca5a5 !important;
            font-size: 11px !important;
            margin-top: 4px !important;
        }

        .login-card [class*="session"],
        .login-card .text-green-600 {
            color: #86efac !important;
            font-size: 12px !important;
        }

        /* ─── Footer ─── */
        .card-footer {
            text-align: center;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid rgba(201,168,76,0.12);
            animation: fadeUp 0.7s 0.65s cubic-bezier(0.16,1,0.3,1) both;
        }

        .card-footer p {
            color: rgba(180,160,120,0.45);
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
    </style>

    <!-- Background overlays: pointer-events:none so they NEVER intercept any click -->
    <div class="bg-overlay"></div>
    <div class="bg-orbs"></div>

    <!-- Particles: also pointer-events:none -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="login-card">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="login-title">
            <div class="school-emblem">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 3C9.8 3 8 4.8 8 7c0 1.7 1 3.2 2.5 3.8V13h3v-2.2C15 10.2 16 8.7 16 7c0-2.2-1.8-4-4-4zm-1 12v2H9l-1 4h8l-1-4h-2v-2h-2zm1-10c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z"/>
                </svg>
            </div>
            <h1>Arya Public Academy</h1>
            <p>Admin Login Portal</p>
        </div>

        <div class="title-divider"><span>✦</span></div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-field">
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 form-field">
                <x-input-label for="password" :value="__('Password')" />

                <div class="password-wrapper">
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required
                    />

                    <span
                        class="toggle-password"
                        onclick="togglePassword()"
                    >
                        👁
                    </span>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember -->
            <div class="remember form-field">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded text-indigo-600 focus:ring-indigo-500"
                    name="remember"
                >
                <span class="text-sm">
                    {{ __('Remember me') }}
                </span>
            </div>

            <!-- Login Button -->
            <button type="submit" class="login-btn">
                {{ __('Log in') }}
            </button>

            <!-- Forgot Password -->
            {{-- @if (Route::has('password.request'))
                <div class="forgot-row">
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif --}}
        </form>

        <div class="card-footer">
            <p>©  Arya Public Academy &nbsp;·&nbsp; Secured Portal</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type');
            passwordInput.setAttribute('type', type === 'password' ? 'text' : 'password');
        }
    </script>

</x-guest-layout>
