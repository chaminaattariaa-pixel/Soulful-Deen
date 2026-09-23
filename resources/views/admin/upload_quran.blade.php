@extends('layouts')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --gold: #f1c40f;
    --secondary: #1abc9c;
    --dark: #1a252f;
    --gradient-gold: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
}
* { margin: 0; padding: 0; box-sizing: border-box; }
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0c3529 0%, #186d53 100%);
    min-height: 100vh;
    color: #fff;
}
/* NAVBAR */
.admin-navbar {
    position: fixed; top: 0; left: 0; width: 100%;
    background: rgba(13, 76, 62, 0.95);
    backdrop-filter: blur(15px);
    z-index: 1000;
    border-bottom: 2px solid rgba(241, 196, 15, 0.3);
    padding: 15px 0;
}
.admin-navbar .container { display: flex; justify-content: space-between; align-items: center; }
.navbar-brand {
    font-size: 1.6rem; font-weight: 900;
    color: #fff; text-decoration: none;
    display: flex; align-items: center; gap: 12px;
}
.navbar-brand img { height: 50px; border-radius: 50%; border: 3px solid var(--gold); }
.navbar-brand span {
    background: linear-gradient(45deg, #fff, var(--gold));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.admin-nav-links { display: flex; gap: 22px; list-style: none; margin: 0; }
.admin-nav-links a {
    color: #fff; text-decoration: none;
    font-weight: 600; font-size: 13px;
    display: flex; align-items: center; gap: 6px;
}
.admin-nav-links a i { color: var(--gold); }
.admin-nav-links a:hover { color: var(--gold); }

/* WRAP */
.upload-wrap {
    padding: 150px 20px 80px;
    max-width: 800px;
    margin: 0 auto;
}
.upload-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 26px;
    padding: 40px 35px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.35);
    animation: fadeUp 0.7s ease;
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
.upload-card h2 {
    font-size: 1.8rem; font-weight: 900;
    margin-bottom: 8px; text-align: center;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.upload-card .sub {
    text-align: center; color: rgba(255,255,255,0.75);
    font-size: 14px; margin-bottom: 30px;
}
label {
    display: block; font-size: 12px;
    color: var(--gold); text-transform: uppercase;
    letter-spacing: 1.5px; font-weight: 800; margin-bottom: 8px;
}
.form-control {
    width: 100%;
    background: rgba(0,0,0,0.25);
    border: 2px solid rgba(241,196,15,0.35);
    color: #fff;
    padding: 14px 18px;
    border-radius: 12px;
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}
.form-control:focus {
    outline: none;
    border-color: var(--gold);
    background: rgba(0,0,0,0.35);
    box-shadow: 0 0 0 4px rgba(241,196,15,0.15);
}
.form-control::placeholder { color: rgba(255,255,255,0.5); }
textarea.form-control { resize: vertical; min-height: 90px; }
.form-control.arabic {
    font-family: 'Amiri', serif;
    font-size: 20px;
    direction: rtl;
    text-align: right;
}
.row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
.btn-submit {
    width: 100%;
    background: var(--gradient-gold);
    color: var(--dark);
    border: none;
    padding: 16px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 15px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center; gap: 10px;
    box-shadow: 0 15px 35px rgba(243,156,18,0.35);
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
    margin-top: 10px;
}
.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 45px rgba(243,156,18,0.55);
    gap: 14px;
}
.alert {
    padding: 14px 20px;
    border-radius: 12px;
    margin-bottom: 22px;
    font-weight: 600;
    background: rgba(46,204,113,0.2);
    border: 1px solid rgba(46,204,113,0.5);
    color: #a8e6cf;
    display: flex; align-items: center; gap: 10px;
}
.back-link {
    display: block;
    text-align: center;
    color: rgba(255,255,255,0.65);
    text-decoration: none;
    margin-top: 20px;
    font-size: 14px;
    font-weight: 600;
}
.back-link:hover { color: var(--gold); }
@media (max-width: 768px) {
    .admin-nav-links { display: none; }
    .upload-wrap { padding: 120px 15px 60px; }
    .upload-card { padding: 28px 22px; }
    .upload-card h2 { font-size: 1.4rem; }
    .row-2 { grid-template-columns: 1fr; }
}
</style>

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
            <li><a href="{{ route('admin.hadith.upload.form') }}"><i class="fas fa-cloud-upload-alt"></i> Hadith</a></li>
        </ul>
    </div>
</nav>

<div class="upload-wrap">
    <div class="upload-card">
        <h2>📥 Upload Quran Verse</h2>
        <p class="sub">Add or edit a Quran verse by surah and ayah number</p>

        @if(session('success'))
            <div class="alert"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.quran.upload') }}">
            @csrf

            <div class="row-2">
                <div>
                    <label for="surah">Surah Number</label>
                    <input type="number" id="surah" name="surah" class="form-control" placeholder="e.g. 2" required min="1" max="114">
                </div>
                <div>
                    <label for="ayah">Ayah Number</label>
                    <input type="number" id="ayah" name="ayah" class="form-control" placeholder="e.g. 255" required min="1">
                </div>
            </div>

            <label for="arabic_text">Arabic Text</label>
            <textarea id="arabic_text" name="arabic_text" class="form-control arabic" placeholder="ﷲ ..." required></textarea>

            <label for="translation_en">English Translation</label>
            <textarea id="translation_en" name="translation_en" class="form-control" placeholder="Enter English translation..."></textarea>

            <label for="translation_ur">Urdu Translation</label>
            <textarea id="translation_ur" name="translation_ur" class="form-control" placeholder="اردو ترجمہ درج کریں..." style="direction: rtl; text-align: right; font-family: 'Amiri', serif; font-size: 18px;"></textarea>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Save Verse
            </button>

            <a href="{{ route('admin.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Admin Dashboard
            </a>
        </form>
    </div>
</div>

@endsection