<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Result Marksheet</title>

  <style>
    @page { size: A4 portrait; margin: 8mm; }

    body{
      font-family: DejaVu Sans, sans-serif;
      font-size: 11px;
      color: #111;
      margin: 0;
      padding: 0;
      background: #ffffff;
    }

    :root{
      --header1: #3B0764;
      --header2: #6D28D9;
      --accent1: #06B6D4;
      --accent2: #F97316;
      --labelbg: #F3E8FF;
      --rowalt:  #FFF7ED;
      --border:  #1F2937;
      --text:    #111827;
      --muted:   #4B5563;
      --white:   #ffffff;
    }

    .sheet{
      border: 2px solid var(--border);
      border-radius: 10px;
      overflow: hidden;
    }

    .header{
      background: var(--header1);
      color: var(--white);
      padding: 12px 12px 10px 12px;
      border-bottom: 3px solid var(--accent1);
    }

    .header-table{
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }

    .header-logo{
      width: 78px;
      vertical-align: middle;
    }

    .header-logo img{
      width: 62px;
      height: 62px;
      object-fit: contain;
      display: block;
      background: #ffffff;
      border-radius: 10px;
      padding: 4px;
    }

    .header-center{
      text-align: center;
      vertical-align: middle;
      padding: 0 6px;
    }

    .school-name{
      font-size: 22px;
      font-weight: 900;
      letter-spacing: 0.4px;
      line-height: 1.1;
      margin: 0;
    }

    .school-meta{
      font-size: 10px;
      margin-top: 6px;
      line-height: 1.35;
      opacity: 0.95;
      white-space: normal;
      word-wrap: break-word;
    }

    .titlebar{
      background: var(--accent1);
      color: #001018;
      font-weight: 900;
      text-align: center;
      padding: 8px 10px;
      border-bottom: 2px solid var(--border);
      font-size: 13px;
      letter-spacing: 0.3px;
    }

    table{
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }

    .info td{
      border: 1px solid var(--border);
      padding: 7px 8px;
      vertical-align: top;
    }

    .label{
      font-weight: 900;
      width: 28%;
      background: var(--labelbg);
      color: var(--header1);
    }

    .photo-cell{
      width: 18%;
      text-align: center;
      vertical-align: middle;
      background: #F9FAFB;
    }

    .photo-box{
      border: 2px solid var(--border);
      width: 92px;
      height: 112px;
      margin: 0 auto;
      overflow: hidden;
      background: #fff;
      border-radius: 8px;
    }

    .photo-box img{
      width: 92px;
      height: 112px;
      object-fit: cover;
      display: block;
    }

    .section-gap{ height: 8px; }

    /* MARKS TABLE */
    .marks th{
      background: var(--accent2);
      border: 1px solid var(--border);
      padding: 7px 6px;
      font-weight: 900;
      text-align: center;
      font-size: 10px;
      color: #1a0b00;
      letter-spacing: 0.2px;
    }

    .marks td{
      border: 1px solid var(--border);
      padding: 6px 6px;
      text-align: center;
      font-size: 10px;
      color: var(--text);
    }

    .marks .subj{
      text-align: left;
      font-weight: 800;
      font-size: 10px;
    }

    .marks tbody tr:nth-child(even){
      background: var(--rowalt);
    }

    .total-row td{
      background: #FFEDD5;
      font-weight: 900;
      border-top: 2px solid var(--border);
    }

    .summary td{
      border: 1px solid var(--border);
      padding: 7px 8px;
      font-size: 11px;
    }

    .summary .label2{
      font-weight: 900;
      background: var(--labelbg);
      color: var(--header1);
      width: 18%;
    }

    .summary .value-strong{
      font-weight: 900;
      color: var(--header2);
    }

    .cosch th{
      background: #A855F7;
      border: 1px solid var(--border);
      padding: 7px;
      text-align: left;
      font-weight: 900;
      color: #fff;
    }

    .cosch td{
      border: 1px solid var(--border);
      padding: 6px;
    }

    .cosch tbody tr:nth-child(even){
      background: #F5F3FF;
    }

    .footer td{
      border: 1px solid var(--border);
      padding: 9px;
      vertical-align: top;
      font-size: 11px;
    }

    .footer-left{ background: #EEF2FF; }
    .footer-mid{ background: #ECFEFF; }
    .footer-right{ background: #FFF7ED; }

    .signbox{
      border: 1px solid var(--border);
      height: 55px;
      border-radius: 6px;
      background: #fff;
      margin-top: 6px;
    }

    .grade-table th{
      background: #F59E0B;
      border: 1px solid var(--border);
      padding: 6px;
      text-align: center;
      font-weight: 900;
      font-size: 10px;
    }
    .grade-table td{
      border: 1px solid var(--border);
      padding: 6px;
      text-align: center;
      font-size: 10px;
    }

    /* OVERALL % small block */
    .overall-wrap{
      width: 100%;
      margin-top: 6px;
      text-align: right;
    }

    .overall-box{
      display: inline-block;
      border: 1px solid var(--border);
      background: #E0F2FE;
      padding: 6px 10px;
      border-radius: 8px;
      font-weight: 900;
      color: var(--header1);
      font-size: 11px;
    }

    .overall-box span{
      color: var(--header2);
    }
  </style>
</head>

<body>
  @php
    // support old controller (only $result) + new controller ($half, $annual)
    $extra = $extra ?? null;

    // If controller hasn't sent $annual/$half yet, we fallback:
    $annual = $annual ?? ($result ?? null);
    $half   = $half ?? null;

    // helpers
    $attendance = $extra->attendance ?? ($annual->attendance ?? ($result->attendance ?? '-'));

    $promotedTo = $extra->promoted_to_class
      ?? ($annual->promoted_to ?? ($annual->promoted_to_class ?? ($result->promoted_to_class ?? '-')));

    $remarks = $extra->class_teacher_remarks
      ?? ($annual->remarks ?? ($annual->class_teacher_remarks ?? ($result->class_teacher_remarks ?? '-')));

    // Co-scholastic from extras
    $disciplineT1 = $extra->discipline_term1 ?? '-';
    $disciplineT2 = $extra->discipline_term2 ?? '-';

    $artT1 = $extra->art_education_term1 ?? '-';
    $artT2 = $extra->art_education_term2 ?? '-';

    $gaT1 = $extra->general_awareness_term1 ?? '-';
    $gaT2 = $extra->general_awareness_term2 ?? '-';

    $hpT1 = $extra->health_physical_term1 ?? '-';
    $hpT2 = $extra->health_physical_term2 ?? '-';

    // grade calculator
    $calcGrade = function($marks, $max) {
        $marks = (float)($marks ?? 0);
        $max   = (float)($max ?? 0);
        if ($max <= 0) return '-';
        $p = ($marks / $max) * 100;

        if ($p >= 91) return 'A1';
        if ($p >= 81) return 'A2';
        if ($p >= 71) return 'B1';
        if ($p >= 61) return 'B2';
        if ($p >= 51) return 'C1';
        if ($p >= 41) return 'C2';
        if ($p >= 33) return 'D';
        return 'E';
    };

    // merge subject list (half + annual) so both show
    $subNames = collect();

    if($half && $half->subjects) {
      $subNames = $subNames->merge($half->subjects->pluck('subject'));
    }
    if($annual && $annual->subjects) {
      $subNames = $subNames->merge($annual->subjects->pluck('subject'));
    }

    // unique & clean
    $subNames = $subNames->filter()->map(fn($x)=>trim((string)$x))->filter()->unique()->values();

    $totalHalf=0; $maxHalf=0;
    $totalAnnual=0; $maxAnnual=0;
  @endphp

  <div class="sheet">

    <!-- HEADER (RESTORED) -->
    <div class="header">
      <table class="header-table">
        <tr>
          <td class="header-logo">
            @php $logoPath = public_path('images/school-logo.png'); @endphp
            @if(file_exists($logoPath))
              <img src="{{ $logoPath }}" alt="School Logo">
            @else
              <div style="width:62px;height:62px;background:#fff;border-radius:10px;"></div>
            @endif
          </td>

          <td class="header-center">
            <div class="school-name">{{ optional($school)->name ?? 'Arya Public Academy' }}</div>
            <div class="school-meta">
              {{ optional($school)->address ?? 'Kusmara, Jalaun, 205304' }}<br>
              Phone: {{ optional($school)->phone ?? '8127515044' }} |
              Website: {{ optional($school)->website ?? 'www.aryapublicacademy.com' }}
            </div>
          </td>

          <td class="header-logo"></td>
        </tr>
      </table>
    </div>

    <!-- TITLE -->
    <div class="titlebar">
      Academic Performance (Session:
      {{
        is_numeric($annual->year ?? null)
          ? ((int)$annual->year - 1) . '-' . (int)$annual->year
          : ($annual->year ?? ($half->year ?? '2025-2026'))
      }})
    </div>

    <!-- INFO (RESTORED: Mother, DOB, PHOTO) -->
    <table class="info">
      <tr>
        <td class="label">Student's Name</td>
        <td>{{ $student->name ?? '-' }}</td>

        <td class="label">Roll No.</td>
        <td>{{ $student->roll_no ?? '-' }}</td>

        <td class="photo-cell" rowspan="4">
          <div class="photo-box">
            @php
              $photoBase64 = null;
              $relativePath = $student->photo_path ?? null;

              if (!empty($relativePath)) {
                  $photoFile = public_path($relativePath);

                  if (file_exists($photoFile)) {
                      $ext = strtolower(pathinfo($photoFile, PATHINFO_EXTENSION));

                      if (in_array($ext, ['jpg', 'jpeg', 'png','webp'])) {
                          $data = file_get_contents($photoFile);
                          $mime = ($ext === 'jpg') ? 'jpeg' : $ext;
                          $photoBase64 = "data:image/{$mime};base64," . base64_encode($data);
                      }
                  }
              }
            @endphp

            @if($photoBase64)
              <img src="{{ $photoBase64 }}" alt="Student Photo">
            @else
              <div style="font-weight:900;color:#6B7280;padding-top:45px;">PHOTO</div>
            @endif
          </div>
        </td>
      </tr>

      <tr>
        <td class="label">Father's Name</td>
        <td>{{ $student->father_name ?? '-' }}</td>

        <td class="label">Class</td>
        <td>{{ $student->class ?? '-' }}</td>
      </tr>

      <tr>
        <td class="label">Mother's Name</td>
        <td>{{ $student->mother_name ?? '-' }}</td>

        <td class="label">Date of Birth</td>
        <td>
          {{ !empty($student->dob) ? \Carbon\Carbon::parse($student->dob)->format('d-m-Y') : '-' }}
        </td>
      </tr>

      <tr>
        <td class="label">Attendance</td>
        <td colspan="3">{{ $attendance }} (IN DAYS)</td>
      </tr>
    </table>

    <div class="section-gap"></div>

    <!-- MARKS (Half + Annual with Grades) -->
    <table class="marks">
      <thead>
        <tr>
          <th rowspan="2" style="width:28%;">SUBJECT</th>
          <th colspan="3" style="width:36%;">HALF YEARLY</th>
          <th colspan="3" style="width:36%;">ANNUAL</th>
        </tr>
        <tr>
          <th>Marks</th><th>Max</th><th>Grade</th>
          <th>Marks</th><th>Max</th><th>Grade</th>
        </tr>
      </thead>

      <tbody>
        @foreach($subNames as $subName)
          @php
            $hRow = $half?->subjects?->firstWhere('subject', $subName);
            $aRow = $annual?->subjects?->firstWhere('subject', $subName);

            $hm  = (int)($hRow->marks ?? 0);
            $hmx = (int)($hRow->max_marks ?? 0);

            $am  = (int)($aRow->marks ?? 0);
            $amx = (int)($aRow->max_marks ?? 0);

            $totalHalf  += $hm;
            $maxHalf    += $hmx;

            $totalAnnual += $am;
            $maxAnnual   += $amx;
          @endphp

          <tr>
            <td class="subj">{{ $subName }}</td>

            <td>{{ $half ? $hm : '-' }}</td>
            <td>{{ $half ? $hmx : '-' }}</td>
            <td>{{ $half ? $calcGrade($hm, $hmx) : '-' }}</td>

            <td>{{ $annual ? $am : '-' }}</td>
            <td>{{ $annual ? $amx : '-' }}</td>
            <td>{{ $annual ? $calcGrade($am, $amx) : '-' }}</td>
          </tr>
        @endforeach

        <tr class="total-row">
          <td class="subj">TOTAL</td>

          <td>{{ $half ? $totalHalf : '-' }}</td>
          <td>{{ $half ? $maxHalf : '-' }}</td>
          <td>-</td>

          <td>{{ $annual ? $totalAnnual : '-' }}</td>
          <td>{{ $annual ? $maxAnnual : '-' }}</td>
          <td>-</td>
        </tr>
      </tbody>
    </table>

    <div class="section-gap"></div>

    <!-- SUMMARY (keeps PASS/FAIL) -->
    <table class="summary">
      <tr>
        <td class="label2">Annual %</td>
        <td class="value-strong">
          @php
            $annualPerc = $maxAnnual > 0 ? round(($totalAnnual / $maxAnnual) * 100, 2) : 0;
          @endphp
          {{ $annual->percentage ?? $annualPerc }}%
        </td>

        <td class="label2">Result</td>
        <td class="value-strong">
          {{ strtoupper($annual->status ?? ($annualPerc >= 33 ? 'PASS' : 'FAIL')) }}
        </td>

        <td class="label2">Half %</td>
        <td class="value-strong">
          @php
            $halfPerc = $maxHalf > 0 ? round(($totalHalf / $maxHalf) * 100, 2) : 0;
          @endphp
          {{ $half ? ($half->percentage ?? $halfPerc) . '%' : '-' }}
        </td>
      </tr>
    </table>

    @php
      // ✅ Overall % (Weighted by total marks)
      $annualPerc2 = $maxAnnual > 0 ? round(($totalAnnual / $maxAnnual) * 100, 2) : 0;
      $halfPerc2   = $maxHalf > 0 ? round(($totalHalf / $maxHalf) * 100, 2) : 0;

      if ($maxHalf > 0 && $maxAnnual > 0) {
          $overallPerc = round((($totalHalf + $totalAnnual) / ($maxHalf + $maxAnnual)) * 100, 2);
      } elseif ($maxAnnual > 0) {
          $overallPerc = $annualPerc2;
      } elseif ($maxHalf > 0) {
          $overallPerc = $halfPerc2;
      } else {
          $overallPerc = 0;
      }
    @endphp

    <div class="overall-wrap">
      <div class="overall-box">
        Overall %: <span>{{ $overallPerc }}%</span>
      </div>
    </div>

    <div class="section-gap"></div>

    <!-- CO-SCHOLASTIC -->
    <table class="cosch">
      <thead>
        <tr>
          <th style="width:70%;">CO-SCHOLASTIC AREAS</th>
          <th style="width:15%;">TERM-I</th>
          <th style="width:15%;">TERM-II</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Art Education</td>
          <td style="text-align:center;">{{ $artT1 }}</td>
          <td style="text-align:center;">{{ $artT2 }}</td>
        </tr>
        <tr>
          <td>General Awareness</td>
          <td style="text-align:center;">{{ $gaT1 }}</td>
          <td style="text-align:center;">{{ $gaT2 }}</td>
        </tr>
        <tr>
          <td>Health & Physical Education</td>
          <td style="text-align:center;">{{ $hpT1 }}</td>
          <td style="text-align:center;">{{ $hpT2 }}</td>
        </tr>
        <tr>
          <td>Discipline</td>
          <td style="text-align:center;">{{ $disciplineT1 }}</td>
          <td style="text-align:center;">{{ $disciplineT2 }}</td>
        </tr>
      </tbody>
    </table>

    <div class="section-gap"></div>

    <!-- FOOTER (signs blank as you wanted) -->
    <table class="footer">
      <tr>
        <td class="footer-left" style="width:55%;">
          <div><b>Promoted To Class:</b> {{ $promotedTo }}</div>
          <div style="margin-top:6px;"><b>Class Teacher Remarks:</b> {{ $remarks }}</div>
          <div style="margin-top:6px;"><b>Place:</b> {{ optional($school)->city ?? '-' }}</div>

          <div style="margin-top:10px;">
            <b>Class Teacher Sign:</b>
            <div class="signbox"></div>
          </div>
        </td>

        <td class="footer-mid" style="width:20%;">
          <div><b>Date:</b> {{ now()->format('d/m/Y') }}</div>
          <div style="margin-top:10px;"><b>Result:</b> {{ strtoupper($annual->status ?? 'PASS') }}</div>
        </td>

        <td class="footer-right" style="width:25%;">
          <div><b>Principal Sign:</b></div>
          <div class="signbox"></div>
        </td>
      </tr>
    </table>

    <div class="section-gap"></div>

    <!-- GRADING SYSTEM TABLE -->
    <table class="grade-table">
      <tr>
        <th>RANGE</th><th>GRADE</th>
        <th>RANGE</th><th>GRADE</th>
        <th>RANGE</th><th>GRADE</th>
      </tr>
      <tr>
        <td>91-100</td><td>A1</td>
        <td>81-90</td><td>A2</td>
        <td>71-80</td><td>B1</td>
      </tr>
      <tr>
        <td>61-70</td><td>B2</td>
        <td>51-60</td><td>C1</td>
        <td>41-50</td><td>C2</td>
      </tr>
      <tr>
        <td>33-40</td><td>D</td>
        <td colspan="4">E (Needs Improvement)</td>
      </tr>
    </table>

  </div>
</body>
</html>
