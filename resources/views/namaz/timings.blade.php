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
.navbar {
    position: fixed; top: 0; left: 0; width: 100%;
    background: rgba(13, 76, 62, 0.95);
    backdrop-filter: blur(15px);
    z-index: 1000;
    transition: all 0.4s ease;
    border-bottom: 2px solid rgba(241, 196, 15, 0.3);
    padding: 15px 0;
}
.navbar.scrolled { background: rgba(13, 76, 62, 0.98); box-shadow: 0 10px 40px rgba(0,0,0,0.4); padding: 10px 0; }
.navbar-brand { font-size: 2rem; font-weight: 900; color: #fff; text-decoration: none; display: flex; align-items: center; gap: 15px; letter-spacing: -0.5px; }
.navbar-brand img { height: 60px; border-radius: 50%; border: 3px solid var(--gold); box-shadow: 0 0 20px rgba(241,196,15,0.5); }
.navbar-brand span { background: linear-gradient(45deg, #fff, var(--gold)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.nav-links { display: flex; gap: 30px; list-style: none; align-items: center; margin: 0; }
.nav-links a { color: #fff; text-decoration: none; font-weight: 600; transition: all 0.3s ease; position: relative; padding: 8px 0; font-size: 16px; display: flex; align-items: center; gap: 8px; }
.nav-links a i { color: var(--gold); font-size: 18px; }
.nav-links a::after { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 3px; background: var(--gold); border-radius: 3px; transition: width 0.4s ease; }
.nav-links a:hover { color: var(--gold); transform: translateY(-2px); }
.nav-links a:hover::after { width: 100%; }

/* HERO */
.timings-hero {
    min-height: 45vh;
    position: relative;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 180px 40px 70px;
    overflow: hidden;
}
.timings-hero-bg {
    position: absolute; inset: 0;
    background:
        linear-gradient(rgba(13, 76, 62, 0.9), rgba(26, 188, 156, 0.75)),
        url('https://static.vecteezy.com/system/resources/thumbnails/035/912/156/small_2x/ai-generated-beautiful-view-of-worship-mosque-building-in-bright-day-photo.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    z-index: 1;
}
.timings-hero-overlay {
    position: absolute; inset: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(241,196,15,0.3) 0%, transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(46,204,113,0.2) 0%, transparent 40%);
    animation: pulseOverlay 12s ease-in-out infinite alternate;
    z-index: 2;
}
@keyframes pulseOverlay { 0% { opacity: .6; } 100% { opacity: 1; } }

.timings-hero-content { position: relative; z-index: 3; max-width: 900px; }
.timings-hero-content h1 {
    font-size: 3.5rem; font-weight: 900; margin-bottom: 18px;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: textGlow 3s ease-in-out infinite;
}
@keyframes textGlow {
    0%, 100% { filter: brightness(1) drop-shadow(0 0 20px rgba(241,196,15,.3)); }
    50% { filter: brightness(1.2) drop-shadow(0 0 30px rgba(241,196,15,.5)); }
}
.timings-hero-content p { font-size: 1.15rem; color: rgba(255,255,255,0.95); line-height: 1.7; }

/* SECTION */
.timings-section { padding: 60px 40px 80px; max-width: 1400px; margin: 0 auto; }
.section-title { text-align: center; margin-bottom: 40px; }
.section-title h2 {
    font-size: 2.4rem; font-weight: 900; color: #fff; margin-bottom: 12px;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.section-title p { color: rgba(255,255,255,0.85); }

/* CONTROLS */
.timings-controls {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 24px;
    padding: 25px 30px;
    margin-bottom: 40px;
    display: grid;
    grid-template-columns: 1.2fr 1.2fr 1.4fr auto;
    gap: 18px;
    align-items: end;
}
.control-group { display: flex; flex-direction: column; gap: 8px; }
.control-group label {
    font-size: 12px; font-weight: 800;
    color: var(--gold); text-transform: uppercase; letter-spacing: 1.5px;
}
.control-group select,
.control-group input {
    width: 100%;
    padding: 14px 18px;
    border-radius: 50px;
    border: 2px solid rgba(241,196,15,0.4);
    background: rgba(0,0,0,0.25);
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    font-weight: 600;
    outline: none;
    transition: all 0.3s ease;
    appearance: none;
}
.control-group select {
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'><path fill='%23f1c40f' d='M6 8 0 0h12z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 18px center;
    padding-right: 44px;
}
.control-group select:focus,
.control-group input:focus {
    border-color: var(--gold);
    background-color: rgba(0,0,0,0.35);
    box-shadow: 0 0 0 4px rgba(241,196,15,0.15);
}
.control-group option { background: var(--dark); color: #fff; }
.control-group input::placeholder { color: rgba(255,255,255,0.55); }

.btn-fetch {
    padding: 14px 30px;
    border-radius: 50px;
    border: none;
    background: var(--gradient-gold);
    color: var(--dark);
    font-weight: 800;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 15px 35px rgba(243,156,18,0.35);
    font-family: 'Poppins', sans-serif;
    white-space: nowrap;
}
.btn-fetch:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 45px rgba(243,156,18,0.55);
    gap: 14px;
}

/* DATE BANNER */
.today-banner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 25px;
    flex-wrap: wrap;
    background: linear-gradient(135deg, rgba(243,156,18,0.15), rgba(46,204,113,0.15));
    border: 2px solid rgba(241,196,15,0.35);
    border-radius: 25px;
    padding: 25px 35px;
    margin-bottom: 35px;
}
.today-banner .tb-left h3 {
    font-size: 1.5rem; font-weight: 900; color: #fff;
    display: flex; align-items: center; gap: 12px;
}
.today-banner .tb-left h3 i { color: var(--gold); }
.today-banner .tb-left p { color: rgba(255,255,255,0.8); font-size: 14px; margin-top: 6px; font-weight: 600; }
.today-banner .tb-right { display: flex; gap: 30px; flex-wrap: wrap; }
.tb-chip {
    display: flex; flex-direction: column; gap: 4px;
    padding: 12px 20px;
    background: rgba(0,0,0,0.2);
    border-radius: 15px;
    border-left: 4px solid var(--gold);
}
.tb-chip .tb-label {
    font-size: 11px; font-weight: 800; color: var(--gold);
    text-transform: uppercase; letter-spacing: 1.5px;
}
.tb-chip .tb-value { font-size: 15px; font-weight: 800; color: #fff; }

/* TIMINGS GRID */
.timings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 22px;
    margin-bottom: 35px;
}
.timing-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 24px;
    padding: 32px 25px;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.7s ease forwards;
    animation-delay: calc(var(--i, 0) * 0.07s);
    opacity: 0;
}
.timing-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 5px;
    background: var(--gradient-gold);
    transform: scaleX(0);
    transition: transform 0.5s ease;
    transform-origin: left;
}
.timing-card:hover::before { transform: scaleX(1); }
.timing-card:hover {
    transform: translateY(-10px);
    background: rgba(255,255,255,0.2);
    border-color: var(--gold);
    box-shadow: 0 25px 55px rgba(0,0,0,0.4);
}
.timing-card.next-prayer {
    background: var(--gradient-gold);
    border-color: #fff;
    box-shadow: 0 0 40px rgba(241,196,15,0.55);
    animation: nextPulse 2.5s ease-in-out infinite;
}
@keyframes nextPulse {
    0%, 100% { box-shadow: 0 0 30px rgba(241,196,15,0.4); }
    50% { box-shadow: 0 0 55px rgba(241,196,15,0.75); }
}
.timing-card.next-prayer .tc-icon,
.timing-card.next-prayer .tc-name,
.timing-card.next-prayer .tc-time,
.timing-card.next-prayer .tc-arabic { color: var(--dark); }

.timing-card .tc-icon {
    font-size: 38px;
    color: var(--gold);
    margin-bottom: 14px;
    display: block;
    filter: drop-shadow(0 0 12px rgba(241,196,15,0.5));
    transition: transform 0.5s ease;
}
.timing-card:hover .tc-icon { transform: rotate(360deg); }
.timing-card .tc-name {
    font-size: 14px;
    font-weight: 800;
    color: var(--gold);
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 8px;
}
.timing-card .tc-arabic {
    font-family: 'Amiri', serif;
    font-size: 1.3rem;
    color: rgba(255,255,255,0.75);
    margin-bottom: 12px;
    direction: rtl;
}
.timing-card .tc-time {
    font-size: 2.2rem;
    font-weight: 900;
    color: #fff;
    text-shadow: 0 2px 12px rgba(0,0,0,0.3);
    letter-spacing: 1px;
}
.timing-card .tc-label-next {
    position: absolute;
    top: 14px; right: 14px;
    font-size: 10px;
    font-weight: 900;
    color: var(--dark);
    background: rgba(255,255,255,0.4);
    padding: 4px 10px;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* COUNTDOWN */
.countdown-box {
    background: rgba(0,0,0,0.3);
    border: 2px dashed rgba(241,196,15,0.4);
    border-radius: 24px;
    padding: 30px;
    text-align: center;
    margin-bottom: 35px;
}
.countdown-box .cb-label {
    font-size: 12px; font-weight: 800; color: var(--gold);
    text-transform: uppercase; letter-spacing: 2px; margin-bottom: 12px;
}
.countdown-box .cb-time {
    font-size: 3rem;
    font-weight: 900;
    color: #fff;
    letter-spacing: 3px;
    text-shadow: 0 2px 15px rgba(241,196,15,0.4);
    font-variant-numeric: tabular-nums;
}
.countdown-box .cb-next {
    font-size: 15px; color: rgba(255,255,255,0.8); margin-top: 10px; font-weight: 600;
}
.countdown-box .cb-next strong { color: var(--gold); }

/* ERROR */
.error-box {
    background: rgba(231,76,60,0.15);
    border: 2px solid rgba(231,76,60,0.5);
    border-radius: 20px;
    padding: 28px;
    text-align: center;
    color: #ffd4d0;
    margin-bottom: 35px;
}
.error-box i { font-size: 40px; color: #e74c3c; margin-bottom: 12px; display: block; }
.error-box h3 { font-size: 1.3rem; margin-bottom: 8px; color: #fff; }

/* EXTRA GRID */
.extra-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 18px;
    margin-top: 30px;
}
.extra-card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    border: 2px solid rgba(255,255,255,0.12);
    border-radius: 18px;
    padding: 22px 20px;
    text-align: center;
    transition: all 0.3s ease;
}
.extra-card:hover {
    background: rgba(255,255,255,0.15);
    border-color: var(--gold);
    transform: translateY(-5px);
}
.extra-card i { color: var(--gold); font-size: 24px; margin-bottom: 10px; display: block; }
.extra-card .ec-name {
    font-size: 12px; font-weight: 800; color: var(--gold);
    text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px;
}
.extra-card .ec-time { font-size: 1.4rem; font-weight: 800; color: #fff; }

/* CTA */
.timings-cta {
    background: linear-gradient(135deg, rgba(243,156,18,0.15), rgba(46,204,113,0.15));
    border: 2px solid rgba(241,196,15,0.35);
    border-radius: 30px;
    padding: 50px 45px;
    text-align: center;
    margin-top: 40px;
    position: relative;
    overflow: hidden;
}
.timings-cta::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 50% 0%, rgba(241,196,15,0.25), transparent 60%);
    pointer-events: none;
}
.timings-cta h3 {
    font-size: 2rem; font-weight: 900; margin-bottom: 12px;
    position: relative; z-index: 2;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.timings-cta p {
    color: rgba(255,255,255,0.9); font-size: 1rem; margin-bottom: 28px;
    max-width: 600px; margin-left: auto; margin-right: auto; line-height: 1.7;
    position: relative; z-index: 2;
}
.timings-cta-btns { display: flex; justify-content: center; gap: 18px; flex-wrap: wrap; position: relative; z-index: 2; }
.cta-btn {
    display: inline-flex; align-items: center; gap: 12px;
    padding: 15px 32px; border-radius: 50px;
    font-weight: 800; font-size: 15px; text-decoration: none;
    transition: all 0.4s ease;
}
.cta-btn.gold {
    background: var(--gradient-gold); color: var(--dark);
    box-shadow: 0 15px 40px rgba(243,156,18,0.4);
}
.cta-btn.gold:hover { transform: translateY(-5px) scale(1.03); box-shadow: 0 25px 60px rgba(243,156,18,0.6); gap: 16px; }
.cta-btn.outline {
    background: transparent; color: #fff;
    border: 2px solid rgba(255,255,255,0.5);
    backdrop-filter: blur(10px);
}
.cta-btn.outline:hover { background: rgba(255,255,255,0.15); border-color: #fff; transform: translateY(-5px); gap: 16px; }

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px) scale(0.96); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .timings-controls { grid-template-columns: 1fr 1fr; }
    .btn-fetch { grid-column: 1 / -1; }
    .timings-hero-content h1 { font-size: 2.6rem; }
    .section-title h2 { font-size: 1.9rem; }
}
@media (max-width: 768px) {
    .nav-links { display: none; }
    .timings-hero { padding: 140px 20px 55px; }
    .timings-hero-content h1 { font-size: 2rem; }
    .timings-hero-content p { font-size: 0.95rem; }
    .timings-section { padding: 40px 15px 60px; }
    .timings-controls { grid-template-columns: 1fr; padding: 20px; }
    .today-banner { padding: 20px; flex-direction: column; align-items: flex-start; }
    .today-banner .tb-right { width: 100%; }
    .tb-chip { flex: 1; }
    .countdown-box .cb-time { font-size: 2.1rem; letter-spacing: 2px; }
    .timing-card { padding: 25px 20px; }
    .timing-card .tc-time { font-size: 1.8rem; }
    .timings-cta { padding: 35px 22px; }
    .timings-cta h3 { font-size: 1.5rem; }
    .cta-btn { padding: 13px 26px; font-size: 14px; }
}
</style>
{{-- @formatter:on --}}

<!-- NAVBAR -->
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
            <li><a href="{{ route('namaz.timings') }}"><i class="fas fa-clock"></i> Timings</a></li>
            <li><a href="/qibla"><i class="fas fa-compass"></i> Qibla</a></li>
            <li><a href="/profile"><i class="fas fa-user"></i> Profile</a></li>
        </ul>
    </div>
</nav>

<!-- HERO -->
<section class="timings-hero">
    <div class="timings-hero-bg"></div>
    <div class="timings-hero-overlay"></div>
    <div class="timings-hero-content">
        <h1>Namaz Timings</h1>
        <p>Accurate prayer times for your city, updated daily from the AlAdhan API</p>
    </div>
</section>

<!-- CONTENT -->
<section class="timings-section">

    {{-- CONTROLS --}}
    <form class="timings-controls" method="GET" action="{{ route('namaz.timings') }}">
        <div class="control-group">
            <label for="cityInput"><i class="fas fa-city"></i> City</label>
            <input
                type="text"
                id="cityInput"
                name="city"
                value="{{ $city }}"
                placeholder="e.g. Karachi"
                list="popularCities"
                autocomplete="off"
            >
            <datalist id="popularCities">
                @foreach($popularCities as $pc)
                    <option value="{{ $pc['city'] }}"></option>
                @endforeach
            </datalist>
        </div>

        <div class="control-group">
            <label for="countryInput"><i class="fas fa-globe"></i> Country</label>
            <input
                type="text"
                id="countryInput"
                name="country"
                value="{{ $country }}"
                placeholder="e.g. Pakistan"
                autocomplete="off"
            >
        </div>

        <div class="control-group">
            <label for="methodSelect"><i class="fas fa-calculator"></i> Calculation Method</label>
            <select id="methodSelect" name="method">
                @foreach($methods as $code => $label)
                    <option value="{{ $code }}" @if((int)$method === (int)$code) selected @endif>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-fetch">
            <i class="fas fa-search-location"></i>
            Get Timings
        </button>
    </form>

    {{-- ERROR --}}
    @if($error)
        <div class="error-box">
            <i class="fas fa-exclamation-circle"></i>
            <h3>Could not load prayer times</h3>
            <p>{{ $error }}</p>
        </div>
    @endif

    {{-- TIMINGS --}}
    @if($timings)
        @php
            $mainPrayers = [
                'Fajr'    => ['label' => 'Fajr',    'arabic' => 'الفجر',  'icon' => 'fa-cloud-sun'],
                'Dhuhr'   => ['label' => 'Dhuhr',   'arabic' => 'الظهر',  'icon' => 'fa-sun'],
                'Asr'     => ['label' => 'Asr',     'arabic' => 'العصر',  'icon' => 'fa-cloud-sun'],
                'Maghrib' => ['label' => 'Maghrib', 'arabic' => 'المغرب', 'icon' => 'fa-cloud-moon'],
                'Isha'    => ['label' => 'Isha',    'arabic' => 'العشاء', 'icon' => 'fa-moon'],
            ];
            $extras = [
                'Imsak'      => ['label' => 'Imsak',      'icon' => 'fa-utensils'],
                'Sunrise'    => ['label' => 'Sunrise',    'icon' => 'fa-sun'],
                'Sunset'     => ['label' => 'Sunset',     'icon' => 'fa-mountain-sun'],
                'Midnight'   => ['label' => 'Midnight',   'icon' => 'fa-star-and-crescent'],
                'Firstthird' => ['label' => 'First 1/3',  'icon' => 'fa-clock'],
                'Lastthird'  => ['label' => 'Last 1/3',   'icon' => 'fa-clock'],
            ];

            // Find next prayer (first one still in the future today)
            $tz = $today['timezone'] ?: config('app.timezone');
            $now = \Carbon\Carbon::now($tz);
            $nextPrayer = null;
            $nextPrayerTime = null;
            foreach ($mainPrayers as $key => $meta) {
                if (! isset($timings[$key])) continue;
                $prayerTime = \Carbon\Carbon::createFromFormat('H:i', $timings[$key], $tz);
                if ($prayerTime->greaterThan($now)) {
                    $nextPrayer = $key;
                    $nextPrayerTime = $prayerTime;
                    break;
                }
            }
        @endphp

        {{-- DATE BANNER --}}
        <div class="today-banner">
            <div class="tb-left">
                <h3><i class="fas fa-calendar-day"></i> {{ $today['gregorian'] }}</h3>
                <p>
                    <i class="fas fa-moon"></i> {{ $today['hijri'] }}
                    &nbsp;·&nbsp;
                    <i class="fas fa-location-dot"></i> {{ $today['city'] }}, {{ $today['country'] }}
                </p>
            </div>
            <div class="tb-right">
                <div class="tb-chip">
                    <span class="tb-label">Timezone</span>
                    <span class="tb-value">{{ $today['timezone'] ?: '—' }}</span>
                </div>
            </div>
        </div>

        {{-- COUNTDOWN --}}
        @if($nextPrayer)
            <div class="countdown-box" id="countdownBox" data-next-time="{{ $nextPrayerTime->toIso8601String() }}">
                <div class="cb-label">Next Prayer In</div>
                <div class="cb-time" id="countdownTime">--:--:--</div>
                <div class="cb-next">
                    Up next: <strong>{{ $nextPrayer }}</strong> at <strong>{{ $timings[$nextPrayer] }}</strong>
                </div>
            </div>
        @endif

        {{-- FIVE PRAYERS --}}
        <div class="timings-grid">
            @foreach($mainPrayers as $key => $meta)
                @if(isset($timings[$key]))
                    <div class="timing-card @if($nextPrayer === $key) next-prayer @endif" data-i="{{ $loop->index }}">
                        @if($nextPrayer === $key)
                            <span class="tc-label-next">Next</span>
                        @endif
                        <i class="fas {{ $meta['icon'] }} tc-icon"></i>
                        <div class="tc-name">{{ $meta['label'] }}</div>
                        <div class="tc-arabic">{{ $meta['arabic'] }}</div>
                        <div class="tc-time">{{ $timings[$key] }}</div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- EXTRA TIMES --}}
        <div class="section-title" style="margin-top: 50px; margin-bottom: 25px;">
            <h2 style="font-size: 1.8rem;">Additional Times</h2>
            <p>Sunrise, sunset, midnight and the thirds of the night</p>
        </div>

        <div class="extra-grid">
            @foreach($extras as $key => $meta)
                @if(isset($timings[$key]))
                    <div class="extra-card">
                        <i class="fas {{ $meta['icon'] }}"></i>
                        <div class="ec-name">{{ $meta['label'] }}</div>
                        <div class="ec-time">{{ $timings[$key] }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    {{-- CTA --}}
    <div class="timings-cta">
        <h3>Need guidance on how to pray?</h3>
        <p>Visit our step-by-step Namaz Guide with authentic Arabic, Urdu and English references.</p>
        <div class="timings-cta-btns">
            <a href="{{ route('namaz.index') }}" class="cta-btn gold">
                <i class="fas fa-book-quran"></i>
                Namaz Guide
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

    // Navbar scroll
    window.addEventListener('scroll', function () {
        var navbar = document.querySelector('.navbar');
        if (!navbar) return;
        if (window.scrollY > 50) navbar.classList.add('scrolled');
        else navbar.classList.remove('scrolled');
    });

    // Stagger delays
    document.querySelectorAll('[data-i]').forEach(function (el) {
        el.style.setProperty('--i', el.getAttribute('data-i'));
    });

    // Countdown
    var box = document.getElementById('countdownBox');
    var el  = document.getElementById('countdownTime');
    if (box && el) {
        var targetIso = box.getAttribute('data-next-time');
        var target = new Date(targetIso).getTime();

        function pad(n) { return n < 10 ? '0' + n : '' + n; }

        function tick() {
            var now = Date.now();
            var diff = target - now;
            if (diff <= 0) {
                el.textContent = '00:00:00';
                clearInterval(handle);
                setTimeout(function () { window.location.reload(); }, 1000);
                return;
            }
            var s = Math.floor(diff / 1000);
            var h = Math.floor(s / 3600);
            s -= h * 3600;
            var m = Math.floor(s / 60);
            s -= m * 60;
            el.textContent = pad(h) + ':' + pad(m) + ':' + pad(s);
        }

        tick();
        var handle = setInterval(tick, 1000);
    }

    // Preserve scroll on form submit
    var form = document.querySelector('.timings-controls');
    if (form) {
        form.addEventListener('submit', function () {
            try { sessionStorage.setItem('namazScrollY', String(window.scrollY)); } catch (e) {}
        });
    }
    try {
        var savedY = sessionStorage.getItem('namazScrollY');
        if (savedY !== null) {
            sessionStorage.removeItem('namazScrollY');
            setTimeout(function () { window.scrollTo({ top: parseInt(savedY, 10), behavior: 'auto' }); }, 50);
        }
    } catch (e) {}
})();
</script>

@endsection