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

    .marks th{
      background: var(--accent2);
      border: 1px solid var(--border);
      padding: 7px 6px;
      font-weight: 900;
      text-align: center;
      font-size: 11px;
      color: #1a0b00;
      letter-spacing: 0.2px;
    }

    .marks td{
      border: 1px solid var(--border);
      padding: 6px 6px;
      text-align: center;
      font-size: 11px;
      color: var(--text);
    }

    .marks .subj{
      text-align: left;
      font-weight: 800;
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
      vertical-align: bottom;
      font-size: 11px;
    }

    .footer-left{ background: #EEF2FF; }
    .footer-mid{ background: #ECFEFF; }
    .footer-right{ background: #FFF7ED; }

    .sign{
      text-align: right;
    }

    .sign img{
      max-width: 150px;
      max-height: 45px;
      display: inline-block;
      margin-bottom: 4px;
      border: 1px solid var(--border);
      padding: 3px;
      border-radius: 6px;
      background: #fff;
    }

    .muted{
      font-size: 10px;
      color: var(--muted);
      margin-top: 6px;
    }
  </style>
</head>

<body>
  @php
    // $extra is optional. If controller didn't pass it, this prevents errors.
    $extra = $extra ?? null;

    $attendance = $extra->attendance
      ?? ($result->attendance ?? '-');

    $promotedTo = $extra->promoted_to_class
      ?? ($result->promoted_to ?? ($result->promoted_to_class ?? '-'));

    $remarks = $extra->class_teacher_remarks
      ?? ($result->remarks ?? ($result->class_teacher_remarks ?? '-'));

    // Co-scholastic: if you store only discipline in extras, we show it here.
    // If your old $result->coscholastic exists, it will still work.
    $cosch = $result->coscholastic ?? [];

    // If $result->coscholastic is empty, we show Discipline from extras as fallback.
    $disciplineT1 = $extra->discipline_term1 ?? '-';
    $disciplineT2 = $extra->discipline_term2 ?? '-';
  @endphp

  <div class="sheet">

    <!-- HEADER -->
    <div class="header">
      <table class="header-table">
        <tr>
          <td class="header-logo">
            @php
              $logoPath = public_path('images/school-logo.png');
            @endphp

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
        $result->session
        ?? (
            is_numeric($result->year ?? null)
              ? ((int)$result->year - 1) . '-' . (int)$result->year
              : ($result->year ?? '2025-2026')
          )
      }})
    </div>

    <!-- INFO -->
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

                      if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
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
        <td colspan="3">{{ $attendance }}</td>
      </tr>
    </table>

    <div class="section-gap"></div>

    <!-- MARKS -->
    <table class="marks">
      <thead>
        <tr>
          <th style="width:50%;">SUBJECT</th>
          <th style="width:25%;">MARKS</th>
          <th style="width:25%;">MAX</th>
        </tr>
      </thead>
      <tbody>
        @php
          $total = 0;
          $maxTotal = 0;
        @endphp

        @foreach(($result->subjects ?? []) as $s)
          @php
            $m = (int)($s->marks ?? 0);
            $mx = (int)($s->max_marks ?? 100);
            $total += $m;
            $maxTotal += $mx;
          @endphp
          <tr>
            <td class="subj">{{ $s->subject ?? '-' }}</td>
            <td>{{ $m }}</td>
            <td>{{ $mx }}</td>
          </tr>
        @endforeach

        <tr class="total-row">
          <td class="subj">TOTAL</td>
          <td>{{ $total }}</td>
          <td>{{ $maxTotal }}</td>
        </tr>
      </tbody>
    </table>

    <div class="section-gap"></div>

    <!-- SUMMARY -->
    <table class="summary">
      <tr>
        <td class="label2">Total</td>
        <td class="value-strong">{{ $total }} / {{ $maxTotal }}</td>

        <td class="label2">Percentage</td>
        <td class="value-strong">
          @php
            $percentage = $maxTotal > 0 ? round(($total / $maxTotal) * 100, 2) : 0;
          @endphp
          {{ $result->percentage ?? $percentage }}%
        </td>

        <td class="label2">Result</td>
        <td class="value-strong">{{ strtoupper($result->status ?? 'PASS') }}</td>
      </tr>
    </table>

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
        @foreach(($cosch ?? []) as $c)
          <tr>
            <td>{{ $c['name'] ?? '-' }}</td>
            <td style="text-align:center;">{{ $c['term1'] ?? '-' }}</td>
            <td style="text-align:center;">{{ $c['term2'] ?? '-' }}</td>
          </tr>
        @endforeach

        @if(empty($cosch))
          <tr>
            <td>Discipline</td>
            <td style="text-align:center;">{{ $disciplineT1 }}</td>
            <td style="text-align:center;">{{ $disciplineT2 }}</td>
          </tr>
        @endif
      </tbody>
    </table>

    <div class="section-gap"></div>

    <!-- FOOTER -->
    <table class="footer">
      <tr>
        <td class="footer-left" style="width:55%;">
          <div><b>Promoted To Class:</b> {{ $promotedTo }}</div>
          <div><b>Class Teacher Remarks:</b> {{ $remarks }}</div>
          <div><b>Place:</b> {{ optional($school)->city ?? '-' }}</div>
        </td>

        <td class="footer-mid" style="width:20%;">
          <div><b>Date:</b> {{ $result->result_date ?? now()->format('d/m/Y') }}</div>
          <div style="margin-top:10px;"><b>Result:</b> {{ strtoupper($result->status ?? 'PASS') }}</div>
        </td>

        <td class="footer-right sign" style="width:25%;">
          @php
            $signPath = public_path('signatures/principal.png');
          @endphp

          @if(file_exists($signPath))
            <img src="{{ $signPath }}" alt="Principal Signature">
          @endif
          <div><b>Principal</b></div>
        </td>
      </tr>
    </table>

  </div>
</body>
</html>
