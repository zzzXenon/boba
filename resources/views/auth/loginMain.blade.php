<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Main</title>
    <!-- Add any CSS libraries if needed -->
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 100px;
        }
        .btn {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            font-size: 16px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to our Website</h1>
        <p>Please select your login type:</p>
        <div>
            <a href="{{ route('login.Ortu') }}" class="btn">Orang Tua</a>
            <a href="{{ route('login.keasramaan') }}" class="btn">Keasramaan</a>
            <a href="{{ route('login.kemahasiswaan') }}" class="btn">Kemahasiswaan</a>
            <a href="{{ route('login.dosen') }}" class="btn">Dosen</a>
        </div>
    </div>
</body>
</html>
