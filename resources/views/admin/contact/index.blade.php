@extends('layouts.app')

@section('content')
<div style="max-width:900px; margin:0 auto; padding:30px 20px;">

    <h1 style="color:#1e293b; margin-bottom:6px;">📬 Contact Messages</h1>
    <p style="color:#64748b; margin-bottom:24px;">Messages sent from the website contact form.</p>

    @if(session('success'))
        <div style="background:#d1fae5; border:1px solid #6ee7b7; color:#065f46;
                    padding:12px 16px; border-radius:8px; margin-bottom:20px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @forelse($messages as $msg)
    <div style="background:#fff; border-radius:12px; padding:20px 24px;
                margin-bottom:16px; box-shadow:0 2px 12px rgba(0,0,0,0.07);
                border-left: 4px solid {{ $msg->is_read ? '#cbd5e1' : '#2563eb' }};">

        <div style="display:flex; justify-content:space-between;
                    align-items:flex-start; flex-wrap:wrap; gap:10px;">
            <div>
                <h3 style="color:#1e293b; font-size:1rem; margin-bottom:4px;">
                    {{ $msg->name }}
                    @if(!$msg->is_read)
                        <span style="background:#2563eb; color:#fff; font-size:0.7rem;
                                     padding:2px 8px; border-radius:999px; margin-left:8px;">
                            New
                        </span>
                    @endif
                </h3>
                <p style="color:#64748b; font-size:0.85rem;">
                    📧 {{ $msg->email }} &nbsp;|&nbsp;
                    🕐 {{ $msg->created_at->format('d M Y') }}
                </p>
            </div>

            <div style="display:flex; gap:8px;">
                @if(!$msg->is_read)
                <form method="POST" action="{{ route('contact.read', $msg) }}">
                    @csrf
                    <button type="submit"
                            style="background:#16a34a; color:#fff; border:none;
                                   padding:6px 14px; border-radius:6px;
                                   font-size:0.8rem; cursor:pointer;">
                        ✔ Mark Read
                    </button>
                </form>
                @endif

                <form method="POST" action="{{ route('contact.destroy', $msg) }}"
                      onsubmit="return confirm('Delete this message?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            style="background:#ef4444; color:#fff; border:none;
                                   padding:6px 14px; border-radius:6px;
                                   font-size:0.8rem; cursor:pointer;">
                        🗑 Delete
                    </button>
                </form>
            </div>
        </div>

        <div style="margin-top:14px; background:#f8fafc; padding:14px 16px;
                    border-radius:8px; color:#334155; font-size:0.9rem;
                    line-height:1.6;">
            {{ $msg->message }}
        </div>
    </div>
    @empty
        <div style="text-align:center; padding:60px; color:#94a3b8;">
            <div style="font-size:3rem; margin-bottom:12px;">📭</div>
            <p>No messages yet.</p>
        </div>
    @endforelse

</div>
@endsection
