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
            background-color: #E7FAFF; /* White background for the form */
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
            padding: 6px;
        }
        .form-check-label {
            color: #333; /* Dark text color for labels */
        }
        button {
            border-radius: 7px;
            background-color: #5AADC2; /* green button */
            border: none;
            color: white;
            padding: 7px;
            width: 60%;
            font-size: 16px;
            margin-top: 20px;
        }
        button:hover {
            background-color: #4F9CAF; /* Darker green on hover */
        }

        .alert {
            border-radius: 8px;
            font-size: 14px;
            padding: 15px 20px;
        }

        .alert-heading {
            font-size: 18px;
            font-weight: bold;
        }

        .alert ul {
            padding-left: 20px;
        }

    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="w-100" style="max-width: 400px;">
        <!-- Error Message -->
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Error</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Login Container -->
        <div class="login-container text-center">
            <h1>LOGIN</h1>
            <img src="/img/del.png" alt="Logo" class="mb-3">
            <p class="text-muted mb-3">Sistem Informasi Orangtua</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-0 text-start">
                    <label for="nama" class="form-label">Username :</label>
                </div>
                <div class="mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="" required>
                </div>
                <div class="mb-0 text-start">
                    <label for="nama" class="form-label">Password :</label>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="" required>
                </div>
                <div class="form-check mb-3 text-start">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
