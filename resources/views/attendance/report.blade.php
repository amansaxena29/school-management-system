<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 40px 15px;
        }

        .report-container {
            max-width: 900px;
            margin: auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .report-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .report-header h2 {
            font-size: 30px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .report-header p {
            font-size: 15px;
            color: #666;
        }

        .report-header span {
            font-weight: 600;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 12px;
        }

        thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        thead th {
            color: #fff;
            padding: 14px;
            text-align: left;
            font-size: 15px;
            letter-spacing: 0.3px;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:nth-child(even) {
            background: #f9f9fb;
        }

        tbody tr:hover {
            background: #eef1ff;
        }

        tbody td {
            padding: 14px;
            font-size: 15px;
            color: #333;
        }

        .status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            text-align: center;
        }

        .present {
            background: #e6f7ef;
            color: #1e8e5a;
        }

        .absent {
            background: #fdecea;
            color: #d93025;
        }

        .not-marked {
            background: #fff4e5;
            color: #b26a00;
        }
            
        .footer-note {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #777;
        }

        @media (max-width: 600px) {
            thead {
                display: none;
            }

            table, tbody, tr, td {
                display: block;
                width: 100%;
            }

            tbody tr {
                margin-bottom: 15px;
                border-radius: 12px;
                background: #fff;
                box-shadow: 0 10px 25px rgba(0,0,0,0.08);
                padding: 10px;
            }

            tbody td {
                padding: 10px;
                text-align: right;
                position: relative;
            }

            tbody td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: 600;
                color: #666;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<div class="report-container">
    <div class="report-header">
        <h2>📋 Attendance Report</h2>
        <p>
            <span>Class:</span> {{ $class }} &nbsp; | &nbsp;
            <span>Date:</span> {{ $date }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Student Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td data-label="Roll No">{{ $student->roll_no }}</td>
                <td data-label="Student Name">{{ $student->name }}</td>
                <td data-label="Status">
                    @if(isset($attendance[$student->id]))
                        @if($attendance[$student->id]->status == 'Present')
                            <span class="status present">Present</span>
                        @else
                            <span class="status absent">Absent</span>
                        @endif
                    @else
                        <span class="status not-marked">Not Marked</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-note">
        Arya School Management System
    </div>
</div>

</body>
</html>
