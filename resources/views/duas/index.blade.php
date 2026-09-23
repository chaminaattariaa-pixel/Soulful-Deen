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
.duas-hero {
    min-height: 55vh;
    position: relative;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 180px 40px 80px;
    overflow: hidden;
}
.duas-hero-bg {
    position: absolute; inset: 0;
    background:
        linear-gradient(rgba(13, 76, 62, 0.9), rgba(26, 188, 156, 0.75)),
        url('https://static.vecteezy.com/system/resources/thumbnails/035/912/156/small_2x/ai-generated-beautiful-view-of-worship-mosque-building-in-bright-day-photo.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    z-index: 1;
}
.duas-hero-overlay {
    position: absolute; inset: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(241,196,15,0.3) 0%, transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(46,204,113,0.2) 0%, transparent 40%);
    animation: pulseOverlay 12s ease-in-out infinite alternate;
    z-index: 2;
}
@keyframes pulseOverlay { 0% { opacity: .6; } 100% { opacity: 1; } }

.duas-hero-content {
    position: relative; z-index: 3;
    max-width: 900px;
}
.duas-hero-content h1 {
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
.duas-hero-content p {
    font-size: 1.25rem;
    color: rgba(255,255,255,0.95);
    line-height: 1.8;
    margin-bottom: 30px;
}
.duas-hero-content .arabic-title {
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
.duas-section {
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

/* ================= CATEGORIES ================= */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 18px;
    margin-bottom: 60px;
}
.category-chip {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 20px;
    padding: 20px 15px;
    text-align: center;
    cursor: pointer;
    transition: all 0.35s ease;
    animation: fadeInUp 0.7s ease forwards;
    animation-delay: calc(var(--i) * 0.04s);
    opacity: 0;
    user-select: none;
}
.category-chip:hover {
    transform: translateY(-8px);
    background: var(--gradient-primary);
    border-color: var(--gold);
    box-shadow: 0 20px 45px rgba(0,0,0,0.35);
}
.category-chip.active {
    background: var(--gradient-gold);
    border-color: #fff;
    box-shadow: 0 15px 40px rgba(243,156,18,0.5);
}
.category-chip .cat-icon {
    font-size: 32px;
    display: block;
    margin-bottom: 10px;
    filter: drop-shadow(0 4px 10px rgba(0,0,0,0.3));
}
.category-chip .cat-name {
    font-weight: 800;
    color: #fff;
    font-size: 15px;
    margin-bottom: 4px;
}
.category-chip.active .cat-name { color: var(--dark); }
.category-chip .cat-arabic {
    font-family: 'Amiri', serif;
    font-size: 15px;
    color: var(--gold);
    direction: rtl;
}
.category-chip.active .cat-arabic { color: rgba(26,37,47,0.8); }

/* ================= DUA CARDS ================= */
.duas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
    gap: 30px;
}
.dua-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 35px;
    border: 2px solid rgba(255,255,255,0.15);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: calc(var(--i) * 0.05s);
    opacity: 0;
    display: flex;
    flex-direction: column;
}
.dua-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 5px;
    background: var(--gradient-gold);
    transform: scaleX(0);
    transition: transform 0.5s ease;
    transform-origin: left;
}
.dua-card:hover::before { transform: scaleX(1); }
.dua-card:hover {
    transform: translateY(-10px);
    background: rgba(255,255,255,0.18);
    border-color: var(--gold);
    box-shadow: 0 25px 60px rgba(0,0,0,0.4);
}

.dua-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 15px;
    margin-bottom: 20px;
}
.dua-title {
    font-size: 1.35rem;
    font-weight: 800;
    color: var(--gold);
    line-height: 1.3;
}
.dua-actions {
    display: flex;
    gap: 8px;
    flex-shrink: 0;
}
.icon-btn {
    width: 38px; height: 38px;
    border-radius: 50%;
    border: 2px solid rgba(241,196,15,0.4);
    background: rgba(255,255,255,0.08);
    color: var(--gold);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: 14px;
}
.icon-btn:hover {
    background: var(--gold);
    color: var(--dark);
    transform: scale(1.1);
}
.icon-btn.favorited {
    background: var(--gold);
    color: var(--dark);
}

.dua-category-badge {
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

.dua-arabic {
    font-family: 'Amiri', serif;
    font-size: 26px;
    direction: rtl;
    text-align: right;
    line-height: 1.9;
    color: #fff;
    font-weight: 700;
    margin-bottom: 20px;
    padding: 20px;
    background: rgba(0,0,0,0.2);
    border-radius: 15px;
    border-right: 4px solid var(--gold);
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.dua-urdu {
    font-size: 15px;
    line-height: 1.9;
    color: rgba(255,255,255,0.92);
    margin-bottom: 15px;
    direction: rtl;
    text-align: right;
    font-family: 'Amiri', serif;
}
.dua-english {
    font-size: 14px;
    line-height: 1.75;
    color: rgba(255,255,255,0.78);
    font-style: italic;
    margin-bottom: 20px;
}
.dua-reference {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--gold);
    font-size: 13px;
    font-weight: 700;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid rgba(255,255,255,0.1);
}
.dua-reference i { font-size: 14px; }

/* Toast */
.toast {
    position: fixed;
    bottom: 30px; left: 50%;
    transform: translateX(-50%) translateY(100px);
    background: var(--gradient-gold);
    color: var(--dark);
    padding: 15px 30px;
    border-radius: 50px;
    font-weight: 800;
    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
    opacity: 0;
    transition: all 0.4s ease;
    z-index: 9999;
    display: flex;
    align-items: center;
    gap: 10px;
    pointer-events: none;
}
.toast.show {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}

/* Empty state */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    color: rgba(255,255,255,0.7);
}
.empty-state i {
    font-size: 60px;
    color: var(--gold);
    margin-bottom: 20px;
    opacity: 0.6;
}
.empty-state h3 {
    font-size: 1.5rem;
    color: #fff;
    margin-bottom: 10px;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px) scale(0.96); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
    .duas-hero-content h1 { font-size: 3rem; }
    .section-title h2 { font-size: 2.2rem; }
    .duas-grid { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
    .nav-links { display: none; }
    .duas-hero { padding: 140px 20px 60px; }
    .duas-hero-content h1 { font-size: 2.2rem; }
    .duas-hero-content p { font-size: 1rem; }
    .duas-hero-content .arabic-title { font-size: 1.4rem; }
    .duas-section { padding: 60px 15px; }
    .dua-card { padding: 25px; }
    .dua-arabic { font-size: 22px; padding: 15px; }
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
<section class="duas-hero">
    <div class="duas-hero-bg"></div>
    <div class="duas-hero-overlay"></div>
    <div class="duas-hero-content">
        <h1>Daily Duas</h1>
        <p>Authentic supplications from the Quran and Sunnah for every moment of your day</p>
        <span class="arabic-title">اَلدُّعَاءُ مُخُّ الْعِبَادَةِ</span>

        <div class="search-bar-wrap">
            <i class="fas fa-search"></i>
            <input type="text" class="search-bar" id="duaSearch" placeholder="Search duas by title, translation or reference...">
        </div>
    </div>
</section>

<!-- ================= CATEGORIES ================= -->
<section class="duas-section" style="padding-bottom: 0;">
    <div class="section-title">
        <h2>Browse by Category</h2>
        <p>Select a category to filter the supplications</p>
    </div>

    <div class="categories-grid" id="categoriesGrid">
        <div class="category-chip active" data-category="all" style="--i:0">
            <span class="cat-icon">📿</span>
            <div class="cat-name">All Duas</div>
            <div class="cat-arabic">الكل</div>
        </div>
       @foreach($categories as $i => $cat)
            <div class="category-chip" data-category="{{ $cat['slug'] }}" data-i="{{ $i + 1 }}">
                <span class="cat-icon">{{ $cat['icon'] }}</span>
                <div class="cat-name">{{ $cat['name'] }}</div>
                <div class="cat-arabic">{{ $cat['arabic'] }}</div>
            </div>
        @endforeach
    </div>
</section>

<!-- ================= DUAS ================= -->
<section class="duas-section">
    <div class="section-title">
        <h2 id="duasHeading">All Duas</h2>
        <p id="duasCount">Supplications for every occasion</p>
    </div>

    <div class="duas-grid" id="duasGrid">
        @foreach($duas as $i => $dua)
            <div class="dua-card"
                 data-i="{{ $i }}"
                 data-id="{{ $dua['id'] }}"
                 data-category="{{ $dua['category'] }}"
                 data-search="{{ strtolower($dua['title'] . ' ' . $dua['english'] . ' ' . $dua['urdu'] . ' ' . $dua['reference']) }}">
                <div class="dua-header">
                    <div class="dua-title">{{ $dua['title'] }}</div>
                    <div class="dua-actions">
                        <button class="icon-btn copy-btn" title="Copy dua" data-id="{{ $dua['id'] }}">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button class="icon-btn fav-btn" title="Add to favorites" data-id="{{ $dua['id'] }}">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>

                <span class="dua-category-badge">{{ $dua['category'] }}</span>

                <div class="dua-arabic">{{ $dua['arabic'] }}</div>
                <div class="dua-urdu">{{ $dua['urdu'] }}</div>
                <div class="dua-english">{{ $dua['english'] }}</div>

                <div class="dua-reference">
                    <i class="fas fa-bookmark"></i>
                    {{ $dua['reference'] }}
                </div>
            </div>
        @endforeach
    </div>

    <div class="empty-state" id="emptyState" style="display: none;">
        <i class="fas fa-search"></i>
        <h3>No duas found</h3>
        <p>Try a different search term or category</p>
    </div>
</section>

<!-- Toast -->
<div class="toast" id="toast">
    <i class="fas fa-check-circle"></i>
    <span id="toastText">Copied!</span>
</div>

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
    document.querySelectorAll('.dua-card[data-i], .category-chip[data-i]').forEach(function (el) {
        el.style.setProperty('--i', el.getAttribute('data-i'));
    });

    // ---------- Filtering (category + search) ----------
    var activeCategory = 'all';
    var searchTerm = '';
    var cards = document.querySelectorAll('.dua-card');
    var emptyState = document.getElementById('emptyState');
    var headingEl = document.getElementById('duasHeading');
    var countEl = document.getElementById('duasCount');

    function applyFilters() {
        var visible = 0;
        cards.forEach(function (card) {
            var catMatch = (activeCategory === 'all') || (card.getAttribute('data-category') === activeCategory);
            var searchMatch = !searchTerm || (card.getAttribute('data-search') || '').indexOf(searchTerm) !== -1;

            if (catMatch && searchMatch) {
                card.style.display = 'flex';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update heading + count
        var catChip = document.querySelector('.category-chip[data-category="' + activeCategory + '"]');
        var catName = catChip ? catChip.querySelector('.cat-name').textContent : 'All Duas';
        headingEl.textContent = activeCategory === 'all' ? 'All Duas' : catName + ' Duas';
        countEl.textContent = visible + ' supplication' + (visible === 1 ? '' : 's') + ' found';

        // Empty state
        emptyState.style.display = visible === 0 ? 'block' : 'none';
    }

    // Category chip clicks
    document.querySelectorAll('.category-chip').forEach(function (chip) {
        chip.addEventListener('click', function () {
            document.querySelectorAll('.category-chip').forEach(function (c) {
                c.classList.remove('active');
            });
            chip.classList.add('active');
            activeCategory = chip.getAttribute('data-category');
            applyFilters();
        });
    });

    // Search input
    var searchInput = document.getElementById('duaSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            searchTerm = this.value.trim().toLowerCase();
            applyFilters();
        });
    }

    // ---------- Toast helper ----------
    var toast = document.getElementById('toast');
    var toastText = document.getElementById('toastText');
    var toastTimer = null;

    function showToast(msg) {
        toastText.textContent = msg;
        toast.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () {
            toast.classList.remove('show');
        }, 2000);
    }

    // ---------- Copy to clipboard ----------
    document.querySelectorAll('.copy-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var card = btn.closest('.dua-card');
            if (!card) return;
            var title = card.querySelector('.dua-title').textContent.trim();
            var arabic = card.querySelector('.dua-arabic').textContent.trim();
            var urdu = card.querySelector('.dua-urdu').textContent.trim();
            var english = card.querySelector('.dua-english').textContent.trim();
            var reference = card.querySelector('.dua-reference').textContent.trim();

            var text = title + '\n\n' + arabic + '\n\n' + urdu + '\n\n' + english + '\n\n— ' + reference;

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(function () {
                    showToast('Dua copied to clipboard!');
                }).catch(function () {
                    fallbackCopy(text);
                });
            } else {
                fallbackCopy(text);
            }
        });
    });

    function fallbackCopy(text) {
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.select();
        try { document.execCommand('copy'); showToast('Dua copied to clipboard!'); }
        catch (e) { showToast('Copy failed'); }
        document.body.removeChild(ta);
    }

    // ---------- Favorites (localStorage) ----------
    var FAV_KEY = 'soulfuldeen_dua_favorites';
    var favorites = {};
    try { favorites = JSON.parse(localStorage.getItem(FAV_KEY) || '{}'); } catch (e) { favorites = {}; }

    function saveFavorites() {
        try { localStorage.setItem(FAV_KEY, JSON.stringify(favorites)); } catch (e) {}
    }

    function updateFavButton(btn, id) {
        var icon = btn.querySelector('i');
        if (favorites[id]) {
            btn.classList.add('favorited');
            icon.classList.remove('far');
            icon.classList.add('fas');
            btn.title = 'Remove from favorites';
        } else {
            btn.classList.remove('favorited');
            icon.classList.remove('fas');
            icon.classList.add('far');
            btn.title = 'Add to favorites';
        }
    }

    document.querySelectorAll('.fav-btn').forEach(function (btn) {
        var id = btn.getAttribute('data-id');
        updateFavButton(btn, id);

        btn.addEventListener('click', function () {
            favorites[id] = !favorites[id];
            if (!favorites[id]) delete favorites[id];
            saveFavorites();
            updateFavButton(btn, id);
            showToast(favorites[id] ? 'Added to favorites' : 'Removed from favorites');
        });
    });

    // Initial state
    applyFilters();
})();
</script>

@endsection