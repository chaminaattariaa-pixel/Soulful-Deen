@extends('layouts')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

{{-- @formatter:off --}}
<style>
:root {
    --primary: #0d4c3e;
    --secondary: #1abc9c;
    --gold: #f1c40f;
    --emerald: #2ecc71;
    --dark: #1a252f;
    --gradient-primary: linear-gradient(135deg, #0d4c3e 0%, #1abc9c 100%);
    --gradient-gold: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
    --gradient-emerald: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0c3529 0%, #186d53 100%);
    min-height: 100vh;
    color: #333;
    overflow-x: hidden;
}

/* NAVBAR */
.admin-navbar {
    position: fixed; top: 0; left: 0; width: 100%;
    background: rgba(13, 76, 62, 0.95);
    backdrop-filter: blur(15px);
    z-index: 1000;
    border-bottom: 2px solid rgba(241, 196, 15, 0.3);
    padding: 15px 0;
    transition: all 0.4s ease;
}
.admin-navbar.scrolled {
    background: rgba(13, 76, 62, 0.98);
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    padding: 10px 0;
}
.admin-navbar .container { display: flex; justify-content: space-between; align-items: center; }
.navbar-brand {
    font-size: 1.6rem; font-weight: 900;
    color: #fff; text-decoration: none;
    display: flex; align-items: center; gap: 12px;
}
.navbar-brand img {
    height: 50px; border-radius: 50%;
    border: 3px solid var(--gold);
    box-shadow: 0 0 20px rgba(241,196,15,0.5);
}
.navbar-brand span {
    background: linear-gradient(45deg, #fff, var(--gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.admin-nav-links {
    display: flex; gap: 25px; list-style: none; margin: 0;
}
.admin-nav-links a {
    color: #fff; text-decoration: none;
    font-weight: 600; font-size: 14px;
    display: flex; align-items: center; gap: 8px;
    padding: 6px 0; transition: all 0.3s ease;
    position: relative;
}
.admin-nav-links a i { color: var(--gold); }
.admin-nav-links a::after {
    content: ''; position: absolute;
    bottom: 0; left: 0; width: 0; height: 2px;
    background: var(--gold); transition: width 0.3s ease;
}
.admin-nav-links a:hover { color: var(--gold); }
.admin-nav-links a:hover::after { width: 100%; }

/* HERO */
.admin-hero {
    min-height: 40vh;
    position: relative;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 160px 40px 60px;
    overflow: hidden;
}
.admin-hero-bg {
    position: absolute; inset: 0;
    background:
        linear-gradient(rgba(13, 76, 62, 0.92), rgba(26, 188, 156, 0.78)),
        url('https://static.vecteezy.com/system/resources/thumbnails/035/912/156/small_2x/ai-generated-beautiful-view-of-worship-mosque-building-in-bright-day-photo.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    z-index: 1;
}
.admin-hero-overlay {
    position: absolute; inset: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(241,196,15,0.3) 0%, transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(46,204,113,0.2) 0%, transparent 40%);
    animation: pulseOverlay 12s ease-in-out infinite alternate;
    z-index: 2;
}
@keyframes pulseOverlay { 0% { opacity: .6; } 100% { opacity: 1; } }

.admin-hero-content { position: relative; z-index: 3; max-width: 900px; }
.admin-hero-content h1 {
    font-size: 3.5rem; font-weight: 900;
    margin-bottom: 15px;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: textGlow 3s ease-in-out infinite;
}
@keyframes textGlow {
    0%, 100% { filter: brightness(1) drop-shadow(0 0 20px rgba(241,196,15,.3)); }
    50% { filter: brightness(1.2) drop-shadow(0 0 30px rgba(241,196,15,.5)); }
}
.admin-hero-content p {
    font-size: 1.15rem;
    color: rgba(255,255,255,0.95);
    line-height: 1.7;
    margin-bottom: 25px;
}
.admin-badge {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 10px 26px; border-radius: 50px;
    background: rgba(241,196,15,0.2);
    border: 2px solid rgba(241,196,15,0.5);
    color: var(--gold);
    font-weight: 800; font-size: 13px;
    letter-spacing: 1.5px; text-transform: uppercase;
}

/* SECTION */
.admin-section { padding: 60px 40px 80px; max-width: 1400px; margin: 0 auto; }
.welcome-box {
    background: linear-gradient(135deg, rgba(243,156,18,0.15), rgba(46,204,113,0.15));
    border: 2px solid rgba(241,196,15,0.35);
    border-radius: 24px;
    padding: 32px 40px;
    margin-bottom: 45px;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 25px;
    flex-wrap: wrap;
}
.welcome-box h2 {
    font-size: 1.6rem; font-weight: 900; margin-bottom: 6px;
    display: flex; align-items: center; gap: 12px;
}
.welcome-box h2 i { color: var(--gold); }
.welcome-box p { color: rgba(255,255,255,0.85); font-size: 15px; }
.welcome-box p strong { color: var(--gold); }
.wb-stats {
    display: flex; gap: 20px; flex-wrap: wrap;
}
.wb-chip {
    padding: 14px 22px;
    background: rgba(0,0,0,0.25);
    border-radius: 14px;
    border-left: 4px solid var(--gold);
    text-align: center;
}
.wb-chip .wb-num { font-size: 1.8rem; font-weight: 900; color: #fff; line-height: 1; }
.wb-chip .wb-lbl {
    font-size: 11px; color: var(--gold);
    text-transform: uppercase; letter-spacing: 1.5px;
    font-weight: 800; margin-top: 4px;
}

.section-title {
    text-align: center;
    margin-bottom: 40px;
}
.section-title h2 {
    font-size: 2rem; font-weight: 900; color: #fff; margin-bottom: 10px;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.section-title p { color: rgba(255,255,255,0.85); font-size: 1rem; }

/* ADMIN CARDS GRID */
.admin-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}
.admin-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 24px;
    padding: 35px 30px;
    color: #fff;
    text-decoration: none;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    animation: fadeInUp 0.7s ease forwards;
    animation-delay: calc(var(--i, 0) * 0.08s);
    opacity: 0;
}
.admin-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 5px;
    background: var(--gradient-gold);
    transform: scaleX(0);
    transition: transform 0.5s ease;
    transform-origin: left;
}
.admin-card:hover::before { transform: scaleX(1); }
.admin-card:hover {
    transform: translateY(-10px);
    background: rgba(255,255,255,0.2);
    border-color: var(--gold);
    box-shadow: 0 25px 60px rgba(0,0,0,0.4);
    color: #fff;
}
.admin-card .ac-icon {
    font-size: 46px;
    display: inline-block;
    margin-bottom: 15px;
    filter: drop-shadow(0 4px 12px rgba(0,0,0,0.35));
    transition: transform 0.5s ease;
}
.admin-card:hover .ac-icon { transform: scale(1.15) rotate(-5deg); }
.admin-card h3 {
    font-size: 1.35rem;
    font-weight: 800;
    color: var(--gold);
    margin-bottom: 10px;
}
.admin-card p {
    font-size: 14px;
    line-height: 1.7;
    color: rgba(255,255,255,0.85);
    margin-bottom: 20px;
    flex-grow: 1;
}
.admin-card .ac-link {
    display: inline-flex; align-items: center; gap: 8px;
    font-weight: 800; font-size: 13px;
    color: var(--gold);
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: gap 0.3s ease;
    margin-top: auto;
}
.admin-card:hover .ac-link { gap: 16px; }

/* DANGER CARD */
.admin-card.danger::before { background: linear-gradient(135deg, #e74c3c, #c0392b); }
.admin-card.danger h3 { color: #ff8a80; }
.admin-card.danger .ac-link { color: #ff8a80; }

/* ANIMATIONS */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px) scale(0.96); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .admin-hero-content h1 { font-size: 2.6rem; }
    .section-title h2 { font-size: 1.7rem; }
}
@media (max-width: 768px) {
    .admin-nav-links { display: none; }
    .admin-hero { padding: 130px 20px 50px; }
    .admin-hero-content h1 { font-size: 2rem; }
    .admin-hero-content p { font-size: 1rem; }
    .admin-section { padding: 40px 15px 60px; }
    .welcome-box { padding: 25px 22px; flex-direction: column; align-items: flex-start; }
    .wb-stats { width: 100%; }
    .wb-chip { flex: 1; padding: 12px 15px; }
    .wb-chip .wb-num { font-size: 1.4rem; }
    .admin-card { padding: 28px 22px; }
    .admin-card .ac-icon { font-size: 38px; }
    .admin-card h3 { font-size: 1.15rem; }
}
</style>
{{-- @formatter:on --}}

<!-- ================= ADMIN NAVBAR ================= -->
<nav class="admin-navbar">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
            <span>Soulful Deen</span>
        </a>
        <ul class="admin-nav-links">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.ayat.create') }}"><i class="fas fa-book-quran"></i> Ayat</a></li>
            <li><a href="{{ route('admin.hadees.create') }}"><i class="fas fa-scroll"></i> Hadees</a></li>
            <li><a href="{{ route('admin.quran.upload.form') }}"><i class="fas fa-upload"></i> Quran</a></li>
            <li><a href="{{ route('admin.hadith.upload.form') }}"><i class="fas fa-cloud-upload-alt"></i> Hadith</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:#fff;font-family:'Poppins';font-weight:600;font-size:14px;cursor:pointer;display:flex;align-items:center;gap:8px;padding:6px 0;">
                        <i class="fas fa-sign-out-alt" style="color:#f1c40f;"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<!-- ================= HERO ================= -->
<section class="admin-hero">
    <div class="admin-hero-bg"></div>
    <div class="admin-hero-overlay"></div>
    <div class="admin-hero-content">
        <h1>Admin Dashboard</h1>
        <p>Manage content, ayats, hadees and platform resources for Soulful Deen</p>
        <span class="admin-badge">
            <i class="fas fa-shield-halved"></i> Administrator Access
        </span>
    </div>
</section>

<!-- ================= CONTENT ================= -->
<section class="admin-section">

    {{-- WELCOME --}}
    <div class="welcome-box">
        <div>
            <h2><i class="fas fa-hand-sparkles"></i> Welcome back, {{ auth()->user()->name }}</h2>
            <p>You are logged in as <strong>{{ auth()->user()->email }}</strong>. Choose a section below to begin.</p>
        </div>
        <div class="wb-stats">
            <div class="wb-chip">
                <div class="wb-num">{{ \App\Models\QuranVerse::count() ?? 0 }}</div>
                <div class="wb-lbl">Ayat</div>
            </div>
            <div class="wb-chip">
                <div class="wb-num">{{ \App\Models\Hadith::count() ?? 0 }}</div>
                <div class="wb-lbl">Hadees</div>
            </div>
            <div class="wb-chip">
                <div class="wb-num">{{ \App\Models\User::count() ?? 0 }}</div>
                <div class="wb-lbl">Users</div>
            </div>
        </div>
    </div>

    {{-- SECTION TITLE --}}
    <div class="section-title">
        <h2>Content Management</h2>
        <p>Add, edit and manage all Islamic content on the platform</p>
    </div>

    {{-- CARDS GRID --}}
    <div class="admin-grid">

        {{-- AYAT --}}
        <a href="{{ route('admin.ayat.create') }}" class="admin-card" data-i="0">
            <span class="ac-icon">📖</span>
            <h3>Manage Ayat</h3>
            <p>Add or update daily Quranic verses with Arabic, Urdu, English translations and reference.</p>
            <span class="ac-link">Open Ayat Panel <i class="fas fa-arrow-right"></i></span>
        </a>

        {{-- HADEES --}}
        <a href="{{ route('admin.hadees.create') }}" class="admin-card" data-i="1">
            <span class="ac-icon">📜</span>
            <h3>Manage Hadees</h3>
            <p>Add authentic hadith with narrator, book, reference and multilingual translations.</p>
            <span class="ac-link">Open Hadees Panel <i class="fas fa-arrow-right"></i></span>
        </a>

        {{-- QURAN UPLOAD --}}
        <a href="{{ route('admin.quran.upload.form') }}" class="admin-card" data-i="2">
            <span class="ac-icon">📥</span>
            <h3>Quran Upload</h3>
            <p>Upload or edit specific Quran verses by surah and ayah number with translations.</p>
            <span class="ac-link">Open Uploader <i class="fas fa-arrow-right"></i></span>
        </a>

        {{-- HADITH UPLOAD --}}
        <a href="{{ route('admin.hadith.upload.form') }}" class="admin-card" data-i="3">
            <span class="ac-icon">📤</span>
            <h3>Hadith Upload</h3>
            <p>Upload hadith with book, narrator, Arabic text, English and Urdu translations.</p>
            <span class="ac-link">Open Uploader <i class="fas fa-arrow-right"></i></span>
        </a>

        

        {{-- BACK TO SITE --}}
        <a href="/" class="admin-card" data-i="5">
            <span class="ac-icon">🌙</span>
            <h3>Back to Site</h3>
            <p>Return to the main Soulful Deen homepage and view the site as a visitor.</p>
            <span class="ac-link">Go to Homepage <i class="fas fa-arrow-right"></i></span>
        </a>

    </div>
</section>

<script>
(function () {
    'use strict';

    // Navbar scroll
    window.addEventListener('scroll', function () {
        var navbar = document.querySelector('.admin-navbar');
        if (!navbar) return;
        if (window.scrollY > 50) navbar.classList.add('scrolled');
        else navbar.classList.remove('scrolled');
    });

    // Stagger animation delays
    document.querySelectorAll('.admin-card[data-i]').forEach(function (el) {
        el.style.setProperty('--i', el.getAttribute('data-i'));
    });
})();
</script>

@endsection