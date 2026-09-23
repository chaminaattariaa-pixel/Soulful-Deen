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
.guidance-hero {
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
.guidance-hero-bg {
    position: absolute; inset: 0;
    background:
        linear-gradient(rgba(13, 76, 62, 0.9), rgba(26, 188, 156, 0.75)),
        url('https://static.vecteezy.com/system/resources/thumbnails/035/912/156/small_2x/ai-generated-beautiful-view-of-worship-mosque-building-in-bright-day-photo.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    z-index: 1;
}
.guidance-hero-overlay {
    position: absolute; inset: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(241,196,15,0.3) 0%, transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(46,204,113,0.2) 0%, transparent 40%);
    animation: pulseOverlay 12s ease-in-out infinite alternate;
    z-index: 2;
}
@keyframes pulseOverlay { 0% { opacity: .6; } 100% { opacity: 1; } }

.guidance-hero-content {
    position: relative; z-index: 3;
    max-width: 900px;
}
.guidance-hero-content h1 {
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
.guidance-hero-content p {
    font-size: 1.25rem;
    color: rgba(255,255,255,0.95);
    line-height: 1.8;
    margin-bottom: 30px;
}
.guidance-hero-content .arabic-title {
    font-family: 'Amiri', serif;
    font-size: 2rem;
    color: var(--gold);
    display: block;
    margin-top: 15px;
    direction: rtl;
}

/* ================= SEARCH ================= */
.search-bar-wrap {
    max-width: 700px;
    margin: 30px auto 0;
    position: relative;
}
.search-bar-wrap i {
    position: absolute;
    left: 25px; top: 50%;
    transform: translateY(-50%);
    color: var(--gold);
    font-size: 20px;
    pointer-events: none;
}
.search-bar {
    width: 100%;
    padding: 20px 25px 20px 60px;
    border-radius: 50px;
    border: 2px solid rgba(241,196,15,0.4);
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(20px);
    color: #fff;
    font-size: 16px;
    font-family: 'Poppins', sans-serif;
    outline: none;
    transition: all 0.3s ease;
}
.search-bar::placeholder { color: rgba(255,255,255,0.6); }
.search-bar:focus {
    border-color: var(--gold);
    background: rgba(255,255,255,0.2);
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}

/* ================= SECTION ================= */
.guidance-section {
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

/* ================= TOPICS ================= */
.topics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 22px;
    margin-bottom: 60px;
}
.topic-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 22px;
    padding: 30px 22px;
    text-align: center;
    cursor: pointer;
    transition: all 0.4s ease;
    animation: fadeInUp 0.7s ease forwards;
    animation-delay: calc(var(--i, 0) * 0.05s);
    opacity: 0;
    user-select: none;
}
.topic-card:hover {
    transform: translateY(-10px);
    background: var(--gradient-primary);
    border-color: var(--gold);
    box-shadow: 0 25px 50px rgba(0,0,0,0.4);
}
.topic-card.active {
    background: var(--gradient-gold);
    border-color: #fff;
    box-shadow: 0 15px 40px rgba(243,156,18,0.5);
}
.topic-icon {
    font-size: 40px;
    display: block;
    margin-bottom: 15px;
    filter: drop-shadow(0 4px 10px rgba(0,0,0,0.3));
}
.topic-name {
    font-weight: 800;
    color: #fff;
    font-size: 17px;
    margin-bottom: 6px;
}
.topic-card.active .topic-name { color: var(--dark); }
.topic-arabic {
    font-family: 'Amiri', serif;
    font-size: 18px;
    color: var(--gold);
    direction: rtl;
    margin-bottom: 10px;
}
.topic-card.active .topic-arabic { color: rgba(26,37,47,0.85); }
.topic-desc {
    font-size: 13px;
    color: rgba(255,255,255,0.75);
    line-height: 1.6;
}
.topic-card.active .topic-desc { color: rgba(26,37,47,0.85); }

/* ================= ARTICLES ================= */
.articles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
    gap: 28px;
}
.article-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 35px;
    border: 2px solid rgba(255,255,255,0.15);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: calc(var(--i, 0) * 0.05s);
    opacity: 0;
}
.article-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 5px;
    background: var(--gradient-gold);
    transform: scaleX(0);
    transition: transform 0.5s ease;
    transform-origin: left;
}
.article-card:hover::before { transform: scaleX(1); }
.article-card:hover {
    transform: translateY(-10px);
    background: rgba(255,255,255,0.18);
    border-color: var(--gold);
    box-shadow: 0 25px 60px rgba(0,0,0,0.4);
}

.article-topic-badge {
    display: inline-block;
    background: rgba(26,188,156,0.2);
    color: var(--secondary);
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 18px;
    border: 1px solid rgba(26,188,156,0.3);
    text-transform: uppercase;
    letter-spacing: 1px;
    align-self: flex-start;
}
.article-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--gold);
    line-height: 1.3;
    margin-bottom: 15px;
}
.article-excerpt {
    font-size: 14px;
    color: rgba(255,255,255,0.82);
    line-height: 1.75;
    margin-bottom: 20px;
}
.article-verse {
    font-family: 'Amiri', serif;
    font-size: 20px;
    direction: rtl;
    text-align: right;
    line-height: 1.9;
    color: #fff;
    font-weight: 700;
    margin-bottom: 12px;
    padding: 16px 20px;
    background: rgba(0,0,0,0.2);
    border-radius: 14px;
    border-right: 4px solid var(--gold);
}
.article-urdu {
    font-size: 14px;
    line-height: 1.85;
    color: rgba(255,255,255,0.9);
    direction: rtl;
    text-align: right;
    font-family: 'Amiri', serif;
    margin-bottom: 10px;
}
.article-english {
    font-size: 13px;
    line-height: 1.7;
    color: rgba(255,255,255,0.72);
    font-style: italic;
    margin-bottom: 18px;
}
.article-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid rgba(255,255,255,0.1);
    gap: 12px;
}
.article-ref {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--gold);
    font-size: 13px;
    font-weight: 700;
}
.article-read-time {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: rgba(255,255,255,0.65);
    font-size: 12px;
    font-weight: 600;
}
.article-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--gradient-gold);
    color: var(--dark);
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 13px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    margin-top: 18px;
    align-self: flex-start;
}
.article-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(243,156,18,0.4);
    gap: 12px;
}

/* ================= FAQ / ACCORDION ================= */
.faq-wrap {
    max-width: 1000px;
    margin: 0 auto;
}
.faq-item {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 18px;
    margin-bottom: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
}
.faq-item.open {
    border-color: var(--gold);
    background: rgba(255,255,255,0.16);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}
.faq-q {
    padding: 22px 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    cursor: pointer;
    font-size: 1.05rem;
    font-weight: 700;
    color: #fff;
    transition: color 0.3s ease;
    user-select: none;
}
.faq-item.open .faq-q { color: var(--gold); }
.faq-q i {
    color: var(--gold);
    transition: transform 0.4s ease;
    flex-shrink: 0;
    font-size: 18px;
}
.faq-item.open .faq-q i { transform: rotate(180deg); }
.faq-a {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s ease;
}
.faq-item.open .faq-a {
    max-height: 500px;
}
.faq-a-inner {
    padding: 0 28px 24px;
    color: rgba(255,255,255,0.9);
    font-size: 15px;
    line-height: 1.8;
}
.faq-ref {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 15px;
    color: var(--gold);
    font-size: 13px;
    font-weight: 700;
}

/* ================= ASK AI CTA ================= */
.ask-cta {
    background: linear-gradient(135deg, rgba(243,156,18,0.15), rgba(46,204,113,0.15));
    border: 2px solid rgba(241,196,15,0.35);
    border-radius: 30px;
    padding: 55px 45px;
    text-align: center;
    margin-top: 60px;
    position: relative;
    overflow: hidden;
}
.ask-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 0%, rgba(241,196,15,0.25), transparent 60%);
    pointer-events: none;
}
.ask-cta h3 {
    font-size: 2.2rem;
    font-weight: 900;
    color: #fff;
    margin-bottom: 15px;
    position: relative;
    z-index: 2;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.ask-cta p {
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
.ask-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: var(--gradient-gold);
    color: var(--dark);
    padding: 18px 45px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 17px;
    text-decoration: none;
    transition: all 0.4s ease;
    box-shadow: 0 15px 40px rgba(243,156,18,0.4);
    position: relative;
    z-index: 2;
}
.ask-cta-btn:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 25px 60px rgba(243,156,18,0.6);
    gap: 18px;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
    .guidance-hero-content h1 { font-size: 3rem; }
    .section-title h2 { font-size: 2.2rem; }
    .articles-grid { grid-template-columns: 1fr; }
    .ask-cta h3 { font-size: 1.8rem; }
}
@media (max-width: 768px) {
    .nav-links { display: none; }
    .guidance-hero { padding: 140px 20px 60px; }
    .guidance-hero-content h1 { font-size: 2.2rem; }
    .guidance-hero-content p { font-size: 1rem; }
    .guidance-hero-content .arabic-title { font-size: 1.4rem; }
    .guidance-section { padding: 60px 15px; }
    .article-card { padding: 25px; }
    .article-title { font-size: 1.25rem; }
    .article-verse { font-size: 17px; padding: 12px 15px; }
    .ask-cta { padding: 35px 25px; }
    .ask-cta h3 { font-size: 1.5rem; }
    .ask-cta p { font-size: 0.95rem; }
    .faq-q { padding: 18px 20px; font-size: 0.95rem; }
    .faq-a-inner { padding: 0 20px 20px; font-size: 14px; }
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px) scale(0.96); }
    to { opacity: 1; transform: translateY(0) scale(1); }
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
            <li><a href="/profile"><i class="fas fa-user"></i> Profile</a></li>
        </ul>
    </div>
</nav>

<!-- ================= HERO ================= -->
<section class="guidance-hero">
    <div class="guidance-hero-bg"></div>
    <div class="guidance-hero-overlay"></div>
    <div class="guidance-hero-content">
        <h1>Islamic Guidance</h1>
        <p>Authentic answers and clear guidance from the Quran and Sunnah for everyday life</p>
        <span class="arabic-title">وَمَا أَرْسَلْنَاكَ إِلَّا رَحْمَةً لِّلْعَالَمِينَ</span>

        <div class="search-bar-wrap">
            <i class="fas fa-search"></i>
            <input type="text" class="search-bar" id="guidanceSearch" placeholder="Search topics, articles, questions...">
        </div>
    </div>
</section>

<!-- ================= TOPICS ================= -->
<section class="guidance-section" style="padding-bottom: 0;">
    <div class="section-title">
        <h2>Browse by Topic</h2>
        <p>Select a topic to filter articles and questions</p>
    </div>

    <div class="topics-grid" id="topicsGrid">
        <div class="topic-card active" data-topic="all" data-i="0">
            <span class="topic-icon">📿</span>
            <div class="topic-name">All Topics</div>
            <div class="topic-arabic">الكل</div>
            <div class="topic-desc">Show all guidance content</div>
        </div>
        @foreach($topics as $i => $topic)
            <div class="topic-card" data-topic="{{ $topic['slug'] }}" data-i="{{ $i + 1 }}">
                <span class="topic-icon">{{ $topic['icon'] }}</span>
                <div class="topic-name">{{ $topic['name'] }}</div>
                <div class="topic-arabic">{{ $topic['arabic'] }}</div>
                <div class="topic-desc">{{ $topic['desc'] }}</div>
            </div>
        @endforeach
    </div>
</section>

<!-- ================= ARTICLES ================= -->
<section class="guidance-section">
    <div class="section-title">
        <h2 id="articlesHeading">Featured Guidance</h2>
        <p id="articlesCount">Articles & answers grounded in the Quran and Sunnah</p>
    </div>

    <div class="articles-grid" id="articlesGrid">
        @foreach($articles as $i => $art)
            <div class="article-card"
                 data-i="{{ $i }}"
                 data-topic="{{ $art['topic'] }}"
                 data-search="{{ strtolower($art['title'] . ' ' . $art['excerpt'] . ' ' . $art['english'] . ' ' . $art['urdu'] . ' ' . $art['reference']) }}">
                <span class="article-topic-badge">{{ $art['topic'] }}</span>
                <div class="article-title">{{ $art['title'] }}</div>
                <p class="article-excerpt">{{ $art['excerpt'] }}</p>

                <div class="article-verse">{{ $art['arabic'] }}</div>
                <div class="article-urdu">{{ $art['urdu'] }}</div>
                <div class="article-english">{{ $art['english'] }}</div>

                <div class="article-footer">
                    <span class="article-ref">
                        <i class="fas fa-bookmark"></i>
                        {{ $art['reference'] }}
                    </span>
                    <span class="article-read-time">
                        <i class="far fa-clock"></i>
                        {{ $art['readTime'] }}
                    </span>
                </div>

                <a href="/guidance/{{ $art['id'] }}" class="article-btn">
                    Read More <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endforeach
    </div>

    <div class="empty-state" id="emptyState" style="display: none; text-align: center; padding: 60px 20px; color: rgba(255,255,255,0.7);">
        <i class="fas fa-search" style="font-size: 50px; color: var(--gold); opacity: 0.6; margin-bottom: 15px; display:block;"></i>
        <h3 style="color:#fff; margin-bottom:10px;">No results found</h3>
        <p>Try a different search term or topic.</p>
    </div>
</section>

<!-- ================= FAQ ================= -->
<section class="guidance-section" style="padding-top: 0;">
    <div class="section-title">
        <h2>Common Questions</h2>
        <p>Frequently asked questions answered with authentic references</p>
    </div>

    <div class="faq-wrap" id="faqWrap">
        @foreach($faqs as $i => $faq)
            <div class="faq-item" data-i="{{ $i }}">
                <div class="faq-q">
                    <span>{{ $faq['q'] }}</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-a">
                    <div class="faq-a-inner">
                        {{ $faq['a'] }}
                        <div class="faq-ref">
                            <i class="fas fa-bookmark"></i>
                            {{ $faq['ref'] }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- ================= ASK AI CTA ================= -->
<section class="guidance-section" style="padding-top: 0;">
    <div class="ask-cta">
        <h3>Still have a question?</h3>
        <p>Ask our AI Deen Bot for instant, source-based answers to your Islamic questions — available 24/7.</p>
        <a href="/chat" class="ask-cta-btn">
            <i class="fas fa-robot"></i>
            Ask the AI Bot
        </a>
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

    // ---------- Stagger delays ----------
    document.querySelectorAll('.topic-card[data-i], .article-card[data-i]').forEach(function (el) {
        el.style.setProperty('--i', el.getAttribute('data-i'));
    });

    // ---------- Filtering ----------
    var activeTopic = 'all';
    var searchTerm = '';
    var cards = document.querySelectorAll('.article-card');
    var emptyState = document.getElementById('emptyState');
    var headingEl = document.getElementById('articlesHeading');
    var countEl = document.getElementById('articlesCount');

    function applyFilters() {
        var visible = 0;
        cards.forEach(function (card) {
            var topicMatch = (activeTopic === 'all') || (card.getAttribute('data-topic') === activeTopic);
            var searchMatch = !searchTerm || (card.getAttribute('data-search') || '').indexOf(searchTerm) !== -1;
            if (topicMatch && searchMatch) {
                card.style.display = 'flex';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });

        var chip = document.querySelector('.topic-card[data-topic="' + activeTopic + '"]');
        var topicName = chip ? chip.querySelector('.topic-name').textContent : 'All Topics';
        headingEl.textContent = activeTopic === 'all' ? 'Featured Guidance' : topicName + ' Guidance';
        countEl.textContent = visible + ' article' + (visible === 1 ? '' : 's') + ' found';

        emptyState.style.display = visible === 0 ? 'block' : 'none';
    }

    // Topic card clicks
    document.querySelectorAll('.topic-card').forEach(function (chip) {
        chip.addEventListener('click', function () {
            document.querySelectorAll('.topic-card').forEach(function (c) { c.classList.remove('active'); });
            chip.classList.add('active');
            activeTopic = chip.getAttribute('data-topic');
            applyFilters();
        });
    });

    // Search
    var searchInput = document.getElementById('guidanceSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            searchTerm = this.value.trim().toLowerCase();
            applyFilters();
        });
    }

    // ---------- FAQ Accordion ----------
    document.querySelectorAll('.faq-item').forEach(function (item) {
        var q = item.querySelector('.faq-q');
        if (!q) return;
        q.addEventListener('click', function () {
            var wasOpen = item.classList.contains('open');
            // Close all
            document.querySelectorAll('.faq-item').forEach(function (it) { it.classList.remove('open'); });
            // Toggle current
            if (!wasOpen) item.classList.add('open');
        });
    });

    // Open first FAQ by default
    var firstFaq = document.querySelector('.faq-item');
    if (firstFaq) firstFaq.classList.add('open');

    // Initial
    applyFilters();
})();
</script>

@endsection