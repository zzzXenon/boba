<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Pelanggaran</title>
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
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #3a81f1;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:nth-child(odd) {
            background-color: #ffffff;
        }
        td {
            background-color: #eef6ff;
            color: #333;
        }
        .button {
            background-color: #3a81f1;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }
        .button:hover {
            background-color: #2d6dc7;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Pelanggaran</th>
                <th>Poin</th>
                <th>Status Pelanggaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mencuri Laptop yang bukan miliknya</td>
                <td>75</td>
                <td>
                    kasus sedang diproses oleh kemahasiswaan <br>
                    <button class="button">Lihat</button>
                </td>
            </tr>
            <tr>
                <td>Bermesraan dengan lawan jenis</td>
                <td>50</td>
                <td>
                    Kasus Selesai <br>
                    <button class="button">Lihat</button>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
