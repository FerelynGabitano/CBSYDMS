<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batang Surigaonon Youth - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: rgb(176, 190, 241);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-size: cover;
            background-position: center;
        }

        .container {
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            background-color: white;
        }

        .login-form {
            padding: 40px 30px;
        }

        .login-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 25px;
        }

        .login-form h2 {
            color: #1C0BA3;
            text-align: center;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.95rem;
            transition: border 0.3s;
        }

        .form-group input:focus {
            border-color: #1C0BA3;
            outline: none;
            box-shadow: 0 0 0 2px rgba(28, 11, 163, 0.2);
        }

        .btn {
            background-color: #1C0BA3;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #12067a;
            transform: translateY(-2px);
        }

        .links {
            margin-top: 20px;
            text-align: center;
        }

        .links a {
            color: #1C0BA3;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
            transition: color 0.3s;
            display: inline-block;
            margin-top: 15px;
        }

        .links a:hover {
            color: #f1c40f;
            text-decoration: underline;
        }

        .logo {
            width: 120px;
            height: 120px;
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        @media (max-width: 480px) {
            .login-form {
                padding: 30px 20px;
            }

            .login-form h2 {
                font-size: 1.5rem;
            }

            .logo {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-form">
            <div class="login-header">
                <div class="logo">
                    <img src="{{ asset('images/BSYLogo.png') }}" alt="BSY Logo" />
                </div>
                <h2>Login</h2>
            </div>
            <form method="GET" action="/login">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <div class="links">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
</body>

</html>