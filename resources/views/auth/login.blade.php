<x-guest-layout>
    <style>
        body {
            background: linear-gradient(
                    rgba(0, 0, 0, 0.6),
                    rgba(0, 0, 0, 0.6)
                ),
                url("{{ asset('images/banner.jpg') }}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 16px;
            padding: 35px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            color: #760404;
        }

        .login-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-title h1 {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .login-title p {
            font-size: 14px;
            opacity: 0.9;
        }

        .login-card label {
            color:  #f1f1f1;
        }

        .login-card input[type="email"],
        .login-card input[type="password"] {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            color: black ;
            border: none;
            padding: 12px;
            font-size: 14px;
        }

        .login-card input:focus {
            outline: none;
            box-shadow: 0 0 0 2px #3b82f6;
        }

        .login-card .remember {
            margin-top: 15px;
        }

        .login-card a {
            color: #bfdbfe;
            font-size: 13px;
        }

        .login-card a:hover {
            color: #ffffff;
        }

        .login-btn {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            background: linear-gradient(to right, #2563eb, #1d4ed8);
            border: none;
            color: #fff;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: linear-gradient(to right, #1d4ed8, #1e40af);
            transform: translateY(-1px);
        }

            .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #374151;
            font-size: 14px;
            user-select: none;
        }
    </style>

    <div class="login-card">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="login-title">
            <h1>Arya Public Academy</h1>
            <p>Admin Login Portal</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
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
            <!-- Password -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')" />

    <div class="password-wrapper">
        <x-text-input
            id="password"
            class="block mt-1 w-full pr-10"
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
            <div class="remember flex items-center mt-4">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded text-indigo-600 focus:ring-indigo-500"
                    name="remember"
                >
                <span class="ms-2 text-sm">
                    {{ __('Remember me') }}
                </span>
            </div>

            <!-- Button -->
            <button type="submit" class="login-btn">
                {{ __('Log in') }}
            </button>

            <!-- Forgot -->
            @if (Route::has('password.request'))
                <div class="text-center mt-4">
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
        </form>
    </div>

    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type');

        passwordInput.setAttribute(
            'type',
            type === 'password' ? 'text' : 'password'
        );
    }
</script>

</x-guest-layout>
