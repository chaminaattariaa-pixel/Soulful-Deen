@extends('layouts')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800;900&family=Scheherazade+New:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --primary: #0d4c3e;
    --gold: #f1c40f;
    --secondary: #1abc9c;
    --dark: #1a252f;
    --gradient-primary: linear-gradient(135deg, #0d4c3e 0%, #1abc9c 100%);
    --gradient-gold: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
}
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Poppins',sans-serif; background: linear-gradient(135deg,#0c3529 0%,#186d53 100%); min-height:100vh; color:#333; }

/* NAVBAR */
.navbar { position:fixed; top:0; left:0; width:100%; background:rgba(13,76,62,.97); backdrop-filter:blur(15px); z-index:1000; border-bottom:2px solid rgba(241,196,15,.3); padding:15px 0; }
.navbar-brand { font-size:1.8rem; font-weight:900; color:#fff; text-decoration:none; display:flex; align-items:center; gap:12px; }
.navbar-brand img { height:50px; border-radius:50%; border:3px solid var(--gold); box-shadow:0 0 20px rgba(241,196,15,.5); }
.navbar-brand span { background:linear-gradient(45deg,#fff,var(--gold)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.nav-links { display:flex; gap:25px; list-style:none; align-items:center; margin:0; }
.nav-links a { color:#fff; text-decoration:none; font-weight:600; transition:all .3s; padding:6px 0; font-size:15px; display:flex; align-items:center; gap:7px; position:relative; }
.nav-links a i { color:var(--gold); }
.nav-links a:hover { color:var(--gold); transform:translateY(-2px); }
.nav-links a.active { color:var(--gold); }

.page-wrap { min-height:100vh; padding-top:90px; padding-bottom:60px; }

/* HERO */
.hadith-hero { background:linear-gradient(rgba(13,76,62,.88),rgba(13,76,62,.92)), url('https://images.unsplash.com/photo-1585036156171-384164a8c675?w=1600') center/cover; padding:70px 40px 60px; text-align:center; color:#fff; border-bottom:3px solid rgba(241,196,15,.4); position:relative; }
.hadith-hero-bismillah { font-family:'Scheherazade New','Amiri',serif; font-size:3.2rem; color:var(--gold); text-shadow:0 2px 20px rgba(241,196,15,.5); margin-bottom:12px; line-height:1.4; }
.hadith-hero h1 { font-size:3rem; font-weight:900; background:linear-gradient(45deg,#fff 30%,var(--gold) 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; margin-bottom:10px; }
.hadith-hero p { font-size:1.15rem; color:rgba(255,255,255,.85); max-width:650px; margin:0 auto; line-height:1.7; }

/* BOOKS GRID */
.books-section { max-width:1400px; margin:0 auto; padding:50px 30px; }
.section-title { text-align:center; color:#fff; margin-bottom:40px; }
.section-title h2 { font-size:2rem; font-weight:800; color:var(--gold); margin-bottom:8px; }
.section-title p { color:rgba(255,255,255,.7); font-size:1rem; }

.books-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(320px,1fr)); gap:26px; }

.book-card {
    background:rgba(255,255,255,.07);
    backdrop-filter:blur(20px);
    border-radius:24px;
    border:1.5px solid rgba(255,255,255,.15);
    overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,.35);
    transition:all .4s cubic-bezier(.4,0,.2,1);
    cursor:pointer;
    display:flex; flex-direction:column;
    text-decoration:none;
}
.book-card:hover { transform:translateY(-8px); border-color:rgba(241,196,15,.5); box-shadow:0 30px 80px rgba(241,196,15,.15); }

.book-card-top {
    background:var(--gradient-primary);
    padding:26px 24px 20px;
    border-bottom:2px solid rgba(241,196,15,.3);
    position:relative;
    overflow:hidden;
}
.book-card-top::before {
    content:''; position:absolute; inset:0;
    background:radial-gradient(circle at 80% 20%, rgba(241,196,15,.15) 0%, transparent 60%);
}
.book-num-badge {
    position:absolute; top:20px; right:20px;
    width:38px; height:38px; border-radius:50%;
    background:rgba(241,196,15,.2);
    border:1.5px solid rgba(241,196,15,.5);
    display:flex; align-items:center; justify-content:center;
    color:var(--gold); font-weight:800; font-size:14px;
    z-index:2;
}
.book-arabic {
    font-family:'Scheherazade New','Amiri',serif;
    font-size:2.4rem; color:var(--gold);
    direction:rtl; line-height:1.3;
    text-shadow:0 2px 15px rgba(241,196,15,.4);
    position:relative; z-index:2;
    margin-bottom:6px;
}
.book-english {
    color:#fff; font-size:1.3rem; font-weight:800;
    position:relative; z-index:2; margin-bottom:2px;
}
.book-author { color:rgba(255,255,255,.7); font-size:13px; position:relative; z-index:2; }

.book-card-body { padding:22px 24px 24px; flex:1; display:flex; flex-direction:column; }
.book-desc { color:rgba(255,255,255,.72); font-size:13.5px; line-height:1.7; margin-bottom:18px; flex:1; }
.book-stats { display:flex; gap:16px; margin-bottom:18px; }
.stat-item { flex:1; background:rgba(255,255,255,.06); border-radius:12px; padding:10px 12px; border:1px solid rgba(255,255,255,.1); }
.stat-label { color:rgba(255,255,255,.5); font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
.stat-value { color:var(--gold); font-size:17px; font-weight:800; }
.reliability-chip {
    display:inline-block; padding:5px 12px; border-radius:20px;
    background:rgba(46,204,113,.15); border:1px solid rgba(46,204,113,.4);
    color:#2ecc71; font-size:11px; font-weight:700;
    margin-bottom:16px;
}
.read-btn {
    display:flex; align-items:center; justify-content:center; gap:10px;
    padding:13px 22px; border-radius:50px;
    background:var(--gradient-gold);
    color:var(--dark); font-weight:800; font-size:14px;
    border:none; cursor:pointer; transition:all .3s;
    font-family:'Poppins',sans-serif; text-decoration:none;
    margin-top:auto;
}
.read-btn:hover { transform:translateY(-3px); box-shadow:0 12px 35px rgba(241,196,15,.45); }

@media (max-width:600px) {
    .hadith-hero { padding:50px 20px 40px; }
    .hadith-hero-bismillah { font-size:2.3rem; }
    .hadith-hero h1 { font-size:2rem; }
    .books-section { padding:30px 15px; }
    .books-grid { grid-template-columns:1fr; }
}
</style>

<nav class="navbar">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/" class="navbar-brand">
            <img src="/images/logo.jpeg" alt="Logo">
            <span>Soulful Deen</span>
        </a>
        <ul class="nav-links">
            <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="/quran/surahs"><i class="fas fa-book-quran"></i> Quran</a></li>
            <li><a href="/hadith" class="active"><i class="fas fa-book-open"></i> Hadith</a></li>
            <li><a href="/chat"><i class="fas fa-robot"></i> AI Bot</a></li>
            <li><a href="/profile"><i class="fas fa-user"></i> Profile</a></li>
        </ul>
    </div>
</nav>

<div class="page-wrap">

    <div class="hadith-hero">
        <div class="hadith-hero-bismillah">وَمَا آتَاكُمُ الرَّسُولُ فَخُذُوهُ</div>
        <h1>The Six Authentic Hadith Books</h1>
        <p>Al-Kutub as-Sittah — the most trusted collections of the Prophet's ﷺ Sunnah, read with Arabic text and English translation</p>
    </div>

    <div class="books-section">
        <div class="section-title">
            <h2>The Six Books (الكتب الستة)</h2>
            <p>Click any book to begin reading</p>
        </div>

        <div class="books-grid">
            @foreach($books as $i => $b)
                <a href="{{ route('hadith.show', $b['slug']) }}" class="book-card">
                    <div class="book-card-top">
                        <div class="book-num-badge">{{ $i + 1 }}</div>
                        <div class="book-arabic">{{ $b['arabic'] }}</div>
                        <div class="book-english">{{ $b['name'] }}</div>
                        <div class="book-author">{{ $b['author'] }}</div>
                    </div>
                    <div class="book-card-body">
                        <div class="reliability-chip"><i class="fas fa-check-circle"></i> {{ $b['reliability'] }}</div>
                        <p class="book-desc">{{ $b['description'] }}</p>
                        <div class="book-stats">
                            <div class="stat-item">
                                <div class="stat-label">Hadiths</div>
                                <div class="stat-value">{{ number_format($b['total_hadiths']) }}</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Chapters</div>
                                <div class="stat-value">{{ $b['total_books'] }}</div>
                            </div>
                        </div>
                        <span class="read-btn"><i class="fas fa-book-open"></i> Read Book</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection