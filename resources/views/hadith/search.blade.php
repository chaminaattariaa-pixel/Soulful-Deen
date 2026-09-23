@extends('layouts')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800;900&family=Scheherazade+New:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root { --primary:#0d4c3e; --gold:#f1c40f; --dark:#1a252f; --gradient-primary: linear-gradient(135deg,#0d4c3e 0%,#1abc9c 100%); --gradient-gold: linear-gradient(135deg,#f39c12 0%,#f1c40f 100%); }
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Poppins',sans-serif; background: linear-gradient(135deg,#0c3529 0%,#186d53 100%); min-height:100vh; color:#333; }

.navbar { position:fixed; top:0; left:0; width:100%; background:rgba(13,76,62,.97); backdrop-filter:blur(15px); z-index:1000; border-bottom:2px solid rgba(241,196,15,.3); padding:15px 0; }
.navbar-brand { font-size:1.8rem; font-weight:900; color:#fff; text-decoration:none; display:flex; align-items:center; gap:12px; }
.navbar-brand img { height:50px; border-radius:50%; border:3px solid var(--gold); }
.navbar-brand span { background:linear-gradient(45deg,#fff,var(--gold)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.nav-links { display:flex; gap:25px; list-style:none; align-items:center; margin:0; }
.nav-links a { color:#fff; text-decoration:none; font-weight:600; font-size:15px; display:flex; align-items:center; gap:7px; }
.nav-links a i { color:var(--gold); }
.nav-links a:hover, .nav-links a.active { color:var(--gold); }

.search-page { min-height:100vh; padding-top:110px; padding-bottom:60px; max-width:1300px; margin:0 auto; padding-left:30px; padding-right:30px; }

.search-header { background:rgba(255,255,255,.07); backdrop-filter:blur(20px); border-radius:24px; padding:30px; border:1.5px solid rgba(255,255,255,.15); margin-bottom:26px; }
.search-header h1 { color:var(--gold); font-size:1.8rem; font-weight:800; margin-bottom:6px; }
.search-header p { color:rgba(255,255,255,.7); font-size:14px; }

.search-form { display:flex; gap:12px; margin-top:20px; flex-wrap:wrap; }
.search-form input, .search-form select {
    padding:13px 18px; border-radius:12px;
    background:rgba(255,255,255,.1);
    border:1.5px solid rgba(255,255,255,.2);
    color:#fff; font-family:'Poppins',sans-serif; font-size:14px; outline:none;
}
.search-form input { flex:1; min-width:220px; }
.search-form input::placeholder { color:rgba(255,255,255,.45); }
.search-form select option { background:#0d4c3e; }
.search-form button {
    padding:13px 30px; border-radius:12px; border:none;
    background:var(--gradient-gold); color:var(--dark);
    font-weight:800; font-family:'Poppins',sans-serif; cursor:pointer; font-size:14px;
}

.results-info { color:#fff; font-size:15px; margin-bottom:18px; padding:0 4px; }
.results-info strong { color:var(--gold); }

.results-list { display:flex; flex-direction:column; gap:18px; }

.hadith-card {
    background:rgba(255,255,255,.07);
    backdrop-filter:blur(20px);
    border-radius:20px;
    border:1.5px solid rgba(255,255,255,.15);
    padding:24px;
    box-shadow:0 15px 45px rgba(0,0,0,.3);
    transition:all .3s;
}
.hadith-card:hover { border-color:rgba(241,196,15,.4); transform:translateY(-3px); }

.hadith-card-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; flex-wrap:wrap; gap:8px; }
.hadith-num-badge { padding:5px 14px; border-radius:20px; background:rgba(241,196,15,.15); border:1px solid rgba(241,196,15,.4); color:var(--gold); font-size:12px; font-weight:800; }
.hadith-source { color:rgba(255,255,255,.55); font-size:12px; font-weight:600; }

.hadith-card-arabic { font-family:'Scheherazade New','Amiri',serif; direction:rtl; text-align:right; line-height:2; color:#fff; font-size:22px; padding:12px 16px; background:rgba(0,0,0,.15); border-radius:12px; margin-bottom:12px; border-right:3px solid rgba(241,196,15,.4); }
.hadith-card-english { color:rgba(255,255,255,.82); font-size:14.5px; line-height:1.8; }
.hadith-card-urdu {
    font-family:'Scheherazade New','Amiri',serif;
    direction:rtl; text-align:right;
    color:rgba(255,255,255,.82);
    font-size:14.5px; line-height:1.8;
    margin-top:8px;
}
.empty-state { text-align:center; padding:80px 30px; color:rgba(255,255,255,.55); }
.empty-state i { font-size:60px; color:rgba(241,196,15,.4); margin-bottom:16px; display:block; }
.empty-state h3 { color:#fff; font-size:1.3rem; margin-bottom:8px; }

.search-pagination { display:flex; align-items:center; justify-content:center; gap:15px; margin-top:28px; flex-wrap:wrap; }
.search-pagination a {
    display:flex; align-items:center; gap:8px;
    padding:11px 24px; border-radius:50px;
    background:rgba(255,255,255,.08); border:1.5px solid rgba(255,255,255,.2);
    color:#fff; font-size:14px; font-weight:700; text-decoration:none;
    transition:all .3s; font-family:'Poppins',sans-serif;
}
.search-pagination a:hover { background:var(--gradient-gold); border-color:var(--gold); color:var(--dark); transform:translateY(-3px); }
.search-pagination .pag-info { color:rgba(255,255,255,.7); font-size:14px; font-weight:600; }
.search-pagination .pag-info strong { color:var(--gold); font-size:17px; }

@media (max-width:600px) {
    .search-page { padding-left:15px; padding-right:15px; padding-top:100px; }
    .search-header { padding:22px 18px; }
    .hadith-card { padding:18px; }
    .hadith-card-arabic { font-size:18px; }
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

<div class="search-page">

    <div class="search-header">
        <h1><i class="fas fa-search" style="color:var(--gold)"></i> Search Hadiths</h1>
        <p>Search across one of the six authentic books of Hadith</p>

        <form class="search-form" method="GET" action="{{ route('hadith.search') }}">
            <input type="text" name="q" value="{{ $query }}" placeholder="e.g. patience, prayer, charity..." autofocus>
            <select name="book" onchange="this.form.submit()">
                @foreach($books as $b)
                    <option value="{{ $b['slug'] }}" {{ $b['slug'] === $bookSlug ? 'selected' : '' }}>{{ $b['name'] }}</option>
                @endforeach
            </select>
            <button type="submit"><i class="fas fa-search"></i> Search</button>
        </form>
    </div>

    @if($query)
        <div class="results-info">
            Found <strong>{{ $total }}</strong> result{{ $total === 1 ? '' : 's' }} for
            "<strong>{{ $query }}</strong>" in <strong>{{ $book['name'] }}</strong>
        </div>
    @else
        <div class="results-info">
            Showing <strong>{{ count($results) }}</strong> of <strong>{{ number_format($total) }}</strong> hadiths from
            <strong>{{ $book['name'] }}</strong> <span style="color:rgba(255,255,255,.5)">(Chapter 1)</span>
        </div>
    @endif

    @if($total > 0)
        <div class="results-list">
            @foreach($results as $h)
                <div class="hadith-card">
                    <div class="hadith-card-top">
                        <span class="hadith-num-badge"><i class="fas fa-hashtag"></i> Hadith {{ $h['hadithNumber'] ?? '—' }}</span>
                        <span class="hadith-source">
                            <i class="fas fa-book"></i>
                            {{ $h['book']['bookName'] ?? $book['name'] }}
                            @if(!empty($h['chapter']['chapterName'])) · {{ $h['chapter']['chapterName'] }} @endif
                        </span>
                    </div>

                    @if(!empty($h['hadithArabic']))
                        <div class="hadith-card-arabic">{{ $h['hadithArabic'] }}</div>
                    @endif

                    @if(!empty($h['hadithEnglish']))
                        <div class="hadith-card-english">{{ $h['hadithEnglish'] }}</div>
                    @endif

                    @if(!empty($h['hadithUrdu']))
                        <div class="hadith-card-urdu">{{ $h['hadithUrdu'] }}</div>
                    @endif
                    
                    @if(!empty($h['englishNarrator']))
                        <div style="margin-top:12px;color:#c39bd3;font-size:12px;">
                            <i class="fas fa-user"></i> Narrated by {{ $h['englishNarrator'] }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        @if(!$query && isset($lastPage) && $lastPage > 1)
            <div class="search-pagination">
                @if($page > 1)
                    <a href="{{ route('hadith.search', ['book' => $bookSlug, 'page' => $page - 1]) }}">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                @endif
                <span class="pag-info">Page <strong>{{ $page }}</strong> / {{ $lastPage }}</span>
                @if($page < $lastPage)
                    <a href="{{ route('hadith.search', ['book' => $bookSlug, 'page' => $page + 1]) }}">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                @endif
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="fas fa-search-minus"></i>
            <h3>No hadiths found</h3>
            <p>Try different keywords or choose another book.</p>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection