@extends('layouts')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --gold: #f1c40f;
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
.profile-navbar {
    position: fixed; top: 0; left: 0; width: 100%;
    background: rgba(13, 76, 62, 0.95);
    backdrop-filter: blur(15px);
    z-index: 1000;
    border-bottom: 2px solid rgba(241,196,15,0.3);
    padding: 15px 0;
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

.edit-wrap { padding: 150px 20px 80px; max-width: 700px; margin: 0 auto; }
.edit-card {
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
.edit-card h2 {
    text-align: center;
    font-size: 1.8rem;
    font-weight: 900;
    margin-bottom: 30px;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
label {
    display: block;
    font-size: 12px;
    font-weight: 800;
    color: var(--gold);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 8px;
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
.error {
    color: #ff7675;
    font-size: 13px;
    margin-top: -14px;
    margin-bottom: 16px;
    font-weight: 600;
}
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
    box-shadow: 0 22px 45px rgba(243,156,18,0.55);
    gap: 14px;
}
.divider {
    border-top: 1px solid rgba(255,255,255,0.15);
    margin: 35px 0 25px;
}
.divider-title {
    font-size: 13px;
    color: var(--gold);
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 20px;
    display: flex; align-items: center; gap: 10px;
}
.back-link {
    display: block;
    text-align: center;
    color: rgba(255,255,255,0.65);
    text-decoration: none;
    margin-top: 22px;
    font-size: 14px;
    font-weight: 600;
}
.back-link:hover { color: var(--gold); }

@media (max-width: 768px) {
    .edit-wrap { padding: 120px 15px 60px; }
    .edit-card { padding: 32px 22px; }
    .edit-card h2 { font-size: 1.4rem; }
}
</style>

<!-- NAVBAR -->
<nav class="profile-navbar">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
            <span>Soulful Deen</span>
        </a>
    </div>
</nav>

<div class="edit-wrap">
    <div class="edit-card">
        <h2>Edit Profile</h2>

        {{-- ========== UPDATE INFO ========== --}}
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" class="form-control"
                   value="{{ old('name', $user->name) }}" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control"
                   value="{{ old('email', $user->email) }}" required>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </form>

        <div class="divider"></div>
        <div class="divider-title">
            <i class="fas fa-lock"></i> Change Password
        </div>

        {{-- ========== CHANGE PASSWORD ========== --}}
        <form method="POST" action="{{ route('profile.password') }}">
            @csrf
            @method('PUT')

            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
            @error('current_password') <div class="error">{{ $message }}</div> @enderror

            <label for="password">New Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>

            <button type="submit" class="btn-submit">
                <i class="fas fa-key"></i> Update Password
            </button>
        </form>

        <a href="{{ route('profile.show') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Profile
        </a>
    </div>
</div>

@endsection