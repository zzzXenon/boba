<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 600px;
            display: flex;
            flex-direction: row;
            align-items: center;
        }
        .info {
            flex: 3;
            padding: 10px;
        }
        .info h3 {
            margin-top: 0;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .info p {
            margin: 5px 0;
            background: #e7f3fe;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .photo {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ddd;
            border-radius: 10px;
            width: 100px;
            height: 100px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="info">
            <h3>Data Mahasiswa</h3>
            <p><strong>Nama:</strong> {{ $student['name'] }}</p>
            <p><strong>Angkatan:</strong> {{ $student['batch'] }}</p>
            <p><strong>NIM:</strong> {{ $student['nim'] }}</p>
            <p><strong>Username:</strong> {{ $student['username'] }}</p>
            <p><strong>Email Akademik:</strong> {{ $student['email'] }}</p>
            <p><strong>Kelas:</strong> {{ $student['class'] }}</p>
            <p><strong>Program Studi:</strong> {{ $student['program'] }}</p>
            <p><strong>Wali Kelas:</strong> {{ $student['mentor'] }}</p>
        </div>
        <div class="photo">
            foto profil mahasiswa
        </div>
    </div>
</body>
</html>
