<!DOCTYPE html>
<html lang="en">                
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahle Sunnat Prayer Timings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f9;
            padding: 30px;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #0b5d4b;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        th {
            background: #0b5d4b;
            color: white;
        }
        .city-form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            gap: 10px;
        }
        .city-form input {
            padding: 10px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .city-form button {
            padding: 10px 15px;
            background: #0b5d4b;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .city-form button:hover {
            background: #0d7a64;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ahle Sunnat Prayer Timings - {{ $city }}</h1>
        <form method="GET" action="{{ route('prayer.index') }}" class="city-form">
            <input type="text" name="city" placeholder="Enter city" value="{{ $city }}">
            <button type="submit"><i class="fas fa-search"></i> Search</button>
        </form>

        <p style="text-align:center; color:#555;">Date: {{ $date }}</p>

        @if(!empty($timings))
        <table>
            <tr><th>Prayer</th><th>Time</th></tr>
            <tr><td>Fajr</td><td>{{ $timings['Fajr'] }}</td></tr>
            <tr><td>Sunrise</td><td>{{ $timings['Sunrise'] }}</td></tr>
            <tr><td>Dhuhr</td><td>{{ $timings['Dhuhr'] }}</td></tr>
            <tr><td>Asr</td><td>{{ $timings['Asr'] }}</td></tr>
            <tr><td>Maghrib</td><td>{{ $timings['Maghrib'] }}</td></tr>
            <tr><td>Isha</td><td>{{ $timings['Isha'] }}</td></tr>
        </table>
        @else
        <p style="text-align:center; color:red;">Prayer timings not available</p>
        @endif
    </div>
</body>
</html>
