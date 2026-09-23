{{-- @extends('layouts')
@section('content')
<h3>Admin Dashboard</h3>
<p>Welcome, admin.</p>
<ul>
  <li><a href="/admin/quran/upload">Upload Quran Verse</a></li>
  <li><a href="/admin/hadith/upload">Upload Hadith</a></li>
</ul>
@endsection --}}
@extends('layouts')

@section('content')

<style>
    /* HERO SECTION */
    .hero {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        color: #fff;
        padding: 110px 0;
        text-align: center;
        animation: fadeDown 1s ease;
    }

    @keyframes fadeDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .hero h1 {
        font-weight: 800;
        font-size: 48px;
    }

    .hero p {
        font-size: 18px;
        opacity: 0.9;
        max-width: 700px;
        margin: auto;
    }

    .hero-btn {
        margin-top: 25px;
        padding: 12px 32px;
        border-radius: 30px;
        font-weight: 600;
    }
    .feature-box {
        background: #fff;
        border-radius: 18px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: 0.4s;
        height: 100%;
    }

    .feature-box:hover {
        transform: translateY(-8px);
    }

    .feature-icon {
        font-size: 40px;
        color: #198754;
        margin-bottom: 15px;
    }

    .section-title {
        font-weight: 700;
        text-align: center;
        margin-bottom: 45px;
    }

   
    .cta {
        background: linear-gradient(45deg, #198754, #43cea2);
        color: #fff;
        border-radius: 20px;
        padding: 50px;
        text-align: center;
    }
</style>


<section class="hero">
    <div class="container">
        <h1>Soulful Deen</h1>
        <p>
            Discover authentic Islamic knowledge, ask questions,
            strengthen your faith and connect with Islam in a modern way.
        </p>

        <div>
            <a href="/register" class="btn btn-success hero-btn">Get Started</a>
            <a href="/login" class="btn btn-outline-light hero-btn ms-2">Login</a>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="section-title">What We Offer</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon">🕌</div>
                    <h5>Authentic Islamic Guidance</h5>
                    <p>
                        Reliable answers based on Quran and Sunnah,
                        presented in a clear and simple language.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon">🤖</div>
                    <h5>AI Deen Assistant</h5>
                    <p>
                        Ask Islamic questions anytime in English or Urdu
                        with our intelligent Deen bot.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon">📖</div>
                    <h5>Learning Resources</h5>
                    <p>
                        Daily duas, hadith, Islamic reminders
                        and faith-building content.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container py-5">
    <div class="cta">
        <h2>Begin Your Spiritual Journey Today</h2>
        <p class="mt-2">
            Join Soulful Deen and grow closer to Allah with
            authentic knowledge and modern experience.
        </p>
        <a href="/register" class="btn btn-light btn-lg mt-3">
            Join Now
        </a>
    </div>
</section>

<footer class="text-center py-4 text-muted">
    © {{ date('Y') }} Soulful Deen • All Rights Reserved
</footer>

@endsection
