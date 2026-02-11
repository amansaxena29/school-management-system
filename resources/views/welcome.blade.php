<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arya Public Academy</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            height: 100vh;
            background:
                linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
                url("{{ asset('images/banner.jpg') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            color: #fff;
        }

        .container h1 {
            font-size: 26px;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .container p {
            font-size: 14px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            margin: 12px 0;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #fff;
        }

        .btn-login {
            background: #2563eb;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .btn-register {
            background: transparent;
            border: 2px solid #fff;
        }

        .btn-register:hover {
            background: #fff;
            color: #000;
        }

        footer {
            position: absolute;
            bottom: 20px;
            color: #fff;
            font-size: 12px;
            opacity: 0.7;
        }

        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Arya Public Academy</h1>
        <p>Admin Login & Management Portal</p>

        <a href="{{ route('login') }}" class="btn btn-login">Login</a>

        <a href="{{ route('register') }}" class="btn btn-register">Register</a>
    </div>

    <footer>
        © {{ date('Y') }} Arya Public Academy
    </footer>

</body>
</html>
