<section class="glass-section">

<style>
.danger-card {
    background: rgba(127, 29, 29, 0.8);
    backdrop-filter: blur(18px);
    border-radius: 28px;
    padding: 40px;
    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 30px 80px rgba(0,0,0,0.6);
}

.danger-card h2 {
    font-size: 1.6rem;
    font-weight: 700;
    color: #fecaca;
}

.danger-card p {
    color: #fee2e2;
    margin-top: 10px;
}

.delete-btn {
    margin-top: 26px;
    background: linear-gradient(90deg, #ef4444, #b91c1c);
    padding: 14px 34px;
    border-radius: 16px;
    border: none;
    color: white;
    font-weight: 700;
    cursor: pointer;
}
</style>

<div class="danger-card">

    <h2>{{ __('Delete Account') }}</h2>
    <p>
        {{ __('Once deleted, all your data will be permanently removed. This action cannot be undone.') }}
    </p>

    <form method="post" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <button class="delete-btn">
            {{ __('Delete Account') }}
        </button>
    </form>

</div>
</section>
