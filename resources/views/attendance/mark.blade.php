<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Sheet</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .attendance-card {
            background: #ffffff;
            width: 90%;
            max-width: 900px;
            border-radius: 18px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.25);
            padding: 30px;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            font-size: 26px;
            color: #333;
        }

        .header span {
            font-size: 14px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table thead {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        table th, table td {
            padding: 14px;
            text-align: center;
        }

        table tbody tr {
            border-bottom: 1px solid #eee;
            transition: background 0.3s;
        }

        table tbody tr:hover {
            background: #f5f7ff;
        }

        select {
            padding: 8px 14px;
            border-radius: 20px;
            border: 1px solid #ccc;
            font-weight: 600;
            outline: none;
            cursor: pointer;
            transition: 0.3s;
        }

        select[value="Present"] {
            color: green;
        }

        select[value="Absent"] {
            color: red;
        }

        .save-btn {
            margin-top: 25px;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.25);
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: #888;
        }

        @media(max-width: 600px) {
            table th, table td {
                padding: 10px;
                font-size: 14px;
            }

            .header h2 {
                font-size: 20px;
            }
        }

        .change-btn {
            padding: 10px 18px;
            border-radius: 20px;
            background: #f3f4f6;
            color: #4f46e5;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid #d1d5db;
            transition: 0.3s;
        }

        .change-btn:hover {
            background: #4f46e5;
            color: white;
        }

    </style>
</head>

<body>

        <div class="attendance-card">

            <div class="header">
            <div>
                <h2>📋 Attendance Sheet</h2>
                <span>Class: <strong>{{ $class }}</strong> | Date: <strong>{{ $date }}</strong></span>
            </div>

            <a href="{{ url('/attendance') }}" class="change-btn">
                🔄 Change Class
            </a>
        </div>


    <form method="POST" action="{{ url('/attendance/store') }}">
        @csrf

        <input type="hidden" name="date" value="{{ $date }}">

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
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->name }}</td>
                    <td>
                        <select name="attendance[{{ $student->id }}]">
                            <option value="Present"
                                {{ isset($attendance[$student->id]) && $attendance[$student->id]->status == 'Present' ? 'selected' : '' }}>
                                ✅ Present
                            </option>

                            <option value="Absent"
                                {{ isset($attendance[$student->id]) && $attendance[$student->id]->status == 'Absent' ? 'selected' : '' }}>
                                ❌ Absent
                            </option>
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="save-btn">
            💾 Save Attendance
        </button>
    </form>

    <div class="footer">
        Arya School Management System • Attendance Module
    </div>

</div>

</body>
</html>
