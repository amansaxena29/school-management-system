@extends('layouts.app')
@section('header', 'Class ' . $class . ' — Students')
@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap');
:root{--bg:#070d1c;--cyan:#0ff4c6;--indigo:#6470ff;--green:#22d3a0;--rose:#ff6b8a;
--glass:rgba(12,22,48,0.78);--edge:rgba(255,255,255,0.08);--text:#eef4f8;--muted:rgba(200,220,235,0.6);--input:#1a2540;}
*,*::before,*::after{box-sizing:border-box;}
.fc-bg{position:fixed;inset:0;z-index:-10;background:var(--bg);pointer-events:none;overflow:hidden;}
.fc-orb{position:absolute;border-radius:50%;filter:blur(90px);animation:orbD ease-in-out infinite alternate;}
.fc-orb:nth-child(1){width:600px;height:450px;background:radial-gradient(circle,rgba(100,112,255,0.2) 0%,transparent 70%);top:-100px;left:-80px;animation-duration:18s;}
.fc-orb:nth-child(2){width:500px;height:380px;background:radial-gradient(circle,rgba(15,244,198,0.12) 0%,transparent 70%);bottom:-80px;right:-80px;animation-duration:22s;animation-delay:-6s;}
@keyframes orbD{0%{transform:translate(0,0) scale(1);}100%{transform:translate(30px,20px) scale(1.08);}}
.fc-gridlines{position:fixed;inset:0;z-index:-9;pointer-events:none;
background-image:linear-gradient(rgba(15,244,198,0.016) 1px,transparent 1px),linear-gradient(90deg,rgba(15,244,198,0.016) 1px,transparent 1px);
background-size:65px 65px;}
.fc-wrap{font-family:'DM Sans',sans-serif;max-width:1140px;margin:0 auto;padding:36px 24px 80px;color:var(--text);}
.fc-top{display:flex;justify-content:space-between;align-items:flex-start;gap:14px;flex-wrap:wrap;margin-bottom:28px;
opacity:0;animation:fadeUp 0.7s 0.1s cubic-bezier(0.16,1,0.3,1) forwards;}
@keyframes fadeUp{0%{opacity:0;transform:translateY(18px);}100%{opacity:1;transform:translateY(0);}}
.fc-title{font-size:clamp(1.6rem,3vw,2.2rem);font-weight:700;margin:0 0 5px;
background:linear-gradient(90deg,var(--cyan),var(--indigo));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.fc-sub{color:var(--muted);font-size:0.88rem;margin:0;}
.fc-back{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:12px;
text-decoration:none;font-weight:600;font-size:13px;color:var(--text);
background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);transition:all 0.2s;white-space:nowrap;align-self:center;}
.fc-back:hover{background:rgba(255,255,255,0.12);transform:translateY(-1px);}
.fc-alert{display:flex;align-items:center;gap:10px;padding:13px 18px;border-radius:10px;margin-bottom:20px;
font-size:0.88rem;font-weight:500;background:rgba(34,211,160,0.1);border:1px solid rgba(34,211,160,0.3);color:#6effd8;}
.fc-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;
opacity:0;animation:fadeUp 0.7s 0.22s cubic-bezier(0.16,1,0.3,1) forwards;}
.fc-stat{background:var(--glass);border:1px solid var(--edge);border-radius:16px;padding:20px 22px;backdrop-filter:blur(20px);position:relative;overflow:hidden;}
.fc-stat::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;}
.fc-stat:nth-child(1)::before{background:linear-gradient(90deg,transparent,var(--cyan),transparent);}
.fc-stat:nth-child(2)::before{background:linear-gradient(90deg,transparent,var(--green),transparent);}
.fc-stat:nth-child(3)::before{background:linear-gradient(90deg,transparent,var(--rose),transparent);}
.fc-stat-num{font-size:2rem;font-weight:700;margin-bottom:4px;}
.fc-stat:nth-child(1) .fc-stat-num{color:var(--cyan);}
.fc-stat:nth-child(2) .fc-stat-num{color:var(--green);}
.fc-stat:nth-child(3) .fc-stat-num{color:var(--rose);}
.fc-stat-label{font-size:11px;font-weight:500;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);}
.fc-search-row{display:flex;gap:10px;margin-bottom:20px;
opacity:0;animation:fadeUp 0.7s 0.32s cubic-bezier(0.16,1,0.3,1) forwards;}
.fc-search{flex:1;min-width:220px;padding:11px 16px;background:var(--input);
border:1px solid rgba(255,255,255,0.12);border-radius:10px;color:var(--text);
font-size:0.88rem;font-family:'DM Sans',sans-serif;outline:none;transition:border-color 0.2s,box-shadow 0.2s;}
.fc-search::placeholder{color:rgba(180,200,220,0.35);}
.fc-search:focus{border-color:rgba(15,244,198,0.45);box-shadow:0 0 0 3px rgba(15,244,198,0.1);}
.fc-card{background:var(--glass);border:1px solid var(--edge);border-radius:20px;overflow:hidden;
backdrop-filter:blur(24px);box-shadow:0 24px 60px rgba(0,0,0,0.5);
opacity:0;animation:fadeUp 0.7s 0.38s cubic-bezier(0.16,1,0.3,1) forwards;}
.fc-table-wrap{overflow-x:auto;}
table{width:100%;border-collapse:collapse;min-width:700px;}
thead th{text-align:left;padding:13px 16px;font-size:11px;letter-spacing:0.2em;text-transform:uppercase;
color:rgba(200,220,235,0.7);background:rgba(255,255,255,0.06);border-bottom:1px solid rgba(255,255,255,0.08);white-space:nowrap;}
tbody td{padding:13px 16px;border-bottom:1px solid rgba(255,255,255,0.06);color:var(--text);font-size:14px;vertical-align:middle;}
tbody tr:last-child td{border-bottom:none;}
tbody tr:hover td{background:rgba(255,255,255,0.04);}
.fc-badge{display:inline-flex;align-items:center;padding:4px 12px;border-radius:99px;font-size:11px;font-weight:600;border:1px solid;white-space:nowrap;}
.fc-badge-paid{background:rgba(34,211,160,0.1);border-color:rgba(34,211,160,0.3);color:var(--green);}
.fc-badge-pending{background:rgba(255,107,138,0.1);border-color:rgba(255,107,138,0.3);color:var(--rose);}
.fc-badge-none{background:rgba(255,255,255,0.06);border-color:rgba(255,255,255,0.12);color:var(--muted);}
.fc-btn-view{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:9px;
text-decoration:none;font-size:12px;font-weight:600;border:none;cursor:pointer;transition:all 0.2s;white-space:nowrap;
background:linear-gradient(135deg,var(--cyan),#00d4a8);color:#041020;box-shadow:0 4px 14px rgba(15,244,198,0.25);}
.fc-btn-view:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(15,244,198,0.38);}
.fc-empty{text-align:center;padding:48px 20px;}
.fc-empty-icon{font-size:2.5rem;margin-bottom:12px;}
.fc-empty p{color:var(--muted);font-size:0.88rem;}
.fc-roll{font-size:12px;color:var(--muted);}
.fc-name-main{font-weight:600;}
@media(max-width:600px){.fc-stats{grid-template-columns:1fr;}}
</style>

<div class="fc-bg"><div class="fc-orb"></div><div class="fc-orb"></div></div>
<div class="fc-gridlines"></div>

<div class="fc-wrap">
    <div class="fc-top">
        <div>
            <h1 class="fc-title">Class {{ $class }} — Students</h1>
            <p class="fc-sub">Click on any student to view and manage their fee installments.</p>
        </div>
        <a href="{{ route('fees.index') }}" class="fc-back">← Back to Classes</a>
    </div>

    @if(session('success'))
        <div class="fc-alert">✅ &nbsp;{{ session('success') }}</div>
    @endif

    @php
        $totalStudents = $students->count();
        $withFees = $students->filter(fn($s) => isset($feesMap[$s->id]))->count();
        $pendingCount = $students->filter(function($s) use ($feesMap) {
            if (!isset($feesMap[$s->id])) return false;
            $f = $feesMap[$s->id];
            for ($i = 1; $i <= 5; $i++) {
                if ($f->{"inst{$i}_status"} === 'pending' && $f->{"inst{$i}_amount"}) return true;
            }
            return false;
        })->count();
    @endphp

    <div class="fc-stats">
        <div class="fc-stat">
            <div class="fc-stat-num">{{ $totalStudents }}</div>
            <div class="fc-stat-label">Total Students</div>
        </div>
        <div class="fc-stat">
            <div class="fc-stat-num">{{ $withFees }}</div>
            <div class="fc-stat-label">Fee Records Added</div>
        </div>
        <div class="fc-stat">
            <div class="fc-stat-num">{{ $pendingCount }}</div>
            <div class="fc-stat-label">With Pending Installments</div>
        </div>
    </div>

    <div class="fc-search-row">
        <input type="text" class="fc-search" id="studentSearch"
               placeholder="Search by name or roll no...">
    </div>

    <div class="fc-card">
        @if($students->count())
            <div class="fc-table-wrap">
                <table id="studentTable">
                    <thead>
                        <tr>
                            <th>Roll No</th>
                            <th>Student Name</th>
                            <th>Father's Name</th>
                            <th>DOB</th>
                            <th>Fee Status</th>
                            <th>Total Paid</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            @php
                                $fee = $feesMap[$student->id] ?? null;
                                $hasAny = false; $allPaid = false; $hasPending = false;
                                if ($fee) {
                                    $paidC = 0; $pendC = 0; $fillC = 0;
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($fee->{"inst{$i}_amount"}) {
                                            $fillC++;
                                            $fee->{"inst{$i}_status"} === 'paid' ? $paidC++ : $pendC++;
                                        }
                                    }
                                    $hasAny    = $fillC > 0;
                                    $allPaid   = $fillC > 0 && $pendC === 0;
                                    $hasPending = $pendC > 0;
                                }
                            @endphp
                            <tr class="student-row">
                                <td><span class="fc-roll">{{ $student->roll_no }}</span></td>
                                <td>
                                    <div>
                                        <div class="fc-name-main">{{ $student->name }}</div>
                                        @if($student->mother_name)
                                            <div class="fc-roll">M: {{ $student->mother_name }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $student->father_name ?? '—' }}</td>
                               <td>{{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d M Y') : '—' }}</td>
                                <td>
                                    @if(!$hasAny)
                                        <span class="fc-badge fc-badge-none">No Record</span>
                                    @elseif($allPaid)
                                        <span class="fc-badge fc-badge-paid">All Paid</span>
                                    @else
                                        <span class="fc-badge fc-badge-pending">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $fee ? '₹'.number_format($fee->totalPaid(), 0) : '—' }}</td>
                                <td>
                                    <a href="{{ route('fees.student', ['class' => $class, 'student' => $student->id]) }}"
                                       class="fc-btn-view">Manage Fees →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="fc-empty">
                <div class="fc-empty-icon">👨‍🎓</div>
                <p>No students found in Class {{ $class }}.<br>Add students first from the Students section.</p>
            </div>
        @endif
    </div>
</div>

<script>
document.getElementById('studentSearch')?.addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#studentTable .student-row').forEach(function (row) {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>
@endsection
