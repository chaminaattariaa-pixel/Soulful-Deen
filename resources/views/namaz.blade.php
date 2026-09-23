<!DOCTYPE html>
<html>
<head>
    <title>Namaz Timings</title>
</head>
<body>

<h2>Namaz Timings – {{ $city }}</h2>
<p>Date: {{ $date }}</p>

<ul>
    <li>Fajr: {{ $timings['Fajr'] }}</li>
    <li>Dhuhr: {{ $timings['Dhuhr'] }}</li>
    <li>Asr: {{ $timings['Asr'] }}</li>
    <li>Maghrib: {{ $timings['Maghrib'] }}</li>
    <li>Isha: {{ $timings['Isha'] }}</li>
</ul>

</body>
</html>
