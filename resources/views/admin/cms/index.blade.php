@extends('layouts.app')

@section('content')
<div style="max-width:900px; margin:0 auto; padding:30px 20px;">

    <h1 style="color:#1e293b; margin-bottom:6px;">🖥️ Website CMS</h1>
    <p style="color:#64748b; margin-bottom:30px;">Manage your homepage content from here.</p>

    @if(session('success'))
        <div style="background:#d1fae5; border:1px solid #6ee7b7; color:#065f46;
                    padding:12px 16px; border-radius:8px; margin-bottom:20px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#fee2e2; border:1px solid #fca5a5; color:#991b1b;
                    padding:12px 16px; border-radius:8px; margin-bottom:20px;">
            ❌ {{ $errors->first() }}
        </div>
    @endif

    {{-- ======================== HERO & ABOUT SETTINGS ======================== --}}
    <div style="background:#fff; border-radius:12px; padding:24px;
                box-shadow:0 2px 12px rgba(0,0,0,0.08); margin-bottom:28px;">
        <h2 style="color:#1e293b; margin-bottom:18px; font-size:1.1rem;
                   border-bottom:2px solid #e2e8f0; padding-bottom:10px;">
            ⚙️ Hero, About & Footer Settings
        </h2>

        <form method="POST" action="{{ route('cms.settings.update') }}">
            @csrf

            <div style="margin-bottom:14px;">
                <label style="display:block; color:#475569; font-size:0.875rem;
                              font-weight:600; margin-bottom:5px;">Hero Title</label>
                <input type="text" name="hero_title"
                       value="{{ \App\Models\SiteSetting::get('hero_title', 'Welcome to Your School') }}"
                       style="width:100%; padding:10px 12px; border:1px solid #cbd5e1;
                              border-radius:8px; font-size:0.95rem; outline:none;">
            </div>

            <div style="margin-bottom:14px;">
                <label style="display:block; color:#475569; font-size:0.875rem;
                              font-weight:600; margin-bottom:5px;">Hero Subtitle</label>
                <input type="text" name="hero_subtitle"
                       value="{{ \App\Models\SiteSetting::get('hero_subtitle', 'Empowering students with creativity, knowledge, and confidence') }}"
                       style="width:100%; padding:10px 12px; border:1px solid #cbd5e1;
                              border-radius:8px; font-size:0.95rem; outline:none;">
            </div>

            <div style="margin-bottom:14px;">
                <label style="display:block; color:#475569; font-size:0.875rem;
                              font-weight:600; margin-bottom:5px;">About Us Text</label>
                <textarea name="about_text" rows="4"
                          style="width:100%; padding:10px 12px; border:1px solid #cbd5e1;
                                 border-radius:8px; font-size:0.95rem; outline:none; resize:vertical;">{{ \App\Models\SiteSetting::get('about_text', 'Our school fosters academic excellence...') }}</textarea>
            </div>

            <div style="margin-bottom:14px;">
                <label style="display:block; color:#475569; font-size:0.875rem;
                              font-weight:600; margin-bottom:5px;">Footer Contact Number</label>
                <input type="text" name="footer_contact"
                       value="{{ \App\Models\SiteSetting::get('footer_contact', '8127515044') }}"
                       style="width:100%; padding:10px 12px; border:1px solid #cbd5e1;
                              border-radius:8px; font-size:0.95rem; outline:none;">
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block; color:#475569; font-size:0.875rem;
                              font-weight:600; margin-bottom:5px;">Footer Address</label>
                <input type="text" name="footer_address"
                       value="{{ \App\Models\SiteSetting::get('footer_address', 'Kusmara, Jalaun (U.P)') }}"
                       style="width:100%; padding:10px 12px; border:1px solid #cbd5e1;
                              border-radius:8px; font-size:0.95rem; outline:none;">
            </div>

            <button type="submit"
                    style="background:#2563eb; color:#fff; padding:10px 24px;
                           border:none; border-radius:8px; font-size:0.95rem;
                           font-weight:600; cursor:pointer;">
                💾 Save Settings
            </button>
        </form>
    </div>

    {{-- ======================== COURSES ======================== --}}
    <div style="background:#fff; border-radius:12px; padding:24px;
                box-shadow:0 2px 12px rgba(0,0,0,0.08); margin-bottom:28px;">
        <h2 style="color:#1e293b; margin-bottom:18px; font-size:1.1rem;
                   border-bottom:2px solid #e2e8f0; padding-bottom:10px;">
            📚 Courses
        </h2>

        <form method="POST" action="{{ route('cms.courses.store') }}"
              style="display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap;">
            @csrf
            <input type="text" name="title" placeholder="Course Title" required
                   style="flex:1; min-width:150px; padding:9px 12px; border:1px solid #cbd5e1;
                          border-radius:8px; outline:none;">
            <input type="text" name="description" placeholder="Course Description" required
                   style="flex:2; min-width:200px; padding:9px 12px; border:1px solid #cbd5e1;
                          border-radius:8px; outline:none;">
            <button type="submit"
                    style="background:#16a34a; color:#fff; padding:9px 18px;
                           border:none; border-radius:8px; font-weight:600; cursor:pointer;">
                + Add
            </button>
        </form>

        @forelse($courses as $course)
        <form method="POST" action="{{ route('cms.courses.update', $course) }}"
              style="display:flex; gap:10px; align-items:center;
                     margin-bottom:10px; flex-wrap:wrap;
                     background:#f8fafc; padding:10px; border-radius:8px;">
            @csrf @method('PUT')
            <input type="text" name="title" value="{{ $course->title }}" required
                   style="flex:1; min-width:130px; padding:8px 10px; border:1px solid #cbd5e1;
                          border-radius:6px; outline:none; font-size:0.875rem;">
            <input type="text" name="description" value="{{ $course->description }}" required
                   style="flex:2; min-width:180px; padding:8px 10px; border:1px solid #cbd5e1;
                          border-radius:6px; outline:none; font-size:0.875rem;">
            <button type="submit"
                    style="background:#2563eb; color:#fff; padding:8px 14px;
                           border:none; border-radius:6px; font-size:0.8rem;
                           font-weight:600; cursor:pointer;">
                Update
            </button>
        </form>
        <form method="POST" action="{{ route('cms.courses.delete', $course) }}"
              style="margin-bottom:10px; margin-top:-8px;"
              onsubmit="return confirm('Delete this course?')">
            @csrf @method('DELETE')
            <button type="submit"
                    style="background:#ef4444; color:#fff; padding:5px 12px;
                           border:none; border-radius:6px; font-size:0.8rem; cursor:pointer;">
                🗑 Delete Course
            </button>
        </form>
        @empty
            <p style="color:#94a3b8;">No courses yet. Add one above.</p>
        @endforelse
    </div>

    {{-- ======================== GALLERY ======================== --}}
    <div style="background:#fff; border-radius:12px; padding:24px;
                box-shadow:0 2px 12px rgba(0,0,0,0.08); margin-bottom:28px;">
        <h2 style="color:#1e293b; margin-bottom:18px; font-size:1.1rem;
                   border-bottom:2px solid #e2e8f0; padding-bottom:10px;">
            🖼️ Gallery
        </h2>

        <form method="POST" action="{{ route('cms.gallery.store') }}"
              enctype="multipart/form-data"
              style="background:#f8fafc; padding:16px; border-radius:8px; margin-bottom:20px;">
            @csrf
            <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:flex-end;">
                <div style="flex:1; min-width:150px;">
                    <label style="font-size:0.8rem; color:#475569; font-weight:600;">Upload Image File</label>
                    <input type="file" name="image_file" accept="image/*"
                           style="display:block; margin-top:4px; font-size:0.875rem;">
                </div>
                <div style="color:#94a3b8; font-weight:700; padding-bottom:4px;">OR</div>
                <div style="flex:1; min-width:180px;">
                    <label style="font-size:0.8rem; color:#475569; font-weight:600;">Paste Image URL</label>
                    <input type="url" name="image_url" placeholder="https://..."
                           style="display:block; margin-top:4px; width:100%; padding:8px 10px;
                                  border:1px solid #cbd5e1; border-radius:6px; outline:none; font-size:0.875rem;">
                </div>
                <div style="flex:1; min-width:150px;">
                    <label style="font-size:0.8rem; color:#475569; font-weight:600;">Caption (Optional)</label>
                    <input type="text" name="caption" placeholder="e.g. Sports Day"
                           style="display:block; margin-top:4px; width:100%; padding:8px 10px;
                                  border:1px solid #cbd5e1; border-radius:6px; outline:none; font-size:0.875rem;">
                </div>
                <button type="submit"
                        style="background:#16a34a; color:#fff; padding:9px 18px;
                               border:none; border-radius:8px; font-weight:600; cursor:pointer; height:38px;">
                    + Add Image
                </button>
            </div>
        </form>

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(160px,1fr)); gap:14px;">
            @forelse($gallery as $img)
            <div style="position:relative; background:#f1f5f9; border-radius:10px; overflow:hidden;">
                <img src="{{ $img->is_url ? $img->image_path : asset('storage/'.$img->image_path) }}"
                     alt="{{ $img->caption }}"
                     style="width:100%; height:120px; object-fit:cover; border-radius:0;">
                @if($img->caption)
                    <p style="font-size:0.75rem; color:#475569; padding:6px 8px; margin:0;">{{ $img->caption }}</p>
                @endif
                <form method="POST" action="{{ route('cms.gallery.delete', $img) }}"
                      onsubmit="return confirm('Delete this image?')" style="padding:0 8px 8px;">
                    @csrf @method('DELETE')
                    <button type="submit"
                            style="width:100%; background:#ef4444; color:#fff; border:none;
                                   border-radius:6px; padding:5px; font-size:0.75rem; cursor:pointer;">
                        🗑 Delete
                    </button>
                </form>
            </div>
            @empty
                <p style="color:#94a3b8;">No images yet.</p>
            @endforelse
        </div>
    </div>

    {{-- ======================== ACHIEVEMENTS ======================== --}}
    <div style="background:#fff; border-radius:12px; padding:24px;
                box-shadow:0 2px 12px rgba(0,0,0,0.08); margin-bottom:28px;">
        <h2 style="color:#1e293b; margin-bottom:18px; font-size:1.1rem;
                   border-bottom:2px solid #e2e8f0; padding-bottom:10px;">
            🏆 Achievements
        </h2>

        <form method="POST" action="{{ route('cms.achievements.store') }}"
              style="display:flex; gap:10px; margin-bottom:20px;">
            @csrf
            <input type="text" name="title" placeholder="e.g. Won National Science Award 2025" required
                   style="flex:1; padding:9px 12px; border:1px solid #cbd5e1; border-radius:8px; outline:none;">
            <button type="submit"
                    style="background:#16a34a; color:#fff; padding:9px 18px;
                           border:none; border-radius:8px; font-weight:600; cursor:pointer;">
                + Add
            </button>
        </form>

        @forelse($achievements as $ach)
        <div style="display:flex; gap:10px; align-items:center; margin-bottom:10px;
                    background:#f8fafc; padding:10px; border-radius:8px;">
            <form method="POST" action="{{ route('cms.achievements.update', $ach) }}"
                  style="display:flex; gap:10px; flex:1;">
                @csrf @method('PUT')
                <input type="text" name="title" value="{{ $ach->title }}" required
                       style="flex:1; padding:8px 10px; border:1px solid #cbd5e1;
                              border-radius:6px; outline:none; font-size:0.875rem;">
                <button type="submit"
                        style="background:#2563eb; color:#fff; padding:8px 14px;
                               border:none; border-radius:6px; font-size:0.8rem; font-weight:600; cursor:pointer;">
                    Update
                </button>
            </form>
            <form method="POST" action="{{ route('cms.achievements.delete', $ach) }}"
                  onsubmit="return confirm('Delete this achievement?')">
                @csrf @method('DELETE')
                <button type="submit"
                        style="background:#ef4444; color:#fff; padding:8px 12px;
                               border:none; border-radius:6px; font-size:0.8rem; cursor:pointer;">
                    🗑
                </button>
            </form>
        </div>
        @empty
            <p style="color:#94a3b8;">No achievements yet. Add one above.</p>
        @endforelse
    </div>

    {{-- ======================== ANNOUNCEMENTS ======================== --}}
    <div style="background:#fff; border-radius:12px; padding:24px;
                box-shadow:0 2px 12px rgba(0,0,0,0.08); margin-bottom:28px;">
        <h2 style="color:#1e293b; margin-bottom:4px; font-size:1.1rem;
                   border-bottom:2px solid #e2e8f0; padding-bottom:10px;">
            📢 Announcements
        </h2>
        <p style="color:#64748b; font-size:0.82rem; margin-bottom:18px;">
            These appear on the public website below the Achievements section.
        </p>

        {{-- Add Announcement Form --}}
        <form method="POST" action="{{ route('cms.announcements.store') }}"
              style="background:#f8fafc; padding:16px; border-radius:10px; margin-bottom:24px;">
            @csrf

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px;">
                <div style="grid-column:1/-1;">
                    <label style="font-size:0.8rem; color:#475569; font-weight:600; display:block; margin-bottom:4px;">
                        Title <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="title" required
                           placeholder="e.g. Annual Sports Day – 15 March 2026"
                           style="width:100%; padding:9px 12px; border:1px solid #cbd5e1;
                                  border-radius:8px; outline:none; font-size:0.9rem;">
                </div>

                <div style="grid-column:1/-1;">
                    <label style="font-size:0.8rem; color:#475569; font-weight:600; display:block; margin-bottom:4px;">
                        Details (Optional)
                    </label>
                    <textarea name="body" rows="2"
                              placeholder="Additional details about the announcement..."
                              style="width:100%; padding:9px 12px; border:1px solid #cbd5e1;
                                     border-radius:8px; outline:none; font-size:0.9rem; resize:vertical;"></textarea>
                </div>

                <div>
                    <label style="font-size:0.8rem; color:#475569; font-weight:600; display:block; margin-bottom:4px;">
                        Type <span style="color:#ef4444;">*</span>
                    </label>
                    <select name="type" required
                            style="width:100%; padding:9px 12px; border:1px solid #cbd5e1;
                                   border-radius:8px; outline:none; font-size:0.9rem; background:#fff;">
                        <option value="info">📘 Info (Blue)</option>
                        <option value="success">📗 Success (Green)</option>
                        <option value="warning">📙 Warning (Orange)</option>
                        <option value="urgent">📕 Urgent (Red)</option>
                    </select>
                </div>

                <div>
                    <label style="font-size:0.8rem; color:#475569; font-weight:600; display:block; margin-bottom:4px;">
                        Expires On (Optional)
                    </label>
                    <input type="date" name="expires_at" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           style="width:100%; padding:9px 12px; border:1px solid #cbd5e1;
                                  border-radius:8px; outline:none; font-size:0.9rem;">
                </div>
            </div>

            <button type="submit"
                    style="background:#7c3aed; color:#fff; padding:10px 22px;
                           border:none; border-radius:8px; font-weight:600;
                           font-size:0.9rem; cursor:pointer;">
                📢 Add Announcement
            </button>
        </form>

        {{-- Announcements List --}}
        @php
            $typeColors = [
                'info'    => ['bg' => '#eff6ff', 'border' => '#93c5fd', 'badge' => '#2563eb', 'label' => '📘 Info'],
                'success' => ['bg' => '#f0fdf4', 'border' => '#86efac', 'badge' => '#16a34a', 'label' => '📗 Success'],
                'warning' => ['bg' => '#fff7ed', 'border' => '#fdba74', 'badge' => '#ea580c', 'label' => '📙 Warning'],
                'urgent'  => ['bg' => '#fef2f2', 'border' => '#fca5a5', 'badge' => '#dc2626', 'label' => '📕 Urgent'],
            ];
        @endphp

        @forelse($announcements as $ann)
            @php $c = $typeColors[$ann->type] ?? $typeColors['info']; @endphp
            <div style="background:{{ $ann->is_active ? $c['bg'] : '#f8fafc' }};
                        border:1px solid {{ $ann->is_active ? $c['border'] : '#e2e8f0' }};
                        border-radius:10px; padding:14px 16px; margin-bottom:12px;
                        opacity:{{ $ann->is_active ? '1' : '0.6' }};">

                <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:12px; flex-wrap:wrap;">
                    <div style="flex:1; min-width:200px;">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px; flex-wrap:wrap;">
                            <span style="background:{{ $c['badge'] }}; color:#fff; font-size:0.68rem;
                                         font-weight:700; padding:3px 9px; border-radius:999px; letter-spacing:0.5px;">
                                {{ strtoupper($ann->type) }}
                            </span>
                            @if(!$ann->is_active)
                                <span style="background:#94a3b8; color:#fff; font-size:0.68rem;
                                             font-weight:700; padding:3px 9px; border-radius:999px;">
                                    INACTIVE
                                </span>
                            @endif
                            @if($ann->expires_at)
                                <span style="color:#64748b; font-size:0.75rem;">
                                    ⏳ Expires: {{ $ann->expires_at->format('d M Y') }}
                                </span>
                            @endif
                        </div>
                        <div style="font-weight:700; color:#1e293b; font-size:0.95rem; margin-bottom:3px;">
                            {{ $ann->title }}
                        </div>
                        @if($ann->body)
                            <div style="color:#475569; font-size:0.82rem; line-height:1.5;">
                                {{ $ann->body }}
                            </div>
                        @endif
                        <div style="color:#94a3b8; font-size:0.72rem; margin-top:6px;">
                            Added: {{ $ann->created_at->format('d M Y') }}
                        </div>
                    </div>

                    <div style="display:flex; gap:6px; flex-shrink:0;">
                        {{-- Toggle active/inactive --}}
                        <form method="POST" action="{{ route('cms.announcements.toggle', $ann) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    style="background:{{ $ann->is_active ? '#f1f5f9' : '#dcfce7' }};
                                           color:{{ $ann->is_active ? '#64748b' : '#16a34a' }};
                                           border:1px solid {{ $ann->is_active ? '#cbd5e1' : '#86efac' }};
                                           padding:7px 12px; border-radius:7px;
                                           font-size:0.78rem; font-weight:600; cursor:pointer;"
                                    title="{{ $ann->is_active ? 'Deactivate' : 'Activate' }}">
                                {{ $ann->is_active ? '⏸ Hide' : '▶ Show' }}
                            </button>
                        </form>

                        {{-- Delete --}}
                        <form method="POST" action="{{ route('cms.announcements.delete', $ann) }}"
                              onsubmit="return confirm('Delete this announcement?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="background:#fef2f2; color:#dc2626; border:1px solid #fca5a5;
                                           padding:7px 12px; border-radius:7px;
                                           font-size:0.78rem; font-weight:600; cursor:pointer;">
                                🗑 Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align:center; padding:32px; color:#94a3b8; background:#f8fafc;
                        border-radius:10px; border:1px dashed #e2e8f0;">
                <div style="font-size:2rem; margin-bottom:8px;">📢</div>
                <p>No announcements yet. Add one above.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
