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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Student Information System</title>
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <!-- Welcome Section -->
    <div class="welcome-section">
      <img src="{{ asset('assets/img/Logo Institut Teknologi Del.png') }}" alt="Del Logo">
      <div class="welcome-content">

        <p class="welcome-text">Selamat Datang,</p>
        <div class="container-sis">
          <p class="welcome-text">Di</p>
          <p class="font-sis">SIS</p>
        </div>
        <p class="student-text">Student Information System</p>
      </div>
    </div>

    <!-- Login Section -->
    <div class="login-section">
      <p class="login-heading">SIS</p>
      <p style="text-align: center; color: #ffffff; margin-bottom: 20px; margin-top: -1rem;">Student Information System
      </p>
      <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="nim">NIM</label>
          <div class="input-wrapper">
            <input type="text" id="nim" name="nim" placeholder="Student NIM" required>
            <i class="fas fa-user"></i>
          </div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-wrapper">
            <input type="password" id="password" name="password" placeholder="*******" required>
            <i class="fas fa-lock"></i>
          </div>
        </div>
        <center>
          <button type="submit" class="btn">Login</button>
        </center>
      </form>
    </div>
  </div>
</body>

</html>

