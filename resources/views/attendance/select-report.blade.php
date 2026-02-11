<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Attendance Report</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .attendance-card {
            background: rgba(255, 255, 255, 0.95);
            width: 380px;
            padding: 35px 30px;
            border-radius: 18px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            text-align: center;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .attendance-card h2 {
            margin-bottom: 8px;
            color: #333;
            font-size: 26px;
            font-weight: 700;
        }

        .attendance-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 600;
            color: #555;
        }

        select,
        input[type="date"] {
            width: 100%;
            padding: 12px 14px;
            font-size: 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            outline: none;
            transition: all 0.3s ease;
        }

        select:focus,
        input[type="date"]:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }

        .btn {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            color: #fff;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(118, 75, 162, 0.4);
        }

        .footer-text {
            margin-top: 18px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="attendance-card">
        <h2>📊 Attendance Report</h2>
        <p>Select class & date to view attendance</p>

        <form method="GET" action="{{ url('/attendance/report') }}">

            <div class="form-group">
                <label>Select Class</label>
                <select name="class" required>
                    <option value="">-- Choose Class --</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}th">{{ $i }}th</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label>Select Date</label>
                <input type="date" name="date" required>
            </div>

            <button type="submit" class="btn">
                View Attendance →
            </button>
        </form>

        <div class="footer-text">
            Arya School Management System
        </div>
    </div>

</body>
</html>
