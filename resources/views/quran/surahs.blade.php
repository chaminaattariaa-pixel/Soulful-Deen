<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al-Quran - Surahs</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root{
            --primary:#0ea5a4;
            --light:#e6f7f7;
            --text:#0f172a;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
        }
        
        .container {
            max-width: 1100px;
            margin: auto;
            padding: 40px 20px;
        }
        
        h1 {
            color: var(--text);
            text-align: center;
            margin-bottom: 40px;
            font-weight: 600;
        }
        
        .surah-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .surah-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: var(--text);
            display: block;
        }
        
        .surah-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            text-decoration: none;
            color: var(--text);
        }
        
        .surah-number {
            background: var(--primary);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .surah-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .surah-name-arabic {
            font-size: 1.8rem;
            font-family: 'Amiri', serif;
            direction: rtl;
            margin-bottom: 10px;
            color: var(--primary);
        }
        
        .surah-info {
            color: #64748b;
            font-size: 0.9rem;
        }
        
        .surah-info i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📖 Select a Surah</h1>
        
        <div class="surah-grid">
            @foreach($surahs as $surah)
                <a href="{{ route('quran.surah', ['surahNumber' => $surah['number']]) }}" class="surah-card">
                    <div class="surah-number">{{ $surah['number'] }}</div>
                    <div class="surah-name">{{ $surah['englishName'] }}</div>
                    <div class="surah-name-arabic">{{ $surah['name'] }}</div>
                    <div class="surah-info">
                        <i class="fas fa-book"></i> {{ $surah['numberOfAyahs'] }} Ayahs
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</body>
</html>