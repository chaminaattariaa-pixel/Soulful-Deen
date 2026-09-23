@extends('layouts')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

{{-- @formatter:off --}}
<style>
:root {
    --primary: #0d4c3e;
    --secondary: #1abc9c;
    --accent: #f39c12;
    --gold: #f1c40f;
    --emerald: #2ecc71;
    --dark: #1a252f;
    --purple: #8e44ad;
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

/* ================= NAVBAR ================= */
.navbar {
    position: fixed; top: 0; left: 0; width: 100%;
    background: rgba(13, 76, 62, 0.95);
    backdrop-filter: blur(15px);
    z-index: 1000;
    transition: all 0.4s ease;
    border-bottom: 2px solid rgba(241, 196, 15, 0.3);
    padding: 15px 0;
}
.navbar.scrolled {
    background: rgba(13, 76, 62, 0.98);
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    padding: 10px 0;
}
.navbar-brand {
    font-size: 2rem; font-weight: 900;
    color: #fff; text-decoration: none;
    display: flex; align-items: center; gap: 15px;
    letter-spacing: -0.5px;
}
.navbar-brand img {
    height: 60px; border-radius: 50%;
    border: 3px solid var(--gold);
    box-shadow: 0 0 20px rgba(241,196,15,0.5);
}
.navbar-brand span {
    background: linear-gradient(45deg, #fff, var(--gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.nav-links {
    display: flex; gap: 30px; list-style: none;
    align-items: center; margin: 0;
}
.nav-links a {
    color: #fff; text-decoration: none;
    font-weight: 600; transition: all 0.3s ease;
    position: relative; padding: 8px 0;
    font-size: 16px;
    display: flex; align-items: center; gap: 8px;
}
.nav-links a i { color: var(--gold); font-size: 18px; }
.nav-links a::after {
    content: ''; position: absolute;
    bottom: 0; left: 0; width: 0; height: 3px;
    background: var(--gold); border-radius: 3px;
    transition: width 0.4s ease;
}
.nav-links a:hover { color: var(--gold); transform: translateY(-2px); }
.nav-links a:hover::after { width: 100%; }

/* ================= HERO ================= */
.namaz-hero {
    min-height: 60vh;
    position: relative;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 180px 40px 90px;
    overflow: hidden;
}
.namaz-hero-bg {
    position: absolute; inset: 0;
    background:
        linear-gradient(rgba(13, 76, 62, 0.9), rgba(26, 188, 156, 0.75)),
        url('https://static.vecteezy.com/system/resources/thumbnails/035/912/156/small_2x/ai-generated-beautiful-view-of-worship-mosque-building-in-bright-day-photo.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    z-index: 1;
}
.namaz-hero-overlay {
    position: absolute; inset: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(241,196,15,0.3) 0%, transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(46,204,113,0.2) 0%, transparent 40%);
    animation: pulseOverlay 12s ease-in-out infinite alternate;
    z-index: 2;
}
@keyframes pulseOverlay { 0% { opacity: .6; } 100% { opacity: 1; } }

.namaz-hero-content {
    position: relative; z-index: 3;
    max-width: 900px;
}
.namaz-hero-content h1 {
    font-size: 4rem; font-weight: 900;
    margin-bottom: 20px;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: textGlow 3s ease-in-out infinite;
}
@keyframes textGlow {
    0%, 100% { filter: brightness(1) drop-shadow(0 0 20px rgba(241,196,15,.3)); }
    50% { filter: brightness(1.2) drop-shadow(0 0 30px rgba(241,196,15,.5)); }
}
.namaz-hero-content p {
    font-size: 1.25rem;
    color: rgba(255,255,255,0.95);
    line-height: 1.8;
    margin-bottom: 30px;
}
.namaz-hero-content .arabic-title {
    font-family: 'Amiri', serif;
    font-size: 2rem;
    color: var(--gold);
    display: block;
    margin-top: 15px;
    direction: rtl;
}

/* ================= SECTION ================= */
.namaz-section {
    padding: 80px 40px;
    max-width: 1400px;
    margin: 0 auto;
}
.section-title {
    text-align: center;
    margin-bottom: 50px;
}
.section-title h2 {
    font-size: 2.8rem; font-weight: 900;
    color: #fff;
    margin-bottom: 15px;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.section-title p {
    color: rgba(255,255,255,0.85);
    font-size: 1.1rem;
}

/* ================= PRAYERS GRID ================= */
.prayers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}
.prayer-box {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 35px 28px;
    border: 2px solid rgba(255,255,255,0.15);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: calc(var(--i, 0) * 0.06s);
    opacity: 0;
    display: flex;
    flex-direction: column;
}
.prayer-box::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 5px;
    background: var(--gradient-gold);
    transform: scaleX(0);
    transition: transform 0.5s ease;
    transform-origin: left;
}
.prayer-box:hover::before { transform: scaleX(1); }
.prayer-box:hover {
    transform: translateY(-10px);
    background: rgba(255,255,255,0.18);
    border-color: var(--gold);
    box-shadow: 0 25px 60px rgba(0,0,0,0.4);
}

.prayer-box .p-icon {
    font-size: 44px;
    display: block;
    margin-bottom: 12px;
    filter: drop-shadow(0 4px 10px rgba(0,0,0,0.3));
}
.prayer-box .p-name {
    font-size: 1.7rem;
    font-weight: 800;
    color: var(--gold);
    line-height: 1.2;
    margin-bottom: 4px;
}
.prayer-box .p-arabic {
    font-family: 'Amiri', serif;
    font-size: 1.4rem;
    color: rgba(255,255,255,0.85);
    direction: rtl;
    margin-bottom: 15px;
}
.prayer-box .p-time {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(26,188,156,0.2);
    color: var(--secondary);
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 15px;
    border: 1px solid rgba(26,188,156,0.3);
    align-self: flex-start;
}
.prayer-box .p-rakats {
    font-size: 14px;
    line-height: 1.7;
    color: #fff;
    font-weight: 700;
    margin-bottom: 15px;
    padding: 14px 16px;
    background: rgba(0,0,0,0.2);
    border-radius: 12px;
    border-left: 4px solid var(--gold);
}
.prayer-box .p-hadith {
    font-size: 13px;
    line-height: 1.7;
    color: rgba(255,255,255,0.82);
    font-style: italic;
    margin-bottom: 12px;
}
.prayer-box .p-ref {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--gold);
    font-size: 12px;
    font-weight: 700;
    margin-top: auto;
    padding-top: 12px;
    border-top: 1px solid rgba(255,255,255,0.1);
}

/* ================= STEPS ================= */
.steps-wrap {
    max-width: 1000px;
    margin: 0 auto;
    position: relative;
}
.step {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 22px;
    padding: 30px 30px 30px 100px;
    margin-bottom: 22px;
    position: relative;
    transition: all 0.4s ease;
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: calc(var(--i, 0) * 0.06s);
    opacity: 0;
}
.step:hover {
    background: rgba(255,255,255,0.16);
    border-color: var(--gold);
    transform: translateX(6px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.3);
}
.step::before {
    content: attr(data-step);
    position: absolute;
    left: 22px;
    top: 50%;
    transform: translateY(-50%);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--gradient-gold);
    color: var(--dark);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 24px;
    box-shadow: 0 10px 25px rgba(243,156,18,0.4);
    border: 3px solid rgba(255,255,255,0.3);
}
.step-title {
    font-size: 1.35rem;
    font-weight: 800;
    color: var(--gold);
    margin-bottom: 12px;
}
.step-arabic {
    font-family: 'Amiri', serif;
    font-size: 22px;
    direction: rtl;
    text-align: right;
    line-height: 1.9;
    color: #fff;
    font-weight: 700;
    margin-bottom: 10px;
    padding: 14px 18px;
    background: rgba(0,0,0,0.2);
    border-radius: 12px;
    border-right: 4px solid var(--gold);
}
.step-urdu {
    font-size: 14px;
    line-height: 1.85;
    color: rgba(255,255,255,0.9);
    direction: rtl;
    text-align: right;
    font-family: 'Amiri', serif;
    margin-bottom: 8px;
}
.step-english {
    font-size: 13px;
    line-height: 1.7;
    color: rgba(255,255,255,0.72);
    font-style: italic;
    margin-bottom: 14px;
}
.step-desc {
    font-size: 14px;
    line-height: 1.8;
    color: rgba(255,255,255,0.88);
    margin-bottom: 12px;
}
.step-ref {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--gold);
    font-size: 12px;
    font-weight: 700;
}

/* ================= MISTAKES ================= */
.mistakes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 22px;
}
.mistake-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 20px;
    padding: 28px;
    transition: all 0.4s ease;
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: calc(var(--i, 0) * 0.05s);
    opacity: 0;
    position: relative;
    overflow: hidden;
}
.mistake-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; bottom: 0;
    width: 5px;
    background: linear-gradient(180deg, #e74c3c, #f39c12);
}
.mistake-card:hover {
    transform: translateY(-8px);
    background: rgba(255,255,255,0.16);
    border-color: var(--gold);
    box-shadow: 0 20px 50px rgba(0,0,0,0.35);
}
.mistake-title {
    font-size: 1.15rem;
    font-weight: 800;
    color: #ff9800;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.mistake-title i { font-size: 18px; }
.mistake-desc {
    font-size: 14px;
    line-height: 1.7;
    color: rgba(255,255,255,0.82);
    margin-bottom: 15px;
}
.mistake-fix {
    font-size: 13px;
    line-height: 1.7;
    color: rgba(255,255,255,0.95);
    padding: 12px 15px;
    background: rgba(46,204,113,0.15);
    border-radius: 10px;
    border-left: 3px solid var(--emerald);
}
.mistake-fix strong {
    color: var(--emerald);
    display: block;
    margin-bottom: 4px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* ================= INFO CTA ================= */
.namaz-cta {
    background: linear-gradient(135deg, rgba(243,156,18,0.15), rgba(46,204,113,0.15));
    border: 2px solid rgba(241,196,15,0.35);
    border-radius: 30px;
    padding: 55px 45px;
    text-align: center;
    margin-top: 60px;
    position: relative;
    overflow: hidden;
}
.namaz-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 0%, rgba(241,196,15,0.25), transparent 60%);
    pointer-events: none;
}
.namaz-cta h3 {
    font-size: 2.2rem;
    font-weight: 900;
    margin-bottom: 15px;
    position: relative;
    z-index: 2;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.namaz-cta p {
    color: rgba(255,255,255,0.9);
    font-size: 1.1rem;
    margin-bottom: 30px;
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.7;
    position: relative;
    z-index: 2;
}
.namaz-cta-btns {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    position: relative;
    z-index: 2;
}
.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 16px 36px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.4s ease;
}
.cta-btn.gold {
    background: var(--gradient-gold);
    color: var(--dark);
    box-shadow: 0 15px 40px rgba(243,156,18,0.4);
}
.cta-btn.gold:hover {
    transform: translateY(-5px) scale(1.03);
    box-shadow: 0 25px 60px rgba(243,156,18,0.6);
    gap: 16px;
}
.cta-btn.outline {
    background: transparent;
    color: #fff;
    border: 2px solid rgba(255,255,255,0.5);
    backdrop-filter: blur(10px);
}
.cta-btn.outline:hover {
    background: rgba(255,255,255,0.15);
    border-color: #fff;
    transform: translateY(-5px);
    gap: 16px;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px) scale(0.96); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
    .namaz-hero-content h1 { font-size: 3rem; }
    .section-title h2 { font-size: 2.2rem; }
    .namaz-cta h3 { font-size: 1.8rem; }
}
@media (max-width: 768px) {
    .nav-links { display: none; }
    .namaz-hero { padding: 140px 20px 60px; }
    .namaz-hero-content h1 { font-size: 2.2rem; }
    .namaz-hero-content p { font-size: 1rem; }
    .namaz-hero-content .arabic-title { font-size: 1.4rem; }
    .namaz-section { padding: 60px 15px; }
    .step { padding: 70px 22px 22px; }
    .step::before {
        top: 20px;
        left: 20px;
        transform: none;
        width: 46px;
        height: 46px;
        font-size: 18px;
    }
    .step-arabic { font-size: 18px; padding: 12px 14px; }
    .namaz-cta { padding: 35px 25px; }
    .namaz-cta h3 { font-size: 1.5rem; }
    .namaz-cta p { font-size: 0.95rem; }
    .cta-btn { padding: 14px 28px; font-size: 14px; }
}
</style>
{{-- @formatter:on --}}

<!-- ================= NAVBAR ================= -->
<nav class="navbar">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
            <span>Soulful Deen</span>
        </a>
        <ul class="nav-links">
            <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="/quran/search"><i class="fas fa-book-quran"></i> Quran</a></li>
            <li><a href="/hadith/search"><i class="fas fa-book-open"></i> Hadith</a></li>
            <li><a href="/chat"><i class="fas fa-robot"></i> AI Bot</a></li>
            <li><a href="/qibla"><i class="fas fa-compass"></i> Qibla</a></li>
            <li><a href="{{ route('namaz.timings') }}"><i class="fas fa-clock"></i> Timings</a></li>
            <li><a href="/profile"><i class="fas fa-user"></i> Profile</a></li>
        </ul>
    </div>
</nav>

<!-- ================= HERO ================= -->
<section class="namaz-hero">
    <div class="namaz-hero-bg"></div>
    <div class="namaz-hero-overlay"></div>
    <div class="namaz-hero-content">
        <h1>Namaz Guide</h1>
        <p>A complete step-by-step guide to the five daily prayers, with authentic references from the Quran and Sunnah</p>
        <span class="arabic-title">إِنَّ الصَّلَاةَ كَانَتْ عَلَى الْمُؤْمِنِينَ كِتَابًا مَّوْقُوتًا</span>
    </div>
</section>

<!-- ================= FIVE PRAYERS ================= -->
<section class="namaz-section" style="padding-bottom: 0;">
    <div class="section-title">
        <h2>The Five Daily Prayers</h2>
        <p>Each prayer has its own time, rakats and spiritual virtue</p>
    </div>

    <div class="prayers-grid">
        @foreach($prayers as $i => $p)
            <div class="prayer-box" data-i="{{ $i }}">
                <span class="p-icon">{{ $p['icon'] }}</span>
                <div class="p-name">{{ $p['name'] }}</div>
                <div class="p-arabic">{{ $p['arabic'] }}</div>
                <span class="p-time"><i class="far fa-clock"></i> {{ $p['time'] }}</span>
                <div class="p-rakats">{{ $p['rakats'] }}</div>
                <p class="p-hadith">"{{ $p['hadith'] }}"</p>
                <span class="p-ref"><i class="fas fa-bookmark"></i> {{ $p['reference'] }}</span>
            </div>
        @endforeach
    </div>
</section>

<!-- ================= STEP-BY-STEP ================= -->
<section class="namaz-section">
    <div class="section-title">
        <h2>How to Pray — Step by Step</h2>
        <p>The essential steps of salah with the authentic Arabic, Urdu and English</p>
    </div>

    <div class="steps-wrap">
        @foreach($steps as $i => $s)
            <div class="step" data-step="{{ $s['step'] }}" data-i="{{ $i }}">
                <div class="step-title">{{ $s['title'] }}</div>
                <div class="step-arabic">{{ $s['arabic'] }}</div>
                <div class="step-urdu">{{ $s['urdu'] }}</div>
                <div class="step-english">{{ $s['english'] }}</div>
                <p class="step-desc">{{ $s['desc'] }}</p>
                <span class="step-ref"><i class="fas fa-bookmark"></i> {{ $s['reference'] }}</span>
            </div>
        @endforeach
    </div>
</section>

<!-- ================= COMMON MISTAKES ================= -->
<section class="namaz-section" style="padding-top: 0;">
    <div class="section-title">
        <h2>Common Mistakes in Salah</h2>
        <p>Avoid these pitfalls to protect the validity and reward of your prayer</p>
    </div>

    <div class="mistakes-grid">
        @foreach($mistakes as $i => $m)
            <div class="mistake-card" data-i="{{ $i }}">
                <div class="mistake-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ $m['title'] }}
                </div>
                <p class="mistake-desc">{{ $m['desc'] }}</p>
                <div class="mistake-fix">
                    <strong>How to fix it</strong>
                    {{ $m['fix'] }}
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- ================= CTA ================= -->
<section class="namaz-section" style="padding-top: 0;">
    <div class="namaz-cta">
        <h3>Need today's prayer times for your city?</h3>
        <p>View accurate Fajr, Dhuhr, Asr, Maghrib and Isha timings — or ask the AI bot for a specific question.</p>
        <div class="namaz-cta-btns">
            <a href="{{ route('namaz.timings') }}" class="cta-btn gold">
                <i class="fas fa-clock"></i>
                Today's Timings
            </a>
            <a href="/chat" class="cta-btn outline">
                <i class="fas fa-robot"></i>
                Ask AI Bot
            </a>
            <a href="/qibla" class="cta-btn outline">
                <i class="fas fa-compass"></i>
                Find Qibla
            </a>
        </div>
    </div>
</section>


<script>
(function () {
    'use strict';

    // ---------- Navbar scroll ----------
    window.addEventListener('scroll', function () {
        var navbar = document.querySelector('.navbar');
        if (!navbar) return;
        if (window.scrollY > 50) navbar.classList.add('scrolled');
        else navbar.classList.remove('scrolled');
    });

    // ---------- Stagger animation delays ----------
    document.querySelectorAll('[data-i]').forEach(function (el) {
        el.style.setProperty('--i', el.getAttribute('data-i'));
    });
})();
</script>

@endsection