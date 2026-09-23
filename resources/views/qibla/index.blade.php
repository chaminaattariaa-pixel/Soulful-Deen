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
.nav-links a { color:#fff; text-decoration:none; font-weight:600; font-size:15px; display:flex; align-items:center; gap:7px; }
.nav-links a i { color:var(--gold); }
.nav-links a:hover, .nav-links a.active { color:var(--gold); }

.page-wrap { min-height:100vh; padding-top:110px; padding-bottom:60px; }

/* HERO */
.qibla-hero { text-align:center; padding:10px 30px 30px; color:#fff; }
.qibla-hero .kaaba-ar { font-family:'Scheherazade New','Amiri',serif; font-size:2.6rem; color:var(--gold); text-shadow:0 2px 20px rgba(241,196,15,.5); line-height:1.4; margin-bottom:8px; }
.qibla-hero h1 { font-size:2rem; font-weight:900; background:linear-gradient(45deg,#fff 30%,var(--gold) 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; margin-bottom:8px; }
.qibla-hero p { color:rgba(255,255,255,.75); font-size:14px; max-width:520px; margin:0 auto; line-height:1.6; }

/* CONTAINER */
.qibla-container { max-width:560px; margin:0 auto; padding:0 24px; }

.qibla-card {
    background:rgba(255,255,255,.07);
    backdrop-filter:blur(20px);
    border-radius:24px;
    border:1.5px solid rgba(255,255,255,.15);
    box-shadow:0 25px 80px rgba(0,0,0,.4);
    padding:30px;
    text-align:center;
}

/* STATE: requesting permission */
.state-block { display:flex; flex-direction:column; align-items:center; gap:18px; padding:20px 10px; }
.state-icon { font-size:54px; color:var(--gold); }
.state-block h3 { color:#fff; font-size:1.2rem; font-weight:700; }
.state-block p { color:rgba(255,255,255,.65); font-size:13.5px; line-height:1.7; max-width:380px; }

.action-btn {
    padding:14px 34px; border-radius:50px; border:none;
    background:var(--gradient-gold); color:var(--dark);
    font-weight:800; font-family:'Poppins',sans-serif; cursor:pointer; font-size:14.5px;
    display:inline-flex; align-items:center; gap:10px;
    transition:all .3s;
}
.action-btn:hover { transform:translateY(-3px); box-shadow:0 12px 35px rgba(241,196,15,.4); }
.action-btn:disabled { opacity:.5; cursor:not-allowed; transform:none; }

.secondary-btn {
    padding:11px 24px; border-radius:50px;
    background:rgba(255,255,255,.08); border:1.5px solid rgba(255,255,255,.2);
    color:#fff; font-weight:700; font-family:'Poppins',sans-serif; cursor:pointer; font-size:13px;
    transition:all .3s;
}
.secondary-btn:hover { background:rgba(255,255,255,.15); border-color:var(--gold); color:var(--gold); }

.error-box {
    background:rgba(231,76,60,.12); border:1.5px solid rgba(231,76,60,.35);
    border-radius:14px; padding:16px 18px; color:#e88; font-size:13px; line-height:1.6;
    text-align:left; display:flex; gap:12px; align-items:flex-start;
}
.error-box i { color:#e74c3c; font-size:18px; margin-top:1px; flex-shrink:0; }

/* COMPASS */
.compass-wrap { display:flex; flex-direction:column; align-items:center; gap:22px; }

.compass-stage { position:relative; width:280px; height:280px; margin:0 auto; }

.compass-ring {
    width:100%; height:100%; border-radius:50%;
    background: radial-gradient(circle at 50% 45%, rgba(255,255,255,.08), rgba(0,0,0,.15));
    border:2px solid rgba(241,196,15,.35);
    box-shadow: 0 0 0 1px rgba(255,255,255,.05) inset, 0 20px 60px rgba(0,0,0,.4);
    position:relative;
    transition: transform .15s ease-out;
}
.compass-tick { position:absolute; left:50%; top:6px; width:2px; height:12px; background:rgba(255,255,255,.3); transform-origin:50% 134px; }
.compass-tick.major { height:16px; background:rgba(241,196,15,.6); width:2.5px; }

.compass-label { position:absolute; color:rgba(255,255,255,.55); font-size:13px; font-weight:700; }
.compass-label.n { top:16px; left:50%; transform:translateX(-50%); color:var(--gold); }
.compass-label.e { right:16px; top:50%; transform:translateY(-50%); }
.compass-label.s { bottom:16px; left:50%; transform:translateX(-50%); }
.compass-label.w { left:16px; top:50%; transform:translateY(-50%); }

.compass-center-dot { position:absolute; left:50%; top:50%; width:10px; height:10px; border-radius:50%; background:var(--gold); transform:translate(-50%,-50%); box-shadow:0 0 12px rgba(241,196,15,.7); z-index:5; }

.qibla-needle {
    position:absolute; left:50%; top:50%;
    width:6px; height:118px;
    transform-origin:50% 100%;
    margin-left:-3px; margin-top:-118px;
    transition: transform .2s ease-out;
    z-index:4;
}
.qibla-needle .needle-head {
    width:0; height:0;
    border-left:13px solid transparent;
    border-right:13px solid transparent;
    border-bottom:34px solid var(--gold);
    margin-left:-10px;
    filter: drop-shadow(0 4px 10px rgba(241,196,15,.5));
}
.qibla-needle .needle-tail {
    width:6px; height:84px;
    background:linear-gradient(180deg, var(--gold), rgba(241,196,15,.2));
    margin:0 auto;
    border-radius:3px;
}
.qibla-needle .kaaba-icon {
    position:absolute; top:-14px; left:50%; transform:translateX(-50%);
    width:26px; height:26px; border-radius:6px;
    background:var(--dark); border:2px solid var(--gold);
    display:flex; align-items:center; justify-content:center;
    color:var(--gold); font-size:11px;
    box-shadow:0 4px 14px rgba(0,0,0,.5);
}

.device-arrow {
    position:absolute; left:50%; top:50%;
    width:2px; height:100px;
    background:rgba(255,255,255,.25);
    transform-origin:50% 100%;
    margin-left:-1px; margin-top:-100px;
    z-index:2;
}
.device-arrow::after {
    content:''; position:absolute; top:-6px; left:50%; transform:translateX(-50%);
    width:0; height:0; border-left:5px solid transparent; border-right:5px solid transparent; border-bottom:10px solid rgba(255,255,255,.3);
}

.qibla-readout { display:flex; gap:14px; flex-wrap:wrap; justify-content:center; }
.readout-chip {
    background:rgba(255,255,255,.08); border:1.5px solid rgba(255,255,255,.15);
    border-radius:14px; padding:12px 20px; min-width:120px;
}
.readout-chip .label { color:rgba(255,255,255,.5); font-size:10.5px; font-weight:700; text-transform:uppercase; letter-spacing:.5px; margin-bottom:4px; }
.readout-chip .value { color:var(--gold); font-size:19px; font-weight:800; }
.readout-chip .value small { color:rgba(255,255,255,.5); font-size:11px; font-weight:600; }

.align-status {
    padding:9px 20px; border-radius:20px; font-size:13px; font-weight:700;
    background:rgba(255,255,255,.08); border:1.5px solid rgba(255,255,255,.2); color:rgba(255,255,255,.7);
    transition:all .3s;
}
.align-status.aligned {
    background:rgba(46,204,113,.15); border-color:rgba(46,204,113,.4); color:#2ecc71;
}

.mode-note { color:rgba(255,255,255,.45); font-size:11.5px; line-height:1.6; max-width:360px; }

.location-line { color:rgba(255,255,255,.6); font-size:12.5px; display:flex; align-items:center; gap:8px; justify-content:center; }
.location-line i { color:var(--gold); }

@media (max-width:600px) {
    .qibla-hero { padding:5px 18px 22px; }
    .qibla-hero .kaaba-ar { font-size:2rem; }
    .qibla-hero h1 { font-size:1.6rem; }
    .qibla-container { padding:0 16px; }
    .qibla-card { padding:22px 16px; }
    .compass-stage { width:240px; height:240px; }
    .compass-tick { transform-origin:50% 114px; }
    .qibla-needle { height:100px; margin-top:-100px; }
    .qibla-needle .needle-tail { height:70px; }
    .device-arrow { height:84px; margin-top:-84px; }
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
            <li><a href="/hadith"><i class="fas fa-book-open"></i> Hadith</a></li>
            <li><a href="/qibla" class="active"><i class="fas fa-compass"></i> Qibla</a></li>
            <li><a href="/chat"><i class="fas fa-robot"></i> AI Bot</a></li>
            <li><a href="/profile"><i class="fas fa-user"></i> Profile</a></li>
        </ul>
    </div>
</nav>

<div class="page-wrap">

    <div class="qibla-hero">
        <div class="kaaba-ar">القِبْلَة</div>
        <h1>Find the Qibla Direction</h1>
        <p>Point your device toward the Kaaba in Makkah for prayer, calculated from your exact location.</p>
    </div>

    <div class="qibla-container">
        <div class="qibla-card" id="qiblaCard">

            <!-- STATE: initial / requesting -->
            <div class="state-block" id="stateInitial">
                <i class="fas fa-location-crosshairs state-icon"></i>
                <h3>Allow Location Access</h3>
                <p>We need your GPS location to calculate the exact Qibla direction from where you're standing. Your location is only used in your browser and is never stored.</p>
                <button type="button" class="action-btn" id="btnLocate">
                    <i class="fas fa-location-arrow"></i> Find My Qibla
                </button>
            </div>

            <!-- STATE: loading -->
            <div class="state-block" id="stateLoading" style="display:none">
                <div class="spinner" style="width:50px;height:50px;border:4px solid rgba(255,255,255,.1);border-top-color:var(--gold);border-radius:50%;animation:spin .9s linear infinite"></div>
                <h3>Getting your location...</h3>
                <p>This may take a few seconds depending on your device's GPS.</p>
            </div>

            <!-- STATE: error -->
            <div class="state-block" id="stateError" style="display:none">
                <div class="error-box">
                    <i class="fas fa-triangle-exclamation"></i>
                    <span id="errorText">Could not access your location.</span>
                </div>
                <button type="button" class="action-btn" id="btnRetry">
                    <i class="fas fa-redo"></i> Try Again
                </button>
            </div>

            <!-- STATE: result -->
            <div class="state-block" id="stateResult" style="display:none">

                <div class="location-line" id="locationLine">
                    <i class="fas fa-map-marker-alt"></i> <span id="locationText">—</span>
                </div>

                <div class="compass-wrap">
                    <div class="compass-stage" id="compassStage">
                        <div class="compass-ring" id="compassRing">
                            <span class="compass-label n">N</span>
                            <span class="compass-label e">E</span>
                            <span class="compass-label s">S</span>
                            <span class="compass-label w">W</span>
                            <div class="device-arrow" id="deviceArrow"></div>
                            <div class="qibla-needle" id="qiblaNeedle">
                                <div class="kaaba-icon"><i class="fas fa-kaaba"></i></div>
                                <div class="needle-tail"></div>
                                <div class="needle-head"></div>
                            </div>
                        </div>
                        <div class="compass-center-dot"></div>
                    </div>

                    <div id="alignStatus" class="align-status">
                        <i class="fas fa-compass"></i> <span id="alignText">Rotate to align with the gold needle</span>
                    </div>

                    <div class="qibla-readout">
                        <div class="readout-chip">
                            <div class="label">Qibla Bearing</div>
                            <div class="value" id="qiblaBearingVal">—<small>°</small></div>
                        </div>
                        <div class="readout-chip">
                            <div class="label">Distance to Kaaba</div>
                            <div class="value" id="qiblaDistanceVal">—<small> km</small></div>
                        </div>
                    </div>

                    <p class="mode-note" id="modeNote">
                        <i class="fas fa-info-circle"></i> Live compass mode: rotate your phone flat until the golden needle points up.
                    </p>

                    <button type="button" class="secondary-btn" id="btnEnableCompass" style="display:none">
                        <i class="fas fa-compass"></i> Enable Live Compass
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>

<script>
(function () {
    'use strict';

    // Kaaba coordinates
    const KAABA_LAT = 21.4225;
    const KAABA_LNG = 39.8262;

    let userLat = null;
    let userLng = null;
    let qiblaBearing = null;   // bearing from user to Kaaba, 0-360 (0 = North)
    let deviceHeading = null;  // current device compass heading, 0-360
    let compassActive = false;

    const el = {
        stateInitial: document.getElementById('stateInitial'),
        stateLoading: document.getElementById('stateLoading'),
        stateError: document.getElementById('stateError'),
        stateResult: document.getElementById('stateResult'),
        errorText: document.getElementById('errorText'),
        btnLocate: document.getElementById('btnLocate'),
        btnRetry: document.getElementById('btnRetry'),
        btnEnableCompass: document.getElementById('btnEnableCompass'),
        locationText: document.getElementById('locationText'),
        qiblaNeedle: document.getElementById('qiblaNeedle'),
        deviceArrow: document.getElementById('deviceArrow'),
        compassRing: document.getElementById('compassRing'),
        alignStatus: document.getElementById('alignStatus'),
        alignText: document.getElementById('alignText'),
        qiblaBearingVal: document.getElementById('qiblaBearingVal'),
        qiblaDistanceVal: document.getElementById('qiblaDistanceVal'),
        modeNote: document.getElementById('modeNote'),
    };

    function showState(name) {
        ['stateInitial', 'stateLoading', 'stateError', 'stateResult'].forEach(function (s) {
            el[s].style.display = (s === name) ? 'flex' : 'none';
        });
    }

    function toRad(deg) { return deg * Math.PI / 180; }
    function toDeg(rad) { return rad * 180 / Math.PI; }

    // Great-circle initial bearing from (lat1,lng1) to (lat2,lng2)
    function calculateBearing(lat1, lng1, lat2, lng2) {
        const φ1 = toRad(lat1), φ2 = toRad(lat2);
        const Δλ = toRad(lng2 - lng1);
        const y = Math.sin(Δλ) * Math.cos(φ2);
        const x = Math.cos(φ1) * Math.sin(φ2) - Math.sin(φ1) * Math.cos(φ2) * Math.cos(Δλ);
        let θ = Math.atan2(y, x);
        return (toDeg(θ) + 360) % 360;
    }

    // Haversine distance in km
    function calculateDistance(lat1, lng1, lat2, lng2) {
        const R = 6371;
        const φ1 = toRad(lat1), φ2 = toRad(lat2);
        const Δφ = toRad(lat2 - lat1);
        const Δλ = toRad(lng2 - lng1);
        const a = Math.sin(Δφ / 2) ** 2 + Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) ** 2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    function reverseGeocode(lat, lng) {
        // Best-effort, non-blocking label — falls back to coordinates if it fails
        fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lng + '&zoom=10')
            .then(function (r) { return r.json(); })
            .then(function (data) {
                const a = data.address || {};
                const place = a.city || a.town || a.village || a.county || a.state || null;
                const country = a.country || null;
                if (place && country) {
                    el.locationText.textContent = place + ', ' + country;
                } else if (country) {
                    el.locationText.textContent = country;
                }
            })
            .catch(function () { /* keep coordinate fallback already shown */ });
    }

    function renderStaticNeedle() {
        // No live compass: rotate the whole ring so North stays fixed visually,
        // and the needle simply points at the qibla bearing.
        el.qiblaNeedle.style.transform = 'rotate(' + qiblaBearing + 'deg)';
        el.deviceArrow.style.display = 'none';
        el.alignStatus.style.display = 'none';
        el.modeNote.innerHTML = '<i class="fas fa-info-circle"></i> Static mode: the golden arrow points toward the Kaaba relative to North. Use a physical compass or your phone\'s compass app to align yourself with North first.';
    }

    function updateLiveCompass(heading) {
        deviceHeading = heading;
        // Rotate the whole ring opposite to device heading so "up" stays aligned with device facing direction
        el.compassRing.style.transform = 'rotate(' + (-heading) + 'deg)';
        el.deviceArrow.style.display = 'block';

        const diff = Math.abs(((qiblaBearing - heading + 540) % 360) - 180);
        const aligned = diff <= 5;
        el.alignStatus.classList.toggle('aligned', aligned);
        el.alignText.textContent = aligned
            ? 'Aligned! You are facing the Qibla'
            : 'Rotate to align with the gold needle';
    }

    function handleOrientation(e) {
        let heading = null;
        if (typeof e.webkitCompassHeading === 'number') {
            // iOS Safari
            heading = e.webkitCompassHeading;
        } else if (e.absolute && typeof e.alpha === 'number') {
            heading = 360 - e.alpha;
        } else if (typeof e.alpha === 'number') {
            heading = 360 - e.alpha;
        }
        if (heading === null || isNaN(heading)) return;
        compassActive = true;
        el.btnEnableCompass.style.display = 'none';
        el.modeNote.innerHTML = '<i class="fas fa-info-circle"></i> Live compass mode: rotate your phone flat until the golden needle points up.';
        updateLiveCompass(heading);
    }

    function tryEnableDeviceOrientation() {
        if (typeof DeviceOrientationEvent !== 'undefined' && typeof DeviceOrientationEvent.requestPermission === 'function') {
            // iOS 13+ requires explicit user-gesture permission
            el.btnEnableCompass.style.display = 'inline-flex';
            el.btnEnableCompass.onclick = function () {
                DeviceOrientationEvent.requestPermission().then(function (state) {
                    if (state === 'granted') {
                        window.addEventListener('deviceorientation', handleOrientation, true);
                    } else {
                        renderStaticNeedle();
                    }
                }).catch(function () {
                    renderStaticNeedle();
                });
            };
            return;
        }

        if (window.DeviceOrientationEvent) {
            window.addEventListener('deviceorientationabsolute', handleOrientation, true);
            window.addEventListener('deviceorientation', handleOrientation, true);

            // If no orientation event fires within 2s, assume unsupported (e.g. desktop) and fall back
            setTimeout(function () {
                if (!compassActive) renderStaticNeedle();
            }, 2000);
        } else {
            renderStaticNeedle();
        }
    }

    function onLocationSuccess(pos) {
        userLat = pos.coords.latitude;
        userLng = pos.coords.longitude;

        qiblaBearing = calculateBearing(userLat, userLng, KAABA_LAT, KAABA_LNG);
        const distance = calculateDistance(userLat, userLng, KAABA_LAT, KAABA_LNG);

        el.qiblaBearingVal.innerHTML = Math.round(qiblaBearing) + '<small>°</small>';
        el.qiblaDistanceVal.innerHTML = Math.round(distance).toLocaleString() + '<small> km</small>';
        el.locationText.textContent = userLat.toFixed(3) + ', ' + userLng.toFixed(3);

        showState('stateResult');
        reverseGeocode(userLat, userLng);
        tryEnableDeviceOrientation();
    }

    function onLocationError(err) {
        let msg = 'Could not access your location.';
        if (err.code === 1) msg = 'Location permission was denied. Please allow location access in your browser settings and try again.';
        else if (err.code === 2) msg = 'Your location could not be determined. Please check your device\'s GPS/location settings.';
        else if (err.code === 3) msg = 'Location request timed out. Please try again.';
        el.errorText.textContent = msg;
        showState('stateError');
    }

    function locate() {
        if (!navigator.geolocation) {
            el.errorText.textContent = 'Your browser does not support geolocation.';
            showState('stateError');
            return;
        }
        showState('stateLoading');
        navigator.geolocation.getCurrentPosition(onLocationSuccess, onLocationError, {
            enableHighAccuracy: true,
            timeout: 15000,
            maximumAge: 60000,
        });
    }

    el.btnLocate.addEventListener('click', locate);
    el.btnRetry.addEventListener('click', locate);
})();
</script>

@endsection