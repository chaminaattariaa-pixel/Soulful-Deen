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
    --gradient-primary: linear-gradient(135deg,#0d4c3e 0%,#1abc9c 100%);
    --gradient-gold: linear-gradient(135deg,#f39c12 0%,#f1c40f 100%);
}
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Poppins',sans-serif; background: linear-gradient(135deg,#0c3529 0%,#186d53 100%); min-height:100vh; color:#333; }

/* NAVBAR (same as Quran page) */
.navbar { position:fixed; top:0; left:0; width:100%; background:rgba(13,76,62,.97); backdrop-filter:blur(15px); z-index:1000; border-bottom:2px solid rgba(241,196,15,.3); padding:15px 0; transition:all .4s; }
.navbar.scrolled { box-shadow:0 10px 40px rgba(0,0,0,.4); padding:10px 0; }
.navbar-brand { font-size:1.8rem; font-weight:900; color:#fff; text-decoration:none; display:flex; align-items:center; gap:12px; }
.navbar-brand img { height:50px; border-radius:50%; border:3px solid var(--gold); box-shadow:0 0 20px rgba(241,196,15,.5); }
.navbar-brand span { background:linear-gradient(45deg,#fff,var(--gold)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.nav-links { display:flex; gap:25px; list-style:none; align-items:center; margin:0; }
.nav-links a { color:#fff; text-decoration:none; font-weight:600; transition:all .3s; padding:6px 0; font-size:15px; display:flex; align-items:center; gap:7px; }
.nav-links a i { color:var(--gold); }
.nav-links a:hover, .nav-links a.active { color:var(--gold); }

.hadith-page { min-height:100vh; padding-top:90px; padding-bottom:60px; }

/* HERO */
.hadith-hero {
    background: linear-gradient(rgba(13,76,62,.9),rgba(13,76,62,.94)),
                url('https://images.unsplash.com/photo-1585036156171-384164a8c675?w=1600') center/cover;
    padding:50px 40px 40px; text-align:center; color:#fff;
    border-bottom:3px solid rgba(241,196,15,.4);
}
.hadith-hero .book-ar { font-family:'Scheherazade New','Amiri',serif; font-size:3rem; color:var(--gold); text-shadow:0 2px 20px rgba(241,196,15,.5); line-height:1.3; }
.hadith-hero h1 { font-size:2.4rem; font-weight:900; background:linear-gradient(45deg,#fff 30%,var(--gold) 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; margin:6px 0; }
.hadith-hero p { color:rgba(255,255,255,.8); font-size:.95rem; }
.hadith-hero .author-chip { display:inline-block; margin-top:10px; padding:5px 16px; border-radius:20px; background:rgba(241,196,15,.15); border:1px solid rgba(241,196,15,.4); color:var(--gold); font-size:12px; font-weight:700; }

/* LAYOUT */
.hadith-layout { max-width:1500px; margin:0 auto; padding:30px; display:grid; grid-template-columns:320px 1fr; gap:28px; align-items:start; }

/* SIDEBAR */
.sidebar {
    position:sticky; top:100px;
    background:rgba(255,255,255,.07);
    backdrop-filter:blur(20px);
    border-radius:24px;
    border:1.5px solid rgba(255,255,255,.15);
    overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,.35);
    max-height:calc(100vh - 120px);
    display:flex; flex-direction:column;
}
.sidebar-header { background:var(--gradient-primary); padding:20px 22px; display:flex; align-items:center; gap:12px; border-bottom:2px solid rgba(241,196,15,.3); flex-shrink:0; }
.sidebar-header i { color:var(--gold); font-size:20px; }
.sidebar-header h3 { color:#fff; font-size:1.05rem; font-weight:700; margin:0; }
.sidebar-header .sub { color:rgba(255,255,255,.6); font-size:11px; margin-top:2px; }

/* Book picker dropdown-style */
.book-picker { padding:14px; border-bottom:1px solid rgba(255,255,255,.1); }
.book-picker label { color:rgba(255,255,255,.5); font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:.5px; display:block; margin-bottom:6px; }
.book-picker select {
    width:100%; padding:10px 14px;
    background:rgba(255,255,255,.1);
    border:1.5px solid rgba(255,255,255,.2);
    border-radius:12px;
    color:#fff; font-family:'Poppins',sans-serif;
    font-size:13px; font-weight:600; outline:none; cursor:pointer;
}
.book-picker select option { background:#0d4c3e; color:#fff; }

/* Tabs */
.sidebar-tabs { display:flex; border-bottom:1.5px solid rgba(255,255,255,.1); flex-shrink:0; }
.sidebar-tab { flex:1; padding:13px 8px; background:transparent; border:none; color:rgba(255,255,255,.6); font-family:'Poppins',sans-serif; font-size:12.5px; font-weight:600; cursor:pointer; transition:all .3s; display:flex; align-items:center; justify-content:center; gap:6px; }
.sidebar-tab.active { color:var(--gold); background:rgba(241,196,15,.1); border-bottom:2px solid var(--gold); }
.sidebar-tab:hover:not(.active) { color:#fff; background:rgba(255,255,255,.05); }

.sidebar-search { padding:14px 14px 8px; flex-shrink:0; }
.search-wrap { position:relative; }
.search-wrap i { position:absolute; left:13px; top:50%; transform:translateY(-50%); color:rgba(255,255,255,.45); font-size:14px; pointer-events:none; }
.sidebar-search input { width:100%; padding:10px 14px 10px 38px; background:rgba(255,255,255,.1); border:1.5px solid rgba(255,255,255,.2); border-radius:12px; color:#fff; font-family:'Poppins',sans-serif; font-size:13.5px; outline:none; transition:all .3s; }
.sidebar-search input::placeholder { color:rgba(255,255,255,.45); }
.sidebar-search input:focus { border-color:var(--gold); background:rgba(255,255,255,.15); }

.sidebar-list { flex:1; overflow-y:auto; padding:8px 0; }
.sidebar-list::-webkit-scrollbar { width:4px; }
.sidebar-list::-webkit-scrollbar-thumb { background:rgba(241,196,15,.4); border-radius:4px; }

.sidebar-item { display:flex; align-items:center; padding:12px 16px; cursor:pointer; transition:all .25s; border-bottom:1px solid rgba(255,255,255,.05); gap:12px; }
.sidebar-item:hover { background:rgba(255,255,255,.08); }
.sidebar-item.active { background:rgba(241,196,15,.12); border-left:3px solid var(--gold); }
.item-num { width:34px; height:34px; border-radius:50%; background:rgba(241,196,15,.15); border:1.5px solid rgba(241,196,15,.3); display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; color:var(--gold); flex-shrink:0; }
.item-info { flex:1; min-width:0; }
.item-name-en { font-size:13px; font-weight:600; color:#fff; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.item-name-ar { font-family:'Amiri',serif; font-size:15px; color:var(--gold); direction:rtl; line-height:1.3; }
.item-meta { font-size:11px; color:rgba(255,255,255,.5); margin-top:2px; }

/* MAIN CONTENT */
.content-area { display:flex; flex-direction:column; gap:22px; }

.controls-bar {
    background:rgba(255,255,255,.08);
    backdrop-filter:blur(20px);
    border-radius:18px;
    padding:16px 22px;
    border:1.5px solid rgba(255,255,255,.15);
    display:flex; align-items:center; justify-content:space-between;
    gap:15px; flex-wrap:wrap;
    box-shadow:0 10px 35px rgba(0,0,0,.25);
}
.controls-left, .controls-right { display:flex; align-items:center; gap:14px; flex-wrap:wrap; }
.page-indicator { color:#fff; font-weight:600; font-size:14px; display:flex; align-items:center; gap:8px; }
.page-indicator span { color:var(--gold); font-size:16px; font-weight:800; }

.ctrl-btn { width:40px; height:40px; border-radius:12px; background:rgba(255,255,255,.1); border:1.5px solid rgba(255,255,255,.2); color:#fff; font-size:15px; cursor:pointer; transition:all .3s; display:flex; align-items:center; justify-content:center; }
.ctrl-btn:hover:not(:disabled) { background:rgba(241,196,15,.2); border-color:var(--gold); color:var(--gold); transform:scale(1.08); }
.ctrl-btn:disabled { opacity:.35; cursor:not-allowed; }

.font-controls { display:flex; align-items:center; gap:8px; }
.font-label { color:rgba(255,255,255,.6); font-size:12px; font-weight:600; }
.font-size-btn { padding:7px 13px; background:rgba(255,255,255,.1); border:1.5px solid rgba(255,255,255,.2); border-radius:10px; color:#fff; font-size:13px; font-weight:700; cursor:pointer; transition:all .2s; font-family:'Poppins',sans-serif; }
.font-size-btn:hover { background:rgba(241,196,15,.15); border-color:var(--gold); color:var(--gold); }

.translation-toggle { display:flex; align-items:center; gap:8px; background:rgba(255,255,255,.08); border:1.5px solid rgba(255,255,255,.15); border-radius:12px; padding:8px 16px; cursor:pointer; transition:all .3s; color:#fff; font-size:13px; font-weight:600; font-family:'Poppins',sans-serif; white-space:nowrap; }
.translation-toggle.active { background:rgba(241,196,15,.18); border-color:var(--gold); color:var(--gold); }

/* VIEWER */
.hadith-viewer {
    background:rgba(255,255,255,.06);
    backdrop-filter:blur(25px);
    border-radius:24px;
    border:1.5px solid rgba(255,255,255,.15);
    box-shadow:0 25px 80px rgba(0,0,0,.4);
    overflow:hidden;
    min-height:500px;
}

.loading-state { display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:500px; gap:20px; color:rgba(255,255,255,.7); }
.spinner { width:60px; height:60px; border:4px solid rgba(255,255,255,.1); border-top-color:var(--gold); border-radius:50%; animation:spin .9s linear infinite; }
@keyframes spin { to { transform:rotate(360deg); } }

.error-state { display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:400px; gap:16px; padding:40px; }
.error-state i { font-size:50px; color:#e74c3c; }
.error-state p { color:rgba(255,255,255,.7); font-size:16px; text-align:center; }
.retry-btn { padding:12px 30px; background:var(--gradient-gold); border:none; border-radius:50px; color:var(--dark); font-weight:700; cursor:pointer; font-size:14px; font-family:'Poppins',sans-serif; }

.viewer-header { background:linear-gradient(135deg,rgba(13,76,62,.8),rgba(26,188,156,.5)); padding:18px 30px; display:flex; align-items:center; justify-content:space-between; border-bottom:1.5px solid rgba(241,196,15,.25); flex-wrap:wrap; gap:10px; }
.viewer-header-left h4 { color:var(--gold); font-size:1.05rem; font-weight:800; margin:0; }
.viewer-header-left span { color:rgba(255,255,255,.7); font-size:12px; }
.viewer-header-right { font-family:'Amiri',serif; font-size:1.4rem; color:var(--gold); }

.hadith-container { padding:10px 30px 30px; }

/* Hadith card */
.hadith-block {
    padding:24px 20px;
    border-bottom:1px solid rgba(255,255,255,.07);
    border-radius:14px;
    margin-bottom:8px;
    animation:fadeInVerse .4s ease both;
    transition:background .25s;
}
.hadith-block:hover { background:rgba(255,255,255,.04); }
@keyframes fadeInVerse { from { opacity:0; transform:translateY(15px); } to { opacity:1; transform:translateY(0); } }

.hadith-meta-top { display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; margin-bottom:14px; }
.hadith-num-badge { display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:20px; background:rgba(241,196,15,.15); border:1.5px solid rgba(241,196,15,.4); color:var(--gold); font-size:12px; font-weight:800; }
.hadith-status { padding:5px 12px; border-radius:20px; font-size:11px; font-weight:700; }
.status-sahih { background:rgba(46,204,113,.15); border:1px solid rgba(46,204,113,.4); color:#2ecc71; }
.status-hasan { background:rgba(241,196,15,.15); border:1px solid rgba(241,196,15,.4); color:var(--gold); }
.status-daif { background:rgba(231,76,60,.15); border:1px solid rgba(231,76,60,.4); color:#e74c3c; }

.hadith-arabic {
    font-family:'Scheherazade New','Amiri',serif;
    direction:rtl; text-align:right; line-height:2.1; color:#fff;
    font-size:26px;
    padding:14px 18px;
    background:rgba(0,0,0,.12);
    border-radius:14px;
    margin-bottom:14px;
    text-shadow:0 1px 8px rgba(0,0,0,.25);
    transition:font-size .3s;
    border-right:3px solid rgba(241,196,15,.4);
}

.hadith-english { color:rgba(255,255,255,.82); font-size:15px; line-height:1.85; padding:0 6px; margin-bottom:12px; transition:all .3s; }
.hadith-english.hidden { display:none; }

.hadith-urdu {
    font-family:'Scheherazade New','Amiri',serif;
    direction:rtl; text-align:right;
    color:rgba(255,255,255,.82);
    font-size:20px; line-height:2;
    padding:0 6px; margin-bottom:12px;
    transition:all .3s;
}
.hadith-urdu.hidden { display:none; }

.hadith-narrator {
    display:inline-flex; align-items:center; gap:8px;
    padding:6px 14px; border-radius:20px;
    background:rgba(142,68,173,.15); border:1px solid rgba(142,68,173,.4);
    color:#c39bd3; font-size:12px; font-weight:600;
    margin-bottom:10px;
}
.hadith-ref { font-size:11.5px; color:rgba(255,255,255,.4); font-weight:500; margin-top:6px; }

/* Chapter opener */
.chapter-opener { text-align:center; padding:22px 20px 18px; border-bottom:1px dashed rgba(241,196,15,.25); margin-bottom:8px; }
.chapter-opener-name { font-family:'Scheherazade New','Amiri',serif; font-size:2rem; color:var(--gold); direction:rtl; line-height:1.4; }
.chapter-opener-en { color:#fff; font-size:1.05rem; font-weight:700; margin-top:6px; }
.chapter-badge { display:inline-block; margin-top:8px; padding:4px 12px; border-radius:20px; background:rgba(241,196,15,.15); border:1px solid rgba(241,196,15,.3); color:var(--gold); font-size:11px; font-weight:700; }

/* Pagination */
.pagination-bar { display:flex; align-items:center; justify-content:center; gap:15px; padding:22px; border-top:1.5px solid rgba(255,255,255,.08); background:rgba(0,0,0,.15); flex-wrap:wrap; }
.pag-btn { display:flex; align-items:center; gap:8px; padding:11px 24px; border-radius:50px; border:1.5px solid rgba(255,255,255,.2); background:rgba(255,255,255,.08); color:#fff; font-size:14px; font-weight:700; cursor:pointer; transition:all .35s; font-family:'Poppins',sans-serif; }
.pag-btn:hover:not(:disabled) { background:var(--gradient-gold); border-color:var(--gold); color:var(--dark); transform:translateY(-3px); box-shadow:0 10px 30px rgba(241,196,15,.35); }
.pag-btn:disabled { opacity:.3; cursor:not-allowed; }
.pag-info { color:rgba(255,255,255,.7); font-size:14px; font-weight:600; }
.pag-info strong { color:var(--gold); font-size:17px; }

/* Responsive */
@media (max-width:1000px) { .hadith-layout { grid-template-columns:1fr; } .sidebar { position:relative; top:0; max-height:none; } .sidebar-list { max-height:320px; } }
@media (max-width:600px) {
    .hadith-hero { padding:35px 20px 30px; }
    .hadith-hero .book-ar { font-size:2.2rem; }
    .hadith-hero h1 { font-size:1.7rem; }
    .hadith-layout { padding:15px; }
    .hadith-container { padding:10px 16px 20px; }
    .viewer-header { padding:14px 18px; }
    .hadith-arabic { font-size:1.5rem !important; padding:12px; }
}
</style>

<nav class="navbar" id="mainNav">
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

<div class="hadith-page"

     id="hadithPage"

     data-book-slug="{{ $book['slug'] }}"

     data-book-name="{{ $book['name'] }}"

     data-book-number="{{ (int) $bookNumber }}"

     data-page="{{ (int) $page }}"

     data-chapters='@json($chapters)'
>

    <!-- Hero -->
    <div class="hadith-hero">
        <div class="book-ar">{{ $book['arabic'] }}</div>
        <h1>{{ $book['name'] }}</h1>
        <p>{{ $book['description'] }}</p>
        <div class="author-chip"><i class="fas fa-user-pen"></i> {{ $book['author'] }} · {{ $book['reliability'] }}</div>
    </div>

    <div class="hadith-layout">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-book-open"></i>
                <div>
                    <h3>Hadith Navigator</h3>
                    <div class="sub">{{ $book['name'] }}</div>
                </div>
            </div>

            <!-- Book picker -->
            <div class="book-picker">
                <label>Switch Book</label>
                <select id="bookPicker">
                    @foreach($books as $b)
                        <option value="{{ $b['slug'] }}" {{ $b['slug'] === $book['slug'] ? 'selected' : '' }}>
                            {{ $b['name'] }} ({{ number_format($b['total_hadiths']) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="sidebar-tabs">
                <button type="button" class="sidebar-tab active" data-tab="chapters">
                    <i class="fas fa-list"></i> Chapters
                </button>
                <button type="button" class="sidebar-tab" data-tab="search">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>

            <!-- Chapters Tab -->
            <div id="tab-chapters" class="tab-panel" style="display:flex; flex-direction:column; flex:1; min-height:0;">
                <div class="sidebar-search">
                    <div class="search-wrap">
                        <i class="fas fa-search"></i>
                        <input type="text" id="chapterSearch" placeholder="Filter chapters...">
                    </div>
                </div>
                <div class="sidebar-list" id="chapterList">
                    @if(empty($chapters))
                        <div style="padding:20px;text-align:center;color:rgba(255,255,255,.5);font-size:13px">
                            <i class="fas fa-exclamation-circle" style="font-size:24px;margin-bottom:8px;display:block"></i>
                            No chapters available.<br>
                            <small>Check your Hadith API key.</small>
                        </div>
                    @else
                        @foreach($chapters as $ch)
                            <div class="sidebar-item {{ $bookNumber == $ch['chapterNumber'] ? 'active' : '' }}"
                                 data-chapter="{{ $ch['chapterNumber'] }}"
                                 data-name="{{ strtolower($ch['chapterEnglish'] ?? '') }}">
                                <div class="item-num">{{ $ch['chapterNumber'] }}</div>
                                <div class="item-info">
                                    <div class="item-name-ar">{{ $ch['chapterArabic'] ?? '' }}</div>
                                    <div class="item-name-en">{{ $ch['chapterEnglish'] ?? ('Chapter ' . $ch['chapterNumber']) }}</div>
                                    <div class="item-meta">{{ $ch['hadiths_count'] ?? 0 }} hadiths</div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Search Tab -->
            <div id="tab-search" class="tab-panel" style="display:none; flex-direction:column; flex:1; min-height:0;">
                <div class="sidebar-search">
                    <div class="search-wrap">
                        <i class="fas fa-search"></i>
                        <input type="text" id="quickSearch" placeholder="Search hadith...">
                    </div>
                </div>
                <div style="padding:8px 14px 14px">
                    <button type="button" id="quickSearchBtn" style="width:100%;padding:11px;border-radius:12px;border:none;background:var(--gradient-gold);color:var(--dark);font-weight:800;font-family:'Poppins',sans-serif;font-size:13px;cursor:pointer;">
                        <i class="fas fa-search"></i> Search Hadiths
                    </button>
                </div>
                <div style="padding:0 14px 14px;color:rgba(255,255,255,.5);font-size:11.5px;line-height:1.6">
                    Searches within <strong style="color:var(--gold)">{{ $book['name'] }}</strong>. Results open in a new page.
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="content-area">

            <div class="controls-bar">
                <div class="controls-left">
                    <div class="page-indicator">
                        <i class="fas fa-file-alt" style="color:var(--gold)"></i>
                        Chapter <span id="currentChapterDisplay">{{ $bookNumber }}</span>
                        · Page <span id="currentPageDisplay">{{ $page }}</span>
                    </div>
                    <div class="font-controls">
                        <span class="font-label">Arabic Size:</span>
                        <button type="button" class="font-size-btn" id="fontMinus">A−</button>
                        <button type="button" class="font-size-btn" id="fontPlus">A+</button>
                    </div>
                </div>
                <div class="controls-right">
                    <button type="button" class="translation-toggle active" id="transToggle">
                        <i class="fas fa-language"></i> Translation
                    </button>
                    <button type="button" class="ctrl-btn" title="Previous Page" id="prevBtn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" class="ctrl-btn" title="Next Page" id="nextBtn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div class="hadith-viewer" id="hadithViewer">
                <div class="loading-state" id="loadingState">
                    <div class="spinner"></div>
                    <p>Loading hadiths...</p>
                </div>
                <div id="hadithContent" style="display:none"></div>
                <div class="error-state" id="errorState" style="display:none">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p id="errorMsg">Failed to load. Please try again.</p>
                    <button type="button" class="retry-btn" id="retryBtn"><i class="fas fa-redo"></i> Retry</button>
                </div>
            </div>

            <div class="pagination-bar">
                <button type="button" class="pag-btn" id="prevBtnBottom">
                    <i class="fas fa-chevron-left"></i> Previous
                </button>
                <div class="pag-info">
                    Page <strong id="pageNumBottom">{{ $page }}</strong> / <span id="lastPageBottom">?</span>
                </div>
                <button type="button" class="pag-btn" id="nextBtnBottom">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
(function () {
    'use strict';

    // ====== READ DATA FROM HTML (no Blade inside JS) ======
    const rootEl = document.getElementById('hadithPage');
    const BOOK_SLUG = rootEl.dataset.bookSlug;
    const BOOK_NAME = rootEl.dataset.bookName;
    const INITIAL_CHAPTER = parseInt(rootEl.dataset.bookNumber, 10) || 1;
    const INITIAL_PAGE = parseInt(rootEl.dataset.page, 10) || 1;

    let allChapters = [];
    try {
        allChapters = JSON.parse(rootEl.dataset.chapters || '[]');
    } catch (e) {
        allChapters = [];
    }

    // ====== STATE ======
    let currentChapter = INITIAL_CHAPTER;
    let currentPage = INITIAL_PAGE;
    let lastPage = 1;
    let showTranslation = true;
    let arabicFontSize = 26;

    // ====== API ======
    async function fetchHadiths(chapter, page) {
        const url = '/hadith/' + BOOK_SLUG + '/json?book=' + chapter + '&page=' + page;
        const res = await fetch(url);
        const data = await res.json();

        if (!res.ok || data.success === false) {
            throw new Error(data.error || 'Failed to load hadiths');
        }
        return data;
    }

    // ====== RENDER ======
    function renderHadiths(data) {
        if (!data.hadiths || data.hadiths.length === 0) {
            return '<div class="error-state"><i class="fas fa-inbox"></i><p>No hadiths found on this page.</p></div>';
        }

        let html = ''
            + '<div class="viewer-header">'
            +   '<div class="viewer-header-left">'
            +     '<h4>' + BOOK_NAME + '</h4>'
            +     '<span>Chapter ' + currentChapter + ' · ' + data.hadiths.length + ' hadiths · ' + (data.total || 0) + ' total</span>'
            +   '</div>'
            +   '<div class="viewer-header-right">حديث</div>'
            + '</div>'
            + '<div class="hadith-container">';

        let lastChapterName = null;

        data.hadiths.forEach(function (h, idx) {
            if (h.chapter_name && h.chapter_name !== lastChapterName) {
                lastChapterName = h.chapter_name;
                html += ''
                    + '<div class="chapter-opener">'
                    +   '<div class="chapter-opener-name">' + (h.chapter_arabic || '') + '</div>'
                    +   '<div class="chapter-opener-en">' + h.chapter_name + '</div>'
                    +   '<span class="chapter-badge">Chapter ' + currentChapter + '</span>'
                    + '</div>';
            }

            const s = (h.status || '').toLowerCase();
            let statusClass = 'status-hasan';
            if (s.indexOf('sahih') !== -1) statusClass = 'status-sahih';
            else if (s.indexOf('da') !== -1) statusClass = 'status-daif';

            const statusHtml = h.status
                ? '<span class="hadith-status ' + statusClass + '">' + h.status + '</span>'
                : '';

            const narratorHtml = h.narrator
                ? '<div class="hadith-narrator"><i class="fas fa-user"></i> Narrated by ' + escapeHtml(h.narrator) + '</div>'
                : '';

                const urduHtml = h.urdu
                ? '<div class="hadith-urdu ' + (showTranslation ? '' : 'hidden') + '">' + escapeHtml(h.urdu) + '</div>'
                : '';

            html += ''
                + '<div class="hadith-block" style="animation-delay:' + (idx * 0.03) + 's">'
                +   '<div class="hadith-meta-top">'
                +     '<span class="hadith-num-badge"><i class="fas fa-hashtag"></i> Hadith ' + (h.hadith_number || '—') + '</span>'
                +     statusHtml
                +   '</div>'
                +   '<div class="hadith-arabic" style="font-size:' + arabicFontSize + 'px">' + (h.arabic || '') + '</div>'
                +   '<div class="hadith-english ' + (showTranslation ? '' : 'hidden') + '">'
                +     escapeHtml(h.english || 'Translation not available')
                +   '</div>'
                +   urduHtml
                +   narratorHtml
                +   '<div class="hadith-ref"><i class="fas fa-book"></i> ' + BOOK_NAME + (h.hadith_number ? (' · Hadith ' + h.hadith_number) : '') + '</div>'
                + '</div>';
        });

        html += '</div>';
        return html;
    }

    // ====== LOAD ======
    async function loadChapter(chapter, page) {
        page = page || 1;
        currentChapter = chapter;
        currentPage = page;

        showLoading();
        updateUI();
        highlightActiveChapter();

        try {
            const data = await fetchHadiths(chapter, page);
            lastPage = data.last_page || 1;
            document.getElementById('hadithContent').innerHTML = renderHadiths(data);
            showContent();
            document.getElementById('lastPageBottom').textContent = lastPage;

            document.getElementById('hadithViewer').scrollIntoView({ behavior: 'smooth', block: 'start' });

            const url = new URL(window.location);
            url.searchParams.set('book', chapter);
            url.searchParams.set('page', page);
            window.history.replaceState({}, '', url);
        } catch (err) {
            console.error(err);
            document.getElementById('errorMsg').textContent = err.message || 'Failed to load hadiths';
            showError();
        }
    }

    function changePage(delta) {
        const next = currentPage + delta;
        if (next < 1 || next > lastPage) return;
        loadChapter(currentChapter, next);
    }

    function reloadCurrent() {
        loadChapter(currentChapter, currentPage);
    }

    // ====== UI ======
    function updateUI() {
        document.getElementById('currentChapterDisplay').textContent = currentChapter;
        document.getElementById('currentPageDisplay').textContent = currentPage;
        document.getElementById('pageNumBottom').textContent = currentPage;
        document.getElementById('lastPageBottom').textContent = lastPage;

        document.getElementById('prevBtn').disabled = currentPage <= 1;
        document.getElementById('nextBtn').disabled = currentPage >= lastPage;
        document.getElementById('prevBtnBottom').disabled = currentPage <= 1;
        document.getElementById('nextBtnBottom').disabled = currentPage >= lastPage;
    }

    function showLoading() {
        document.getElementById('loadingState').style.display = 'flex';
        document.getElementById('hadithContent').style.display = 'none';
        document.getElementById('errorState').style.display = 'none';
    }
    function showContent() {
        document.getElementById('loadingState').style.display = 'none';
        document.getElementById('hadithContent').style.display = 'block';
        document.getElementById('errorState').style.display = 'none';
    }
    function showError() {
        document.getElementById('loadingState').style.display = 'none';
        document.getElementById('hadithContent').style.display = 'none';
        document.getElementById('errorState').style.display = 'flex';
    }

    function highlightActiveChapter() {
        document.querySelectorAll('.sidebar-item[data-chapter]').forEach(function (el) {
            el.classList.toggle('active', parseInt(el.dataset.chapter, 10) === currentChapter);
        });
    }

    // ====== TABS ======
    function switchTab(tab) {
        document.querySelectorAll('.tab-panel').forEach(function (p) { p.style.display = 'none'; });
        document.querySelectorAll('.sidebar-tab').forEach(function (b) { b.classList.remove('active'); });

        const panel = document.getElementById('tab-' + tab);
        if (panel) {
            panel.style.display = 'flex';
            panel.style.flexDirection = 'column';
        }

        const btn = document.querySelector('.sidebar-tab[data-tab="' + tab + '"]');
        if (btn) btn.classList.add('active');
    }

    // ====== CHAPTER FILTER ======
    function filterChapters(query) {
        const q = query.toLowerCase().trim();
        document.querySelectorAll('.sidebar-item[data-chapter]').forEach(function (el) {
            const name = (el.dataset.name || '').toLowerCase();
            const num = el.dataset.chapter;
            el.style.display = (!q || name.indexOf(q) !== -1 || num.indexOf(q) !== -1) ? 'flex' : 'none';
        });
    }

    // ====== TRANSLATION / FONT ======
    function toggleTranslation() {
        showTranslation = !showTranslation;
        document.getElementById('transToggle').classList.toggle('active', showTranslation);
        document.querySelectorAll('.hadith-english, .hadith-urdu').forEach(function (el) {
            el.classList.toggle('hidden', !showTranslation);
        });
    }

    function changeFont(delta) {
        arabicFontSize = Math.max(18, Math.min(44, arabicFontSize + delta));
        document.querySelectorAll('.hadith-arabic').forEach(function (el) {
            el.style.fontSize = arabicFontSize + 'px';
        });
    }

    // ====== BOOK SWITCH ======
    function switchBook(slug) {
        if (!slug || slug === BOOK_SLUG) return;
        window.location.href = '/hadith/' + slug;
    }

    // ====== SEARCH ======
    function quickSearch() {
        const q = document.getElementById('quickSearch').value.trim();
        if (!q) return;
        window.location.href = '/hadith/search?q=' + encodeURIComponent(q) + '&book=' + BOOK_SLUG;
    }

    // ====== HELPERS ======
    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    // ====== EVENT WIRING ======
    document.addEventListener('DOMContentLoaded', function () {
        // Book picker
        const picker = document.getElementById('bookPicker');
        if (picker) picker.addEventListener('change', function () { switchBook(this.value); });

        // Tabs
        document.querySelectorAll('.sidebar-tab').forEach(function (btn) {
            btn.addEventListener('click', function () { switchTab(this.dataset.tab); });
        });

        // Chapter click
        document.querySelectorAll('.sidebar-item[data-chapter]').forEach(function (el) {
            el.addEventListener('click', function () {
                loadChapter(parseInt(this.dataset.chapter, 10), 1);
            });
        });

        // Chapter filter
        const chapSearch = document.getElementById('chapterSearch');
        if (chapSearch) chapSearch.addEventListener('input', function () { filterChapters(this.value); });

        // Quick search
        const qsInput = document.getElementById('quickSearch');
        if (qsInput) {
            qsInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') quickSearch();
            });
        }
        const qsBtn = document.getElementById('quickSearchBtn');
        if (qsBtn) qsBtn.addEventListener('click', quickSearch);

        // Font buttons
        const fMinus = document.getElementById('fontMinus');
        const fPlus = document.getElementById('fontPlus');
        if (fMinus) fMinus.addEventListener('click', function () { changeFont(-2); });
        if (fPlus) fPlus.addEventListener('click', function () { changeFont(2); });

        // Translation toggle
        const tToggle = document.getElementById('transToggle');
        if (tToggle) tToggle.addEventListener('click', toggleTranslation);

        // Pagination
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtnBottom = document.getElementById('prevBtnBottom');
        const nextBtnBottom = document.getElementById('nextBtnBottom');
        if (prevBtn) prevBtn.addEventListener('click', function () { changePage(-1); });
        if (nextBtn) nextBtn.addEventListener('click', function () { changePage(1); });
        if (prevBtnBottom) prevBtnBottom.addEventListener('click', function () { changePage(-1); });
        if (nextBtnBottom) nextBtnBottom.addEventListener('click', function () { changePage(1); });

        // Retry
        const retryBtn = document.getElementById('retryBtn');
        if (retryBtn) retryBtn.addEventListener('click', reloadCurrent);

        // Nav scroll
        window.addEventListener('scroll', function () {
            const nav = document.getElementById('mainNav');
            if (nav) nav.classList.toggle('scrolled', window.scrollY > 50);
        });

        // Force chapters panel to be visible on load
        const chapPanel = document.getElementById('tab-chapters');
        if (chapPanel) {
            chapPanel.style.display = 'flex';
            chapPanel.style.flexDirection = 'column';
        }

        // Initial load
        loadChapter(currentChapter, currentPage);
    });
})();
</script>

@endsection