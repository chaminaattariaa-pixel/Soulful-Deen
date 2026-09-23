@extends('layouts')

@section('content')

@php
    $arabicMonths = [
        1  => 'مُحَرَّم',
        2  => 'صَفَر',
        3  => 'رَبِيع ٱلْأَوَّل',
        4  => 'رَبِيع ٱلثَّانِي',
        5  => 'جُمَادَىٰ ٱلْأُولَىٰ',
        6  => 'جُمَادَىٰ ٱلثَّانِيَة',
        7  => 'رَجَب',
        8  => 'شَعْبَان',
        9  => 'رَمَضَان',
        10 => 'شَوَّال',
        11 => 'ذُو ٱلْقَعْدَة',
        12 => 'ذُو ٱلْحِجَّة',
    ];
@endphp

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
    position: fixed;
    top: 0; left: 0;
    width: 100%;
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
.cal-hero {
    min-height: 60vh;
    position: relative;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 160px 40px 80px;
    overflow: hidden;
}
.cal-hero-bg {
    position: absolute; inset: 0;
    background:
        linear-gradient(rgba(13, 76, 62, 0.9), rgba(26, 188, 156, 0.75)),
        url('https://static.vecteezy.com/system/resources/thumbnails/035/912/156/small_2x/ai-generated-beautiful-view-of-worship-mosque-building-in-bright-day-photo.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    z-index: 1;
}
.cal-hero-overlay {
    position: absolute; inset: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(241,196,15,0.3) 0%, transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(46,204,113,0.2) 0%, transparent 40%);
    animation: pulseOverlay 12s ease-in-out infinite alternate;
    z-index: 2;
}
@keyframes pulseOverlay {
    0% { opacity: 0.6; } 100% { opacity: 1; }
}
.cal-hero-content {
    position: relative; z-index: 3;
    max-width: 900px;
}
.cal-hero-content h1 {
    font-size: 4rem; font-weight: 900;
    margin-bottom: 20px;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: textGlow 3s ease-in-out infinite;
}
@keyframes textGlow {
    0%, 100% { filter: brightness(1) drop-shadow(0 0 20px rgba(241,196,15,0.3)); }
    50% { filter: brightness(1.2) drop-shadow(0 0 30px rgba(241,196,15,0.5)); }
}
.cal-hero-content p {
    font-size: 1.3rem;
    color: rgba(255,255,255,0.95);
    line-height: 1.8;
    margin-bottom: 30px;
}

/* Current Hijri Badge */
.hijri-badge {
    display: inline-flex;
    align-items: center;
    gap: 20px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(20px);
    padding: 20px 40px;
    border-radius: 50px;
    border: 2px solid rgba(241,196,15,0.5);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    margin-top: 20px;
}
.hijri-badge i {
    font-size: 40px; color: var(--gold);
    filter: drop-shadow(0 0 10px rgba(241,196,15,0.5));
}
.hijri-badge .hijri-date {
    font-family: 'Amiri', serif;
    font-size: 2rem; font-weight: 700;
    color: #fff;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.hijri-badge .greg-date {
    font-size: 0.95rem; color: var(--gold);
    font-weight: 600;
    display: block; margin-top: 5px;
}

/* ================= SECTION ================= */
.cal-section {
    padding: 100px 40px;
    max-width: 1400px;
    margin: 0 auto;
}
.section-title {
    text-align: center;
    margin-bottom: 60px;
}
.section-title h2 {
    font-size: 3rem; font-weight: 900;
    color: #fff;
    margin-bottom: 15px;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.section-title p {
    color: rgba(255,255,255,0.85);
    font-size: 1.15rem;
}

/* ================= CALENDAR GRID ================= */
.calendar-wrapper {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(25px);
    border-radius: 30px;
    padding: 40px;
    border: 2px solid rgba(255,255,255,0.2);
    box-shadow: 0 25px 70px rgba(0,0,0,0.4);
    margin-bottom: 60px;
}
.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 35px;
    flex-wrap: wrap;
    gap: 20px;
}
.calendar-title {
    font-size: 2rem; font-weight: 800;
    color: var(--gold);
    font-family: 'Amiri', serif;
    display: flex; align-items: center; gap: 15px;
}
.calendar-title .greg-sub {
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    color: rgba(255,255,255,0.7);
    font-weight: 500;
}
.calendar-nav {
    display: flex; gap: 12px;
}
.calendar-nav button {
    background: var(--gradient-gold);
    color: var(--dark);
    border: none;
    padding: 12px 22px;
    border-radius: 50px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
    display: flex; align-items: center; gap: 8px;
    box-shadow: 0 5px 20px rgba(243,156,18,0.3);
}
.calendar-nav button:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(243,156,18,0.5);
}

.weekdays {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 10px;
    margin-bottom: 15px;
}
.weekday {
    text-align: center;
    color: var(--gold);
    font-weight: 800;
    padding: 12px 5px;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    background: rgba(241,196,15,0.1);
    border-radius: 10px;
    border: 1px solid rgba(241,196,15,0.2);
}

.days-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 10px;
}
.day-cell {
    aspect-ratio: 1;
    background: rgba(255,255,255,0.08);
    border-radius: 15px;
    padding: 12px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    min-height: 90px;
}
.day-cell:hover {
    background: rgba(255,255,255,0.18);
    transform: translateY(-5px);
    border-color: var(--gold);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}
.day-cell.today {
    background: var(--gradient-gold);
    border-color: #fff;
    box-shadow: 0 0 30px rgba(241,196,15,0.6);
    animation: todayPulse 2s ease-in-out infinite;
}
@keyframes todayPulse {
    0%, 100% { box-shadow: 0 0 25px rgba(241,196,15,0.5); }
    50% { box-shadow: 0 0 45px rgba(241,196,15,0.8); }
}
.day-cell.empty {
    background: transparent;
    border: none;
    cursor: default;
}
.day-cell.empty:hover { transform: none; box-shadow: none; }

.day-hijri {
    font-size: 1.5rem;
    font-weight: 800;
    color: #fff;
    font-family: 'Amiri', serif;
    line-height: 1;
}
.day-cell.today .day-hijri { color: var(--dark); }
.day-greg {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.65);
    font-weight: 600;
}
.day-cell.today .day-greg { color: rgba(26,37,47,0.8); }

.day-event {
    position: absolute;
    bottom: 6px; right: 6px;
    font-size: 16px;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));
}
.day-cell.has-event {
    background: linear-gradient(135deg, rgba(142,68,173,0.3), rgba(26,188,156,0.3));
    border-color: rgba(241,196,15,0.4);
}

/* ================= EVENTS ================= */
.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 25px;
    margin-top: 40px;
}
.event-card {
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 30px;
    border: 2px solid rgba(255,255,255,0.15);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: calc(var(--i) * 0.08s);
    opacity: 0;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
.event-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 5px;
    background: var(--gradient-gold);
    transform: scaleX(0);
    transition: transform 0.5s ease;
    transform-origin: left;
}
.event-card:hover::before { transform: scaleX(1); }
.event-card:hover {
    transform: translateY(-10px);
    background: rgba(255,255,255,0.2);
    border-color: var(--gold);
    box-shadow: 0 25px 60px rgba(0,0,0,0.4);
}
.event-icon {
    font-size: 50px;
    margin-bottom: 15px;
    display: inline-block;
    filter: drop-shadow(0 4px 10px rgba(0,0,0,0.3));
}
.event-card h4 {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--gold);
    margin-bottom: 10px;
}
.event-date-badge {
    display: inline-block;
    background: rgba(26,188,156,0.2);
    color: var(--secondary);
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 15px;
    border: 1px solid rgba(26,188,156,0.3);
}
.event-card p {
    color: rgba(255,255,255,0.85);
    line-height: 1.7;
    font-size: 14px;
}

/* ================= MONTHS GRID ================= */
.months-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
}
.month-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 25px 20px;
    text-align: center;
    border: 2px solid rgba(255,255,255,0.15);
    transition: all 0.4s ease;
    cursor: pointer;
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: calc(var(--i) * 0.05s);
    opacity: 0;
}
.month-card:hover {
    transform: translateY(-8px) scale(1.03);
    background: var(--gradient-primary);
    border-color: var(--gold);
    box-shadow: 0 20px 50px rgba(0,0,0,0.4);
}
.month-card.active {
    background: var(--gradient-gold);
    border-color: #fff;
    box-shadow: 0 15px 40px rgba(243,156,18,0.5);
}
.month-num {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--gold);
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 8px;
}
.month-card.active .month-num { color: var(--dark); }
.month-name {
    font-family: 'Amiri', serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 8px;
}
.month-card.active .month-name { color: var(--dark); }
.month-arabic {
    font-family: 'Amiri', serif;
    font-size: 1.2rem;
    color: var(--gold);
    direction: rtl;
}
.month-card.active .month-arabic { color: var(--dark); }

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
    .cal-hero-content h1 { font-size: 3rem; }
    .calendar-wrapper { padding: 25px; }
    .calendar-title { font-size: 1.6rem; }
    .day-cell { min-height: 75px; padding: 8px; }
    .day-hijri { font-size: 1.2rem; }
}
@media (max-width: 768px) {
    .nav-links { display: none; }
    .cal-hero-content h1 { font-size: 2.2rem; }
    .hijri-badge { flex-direction: column; text-align: center; padding: 20px; }
    .hijri-badge .hijri-date { font-size: 1.5rem; }
    .section-title h2 { font-size: 2rem; }
    .calendar-header { flex-direction: column; align-items: flex-start; }
    .weekday { font-size: 11px; padding: 8px 2px; }
    .day-cell { min-height: 60px; padding: 6px; border-radius: 10px; }
    .day-hijri { font-size: 1rem; }
    .day-greg { font-size: 0.65rem; }
    .day-event { font-size: 12px; }
}
@media (max-width: 576px) {
    .cal-section { padding: 60px 15px; }
    .calendar-wrapper { padding: 15px; border-radius: 20px; }
    .days-grid, .weekdays { gap: 5px; }
    .day-cell { min-height: 50px; padding: 4px; }
    .day-hijri { font-size: 0.9rem; }
    .day-greg { display: none; }
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
<section class="cal-hero">
    <div class="cal-hero-bg"></div>
    <div class="cal-hero-overlay"></div>
    <div class="cal-hero-content">
        <h1>Islamic Calendar</h1>
        <p>Track the Hijri dates, Islamic months, and important events throughout the year.</p>

        <div class="hijri-badge">
            <i class="fas fa-moon"></i>
            <div>
                {{-- Hijri date is filled by JS using the browser's Intl API --}}
                <div class="hijri-date" id="hijriDateDisplay">…</div>
                {{-- Gregorian date is also filled by JS for consistency --}}
                <span class="greg-date" id="gregDateDisplay">
                    <i class="fas fa-calendar-day"></i> …
                </span>
            </div>
        </div>
    </div>
</section>

<!-- ================= CALENDAR SECTION ================= -->
<section class="cal-section">
    <div class="section-title">
        <h2>Hijri Calendar</h2>
        <p>Navigate through the Islamic months and mark your important dates</p>
    </div>

    <div class="calendar-wrapper">
        <div class="calendar-header">
            <div class="calendar-title">
                <i class="fas fa-calendar-alt"></i>
                <div>
                    <span id="currentMonthName">…</span>
                    <div class="greg-sub" id="gregRange"></div>
                </div>
            </div>
            <div class="calendar-nav">
                <button id="prevMonth"><i class="fas fa-chevron-left"></i> Prev</button>
                <button id="todayBtn"><i class="fas fa-calendar-day"></i> Today</button>
                <button id="nextMonth">Next <i class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="weekdays">
            <div class="weekday">Sun</div>
            <div class="weekday">Mon</div>
            <div class="weekday">Tue</div>
            <div class="weekday">Wed</div>
            <div class="weekday">Thu</div>
            <div class="weekday">Fri</div>
            <div class="weekday">Sat</div>
        </div>

        <div class="days-grid" id="daysGrid">
            <!-- Filled by JS -->
        </div>
    </div>
</section>

<!-- ================= MONTHS ================= -->
<section class="cal-section" style="padding-top: 0;">
    <div class="section-title">
        <h2>Islamic Months</h2>
        <p>The twelve blessed months of the Hijri year</p>
    </div>

    <div class="months-grid">
        @foreach($hijriMonths as $num => $name)
            <div class="month-card"
                 data-i="{{ $num }}"
                 data-month="{{ $num }}">
                <div class="month-num">Month {{ $num }}</div>
                <div class="month-name">{{ $name }}</div>
                <div class="month-arabic">{{ $arabicMonths[$num] ?? '' }}</div>
            </div>
        @endforeach
    </div>
</section>

<!-- ================= EVENTS ================= -->
<section class="cal-section" style="padding-top: 0;">
    <div class="section-title">
        <h2>Important Islamic Events</h2>
        <p>Key dates every Muslim should remember throughout the year</p>
    </div>

    <div class="events-grid">
        @foreach($islamicEvents as $i => $event)
            <div class="event-card" data-i="{{ $i }}">
                <div class="event-icon">{{ $event['icon'] }}</div>
                <h4>{{ $event['name'] }}</h4>
                <div class="event-date-badge">
                    <i class="fas fa-calendar-day"></i>
                    {{ $event['day'] }} {{ $hijriMonths[$event['month']] }}
                </div>
                <p>{{ $event['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- Data passed to JS as plain JSON (no @ symbols inside script) --}}
<script id="calendar-data" type="application/json">
{!! json_encode([
    'hijriMonths'         => $hijriMonths,
    'arabicMonths'        => $arabicMonths,
    'islamicEvents'       => $islamicEvents,
    'fallbackHijriYear'   => $fallbackHijriYear,
    'fallbackHijriMonth'  => $fallbackHijriMonth,
], JSON_UNESCAPED_UNICODE) !!}
</script>

{{-- @formatter:off --}}
<script>
(function () {
    'use strict';

    // ---------- Load data from JSON script tag ----------
    var dataEl = document.getElementById('calendar-data');
    if (!dataEl) return;

    var data = JSON.parse(dataEl.textContent);
    var hijriMonths   = data.hijriMonths;
    var islamicEvents = data.islamicEvents;
    var fallbackHijriYear  = data.fallbackHijriYear;
    var fallbackHijriMonth = data.fallbackHijriMonth;

    // ---------- Hijri conversion helpers (browser ICU) ----------
    var hijriFormatter = new Intl.DateTimeFormat('en-US-u-ca-islamic-umalqura', {
        day: 'numeric', month: 'numeric', year: 'numeric'
    });

    function toHijri(date) {
        var parts = hijriFormatter.formatToParts(date);
        function get(t) {
            var p = parts.find(function (x) { return x.type === t; });
            return parseInt(p.value, 10);
        }
        return { day: get('day'), month: get('month'), year: get('year') };
    }

    function toGregorian(hYear, hMonth, hDay) {
        var epochHijriYear = 1446;
        var epochGreg = new Date(2024, 6, 7); // 7 Jul 2024 ≈ 1 Muharram 1446
        var daysPerHijriYear = 354.367;
        var daysDiff = ((hYear - epochHijriYear) * daysPerHijriYear) +
                       ((hMonth - 1) * 29.53) + (hDay - 1);
        var approx = new Date(epochGreg.getTime() + daysDiff * 86400000);

        for (var offset = -5; offset <= 5; offset++) {
            var test = new Date(approx.getTime() + offset * 86400000);
            var h = toHijri(test);
            if (h.year === hYear && h.month === hMonth && h.day === hDay) return test;
        }
        return approx;
    }

    // ---------- State ----------
    // The browser owns "today". Everything else derives from this single value.
    var todayHijri = toHijri(new Date());

    // Start on the browser-computed Hijri month. Fallback values from the
    // server are only used if the Intl formatter fails (which it won't in any
    // modern browser), so the calendar stays consistent with the badge.
    var viewHijriYear  = todayHijri.year  || fallbackHijriYear;
    var viewHijriMonth = todayHijri.month || fallbackHijriMonth;

    var monthNames = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

    function getEventForDay(month, day) {
        for (var i = 0; i < islamicEvents.length; i++) {
            if (islamicEvents[i].month === month && islamicEvents[i].day === day) {
                return islamicEvents[i];
            }
        }
        return null;
    }

    // ---------- Hero badge (frontend owns both Hijri + Gregorian "today") ----------
    function renderHeroBadge() {
        var hijriEl = document.getElementById('hijriDateDisplay');
        var gregEl  = document.getElementById('gregDateDisplay');

        if (hijriEl) {
            var monthName = hijriMonths[todayHijri.month] || '';
            hijriEl.textContent = todayHijri.day + ' ' + monthName + ' ' + todayHijri.year + ' AH';
        }

        if (gregEl) {
            var gregFmt = new Intl.DateTimeFormat('en-US', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });
            gregEl.innerHTML = '<i class="fas fa-calendar-day"></i> ' + gregFmt.format(new Date());
        }
    }

    // ---------- Render calendar grid ----------
    function renderCalendar() {
        var grid = document.getElementById('daysGrid');
        var titleEl = document.getElementById('currentMonthName');
        var gregRangeEl = document.getElementById('gregRange');
        if (!grid || !titleEl || !gregRangeEl) return;

        grid.innerHTML = '';
        titleEl.textContent = hijriMonths[viewHijriMonth] + ' ' + viewHijriYear + ' AH';

        var firstGreg = toGregorian(viewHijriYear, viewHijriMonth, 1);

        var nextMonth = viewHijriMonth + 1;
        var nextYear  = viewHijriYear;
        if (nextMonth > 12) { nextMonth = 1; nextYear++; }
        var nextFirstGreg = toGregorian(nextYear, nextMonth, 1);

        var daysInMonth = Math.round((nextFirstGreg - firstGreg) / 86400000);

        var lastGreg = new Date(firstGreg.getTime() + (daysInMonth - 1) * 86400000);
        gregRangeEl.textContent =
            monthNames[firstGreg.getMonth()] + ' ' + firstGreg.getDate() + ' – ' +
            monthNames[lastGreg.getMonth()] + ' ' + lastGreg.getDate() + ', ' + lastGreg.getFullYear();

        var startDow = firstGreg.getDay();

        for (var i = 0; i < startDow; i++) {
            var empty = document.createElement('div');
            empty.className = 'day-cell empty';
            grid.appendChild(empty);
        }

        for (var d = 1; d <= daysInMonth; d++) {
            var cell = document.createElement('div');
            cell.className = 'day-cell';

            var greg = new Date(firstGreg.getTime() + (d - 1) * 86400000);

            var isToday = (todayHijri.year === viewHijriYear &&
                           todayHijri.month === viewHijriMonth &&
                           todayHijri.day === d);
            if (isToday) cell.classList.add('today');

            var ev = getEventForDay(viewHijriMonth, d);
            if (ev) cell.classList.add('has-event');

            var html = '<div class="day-hijri">' + d + '</div>';
            html += '<div class="day-greg">' + greg.getDate() + ' ' + monthNames[greg.getMonth()] + '</div>';
            if (ev) {
                html += '<div class="day-event" title="' + ev.name + '">' + ev.icon + '</div>';
                cell.title = ev.name + ': ' + ev.desc;
            }
            cell.innerHTML = html;
            grid.appendChild(cell);
        }

        // Sync the "active" month card with the currently viewed month
        var cards = document.querySelectorAll('.month-card');
        for (var c = 0; c < cards.length; c++) {
            var cardMonth = parseInt(cards[c].getAttribute('data-month'), 10);
            if (cardMonth === viewHijriMonth) cards[c].classList.add('active');
            else cards[c].classList.remove('active');
        }
    }

    // ---------- Nav handlers ----------
    var prevBtn = document.getElementById('prevMonth');
    var nextBtn = document.getElementById('nextMonth');
    var todayBtn = document.getElementById('todayBtn');

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            viewHijriMonth--;
            if (viewHijriMonth < 1) { viewHijriMonth = 12; viewHijriYear--; }
            renderCalendar();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            viewHijriMonth++;
            if (viewHijriMonth > 12) { viewHijriMonth = 1; viewHijriYear++; }
            renderCalendar();
        });
    }

    if (todayBtn) {
        todayBtn.addEventListener('click', function () {
            viewHijriYear  = todayHijri.year;
            viewHijriMonth = todayHijri.month;
            renderCalendar();
        });
    }

    // ---------- Month card jump ----------
    var monthCards = document.querySelectorAll('.month-card');
    for (var k = 0; k < monthCards.length; k++) {
        (function (card) {
            card.addEventListener('click', function () {
                viewHijriMonth = parseInt(card.getAttribute('data-month'), 10);
                renderCalendar();
                var wrap = document.querySelector('.calendar-wrapper');
                if (wrap) wrap.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        })(monthCards[k]);
    }

    // ---------- Stagger animation delays ----------
    var staggerEls = document.querySelectorAll('.month-card[data-i], .event-card[data-i]');
    for (var s = 0; s < staggerEls.length; s++) {
        staggerEls[s].style.setProperty('--i', staggerEls[s].getAttribute('data-i'));
    }

    // ---------- Navbar scroll ----------
    window.addEventListener('scroll', function () {
        var navbar = document.querySelector('.navbar');
        if (!navbar) return;
        if (window.scrollY > 50) navbar.classList.add('scrolled');
        else navbar.classList.remove('scrolled');
    });

    // ---------- Initial render ----------
    renderHeroBadge();
    renderCalendar();
})();
</script>
{{-- @formatter:on --}}

@endsection