<x-app-layout>
<style>
  :root{
    --bg:#0b1220;
    --glass: rgba(15,23,42,0.85);
    --stroke: rgba(255,255,255,0.12);
    --text:#e5e7eb;
    --muted: rgba(229,231,235,0.75);
    --accent1:#38bdf8;
    --accent2:#818cf8;
    --danger:#ef4444;
    --success:#22c55e;
  }

  *{ box-sizing:border-box; }

  .page-wrap{
    padding: 28px;
    max-width: 1300px;
    margin: 0 auto;
  }

  .back-btn{
    background: var(--accent1);
    color:#fff;
    padding: 10px 18px;
    border-radius: 12px;
    font-weight: 800;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:8px;
    margin-bottom: 14px;
  }

  .glass-box{
    background: var(--glass);
    backdrop-filter: blur(18px);
    border-radius: 22px;
    padding: 22px;
    box-shadow: 0 30px 90px rgba(0,0,0,0.45);
    color: var(--text);
    border: 1px solid var(--stroke);
  }

  .head-row{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap: 14px;
    flex-wrap:wrap;
    margin-bottom: 14px;
  }

  .title{
    margin:0;
    font-size: 26px;
    font-weight: 950;
    background: linear-gradient(90deg, var(--accent1), var(--accent2));
    -webkit-background-clip:text;
    -webkit-text-fill-color: transparent;
    line-height: 1.2;
  }

  .sub{
    margin: 6px 0 0;
    color: var(--muted);
    font-weight: 700;
    font-size: 14px;
  }

  .search-row{
    display:flex;
    justify-content:flex-end;
    width: 100%;
  }

  .search-box{
    position: relative;
    width: 420px;
    max-width: 100%;
  }

  .search-input{
    width:100%;
    padding: 12px 44px 12px 14px;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.18);
    background: rgba(255,255,255,0.08);
    color: var(--text);
    outline: none;
    font-weight: 800;
  }

  .search-input::placeholder{ color: rgba(229,231,235,0.65); font-weight: 700; }

  .search-input:focus{
    border-color: rgba(56,189,248,0.8);
    box-shadow: 0 0 0 4px rgba(56,189,248,0.12);
  }

  .clear-btn{
    position:absolute;
    right: 10px;
    top:50%;
    transform: translateY(-50%);
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border:none;
    cursor:pointer;
    background: rgba(255,255,255,0.15);
    color: var(--text);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight: 900;
  }
  .clear-btn:hover{ background: rgba(239,68,68,0.35); }

  .success{
    margin: 14px 0 16px;
    padding: 12px 14px;
    border-radius: 14px;
    background: rgba(34,197,94,0.14);
    border: 1px solid rgba(34,197,94,0.32);
    color: #bbf7d0;
    font-weight: 800;
  }

  .table-wrap{
    width: 100%;
    overflow:auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.08);
    background: rgba(255,255,255,0.03);
  }

  table{
    width: 100%;
    min-width: 1050px;
    border-collapse: separate;
    border-spacing: 0 12px;
    padding: 12px;
  }

  thead th{
    text-align:left;
    padding: 14px 18px;
    color: #93c5fd;
    font-weight: 900;
    font-size: 13px;
    white-space: nowrap;
  }

  tbody tr{
    background: rgba(255,255,255,0.05);
    transition: all .2s ease;
  }
  tbody tr:hover{ background: rgba(255,255,255,0.08); }

  tbody td{
    padding: 16px 18px;
    vertical-align: middle;
    font-weight: 700;
    font-size: 13px;
  }

  tbody tr td:first-child{ border-radius: 14px 0 0 14px; }
  tbody tr td:last-child{ border-radius: 0 14px 14px 0; }

  .name-cell{
    display:flex;
    align-items:center;
    gap: 12px;
    min-width: 220px;
  }

  .avatar{
    width: 36px;
    height: 36px;
    border-radius: 50%;
    overflow:hidden;
    flex: 0 0 36px;
    border: 1px solid rgba(255,255,255,0.18);
    background: rgba(56,189,248,0.12);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight: 900;
    color: #93c5fd;
    text-transform: uppercase;
  }
  .avatar img{ width:100%; height:100%; object-fit:cover; display:block; }

  .student-name{ font-weight: 900; color: var(--text); }

  .addr{
    max-width: 260px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .action-wrap{
    display:flex;
    gap: 10px;
    flex-wrap:wrap;
    align-items:center;
  }

  .btn{
    padding: 8px 14px;
    border-radius: 10px;
    font-weight: 900;
    text-decoration:none;
    border:none;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    white-space: nowrap;
  }
  .edit{ background: var(--success); color:#032217; }
  .delete{ background: var(--danger); color:#fff; }

  .empty-text{ opacity: .75; font-weight: 800; }

  .cards{ display:none; margin-top: 12px; }
  .st-card{
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.10);
    border-radius: 18px;
    padding: 14px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.25);
    margin-bottom: 12px;
  }
  .st-top{
    display:flex;
    gap: 12px;
    align-items:center;
    justify-content: space-between;
  }
  .st-left{
    display:flex;
    gap: 12px;
    align-items:center;
    min-width: 0;
  }
  .st-meta{ min-width: 0; }
  .st-name{
    font-weight: 950;
    color: var(--text);
    margin:0;
    white-space: nowrap;
    overflow:hidden;
    text-overflow: ellipsis;
  }
  .st-roll{
    margin: 4px 0 0;
    color: var(--muted);
    font-weight: 800;
    font-size: 13px;
  }
  .st-grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px 12px;
    margin-top: 12px;
  }
  .kv{
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 10px 12px;
    min-width: 0;
  }
  .k{ font-size: 11px; color: rgba(229,231,235,0.70); font-weight: 900; }
  .v{ margin-top: 4px; font-weight: 900; color: var(--text); font-size: 13px; white-space: nowrap; overflow:hidden; text-overflow: ellipsis; }

  .st-actions{
    display:flex;
    gap: 10px;
    flex-wrap:wrap;
    margin-top: 12px;
  }
  .st-actions .btn{ flex: 1; }

  /* ✅ PAGINATION */
  .pager{
    margin-top: 16px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap: 12px;
    flex-wrap:wrap;
    padding: 12px;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.10);
    background: rgba(255,255,255,0.04);
  }
  .pager-info{
    color: rgba(229,231,235,0.75);
    font-weight: 900;
    font-size: 13px;
  }
  .pager-links{
    display:flex;
    gap: 8px;
    align-items:center;
    flex-wrap:wrap;
  }
  .pbtn{
    padding: 9px 12px;
    border-radius: 12px;
    font-weight: 950;
    text-decoration:none;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.06);
    color: var(--text);
  }
  .pbtn:hover{ border-color: rgba(56,189,248,0.55); }
  .pbtn.disabled{
    opacity: .45;
    pointer-events:none;
  }
  .pbtn.active{
    background: rgba(56,189,248,0.22);
    border-color: rgba(56,189,248,0.75);
    color: #e0f2fe;
  }

  @media (max-width: 900px){
    .page-wrap{ padding: 18px; }
    .glass-box{ padding: 16px; border-radius: 18px; }
    .title{ font-size: 22px; }
  }

  @media (max-width: 720px){
    .table-wrap{ display:none; }
    .cards{ display:block; }

    .search-row{ justify-content: stretch; }
    .search-box{ width: 100%; }

    .st-grid{ grid-template-columns: 1fr; }
  }
</style>

<div class="page-wrap">
  <a href="/students" class="back-btn">← Back to Students</a>

  <div class="glass-box">
    <div class="head-row">
      <div>
        <h1 class="title">📘 Class {{ $class }} — Students</h1>
        <p class="sub">Search and manage students. On mobile this becomes a card layout.</p>
      </div>

      <div class="search-row">
        <div class="search-box">
          {{-- ✅ Server-side search --}}
          <form method="GET" action="" id="searchForm" style="margin:0;">
            <input
              type="text"
              name="q"
              id="studentSearch"
              class="search-input"
              placeholder="Search here..."
              value="{{ request('q') }}"
              autocomplete="off"
            >
          </form>

          @if(request('q'))
            <button type="button" class="clear-btn" onclick="clearSearch()" title="Clear">✕</button>
          @else
            <button type="button" class="clear-btn" onclick="clearSearch()" title="Clear" style="display:none;">✕</button>
          @endif
        </div>
      </div>
    </div>

    @if(session('success'))
      <div class="success">✅ {{ session('success') }}</div>
    @endif

    @if($students->count() === 0)
      <p class="empty-text">No students found in this class.</p>
    @else

      {{-- ✅ TABLE VIEW --}}
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Roll No</th>
              <th>Phone</th>
              <th>Father</th>
              <th>Mother</th>
              <th>Religion</th>
              <th>Citizenship</th>
              <th>Address</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            @foreach($students as $student)
              @php
                $photoUrl = !empty($student->photo_path) ? asset($student->photo_path) : null;

                $initials = '';
                if (!empty($student->name)) {
                  $parts = preg_split('/\s+/', trim($student->name));
                  $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                  $initials = trim($initials) ?: strtoupper(substr($student->name, 0, 1));
                }
              @endphp

              <tr>
                <td>
                  <div class="name-cell">
                    <div class="avatar">
                      @if($photoUrl)
                        <img src="{{ $photoUrl }}" alt="Photo"
                             onerror="this.onerror=null; this.remove(); this.parentElement.innerText='{{ $initials ?: 'S' }}';">
                      @else
                        {{ $initials ?: 'S' }}
                      @endif
                    </div>
                    <div class="student-name">{{ $student->name }}</div>
                  </div>
                </td>
                <td>{{ $student->roll_no }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->father_name ?? '-' }}</td>
                <td>{{ $student->mother_name ?? '-' }}</td>
                <td>{{ $student->religion ?? '-' }}</td>
                <td>{{ $student->citizenship ?? '-' }}</td>
                <td class="addr">{{ $student->address ?? '-' }}</td>
                <td>
                  <div class="action-wrap">
                    <a href="{{ route('students.edit', $student) }}" class="btn edit">Edit</a>
                    <form method="POST" action="{{ route('students.destroy', $student) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn delete">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- ✅ CARD VIEW --}}
      <div class="cards">
        @foreach($students as $student)
          @php
            $photoUrl = !empty($student->photo_path) ? asset($student->photo_path) : null;

            $initials = '';
            if (!empty($student->name)) {
              $parts = preg_split('/\s+/', trim($student->name));
              $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
              $initials = trim($initials) ?: strtoupper(substr($student->name, 0, 1));
            }
          @endphp

          <div class="st-card">
            <div class="st-top">
              <div class="st-left">
                <div class="avatar">
                  @if($photoUrl)
                    <img src="{{ $photoUrl }}" alt="Photo"
                         onerror="this.onerror=null; this.remove(); this.parentElement.innerText='{{ $initials ?: 'S' }}';">
                  @else
                    {{ $initials ?: 'S' }}
                  @endif
                </div>

                <div class="st-meta">
                  <p class="st-name">{{ $student->name }}</p>
                  <p class="st-roll">Roll: {{ $student->roll_no ?? '-' }} • Phone: {{ $student->phone ?? '-' }}</p>
                </div>
              </div>
            </div>

            <div class="st-grid">
              <div class="kv"><div class="k">Father</div><div class="v">{{ $student->father_name ?? '-' }}</div></div>
              <div class="kv"><div class="k">Mother</div><div class="v">{{ $student->mother_name ?? '-' }}</div></div>
              <div class="kv"><div class="k">Religion</div><div class="v">{{ $student->religion ?? '-' }}</div></div>
              <div class="kv"><div class="k">Citizenship</div><div class="v">{{ $student->citizenship ?? '-' }}</div></div>
              <div class="kv" style="grid-column:1/-1;">
                <div class="k">Address</div>
                <div class="v">{{ $student->address ?? '-' }}</div>
              </div>
            </div>

            <div class="st-actions">
              <a href="{{ route('students.edit', $student) }}" class="btn edit">Edit</a>
              <form method="POST" action="{{ route('students.destroy', $student) }}" style="flex:1;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn delete" style="width:100%;">Delete</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>

      {{-- ✅ PAGINATION BAR --}}
      @if($students->hasPages())
        <div class="pager">
          <div class="pager-info">
            Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }}
          </div>

          <div class="pager-links">
            {{-- Prev --}}
            <a class="pbtn {{ $students->onFirstPage() ? 'disabled' : '' }}"
               href="{{ $students->previousPageUrl() ?? '#' }}">← Prev</a>

            {{-- Numbers (limited range) --}}
            @php
              $current = $students->currentPage();
              $last = $students->lastPage();
              $start = max(1, $current - 2);
              $end = min($last, $current + 2);
            @endphp

            @if($start > 1)
              <a class="pbtn" href="{{ $students->url(1) }}">1</a>
              @if($start > 2)
                <span class="pbtn disabled">...</span>
              @endif
            @endif

            @for($p = $start; $p <= $end; $p++)
              <a class="pbtn {{ $p == $current ? 'active' : '' }}" href="{{ $students->url($p) }}">{{ $p }}</a>
            @endfor

            @if($end < $last)
              @if($end < $last - 1)
                <span class="pbtn disabled">...</span>
              @endif
              <a class="pbtn" href="{{ $students->url($last) }}">{{ $last }}</a>
            @endif

            {{-- Next --}}
            <a class="pbtn {{ $students->hasMorePages() ? '' : 'disabled' }}"
               href="{{ $students->nextPageUrl() ?? '#' }}">Next →</a>
          </div>
        </div>
      @endif

    @endif
  </div>
</div>

<script>
  // ✅ Auto-submit search after user stops typing (debounce)
  let t = null;
  const input = document.getElementById('studentSearch');
  const clearBtn = document.querySelector('.clear-btn');

  if (input) {
    input.addEventListener('input', function(){
      clearBtn.style.display = this.value.trim() ? 'flex' : 'none';

      if (t) clearTimeout(t);
      t = setTimeout(() => {
        document.getElementById('searchForm').submit();
      }, 450);
    });
  }

  function clearSearch(){
    const url = new URL(window.location.href);
    url.searchParams.delete('q');
    window.location.href = url.toString();
  }
</script>
</x-app-layout>
