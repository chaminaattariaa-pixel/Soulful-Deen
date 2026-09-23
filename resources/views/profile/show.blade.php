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
    --gradient-primary: linear-gradient(135deg, #0d4c3e 0%, #1abc9c 100%);
}
* { margin: 0; padding: 0; box-sizing: border-box; }
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0c3529 0%, #186d53 100%);
    min-height: 100vh;
    color: #fff;
}

/* NAVBAR */
.profile-navbar {
    position: fixed; top: 0; left: 0; width: 100%;
    background: rgba(13, 76, 62, 0.95);
    backdrop-filter: blur(15px);
    z-index: 1000;
    border-bottom: 2px solid rgba(241,196,15,0.3);
    padding: 15px 0;
    transition: all 0.4s ease;
}
.profile-navbar.scrolled {
    background: rgba(13, 76, 62, 0.98);
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    padding: 10px 0;
}
.profile-navbar .container { display: flex; justify-content: space-between; align-items: center; }
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
.nav-links { display: flex; gap: 25px; list-style: none; margin: 0; align-items: center; }
.nav-links a, .nav-links button {
    color: #fff; text-decoration: none;
    font-weight: 600; font-size: 14px;
    display: flex; align-items: center; gap: 6px;
    background: none; border: none; cursor: pointer;
    font-family: 'Poppins', sans-serif;
    padding: 6px 0; transition: color 0.3s;
}
.nav-links a i, .nav-links button i { color: var(--gold); }
.nav-links a:hover, .nav-links button:hover { color: var(--gold); }

/* WRAP */
.profile-wrap { padding: 150px 20px 80px; max-width: 900px; margin: 0 auto; }

/* ALERT */
.alert {
    padding: 15px 22px;
    border-radius: 14px;
    margin-bottom: 25px;
    font-weight: 600;
    display: flex; align-items: center; gap: 10px;
    animation: fadeIn 0.4s ease;
}
.alert.success {
    background: rgba(46,204,113,0.2);
    border: 1px solid rgba(46,204,113,0.5);
    color: #a8e6cf;
}
@keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

/* CARD */
.profile-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255,255,255,0.15);
    border-radius: 28px;
    padding: 45px 40px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.35);
    animation: fadeUp 0.7s ease;
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* AVATAR */
.avatar {
    width: 120px; height: 120px;
    border-radius: 50%;
    background: var(--gradient-gold);
    color: var(--dark);
    display: flex; align-items: center; justify-content: center;
    font-size: 52px; font-weight: 900;
    margin: 0 auto 20px;
    border: 5px solid rgba(255,255,255,0.3);
    box-shadow: 0 20px 45px rgba(243,156,18,0.45);
    animation: float 4s ease-in-out infinite;
}
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}
.profile-card h2 {
    text-align: center;
    font-size: 2rem;
    font-weight: 900;
    margin-bottom: 8px;
    color: #fff;
}
.role-badge {
    display: block;
    width: fit-content;
    margin: 0 auto 35px;
    padding: 7px 22px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}
.role-badge.user {
    background: rgba(26,188,156,0.25);
    color: var(--secondary);
    border: 1px solid rgba(26,188,156,0.4);
}
.role-badge.admin {
    background: rgba(241,196,15,0.25);
    color: var(--gold);
    border: 1px solid rgba(241,196,15,0.5);
}

/* INFO ROWS */
.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 22px;
    background: rgba(0,0,0,0.2);
    border-radius: 14px;
    margin-bottom: 12px;
    border-left: 4px solid var(--gold);
    transition: all 0.3s ease;
}
.info-row:hover {
    background: rgba(0,0,0,0.3);
    transform: translateX(5px);
}
.info-row .label {
    color: rgba(255,255,255,0.7);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    display: flex; align-items: center; gap: 8px;
}
.info-row .label i { color: var(--gold); font-size: 15px; }
.info-row .value {
    color: #fff;
    font-weight: 700;
    font-size: 15px;
}

/* ACTIONS */
.actions {
    display: flex;
    gap: 14px;
    margin-top: 35px;
    flex-wrap: wrap;
    justify-content: center;
}
.btn-a {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 14px 32px;
    border-radius: 50px;
    font-weight: 800;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 14px;
    border: none;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
}
.btn-gold {
    background: var(--gradient-gold);
    color: var(--dark);
    box-shadow: 0 15px 35px rgba(243,156,18,0.4);
}
.btn-gold:hover {
    transform: translateY(-3px);
    box-shadow: 0 22px 50px rgba(243,156,18,0.6);
    color: #000;
    gap: 14px;
}
.btn-ghost {
    background: transparent;
    color: #fff;
    border: 2px solid rgba(255,255,255,0.4);
}
.btn-ghost:hover {
    background: rgba(255,255,255,0.12);
    border-color: #fff;
    transform: translateY(-3px);
    color: #fff;
    gap: 14px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .nav-links { display: none; }
    .profile-wrap { padding: 120px 15px 60px; }
    .profile-card { padding: 35px 25px; }
    .profile-card h2 { font-size: 1.6rem; }
    .avatar { width: 95px; height: 95px; font-size: 42px; }
    .info-row { padding: 15px 18px; flex-direction: column; align-items: flex-start; gap: 6px; }
    .btn-a { padding: 12px 24px; font-size: 13px; }
}
</style>

<!-- NAVBAR -->
<nav class="profile-navbar">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
            <span>Soulful Deen</span>
        </a>
        <ul class="nav-links">
            <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="/quran/search"><i class="fas fa-book-quran"></i> Quran</a></li>
            <li><a href="/hadith/search"><i class="fas fa-book-open"></i> Hadith</a></li>
            <li><a href="/chat"><i class="fas fa-robot"></i> AI Bot</a></li>
            @if($user->isAdmin())
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-shield-halved"></i> Admin</a></li>
            @endif
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<div class="profile-wrap">

    @if(session('success'))
        <div class="alert success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="profile-card">
        <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>

        <h2>{{ $user->name }}</h2>

        <span class="role-badge {{ $user->role }}">
            @if($user->isAdmin())
                <i class="fas fa-crown"></i> Administrator
            @else
                <i class="fas fa-user"></i> Member
            @endif
        </span>

        <div class="info-row">
            <span class="label"><i class="fas fa-envelope"></i> Email</span>
            <span class="value">{{ $user->email }}</span>
        </div>

        <div class="info-row">
            <span class="label"><i class="fas fa-user-tag"></i> Role</span>
            <span class="value">{{ ucfirst($user->role) }}</span>
        </div>

        <div class="info-row">
            <span class="label"><i class="fas fa-calendar"></i> Member Since</span>
            <span class="value">{{ $user->created_at->format('F j, Y') }}</span>
        </div>

        <div class="actions">
                <!-- <a href="{{ route('profile.edit') }}" class="btn-a btn-gold">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a> -->

            @if($user->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="btn-a btn-ghost">
                    <i class="fas fa-shield-halved"></i> Admin Panel
                </a>
            @endif

            <a href="/dashboard" class="btn-a btn-ghost">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
        </div>
    </div>
</div>

<script>
window.addEventListener('scroll', function () {
    var navbar = document.querySelector('.profile-navbar');
    if (window.scrollY > 50) navbar.classList.add('scrolled');
    else navbar.classList.remove('scrolled');
});
</script>

@endsection