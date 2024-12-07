<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff; /* Light background color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff; /* White background for the form */
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 6px 15px rgba(0, 111, 255, 0.25); /* Soft blue shadow */
            width: 100%;
            max-width: 400px;
        }
        .login-container img {
            width: 80px;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 7px;
            background-color: #D3E4FB; /* Light blue background for input fields */
            border: 1px solid #ccc;
            padding: 12px;
        }
        .form-check-label {
            color: #333; /* Dark text color for labels */
        }
        button {
            border-radius: 7px;
            background-color: #007BFF; /* Blue button */
            border: none;
            color: white;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            margin-top: 20px;
        }
        button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="login-container text-center">
        <h1>LOGIN</h1>
        <img src="/img/del.png" alt="Logo" class="mb-3">
        <p class="text-muted mb-3">Sistem Informasi Orangtua</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-check mb-3 text-start">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <button type="submit">Sign In</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
