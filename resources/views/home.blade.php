<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .sign-in-section {
            margin-top: 20px;
        }

        .sign-in-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #17a2b8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .sign-in-btn:hover {
            background-color: #117a8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Website</h1>
        <a class="btn" href="{{ route('register') }}">Create Account</a>
        <div class="sign-in-section">
            <p>Already have an account?</p>
            <a class="sign-in-btn" href="{{ route('login') }}">Sign in</a>
        </div>
    </div>
</body>
</html>
