<section class="profile-wrapper">

<style>
/* ===== PROFILE WRAPPER ===== */
.profile-wrapper {
    max-width: 900px;
    margin: 40px auto;
}

/* ===== GLASS CARD ===== */
.profile-card {
    background: linear-gradient(
        145deg,
        rgba(15, 23, 42, 0.85),
        rgba(2, 6, 23, 0.85)
    );
    backdrop-filter: blur(18px);
    border-radius: 28px;
    padding: 40px;
    box-shadow: 0 40px 120px rgba(0,0,0,0.65);
    border: 1px solid rgba(255,255,255,0.08);
}

/* ===== HEADER ===== */
.profile-card h2 {
    font-size: 1.9rem;
    font-weight: 700;
    background: linear-gradient(90deg, #22d3ee, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.profile-card p {
    margin-top: 8px;
    color: #c7d2fe;
}

/* ===== FORM ELEMENTS ===== */
.form-group {
    margin-top: 28px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #e0f2fe;
    letter-spacing: 0.3px;
}

.form-input {
    width: 100%;
    padding: 14px 18px;
    border-radius: 14px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.15);
    color: #e5e7eb;
    font-size: 15px;
    outline: none;
    transition: all 0.25s ease;
}

.form-input:focus {
    border-color: #22d3ee;
    box-shadow: 0 0 0 3px rgba(34,211,238,0.25);
    background: rgba(255,255,255,0.1);
}

/* ===== BUTTON ===== */
.save-btn {
    background: linear-gradient(90deg, #22d3ee, #6366f1);
    border: none;
    padding: 14px 36px;
    border-radius: 16px;
    font-weight: 600;
    color: #020617;
    cursor: pointer;
    transition: all 0.3s ease;
}

.save-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px rgba(34,211,238,0.4);
}

/* ===== STATUS TEXT ===== */
.status-text {
    color: #86efac;
    font-size: 14px;
}

/* ===== EMAIL VERIFY ===== */
.verify-box {
    margin-top: 14px;
    padding: 16px;
    border-radius: 16px;
    background: rgba(255,255,255,0.05);
}

.verify-box button {
    color: #38bdf8;
    font-weight: 500;
    text-decoration: underline;
    cursor: pointer;
}
</style>

<div class="profile-card">

    <!-- HEADER -->
    <header>
        <h2>{{ __('Profile Information') }}</h2>
        <p>{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <!-- EMAIL VERIFICATION FORM -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- PROFILE UPDATE FORM -->
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <!-- NAME -->
        <div class="form-group">
            <label class="form-label">{{ __('Name') }}</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                class="form-input"
            >
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- EMAIL -->
        <div class="form-group">
            <label class="form-label">{{ __('Email') }}</label>
            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
                class="form-input"
            >
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="verify-box">
                    <p class="text-sm">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification">
                            {{ __('Re-send verification email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="status-text mt-2">
                            {{ __('A verification link has been sent.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center gap-6 mt-10">
            <button class="save-btn">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="status-text"
                >
                    {{ __('Profile Updated Successfully') }}
                </p>
            @endif
        </div>

    </form>

</div>
</section>
