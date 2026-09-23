@extends('layouts')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700;800;900&family=Scheherazade+New:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --primary: #0d4c3e;
    --secondary: #1abc9c;
    --accent: #f39c12;
    --gold: #f1c40f;
    --emerald: #2ecc71;
    --turquoise: #1dd1a1;
    --dark: #1a252f;
    --light: #f9f9f9;
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
}

/* ===== NAVBAR ===== */
.navbar {
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    background: rgba(13, 76, 62, 0.97);
    backdrop-filter: blur(15px);
    z-index: 1000;
    border-bottom: 2px solid rgba(241, 196, 15, 0.3);
    padding: 15px 0;
    transition: all 0.4s ease;
}
.navbar.scrolled {
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    padding: 10px 0;
}
.navbar-brand {
    font-size: 1.8rem; font-weight: 900;
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
.nav-links { display: flex; gap: 25px; list-style: none; align-items: center; margin: 0; }
.nav-links a {
    color: #fff; text-decoration: none; font-weight: 600;
    transition: all 0.3s; padding: 6px 0; font-size: 15px;
    display: flex; align-items: center; gap: 7px; position: relative;
}
.nav-links a i { color: var(--gold); }
.nav-links a::after {
    content: ''; position: absolute;
    bottom: 0; left: 0; width: 0; height: 2px;
    background: var(--gold); border-radius: 2px;
    transition: width 0.3s;
}
.nav-links a:hover { color: var(--gold); transform: translateY(-2px); }
.nav-links a:hover::after { width: 100%; }
.nav-links a.active { color: var(--gold); }
.nav-links a.active::after { width: 100%; }

/* ===== PAGE WRAPPER ===== */
.quran-page {
    min-height: 100vh;
    padding-top: 90px;
    padding-bottom: 60px;
}

/* ===== HERO BANNER ===== */
.quran-hero {
    background: 
        linear-gradient(rgba(13,76,62,0.88), rgba(13,76,62,0.92)),
        url('https://static.vecteezy.com/system/resources/thumbnails/035/912/156/small_2x/ai-generated-beautiful-view-of-worship-mosque-building-in-bright-day-photo.jpg');
    background-size: cover;
    background-position: center;
    padding: 60px 40px 50px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
    border-bottom: 3px solid rgba(241,196,15,0.4);
}
.quran-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 30% 50%, rgba(241,196,15,0.15) 0%, transparent 60%),
                radial-gradient(circle at 70% 50%, rgba(46,204,113,0.1) 0%, transparent 60%);
    animation: pulseHero 8s ease-in-out infinite alternate;
}
@keyframes pulseHero { 0% { opacity: 0.6; } 100% { opacity: 1; } }

.quran-hero-inner { position: relative; z-index: 2; }
.quran-hero-bismillah {
    font-family: 'Scheherazade New', 'Amiri', serif;
    font-size: 3.5rem;
    color: var(--gold);
    text-shadow: 0 2px 20px rgba(241,196,15,0.5);
    margin-bottom: 12px;
    line-height: 1.4;
    animation: glow 3s ease-in-out infinite;
}
@keyframes glow {
    0%,100% { filter: drop-shadow(0 0 10px rgba(241,196,15,0.4)); }
    50% { filter: drop-shadow(0 0 25px rgba(241,196,15,0.7)); }
}
.quran-hero h1 {
    font-size: 3rem; font-weight: 900;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 10px;
}
.quran-hero p {
    font-size: 1.15rem;
    color: rgba(255,255,255,0.85);
    max-width: 550px; margin: 0 auto;
    line-height: 1.7;
}

/* ===== MAIN LAYOUT ===== */
.quran-layout {
    max-width: 1500px;
    margin: 0 auto;
    padding: 40px 30px;
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
    align-items: start;
}

/* ===== SIDEBAR ===== */
.sidebar {
    position: sticky;
    top: 100px;
    background: rgba(255,255,255,0.07);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    border: 1.5px solid rgba(255,255,255,0.15);
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.35);
}
.sidebar-header {
    background: var(--gradient-primary);
    padding: 22px 25px;
    display: flex; align-items: center; gap: 12px;
    border-bottom: 2px solid rgba(241,196,15,0.3);
}
.sidebar-header i { color: var(--gold); font-size: 22px; }
.sidebar-header h3 { color: #fff; font-size: 1.2rem; font-weight: 700; }

/* Nav Tabs */
.sidebar-tabs {
    display: flex;
    border-bottom: 1.5px solid rgba(255,255,255,0.1);
}
.sidebar-tab {
    flex: 1; padding: 14px 10px;
    background: transparent; border: none;
    color: rgba(255,255,255,0.6);
    font-family: 'Poppins', sans-serif;
    font-size: 13px; font-weight: 600;
    cursor: pointer; transition: all 0.3s;
    display: flex; align-items: center;
    justify-content: center; gap: 6px;
}
.sidebar-tab.active {
    color: var(--gold);
    background: rgba(241,196,15,0.1);
    border-bottom: 2px solid var(--gold);
}
.sidebar-tab:hover:not(.active) { color: #fff; background: rgba(255,255,255,0.05); }

/* Search in sidebar */
.sidebar-search {
    padding: 18px 18px 10px;
}
.sidebar-search input {
    width: 100%;
    padding: 11px 16px 11px 40px;
    background: rgba(255,255,255,0.1);
    border: 1.5px solid rgba(255,255,255,0.2);
    border-radius: 12px;
    color: #fff; font-family: 'Poppins', sans-serif;
    font-size: 14px; outline: none;
    transition: all 0.3s;
    position: relative;
}
.sidebar-search input::placeholder { color: rgba(255,255,255,0.45); }
.sidebar-search input:focus { border-color: var(--gold); background: rgba(255,255,255,0.15); }
.search-wrap { position: relative; }
.search-wrap i {
    position: absolute; left: 13px; top: 50%;
    transform: translateY(-50%);
    color: rgba(255,255,255,0.45); font-size: 15px;
    pointer-events: none;
}

/* Surah/Page list */
.sidebar-list {
    max-height: 60vh;
    overflow-y: auto;
    padding: 8px 0;
}
.sidebar-list::-webkit-scrollbar { width: 4px; }
.sidebar-list::-webkit-scrollbar-track { background: transparent; }
.sidebar-list::-webkit-scrollbar-thumb { background: rgba(241,196,15,0.4); border-radius: 4px; }

.sidebar-item {
    display: flex; align-items: center;
    padding: 12px 18px;
    cursor: pointer;
    transition: all 0.25s;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    gap: 12px;
}
.sidebar-item:hover { background: rgba(255,255,255,0.08); }
.sidebar-item.active { background: rgba(241,196,15,0.12); border-left: 3px solid var(--gold); }

.item-num {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: rgba(241,196,15,0.15);
    border: 1.5px solid rgba(241,196,15,0.3);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700;
    color: var(--gold); flex-shrink: 0;
}
.item-info { flex: 1; min-width: 0; }
.item-name-en { font-size: 13px; font-weight: 600; color: #fff; }
.item-name-ar {
    font-family: 'Amiri', serif;
    font-size: 16px; color: var(--gold);
    line-height: 1.2; direction: rtl;
}
.item-meta { font-size: 11px; color: rgba(255,255,255,0.5); margin-top: 2px; }

/* Page grid in sidebar */
.page-grid-nav {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 6px;
    padding: 14px;
    max-height: 60vh;
    overflow-y: auto;
}
.page-grid-nav::-webkit-scrollbar { width: 4px; }
.page-grid-nav::-webkit-scrollbar-thumb { background: rgba(241,196,15,0.4); border-radius: 4px; }
.page-btn {
    padding: 8px 4px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 8px;
    color: rgba(255,255,255,0.7);
    font-size: 12px; font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
    font-family: 'Poppins', sans-serif;
}
.page-btn:hover { background: rgba(241,196,15,0.15); color: var(--gold); border-color: rgba(241,196,15,0.3); }
.page-btn.active { background: rgba(241,196,15,0.25); color: var(--gold); border-color: var(--gold); font-weight: 800; }

/* ===== MAIN CONTENT ===== */
.content-area { display: flex; flex-direction: column; gap: 24px; }

/* Controls bar */
.controls-bar {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(20px);
    border-radius: 18px;
    padding: 18px 25px;
    border: 1.5px solid rgba(255,255,255,0.15);
    display: flex; align-items: center;
    justify-content: space-between;
    gap: 15px; flex-wrap: wrap;
    box-shadow: 0 10px 35px rgba(0,0,0,0.25);
}
.controls-left { display: flex; align-items: center; gap: 15px; flex-wrap: wrap; }
.controls-right { display: flex; align-items: center; gap: 12px; }

.page-indicator {
    display: flex; align-items: center; gap: 10px;
    color: #fff; font-weight: 600; font-size: 15px;
}
.page-indicator span { color: var(--gold); font-size: 18px; font-weight: 800; }

.ctrl-btn {
    width: 42px; height: 42px;
    border-radius: 12px;
    background: rgba(255,255,255,0.1);
    border: 1.5px solid rgba(255,255,255,0.2);
    color: #fff; font-size: 16px;
    cursor: pointer; transition: all 0.3s;
    display: flex; align-items: center; justify-content: center;
}
.ctrl-btn:hover { background: rgba(241,196,15,0.2); border-color: var(--gold); color: var(--gold); transform: scale(1.08); }
.ctrl-btn:disabled { opacity: 0.35; cursor: not-allowed; transform: none; }

.font-controls { display: flex; align-items: center; gap: 8px; }
.font-label { color: rgba(255,255,255,0.6); font-size: 12px; font-weight: 600; }
.font-size-btn {
    padding: 7px 14px;
    background: rgba(255,255,255,0.1);
    border: 1.5px solid rgba(255,255,255,0.2);
    border-radius: 10px;
    color: #fff; font-size: 13px; font-weight: 700;
    cursor: pointer; transition: all 0.2s;
    font-family: 'Poppins', sans-serif;
}
.font-size-btn:hover { background: rgba(241,196,15,0.15); border-color: var(--gold); color: var(--gold); }

.translation-toggle {
    display: flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.08);
    border: 1.5px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    padding: 8px 16px;
    cursor: pointer;
    transition: all 0.3s;
    color: #fff; font-size: 13px; font-weight: 600;
    font-family: 'Poppins', sans-serif;
    white-space: nowrap;
}
.translation-toggle.active { background: rgba(241,196,15,0.18); border-color: var(--gold); color: var(--gold); }
.translation-toggle i { font-size: 14px; }

/* ===== QURAN VIEWER ===== */
.quran-viewer {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(25px);
    border-radius: 24px;
    border: 1.5px solid rgba(255,255,255,0.15);
    box-shadow: 0 25px 80px rgba(0,0,0,0.4);
    overflow: hidden;
    min-height: 500px;
}

/* Loading */
.loading-state {
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    min-height: 500px; gap: 20px;
    color: rgba(255,255,255,0.7);
}
.spinner {
    width: 60px; height: 60px;
    border: 4px solid rgba(255,255,255,0.1);
    border-top-color: var(--gold);
    border-radius: 50%;
    animation: spin 0.9s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }
.loading-state p { font-size: 16px; font-weight: 500; color: rgba(255,255,255,0.6); }

/* Error state */
.error-state {
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    min-height: 400px; gap: 16px;
    padding: 40px;
}
.error-state i { font-size: 50px; color: #e74c3c; }
.error-state p { color: rgba(255,255,255,0.7); font-size: 16px; text-align: center; }
.retry-btn {
    padding: 12px 30px;
    background: var(--gradient-gold);
    border: none; border-radius: 50px;
    color: var(--dark); font-weight: 700;
    cursor: pointer; font-size: 15px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s;
}
.retry-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(241,196,15,0.4); }

/* Page header inside viewer */
.page-header {
    background: linear-gradient(135deg, rgba(13,76,62,0.8), rgba(26,188,156,0.5));
    padding: 20px 35px;
    display: flex; align-items: center;
    justify-content: space-between;
    border-bottom: 1.5px solid rgba(241,196,15,0.25);
}
.page-header-left h4 { color: var(--gold); font-size: 1.1rem; font-weight: 800; }
.page-header-left span { color: rgba(255,255,255,0.7); font-size: 13px; }
.page-header-right {
    font-family: 'Amiri', serif;
    font-size: 1.5rem; color: var(--gold);
}

/* Surah header (basmala) */
.surah-opener {
    text-align: center;
    padding: 25px 35px 15px;
    border-bottom: 1px dashed rgba(241,196,15,0.2);
    margin-bottom: 5px;
    animation: fadeIn 0.5s ease;
}
.surah-opener-name {
    font-family: 'Scheherazade New', 'Amiri', serif;
    font-size: 2.5rem;
    color: var(--gold);
    direction: rtl;
    line-height: 1.4;
    text-shadow: 0 2px 15px rgba(241,196,15,0.35);
}
.surah-opener-info {
    font-size: 13px;
    color: rgba(255,255,255,0.6);
    margin-top: 6px;
    display: flex; gap: 15px;
    justify-content: center; align-items: center;
}
.surah-badge {
    background: rgba(241,196,15,0.15);
    border: 1px solid rgba(241,196,15,0.3);
    color: var(--gold);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px; font-weight: 600;
}

/* Bismillah */
.bismillah {
    text-align: center;
    font-family: 'Scheherazade New', 'Amiri', serif;
    font-size: 2.2rem;
    color: rgba(255,255,255,0.92);
    padding: 10px 20px 20px;
    direction: rtl;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

/* Verses container */
.verses-container {
    padding: 10px 35px 35px;
}

/* Single verse */
.verse-block {
    padding: 22px 0;
    border-bottom: 1px solid rgba(255,255,255,0.07);
    animation: fadeInVerse 0.4s ease both;
    transition: background 0.25s;
    border-radius: 12px;
    padding: 18px 16px;
    margin-bottom: 4px;
}
.verse-block:hover { background: rgba(255,255,255,0.04); }

@keyframes fadeInVerse {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

.verse-arabic {
    font-family: 'Scheherazade New', 'Amiri', serif;
    direction: rtl;
    text-align: right;
    line-height: 2.2;
    color: #fff;
    margin-bottom: 10px;
    text-shadow: 0 1px 8px rgba(0,0,0,0.2);
    transition: font-size 0.3s;
}

.verse-num-badge {
    display: inline-flex;
    align-items: center; justify-content: center;
    width: 32px; height: 32px;
    border-radius: 50%;
    background: rgba(241,196,15,0.15);
    border: 1.5px solid rgba(241,196,15,0.4);
    color: var(--gold);
    font-family: 'Poppins', sans-serif;
    font-size: 12px; font-weight: 700;
    margin-left: 8px;
    flex-shrink: 0;
    vertical-align: middle;
}

.verse-translation {
    font-size: 14px;
    color: rgba(255,255,255,0.72);
    line-height: 1.75;
    padding-right: 6px;
    border-right: 2px solid rgba(241,196,15,0.2);
    padding-right: 12px;
    margin-right: 4px;
    transition: all 0.3s;
}
.verse-translation.hidden { display: none; }

.verse-ref {
    font-size: 11px;
    color: rgba(255,255,255,0.35);
    margin-top: 6px;
    font-weight: 500;
}

/* Juz info chip */
.juz-chip {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(142,68,173,0.2);
    border: 1px solid rgba(142,68,173,0.4);
    color: #c39bd3;
    padding: 4px 12px; border-radius: 20px;
    font-size: 12px; font-weight: 600;
    margin: 12px 35px 0;
}

/* ===== PAGINATION ===== */
.pagination-bar {
    display: flex; align-items: center;
    justify-content: center; gap: 15px;
    padding: 22px;
    border-top: 1.5px solid rgba(255,255,255,0.08);
    background: rgba(0,0,0,0.15);
}
.pag-btn {
    display: flex; align-items: center; gap: 8px;
    padding: 12px 28px;
    border-radius: 50px;
    border: 1.5px solid rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.08);
    color: #fff; font-size: 15px; font-weight: 700;
    cursor: pointer; transition: all 0.35s;
    font-family: 'Poppins', sans-serif;
}
.pag-btn:hover:not(:disabled) {
    background: var(--gradient-gold);
    border-color: var(--gold); color: var(--dark);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(241,196,15,0.35);
}
.pag-btn:disabled { opacity: 0.3; cursor: not-allowed; }
.pag-info {
    color: rgba(255,255,255,0.7);
    font-size: 15px; font-weight: 600;
}
.pag-info strong { color: var(--gold); font-size: 18px; }

/* ===== RESPONSIVE ===== */
@media (max-width: 1100px) {
    .quran-layout { grid-template-columns: 260px 1fr; }
}
@media (max-width: 900px) {
    .quran-layout { grid-template-columns: 1fr; }
    .sidebar { position: relative; top: 0; }
    .sidebar-list { max-height: 280px; }
}
@media (max-width: 600px) {
    .quran-hero { padding: 40px 20px 35px; }
    .quran-hero-bismillah { font-size: 2.5rem; }
    .quran-hero h1 { font-size: 2.1rem; }
    .quran-layout { padding: 20px 15px; }
    .controls-bar { padding: 14px 16px; }
    .verses-container { padding: 10px 18px 25px; }
    .page-header { padding: 16px 18px; }
    .verse-arabic { font-size: 1.5rem !important; }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<!-- ===== NAVBAR ===== -->
<nav class="navbar" id="mainNav">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/" class="navbar-brand">
            <img src="images/logo.jpeg" alt="Logo">
            <span>Soulful Deen</span>
        </a>
        <ul class="nav-links">
            <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="/quran/search" class="active"><i class="fas fa-book-quran"></i> Quran</a></li>
            <li><a href="/hadith/search"><i class="fas fa-book-open"></i> Hadith</a></li>
            <li><a href="/chat"><i class="fas fa-robot"></i> AI Bot</a></li>
            <li><a href="/profile"><i class="fas fa-user"></i> Profile</a></li>
        </ul>
    </div>
</nav>

<div class="quran-page">

    <!-- Hero Banner -->
    <div class="quran-hero">
        <div class="quran-hero-inner">
            <div class="quran-hero-bismillah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
            <h1>The Holy Quran</h1>
            <p>Read the complete Quran with translations — browse page by page or jump to any Surah</p>
        </div>
    </div>

    <div class="quran-layout">

        <!-- ===== SIDEBAR ===== -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-book-quran"></i>
                <h3>Quran Navigator</h3>
            </div>

            <div class="sidebar-tabs">
                <button class="sidebar-tab active" onclick="switchTab('surahs', this)">
                    <i class="fas fa-list"></i> Surahs
                </button>
                <button class="sidebar-tab" onclick="switchTab('pages', this)">
                    <i class="fas fa-file"></i> Pages
                </button>
                <button class="sidebar-tab" onclick="switchTab('juz', this)">
                    <i class="fas fa-layer-group"></i> Juz
                </button>
            </div>

            <!-- Surahs Tab -->
            <div id="tab-surahs" class="tab-panel">
                <div class="sidebar-search">
                    <div class="search-wrap">
                        <i class="fas fa-search"></i>
                        <input type="text" id="surahSearch" placeholder="Search surah..." oninput="filterSurahs(this.value)">
                    </div>
                </div>
                <div class="sidebar-list" id="surahList">
                    <div style="padding:20px;text-align:center;color:rgba(255,255,255,0.5)">
                        <div class="spinner" style="width:30px;height:30px;margin:0 auto 10px"></div>
                        <p style="font-size:13px">Loading surahs...</p>
                    </div>
                </div>
            </div>

            <!-- Pages Tab -->
            <div id="tab-pages" class="tab-panel" style="display:none">
                <div class="page-grid-nav" id="pageGrid">
                    <!-- generated by JS -->
                </div>
            </div>

            <!-- Juz Tab -->
            <div id="tab-juz" class="tab-panel" style="display:none">
                <div class="sidebar-list" id="juzList">
                    <!-- generated by JS -->
                </div>
            </div>
        </aside>

        <!-- ===== MAIN CONTENT ===== -->
        <main class="content-area">

            <!-- Controls -->
            <div class="controls-bar">
                <div class="controls-left">
                    <div class="page-indicator">
                        <i class="fas fa-file-alt" style="color:var(--gold)"></i>
                        Page <span id="currentPageDisplay">1</span> of 604
                    </div>
                    <div class="font-controls">
                        <span class="font-label">Arabic Size:</span>
                        <button class="font-size-btn" onclick="changeFont(-2)">A−</button>
                        <button class="font-size-btn" onclick="changeFont(2)">A+</button>
                    </div>
                </div>
                <div class="controls-right">
                    <button class="translation-toggle active" id="transToggle" onclick="toggleTranslation()">
                        <i class="fas fa-language"></i> Translation
                    </button>
                    <button class="ctrl-btn" title="Previous Page" onclick="changePage(-1)" id="prevBtn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="ctrl-btn" title="Next Page" onclick="changePage(1)" id="nextBtn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Quran Viewer -->
            <div class="quran-viewer" id="quranViewer">
                <div class="loading-state" id="loadingState">
                    <div class="spinner"></div>
                    <p>Loading Quran...</p>
                </div>
                <div id="quranContent" style="display:none"></div>
                <div class="error-state" id="errorState" style="display:none">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p id="errorMsg">Failed to load. Please try again.</p>
                    <button class="retry-btn" onclick="loadPage(currentPage)">
                        <i class="fas fa-redo"></i> Retry
                    </button>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-bar">
                <button class="pag-btn" id="prevBtnBottom" onclick="changePage(-1)">
                    <i class="fas fa-chevron-left"></i> Previous
                </button>
                <div class="pag-info">
                    Page <strong id="pageNumBottom">1</strong> / 604
                </div>
                <button class="pag-btn" id="nextBtnBottom" onclick="changePage(1)">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </main>
    </div>
</div>

<script>
// ======== STATE ========
let currentPage = 1;
let showTranslation = true;
let arabicFontSize = 26;
let allSurahs = [];
let currentSurahData = null;

const TOTAL_PAGES = 604;

// ======== API CALLS ========
async function fetchPage(pageNum) {
    // AlQuranCloud: get arabic + english translation for a page
    const [arabicRes, engRes] = await Promise.all([
        fetch(`https://api.alquran.cloud/v1/page/${pageNum}/quran-uthmani`),
        fetch(`https://api.alquran.cloud/v1/page/${pageNum}/en.sahih`)
    ]);
    if (!arabicRes.ok || !engRes.ok) throw new Error('API error');
    const [arabicData, engData] = await Promise.all([arabicRes.json(), engRes.json()]);
    return { arabic: arabicData.data, english: engData.data };
}

async function fetchSurahs() {
    const res = await fetch('https://api.alquran.cloud/v1/surah');
    if (!res.ok) throw new Error('Failed to fetch surahs');
    const data = await res.json();
    return data.data;
}

// ======== RENDER ========
function renderPage(data) {
    const { arabic, english } = data;
    const ayahs = arabic.ayahs;
    const engAyahs = english.ayahs;

    let html = '';
    let lastSurah = null;
    let lastJuz = null;

    html += `
      <div class="page-header">
        <div class="page-header-left">
          <h4>Page ${currentPage}</h4>
          <span>${arabic.ayahs.length} verses</span>
        </div>
        <div class="page-header-right">صفحة ${toArabicNumerals(currentPage)}</div>
      </div>
    `;

    html += '<div class="verses-container">';

    ayahs.forEach((ayah, idx) => {
        const engAyah = engAyahs[idx];

        // Juz boundary marker
        if (ayah.juz !== lastJuz) {
            lastJuz = ayah.juz;
            html += `<div class="juz-chip"><i class="fas fa-layer-group"></i> Juz ${ayah.juz}</div>`;
        }

        // New surah header
        if (ayah.surah.number !== lastSurah) {
            lastSurah = ayah.surah.number;
            html += `
              <div class="surah-opener">
                <div class="surah-opener-name">${ayah.surah.name}</div>
                <div class="surah-opener-info">
                  <span class="surah-badge">Surah ${ayah.surah.number}</span>
                  <span>${ayah.surah.englishName}</span>
                  <span>${ayah.surah.revelationType}</span>
                </div>
              </div>`;
            // Bismillah for all surahs except At-Tawbah (9) and Al-Fatihah gets it as verse 1
            if (ayah.surah.number !== 9 && ayah.numberInSurah === 1 && ayah.surah.number !== 1) {
                html += `<div class="bismillah">بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ</div>`;
            }
        }

        html += `
          <div class="verse-block" style="animation-delay:${idx * 0.03}s">
            <div class="verse-arabic" style="font-size:${arabicFontSize}px">
              ${ayah.text}
              <span class="verse-num-badge">${toArabicNumerals(ayah.numberInSurah)}</span>
            </div>
            <div class="verse-translation ${showTranslation ? '' : 'hidden'}">
              ${engAyah ? escapeHtml(engAyah.text) : ''}
            </div>
            <div class="verse-ref">${ayah.surah.englishName} ${ayah.surah.number}:${ayah.numberInSurah}</div>
          </div>`;
    });

    html += '</div>'; // verses-container

    return html;
}

// ======== LOAD PAGE ========
async function loadPage(pageNum) {
    if (pageNum < 1 || pageNum > TOTAL_PAGES) return;

    currentPage = pageNum;
    showLoading();
    updateUI();

    try {
        const data = await fetchPage(pageNum);
        const html = renderPage(data);
        document.getElementById('quranContent').innerHTML = html;
        showContent();

        // Scroll to top of viewer
        document.getElementById('quranViewer').scrollIntoView({ behavior: 'smooth', block: 'start' });

        // Highlight page in grid
        document.querySelectorAll('.page-btn').forEach(b => {
            b.classList.toggle('active', parseInt(b.dataset.page) === pageNum);
        });

    } catch (err) {
        document.getElementById('errorMsg').textContent = 'Failed to load page ' + pageNum + '. Check internet connection.';
        showError();
    }
}

// ======== NAV ========
function changePage(delta) {
    const next = currentPage + delta;
    if (next >= 1 && next <= TOTAL_PAGES) loadPage(next);
}

function updateUI() {
    document.getElementById('currentPageDisplay').textContent = currentPage;
    document.getElementById('pageNumBottom').textContent = currentPage;
    document.getElementById('prevBtn').disabled = currentPage <= 1;
    document.getElementById('nextBtn').disabled = currentPage >= TOTAL_PAGES;
    document.getElementById('prevBtnBottom').disabled = currentPage <= 1;
    document.getElementById('nextBtnBottom').disabled = currentPage >= TOTAL_PAGES;
}

// ======== STATES ========
function showLoading() {
    document.getElementById('loadingState').style.display = 'flex';
    document.getElementById('quranContent').style.display = 'none';
    document.getElementById('errorState').style.display = 'none';
}
function showContent() {
    document.getElementById('loadingState').style.display = 'none';
    document.getElementById('quranContent').style.display = 'block';
    document.getElementById('errorState').style.display = 'none';
}
function showError() {
    document.getElementById('loadingState').style.display = 'none';
    document.getElementById('quranContent').style.display = 'none';
    document.getElementById('errorState').style.display = 'flex';
}

// ======== TRANSLATION TOGGLE ========
function toggleTranslation() {
    showTranslation = !showTranslation;
    const btn = document.getElementById('transToggle');
    btn.classList.toggle('active', showTranslation);
    document.querySelectorAll('.verse-translation').forEach(el => {
        el.classList.toggle('hidden', !showTranslation);
    });
}

// ======== FONT SIZE ========
function changeFont(delta) {
    arabicFontSize = Math.max(18, Math.min(42, arabicFontSize + delta));
    document.querySelectorAll('.verse-arabic').forEach(el => {
        el.style.fontSize = arabicFontSize + 'px';
    });
}

// ======== TABS ========
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.style.display = 'none');
    document.querySelectorAll('.sidebar-tab').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tab).style.display = '';
    btn.classList.add('active');
}

// ======== SURAH LIST ========
async function loadSurahs() {
    try {
        allSurahs = await fetchSurahs();
        renderSurahList(allSurahs);
        renderJuzList();
    } catch (e) {
        document.getElementById('surahList').innerHTML = `
          <div style="padding:20px;text-align:center;color:rgba(255,255,255,0.5);font-size:13px">
            Failed to load surah list
          </div>`;
    }
}

function renderSurahList(surahs) {
    const list = document.getElementById('surahList');
    if (!surahs.length) {
        list.innerHTML = '<div style="padding:20px;text-align:center;color:rgba(255,255,255,0.5);font-size:13px">No surahs found</div>';
        return;
    }
    list.innerHTML = surahs.map(s => `
      <div class="sidebar-item" onclick="goToSurahPage(${s.number})" title="Go to ${s.englishName}">
        <div class="item-num">${s.number}</div>
        <div class="item-info">
          <div class="item-name-ar">${s.name}</div>
          <div class="item-name-en">${s.englishName}</div>
          <div class="item-meta">${s.numberOfAyahs} verses · ${s.revelationType}</div>
        </div>
      </div>`).join('');
}

function filterSurahs(query) {
    const q = query.toLowerCase();
    const filtered = allSurahs.filter(s =>
        s.englishName.toLowerCase().includes(q) ||
        s.name.includes(query) ||
        String(s.number).includes(q)
    );
    renderSurahList(filtered);
}

async function goToSurahPage(surahNum) {
    // Get page number of surah start
    try {
        const res = await fetch(`https://api.alquran.cloud/v1/surah/${surahNum}`);
        const data = await res.json();
        const page = data.data.ayahs[0].page;
        loadPage(page);
    } catch (e) {
        // Fallback: just load page 1
        loadPage(1);
    }
}

// ======== JUZ LIST ========
function renderJuzList() {
    const juzData = [
        {n:1,name:'Alif Lam Mim',start:'Al-Fatihah 1:1'},
        {n:2,name:'Sayaqul',start:'Al-Baqarah 2:142'},
        {n:3,name:'Tilka Ar-Rusul',start:'Al-Baqarah 2:253'},
        {n:4,name:'Lan Tana Lu',start:'Ali \'Imran 3:92'},
        {n:5,name:'Wal Muhsanat',start:'An-Nisa 4:24'},
        {n:6,name:'La Yuhibbu Allah',start:'An-Nisa 4:148'},
        {n:7,name:'Wa Iza Sami\'u',start:'Al-Ma\'idah 5:82'},
        {n:8,name:'Wa Law Annana',start:'Al-An\'am 6:111'},
        {n:9,name:'Qal Al-Mala',start:'Al-A\'raf 7:88'},
        {n:10,name:'Wa Alamu',start:'Al-Anfal 8:41'},
        {n:11,name:'Ya\'tadhirun',start:'At-Tawbah 9:93'},
        {n:12,name:'Wa Ma Min Da\'abba',start:'Hud 11:6'},
        {n:13,name:'Wa Ma Ubri\'u',start:'Yusuf 12:53'},
        {n:14,name:'Rubama',start:'Al-Hijr 15:1'},
        {n:15,name:'Subhana Allathi',start:'Al-Isra 17:1'},
        {n:16,name:'Qal Alum',start:'Al-Kahf 18:75'},
        {n:17,name:'Aqtaraba',start:'Al-Anbiya 21:1'},
        {n:18,name:'Qad Aflaha',start:'Al-Mu\'minun 23:1'},
        {n:19,name:'Wa Qal Allathina',start:'Al-Furqan 25:21'},
        {n:20,name:'Amman Khalaqa',start:'An-Naml 27:60'},
        {n:21,name:'Utlu Ma Uhiya',start:'Al-Ankabut 29:45'},
        {n:22,name:'Wa Man Yaqnut',start:'Al-Ahzab 33:31'},
        {n:23,name:'Wa Mali',start:'Ya-Sin 36:28'},
        {n:24,name:'Fa Man Azlamu',start:'Az-Zumar 39:32'},
        {n:25,name:'Ilayhi Yuraddu',start:'Fussilat 41:47'},
        {n:26,name:'Ha Mim',start:'Al-Ahqaf 46:1'},
        {n:27,name:'Qala Fa Ma Khatbukum',start:'Adh-Dhariyat 51:31'},
        {n:28,name:'Qad Sami Allahu',start:'Al-Mujadila 58:1'},
        {n:29,name:'Tabaraka Allathi',start:'Al-Mulk 67:1'},
        {n:30,name:'Amma',start:'An-Naba 78:1'}
    ];
    // Approximate page numbers for each juz
    const juzPages = [1,22,42,62,82,102,121,142,162,182,201,222,242,262,282,302,322,342,362,382,402,422,442,462,482,502,522,542,562,582];

    document.getElementById('juzList').innerHTML = juzData.map((j, i) => `
      <div class="sidebar-item" onclick="loadPage(${juzPages[i]})">
        <div class="item-num">${j.n}</div>
        <div class="item-info">
          <div class="item-name-en" style="font-size:12px;font-weight:700">Juz ${j.n}</div>
          <div class="item-name-en" style="font-size:11px;font-weight:500;color:rgba(255,255,255,0.6)">${j.name}</div>
          <div class="item-meta">Starts: ${j.start}</div>
        </div>
      </div>`).join('');
}

// ======== PAGE GRID ========
function buildPageGrid() {
    const grid = document.getElementById('pageGrid');
    let html = '';
    for (let i = 1; i <= TOTAL_PAGES; i++) {
        html += `<button class="page-btn ${i === 1 ? 'active' : ''}" 
                   data-page="${i}" onclick="loadPage(${i})">${i}</button>`;
    }
    grid.innerHTML = html;
}

// ======== HELPERS ========
function toArabicNumerals(num) {
    return String(num).replace(/\d/g, d => '٠١٢٣٤٥٦٧٨٩'[d]);
}

function escapeHtml(str) {
    return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// ======== NAVBAR SCROLL ========
window.addEventListener('scroll', () => {
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50);
});

// ======== INIT ========
document.addEventListener('DOMContentLoaded', () => {
    buildPageGrid();
    loadSurahs();
    loadPage(1);
});
</script>

@endsection