<section class="glass-section">

<style>
.glass-section {
    max-width: 880px;
    margin: 40px auto;
}

.glass-card {
    background: rgba(15, 23, 42, 0.78);
    backdrop-filter: blur(20px);
    border-radius: 28px;
    padding: 42px;
    box-shadow: 0 40px 120px rgba(0,0,0,0.6);
    border: 1px solid rgba(255,255,255,0.08);
}

.glass-card h2 {
    font-size: 1.7rem;
    font-weight: 700;
    background: linear-gradient(90deg, #38bdf8, #818cf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.glass-card p {
    margin-top: 8px;
    color: #c7d2fe;
}

.form-group {
    margin-top: 26px;
}

.form-label {
    color: #e0f2fe;
    font-weight: 500;
}

.form-input {
    width: 100%;
    padding: 14px 18px;
    margin-top: 6px;
    border-radius: 14px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.15);
    color: #e5e7eb;
}

.form-input:focus {
    outline: none;
    border-color: #38bdf8;
    box-shadow: 0 0 0 3px rgba(56,189,248,0.25);
}

.save-btn {
    margin-top: 32px;
    background: linear-gradient(90deg, #38bdf8, #6366f1);
    padding: 14px 38px;
    border-radius: 16px;
    font-weight: 700;
    border: none;
    cursor: pointer;
    color: #020617;
}
</style>

<div class="glass-card">

    <header>
        <h2>{{ __('Update Password') }}</h2>
        <p>{{ __('Use a strong password to keep your account secure.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label class="form-label">{{ __('Current Password') }}</label>
            <input type="password" name="current_password" class="form-input" required>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div class="form-group">
            <label class="form-label">{{ __('New Password') }}</label>
            <input type="password" name="password" class="form-input" required>
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div class="form-group">
            <label class="form-label">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" class="form-input" required>
        </div>

        <button class="save-btn">
            {{ __('Update Password') }}
        </button>
    </form>

</div>
</section>
