@extends('layouts.app')

@section('content')
<div style="max-width:900px;margin:0 auto;">
    <div style="display:flex;gap:10px;align-items:center;justify-content:space-between;flex-wrap:wrap;">
        <div>
            <h2 style="margin:0 0 6px 0;">Marksheets - Class {{ $class }}</h2>
            <p style="margin:0;color:#475569;">Click a student to generate their marksheet PDF (latest published).</p>
        </div>
        <a href="{{ route('marksheets.index') }}"
           style="text-decoration:none;padding:10px 14px;border-radius:12px;background:#111827;color:#fff;font-weight:800;">
            ← Back
        </a>
    </div>

    @if(session('error'))
        <div style="padding:12px;border-radius:12px;background:#fee2e2;border:1px solid #fecaca;margin-top:12px;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div style="padding:12px;border-radius:12px;background:#dcfce7;border:1px solid #bbf7d0;margin-top:12px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-top:14px;background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;">
                    <th style="text-align:left;padding:12px;border-bottom:1px solid #e2e8f0;">Roll</th>
                    <th style="text-align:left;padding:12px;border-bottom:1px solid #e2e8f0;">Student Name</th>
                    <th style="text-align:left;padding:12px;border-bottom:1px solid #e2e8f0;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $st)
                    <tr>
                        <td style="padding:12px;border-bottom:1px solid #f1f5f9;">{{ $st->roll_no ?? '-' }}</td>
                        <td style="padding:12px;border-bottom:1px solid #f1f5f9;">{{ $st->name ?? '-' }}</td>
                        <td style="padding:12px;border-bottom:1px solid #f1f5f9; display:flex; gap:10px; flex-wrap:wrap;">

                            {{-- Generate PDF (PASS student + class) --}}
                           <form method="GET" action="{{ route('marksheets.generate', [$st->id, $class]) }}" style="display:flex;gap:6px;align-items:center;flex-wrap:wrap;">

                                <select name="year" style="padding:6px;border-radius:8px;border:1px solid #ccc;">
                                    <option value="">Latest</option>
                                    <option value="2026">2025-2026</option>
                                    <option value="2025">2024-2025</option>
                                </select>

                                <button type="submit"
                                    style="display:inline-block;text-decoration:none;padding:10px 14px;border-radius:12px;background:linear-gradient(135deg,#4a148c,#8e24aa);color:#fff;font-weight:900;border:none;">
                                    ⬇ Generate PDF
                                </button>
                            </form>


                            <a href="{{ route('marksheets.extra.edit', [$st->id, $class]) }}"
                            style="background:#0f172a;color:#fff;padding:10px 14px;border-radius:12px;text-decoration:none;font-weight:600;">
                                ✏️ Edit
                            </a>


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding:14px;color:#64748b;">No students found in this class.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
