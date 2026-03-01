<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login - Arya Public Academy</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-deep:    #04060f;
            --bg-mid:     #070d1a;
            --teal:       #0ff4c6;
            --teal-dim:   #08c49a;
            --teal-glow:  rgba(15,244,198,0.18);
            --teal-ring:  rgba(15,244,198,0.12);
            --gold:       #f0c060;
            --gold-dim:   rgba(240,192,96,0.6);
            --card-bg:    rgba(8,16,36,0.72);
            --card-edge:  rgba(15,244,198,0.18);
            --text-hi:    #e8f4f8;
            --text-lo:    rgba(180,210,220,0.45);
            --input-bg:   rgba(255,255,255,0.05);
            --input-edge: rgba(15,244,198,0.22);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0; padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            background: var(--bg-deep);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            overflow-y: auto;
            padding: 30px 16px;
            position: relative;
        }

        /* ── Deep space star field ── */
        .starfield {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .star {
            position: absolute;
            border-radius: 50%;
            background: #fff;
            animation: twinkle ease-in-out infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.1; transform: scale(1); }
            50%       { opacity: 0.7; transform: scale(1.4); }
        }

        /* ── Aurora background — pointer-events none ── */
        .aurora {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            overflow: hidden;
        }

        .aurora-band {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0;
            animation: auroraFade ease-in-out infinite;
        }

        .aurora-band:nth-child(1) {
            width: 900px; height: 500px;
            background: radial-gradient(ellipse, rgba(15,244,198,0.12) 0%, transparent 70%);
            top: -200px; left: -200px;
            animation-duration: 14s; animation-delay: 0s;
        }

        .aurora-band:nth-child(2) {
            width: 700px; height: 400px;
            background: radial-gradient(ellipse, rgba(8,80,160,0.18) 0%, transparent 70%);
            top: 20%; right: -200px;
            animation-duration: 18s; animation-delay: 3s;
        }

        .aurora-band:nth-child(3) {
            width: 800px; height: 450px;
            background: radial-gradient(ellipse, rgba(15,244,198,0.07) 0%, transparent 70%);
            bottom: -150px; left: 30%;
            animation-duration: 20s; animation-delay: 6s;
        }

        .aurora-band:nth-child(4) {
            width: 500px; height: 300px;
            background: radial-gradient(ellipse, rgba(240,192,96,0.06) 0%, transparent 70%);
            top: 60%; right: 10%;
            animation-duration: 16s; animation-delay: 2s;
        }

        @keyframes auroraFade {
            0%   { opacity: 0;    transform: translate(0, 0) scale(1); }
            25%  { opacity: 1; }
            50%  { opacity: 0.6;  transform: translate(40px, 30px) scale(1.08); }
            75%  { opacity: 0.9; }
            100% { opacity: 0;    transform: translate(0, 0) scale(1); }
        }

        /* ── Grid lines overlay ── */
        .grid-overlay {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(15,244,198,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(15,244,198,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* ── Floating micro-orbs ── */
        .orbs {
            position: fixed;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            overflow: hidden;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            animation: orbFloat linear infinite;
        }

        .orb:nth-child(1)  { width:3px;  height:3px;  left:8%;  background:var(--teal);  opacity:.5; animation-duration:10s; animation-delay:0s;   }
        .orb:nth-child(2)  { width:2px;  height:2px;  left:20%; background:#fff;         opacity:.3; animation-duration:14s; animation-delay:2s;   }
        .orb:nth-child(3)  { width:4px;  height:4px;  left:35%; background:var(--teal);  opacity:.4; animation-duration:11s; animation-delay:1s;   }
        .orb:nth-child(4)  { width:2px;  height:2px;  left:55%; background:var(--gold);  opacity:.4; animation-duration:16s; animation-delay:3s;   }
        .orb:nth-child(5)  { width:3px;  height:3px;  left:70%; background:var(--teal);  opacity:.35;animation-duration:13s; animation-delay:0.5s; }
        .orb:nth-child(6)  { width:5px;  height:5px;  left:82%; background:#fff;         opacity:.2; animation-duration:18s; animation-delay:4s;   }
        .orb:nth-child(7)  { width:2px;  height:2px;  left:15%; background:var(--gold);  opacity:.3; animation-duration:20s; animation-delay:5s;   }
        .orb:nth-child(8)  { width:3px;  height:3px;  left:50%; background:var(--teal);  opacity:.25;animation-duration:15s; animation-delay:7s;   }
        .orb:nth-child(9)  { width:2px;  height:2px;  left:90%; background:#fff;         opacity:.4; animation-duration:12s; animation-delay:1.5s; }
        .orb:nth-child(10) { width:4px;  height:4px;  left:62%; background:var(--teal);  opacity:.3; animation-duration:17s; animation-delay:6s;   }

        @keyframes orbFloat {
            0%   { transform: translateY(110vh); opacity: 0; }
            5%   { opacity: 1; }
            95%  { opacity: 1; }
            100% { transform: translateY(-10vh); opacity: 0; }
        }

        /* ── CARD ── */
        .card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            background: var(--card-bg);
            backdrop-filter: blur(32px) saturate(180%);
            -webkit-backdrop-filter: blur(32px) saturate(180%);
            border: 1px solid var(--card-edge);
            border-radius: 28px;
            padding: 52px 44px 44px;
            box-shadow:
                0 0 0 1px rgba(15,244,198,0.06),
                0 40px 100px rgba(0,0,0,0.7),
                0 0 80px rgba(15,244,198,0.05),
                inset 0 1px 0 rgba(15,244,198,0.1),
                inset 0 -1px 0 rgba(255,255,255,0.02);

            /* Master card entrance */
            opacity: 0;
            animation: cardDrop 1.1s 0.1s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        @keyframes cardDrop {
            0%   { opacity:0; transform: translateY(60px) scale(0.94) rotateX(8deg); filter: blur(8px); }
            60%  { filter: blur(0); }
            100% { opacity:1; transform: translateY(0)  scale(1)    rotateX(0deg);  filter: blur(0); }
        }

        /* Teal top shimmer line */
        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 10%; right: 10%;
            height: 1.5px;
            border-radius: 99px;
            background: linear-gradient(90deg,
                transparent 0%,
                var(--teal-dim) 30%,
                var(--teal) 50%,
                var(--teal-dim) 70%,
                transparent 100%);
            animation: topShimmer 4s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes topShimmer {
            0%, 100% { opacity: 0.5; }
            50%       { opacity: 1; box-shadow: 0 0 12px var(--teal), 0 0 24px var(--teal-glow); }
        }

        /* Corner accents */
        .card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 28px;
            background:
                radial-gradient(ellipse 160px 80px at 50% 0%, rgba(15,244,198,0.08) 0%, transparent 70%),
                radial-gradient(ellipse 80px 80px at 0% 0%, rgba(15,244,198,0.05) 0%, transparent 60%),
                radial-gradient(ellipse 80px 80px at 100% 100%, rgba(15,244,198,0.04) 0%, transparent 60%);
            pointer-events: none;
        }

        /* ── Logo section ── */
        .logo-section {
            text-align: center;
            margin-bottom: 36px;
            opacity: 0;
            animation: riseUp 0.8s 0.5s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        @keyframes riseUp {
            0%   { opacity:0; transform: translateY(24px); }
            100% { opacity:1; transform: translateY(0); }
        }

        .logo-ring {
            display: inline-block;
            position: relative;
            margin-bottom: 18px;
        }

        .logo-ring::before {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            background: conic-gradient(
                from 0deg,
                transparent 0%,
                var(--teal) 25%,
                transparent 50%,
                var(--gold) 75%,
                transparent 100%
            );
            animation: spinRing 6s linear infinite;
            z-index: -1;
        }

        .logo-ring::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            background: var(--bg-deep);
            z-index: -1;
        }

        @keyframes spinRing {
            0%   { transform: rotate(0deg); opacity: 0.7; }
            50%  { opacity: 1; }
            100% { transform: rotate(360deg); opacity: 0.7; }
        }

        .logo-img {
            width: 82px;
            height: 82px;
            border-radius: 50%;
            object-fit: contain;
            display: block;
            filter: drop-shadow(0 0 12px rgba(15,244,198,0.3));
        }

        .school-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 26px;
            font-weight: 600;
            color: var(--text-hi);
            letter-spacing: 0.03em;
            line-height: 1.2;
            margin-bottom: 6px;
            text-shadow: 0 0 30px rgba(15,244,198,0.2);
        }

        .portal-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(15,244,198,0.08);
            border: 1px solid rgba(15,244,198,0.2);
            border-radius: 99px;
            padding: 4px 14px;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--teal);
        }

        .portal-badge::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--teal);
            box-shadow: 0 0 8px var(--teal);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%       { transform: scale(1.4); opacity: 0.6; }
        }

        /* ── Divider ── */
        .divider {
            position: relative;
            margin-bottom: 30px;
            opacity: 0;
            animation: riseUp 0.8s 0.65s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        .divider::before {
            content: '';
            display: block;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(15,244,198,0.25), transparent);
        }

        .divider-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--bg-mid);
            padding: 0 10px;
            color: rgba(15,244,198,0.4);
            font-size: 12px;
            letter-spacing: 0.2em;
        }

        /* ── Error msg ── */
        .error-msg {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 12px;
            margin-bottom: 20px;
            text-align: center;
            opacity: 0;
            animation: riseUp 0.5s 0.7s forwards;
        }

        /* ── Form fields ── */
        .form-group {
            margin-bottom: 16px;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation: fieldSlide 0.7s 0.7s  cubic-bezier(0.16,1,0.3,1) forwards; }
        .form-group:nth-child(2) { animation: fieldSlide 0.7s 0.82s cubic-bezier(0.16,1,0.3,1) forwards; }
        .form-group:nth-child(3) { animation: fieldSlide 0.7s 0.94s cubic-bezier(0.16,1,0.3,1) forwards; }

        @keyframes fieldSlide {
            0%   { opacity:0; transform: translateX(-20px); }
            100% { opacity:1; transform: translateX(0); }
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            font-size: 15px;
            pointer-events: none;
            z-index: 2;
            transition: filter 0.3s;
        }

        .input-wrapper:focus-within .input-icon {
            filter: drop-shadow(0 0 6px var(--teal));
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 44px 14px 46px;
            background: var(--input-bg);
            border: 1px solid var(--input-edge);
            border-radius: 14px;
            color: var(--text-hi);
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .input-wrapper input::placeholder {
            color: rgba(180,210,220,0.3);
            font-size: 13px;
        }

        .input-wrapper input:focus {
            border-color: var(--teal-dim);
            background: rgba(15,244,198,0.05);
            box-shadow:
                0 0 0 3px var(--teal-ring),
                0 0 20px rgba(15,244,198,0.08),
                inset 0 0 10px rgba(15,244,198,0.04);
        }

        .input-wrapper input:not(:placeholder-shown) {
            border-color: rgba(15,244,198,0.3);
        }

        /* floating label effect */
        .field-label {
            display: block;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: rgba(15,244,198,0.55);
            margin-bottom: 6px;
            padding-left: 2px;
        }

        .toggle-eye {
            position: absolute;
            right: 14px;
            cursor: pointer;
            color: rgba(180,210,220,0.35);
            font-size: 16px;
            transition: all 0.2s;
            user-select: none;
            z-index: 3;
            padding: 4px;
            pointer-events: all !important;
        }

        .toggle-eye:hover {
            color: var(--teal);
            filter: drop-shadow(0 0 6px var(--teal));
        }

        /* ── Remember row ── */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
            opacity: 0;
            animation: fieldSlide 0.7s 1.06s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        .remember-row input[type="checkbox"] {
            width: 17px; height: 17px;
            accent-color: var(--teal);
            cursor: pointer;
            border-radius: 4px;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }

        .remember-row label {
            color: rgba(180,210,220,0.5);
            font-size: 12px;
            cursor: pointer;
            user-select: none;
            letter-spacing: 0.03em;
        }

        /* ── Login button ── */
        .btn-login {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--bg-deep);
            background: linear-gradient(135deg, var(--teal) 0%, #00d4aa 40%, #0abf97 70%, var(--teal-dim) 100%);
            box-shadow:
                0 0 0 1px rgba(15,244,198,0.3),
                0 8px 32px rgba(15,244,198,0.3),
                0 2px 8px rgba(0,0,0,0.4),
                inset 0 1px 0 rgba(255,255,255,0.2);
            position: relative;
            z-index: 1;
            overflow: hidden;
            transition: all 0.3s ease;
            opacity: 0;
            animation: btnAppear 0.8s 1.15s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        @keyframes btnAppear {
            0%   { opacity:0; transform: scale(0.95) translateY(10px); }
            100% { opacity:1; transform: scale(1)    translateY(0); }
        }

        /* Button shimmer sweep */
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg,
                transparent 0%,
                rgba(255,255,255,0.25) 50%,
                transparent 100%);
            transition: left 0.6s ease;
            pointer-events: none;
        }

        .btn-login:hover::before { left: 100%; }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow:
                0 0 0 1px rgba(15,244,198,0.5),
                0 16px 48px rgba(15,244,198,0.45),
                0 4px 12px rgba(0,0,0,0.4),
                inset 0 1px 0 rgba(255,255,255,0.25);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 4px 16px rgba(15,244,198,0.25);
        }

        /* ── Back link ── */
        .back-link {
            text-align: center;
            margin-top: 24px;
            opacity: 0;
            animation: riseUp 0.7s 1.3s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        .back-link a {
            color: rgba(180,210,220,0.3);
            font-size: 11px;
            text-decoration: none;
            letter-spacing: 0.08em;
            transition: all 0.25s;
            position: relative;
        }

        .back-link a::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 1px;
            background: var(--teal);
            transform: scaleX(0);
            transition: transform 0.25s ease;
        }

        .back-link a:hover {
            color: var(--teal);
        }

        .back-link a:hover::after {
            transform: scaleX(1);
        }

        /* ── Footer line ── */
        .card-foot {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(15,244,198,0.08);
            opacity: 0;
            animation: riseUp 0.7s 1.4s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        .card-foot p {
            font-size: 9px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(180,210,220,0.2);
        }

        /* ── Mobile ── */
        @media (max-width: 480px) {
            .card { padding: 40px 24px 36px; }
            .school-name { font-size: 22px; }
        }
    </style>
</head>
<body>

<!-- Deep star field -->
<div class="starfield" id="starfield"></div>

<!-- Aurora layers — pointer-events none -->
<div class="aurora">
    <div class="aurora-band"></div>
    <div class="aurora-band"></div>
    <div class="aurora-band"></div>
    <div class="aurora-band"></div>
</div>

<!-- Grid overlay — pointer-events none -->
<div class="grid-overlay"></div>

<!-- Floating orbs — pointer-events none -->
<div class="orbs">
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
    <div class="orb"></div>
</div>

<!-- ── CARD ── -->
<div class="card">

    <!-- Logo -->
    <div class="logo-section">
        <div class="logo-ring">
            <img
                src="{{ asset('images/school-logo.png') }}"
                alt="Arya Public Academy"
                class="logo-img"
            >
        </div>
        <h2 class="school-name">Arya Public Academy</h2>
        <div class="portal-badge">Teacher Portal</div>
    </div>

    <!-- Divider -->
    <div class="divider">
        <span class="divider-icon">✦ ✦ ✦</span>
    </div>

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
            <label class="field-label">Email Address</label>
            <div class="input-wrapper">
                <span class="input-icon">✉️</span>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="your@email.com"
                    required
                >
            </div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label class="field-label">Password</label>
            <div class="input-wrapper">
                <span class="input-icon">🔒</span>
                <input
                    type="password"
                    name="password"
                    id="pass"
                    placeholder="••••••••"
                    required
                >
                <span class="toggle-eye" onclick="togglePass()">👁</span>
            </div>
        </div>

        <!-- Remember me -->
        <div class="remember-row">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Keep me signed in</label>
        </div>

        <button type="submit" class="btn-login">Sign In to Portal</button>
    </form>

    <div class="back-link">
        <a href="{{ url('/') }}">← Return to Website</a>
    </div>

    <div class="card-foot">
        <p>© Arya Public Academy &nbsp;·&nbsp; Secure Access</p>
    </div>

</div>

<script>
    /* ── Procedural star field ── */
    (function() {
        const sf = document.getElementById('starfield');
        const count = 120;
        for (let i = 0; i < count; i++) {
            const s = document.createElement('div');
            s.className = 'star';
            const size = Math.random() * 2 + 0.5;
            s.style.cssText = `
                width:${size}px; height:${size}px;
                top:${Math.random()*100}%;
                left:${Math.random()*100}%;
                animation-duration:${2 + Math.random()*5}s;
                animation-delay:${Math.random()*6}s;
            `;
            sf.appendChild(s);
        }
    })();

    /* ── Password toggle ── */
    function togglePass() {
        const p = document.getElementById('pass');
        p.type = p.type === 'password' ? 'text' : 'password';
    }
</script>
</body>
</html>
