@extends('layouts')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --primary: #0d4c3e;
    --secondary: #1abc9c;
    --accent: #f39c12;
    --gold: #f1c40f;
    --emerald: #2ecc71;
    --turquoise: #1dd1a1;
    --dark: #1a252f;
    --light: #f9f9f9;
    --purple: #8e44ad;
    --orange: #e67e22;
    --blue: #3498db;
    --gradient-primary: linear-gradient(135deg, #0d4c3e 0%, #1abc9c 100%);
    --gradient-gold: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
    --gradient-emerald: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0c3529 0%, #186d53 100%);
    min-height: 100vh;
    overflow-x: hidden;
    color: #333;
}

/* ================= HERO SECTION ================= */
.hero {
    min-height: 100vh;
    width: 100vw;
    position: relative;
    color: #fff;
    overflow: hidden;
    padding-bottom: 0;
    margin-bottom: 0;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
    width: 100vw;
    max-width: 100vw;
}

.hero-bg {
    position: absolute;
    inset: 0;
    background: 
        linear-gradient(rgba(13, 76, 62, 0.85), rgba(26, 188, 156, 0.7)),
        url('https://static.vecteezy.com/system/resources/thumbnails/035/912/156/small_2x/ai-generated-beautiful-view-of-worship-mosque-building-in-bright-day-photo.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(241, 196, 15, 0.3) 0%, transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(46, 204, 113, 0.2) 0%, transparent 40%),
        radial-gradient(circle at 40% 80%, rgba(231, 126, 34, 0.15) 0%, transparent 40%);
    animation: pulseOverlay 12s ease-in-out infinite alternate;
    z-index: 2;
}

@keyframes pulseOverlay {
    0% { opacity: 0.6; }
    100% { opacity: 1; }
}

/* ================= NAVBAR ================= */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: rgba(13, 76, 62, 0.95);
    backdrop-filter: blur(15px);
    z-index: 1000;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-bottom: 2px solid rgba(241, 196, 15, 0.3);
    padding: 15px 0;
}

.navbar.scrolled {
    background: rgba(13, 76, 62, 0.98);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
    padding: 10px 0;
}

.navbar-brand {
    font-size: 2rem;
    font-weight: 900;
    color: #fff;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 15px;
    letter-spacing: -0.5px;
}

.navbar-brand img {
    height: 60px;
    border-radius: 50%;
    border: 3px solid var(--gold);
    box-shadow: 0 0 20px rgba(241, 196, 15, 0.5);
}

.navbar-brand span {
    background: linear-gradient(45deg, #fff, var(--gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.nav-links {
    display: flex;
    gap: 30px;
    list-style: none;
    align-items: center;
    margin: 0;
}

.nav-links a {
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    padding: 8px 0;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.nav-links a i {
    color: var(--gold);
    font-size: 18px;
}

.nav-links a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 3px;
    background: var(--gold);
    border-radius: 3px;
    transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-links a:hover {
    color: var(--gold);
    transform: translateY(-2px);
}

.nav-links a:hover::after {
    width: 100%;
}

/* ================= PRAYER TIMES ================= */
.prayer-times-section {
    position: relative;
    padding: 160px 0 80px;
    z-index: 10;
}

.prayer-times-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 25px;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
}

.prayer-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(25px);
    padding: 30px 25px;
    border-radius: 25px;
    text-align: center;
    border: 2px solid rgba(255, 255, 255, 0.2);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: calc(var(--i) * 0.1s);
    opacity: 0;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
    position: relative;
    overflow: hidden;
}

.prayer-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-gold);
    transform: scaleX(0);
    transition: transform 0.5s ease;
    transform-origin: left;
}

.prayer-card:hover::before {
    transform: scaleX(1);
}

.prayer-card:hover {
    transform: translateY(-15px) scale(1.05);
    background: rgba(255, 255, 255, 0.25);
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
    border-color: var(--gold);
}

.prayer-card i {
    font-size: 40px;
    color: var(--gold);
    margin-bottom: 15px;
    filter: drop-shadow(0 0 10px rgba(241, 196, 15, 0.5));
    transition: transform 0.5s ease;
}

.prayer-card:hover i {
    transform: rotate(360deg);
}

.prayer-card h6 {
    margin: 15px 0 10px;
    font-size: 18px;
    font-weight: 700;
    color: var(--gold);
    text-transform: uppercase;
    letter-spacing: 2px;
}

.prayer-card span {
    font-weight: 800;
    font-size: 28px;
    color: #fff;
    display: block;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

/* ================= HERO CONTENT ================= */
.hero-main-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    min-height: calc(100vh - 200px);
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
    position: relative;
    z-index: 10;
    gap: 60px;
}

.hero-text {
    flex: 1;
    animation: fadeInLeft 1.2s ease forwards;
    padding-right: 40px;
}

.hero-text h1 {
    font-size: 4.5rem;
    font-weight: 900;
    margin-bottom: 25px;
    line-height: 1.1;
    background: linear-gradient(45deg, #fff 30%, var(--gold) 70%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: textGlow 3s ease-in-out infinite;
    text-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
}

@keyframes textGlow {
    0%, 100% { filter: brightness(1) drop-shadow(0 0 20px rgba(241, 196, 15, 0.3)); }
    50% { filter: brightness(1.2) drop-shadow(0 0 30px rgba(241, 196, 15, 0.5)); }
}

.hero-text p {
    font-size: 1.4rem;
    opacity: 0.95;
    line-height: 1.8;
    margin-bottom: 35px;
    color: rgba(255, 255, 255, 0.95);
    max-width: 600px;
}

.hero-text .urdu-text {
    font-family: 'Amiri', serif;
    font-size: 1.8rem;
    direction: rtl;
    text-align: right;
    color: var(--gold);
    margin-top: 30px;
    font-weight: 700;
    padding: 15px 25px;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 15px;
    border-right: 4px solid var(--gold);
}

.cta-buttons {
    display: flex;
    gap: 25px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.btn-primary, .btn-secondary {
    padding: 18px 45px;
    border-radius: 50px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 12px;
    border: 2px solid transparent;
    font-size: 18px;
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;
}

.btn-primary {
    background: var(--gradient-gold);
    color: var(--dark);
    box-shadow: 0 15px 40px rgba(243, 156, 18, 0.4);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.btn-primary:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 25px 60px rgba(243, 156, 18, 0.6);
    color: #000;
}

.btn-secondary {
    background: transparent;
    color: #fff;
    border: 2px solid rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: #fff;
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(255, 255, 255, 0.2);
}

/* ================= DAILY CARDS ================= */
.daily-cards {
    flex: 0 0 500px;
    display: grid;
    gap: 30px;
    animation: fadeInRight 1.2s ease forwards;
}

.glass-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(25px);
    border-radius: 30px;
    padding: 35px;
    border: 2px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.glass-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transform: translateX(-100%);
    transition: transform 0.8s ease;
}

.glass-card:hover::before {
    transform: translateX(100%);
}

.glass-card:hover {
    transform: translateX(-10px) translateY(-10px);
    background: rgba(255, 255, 255, 0.25);
    box-shadow: 0 35px 80px rgba(0, 0, 0, 0.5);
}

.glass-card .label {
    display: inline-block;
    background: var(--gradient-gold);
    color: var(--dark);
    padding: 10px 25px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 20px;
    box-shadow: 0 5px 20px rgba(243, 156, 18, 0.3);
}

.arabic {
    font-family: 'Amiri', serif;
    font-size: 32px;
    direction: rtl;
    text-align: right;
    line-height: 2;
    margin-bottom: 20px;
    color: #fff;
    font-weight: 700;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.urdu {
    font-size: 18px;
    opacity: 0.95;
    line-height: 1.8;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 20px;
}

.glass-card small {
    display: block;
    margin-top: 20px;
    opacity: 0.9;
    color: var(--gold);
    font-weight: 600;
}

/* ================= DASHBOARD SECTION ================= */
.dashboard-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 120px 40px;
    position: relative;
    margin-top: -1px;
}

.dashboard-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 150px;
    background: linear-gradient(135deg, rgba(13, 76, 62, 0.95) 0%, rgba(26, 188, 156, 0.9) 100%);
    clip-path: polygon(0 0, 100% 0, 100% 70%, 0 100%);
    z-index: 1;
}

.section-header {
    text-align: center;
    margin-bottom: 80px;
    position: relative;
    z-index: 2;
}

.section-header h2 {
    font-size: 3.5rem;
    font-weight: 900;
    color: var(--dark);
    margin-bottom: 20px;
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
}

.section-header p {
    font-size: 1.3rem;
    color: #666;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.8;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 35px;
    max-width: 1400px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.dashboard-card {
    background: #fff;
    padding: 45px 35px;
    border-radius: 30px;
    text-align: center;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    border: 3px solid transparent;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 1s ease forwards;
    animation-delay: calc(var(--i) * 0.1s);
    opacity: 0;
}

.dashboard-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 8px;
    background: var(--gradient-emerald);
    transform: scaleX(0);
    transition: transform 0.5s ease;
    transform-origin: left;
}

.dashboard-card:hover::before {
    transform: scaleX(1);
}

.dashboard-card:hover {
    transform: translateY(-20px) scale(1.03);
    box-shadow: 0 35px 80px rgba(0, 0, 0, 0.2);
    border-color: var(--emerald);
}

.dashboard-card .icon {
    font-size: 70px;
    margin-bottom: 25px;
    display: inline-block;
    animation: float 4s ease-in-out infinite;
    filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.1));
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(5deg); }
}

.dashboard-card h5 {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 15px;
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.dashboard-card p {
    color: #666;
    font-size: 15px;
    margin-bottom: 30px;
    line-height: 1.7;
}

.dashboard-card .btn-explore {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--gradient-primary);
    color: #fff;
    padding: 15px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    border: none;
    cursor: pointer;
}

.dashboard-card .btn-explore:hover {
    background: var(--gradient-emerald);
    gap: 15px;
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(46, 204, 113, 0.4);
}

/* ================= STATS SECTION ================= */
.stats-section {
    background: var(--gradient-primary);
    padding: 100px 40px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(241, 196, 15, 0.2) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(142, 68, 173, 0.15) 0%, transparent 50%);
    animation: pulseStats 8s ease-in-out infinite alternate;
}

@keyframes pulseStats {
    0% { opacity: 0.5; }
    100% { opacity: 1; }
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 50px;
    max-width: 1400px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.stat-card {
    text-align: center;
    animation: fadeInUp 1s ease forwards;
    animation-delay: calc(var(--i) * 0.15s);
    opacity: 0;
    padding: 30px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 25px;
    border: 2px solid rgba(255, 255, 255, 0.2);
    transition: all 0.4s ease;
}

.stat-card:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-10px);
    border-color: var(--gold);
}

.stat-card i {
    font-size: 60px;
    color: var(--gold);
    margin-bottom: 20px;
    filter: drop-shadow(0 0 10px rgba(241, 196, 15, 0.5));
}

.stat-card h3 {
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 15px;
    color: #fff;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.stat-card p {
    font-size: 1.3rem;
    opacity: 0.95;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.95);
}

/* ================= FOOTER ================= */
.footer {
    background: linear-gradient(135deg, #1a252f 0%, #2c3e50 100%);
    color: #fff;
    padding: 80px 40px 40px;
    position: relative;
    overflow: hidden;
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-gold);
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 60px;
    max-width: 1400px;
    margin: 0 auto 60px;
    position: relative;
    z-index: 2;
}

.footer-brand h3 {
    font-size: 2.5rem;
    font-weight: 900;
    margin-bottom: 20px;
    background: linear-gradient(45deg, var(--gold), var(--emerald));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.footer-brand p {
    opacity: 0.85;
    line-height: 1.8;
    font-size: 16px;
    max-width: 400px;
}

.footer-links h4 {
    font-size: 1.4rem;
    font-weight: 800;
    margin-bottom: 25px;
    color: var(--gold);
    position: relative;
    padding-bottom: 10px;
}

.footer-links h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: var(--emerald);
    border-radius: 3px;
}

.footer-links ul {
    list-style: none;
}

.footer-links ul li {
    margin-bottom: 15px;
}

.footer-links ul li a {
    color: rgba(255, 255, 255, 0.85);
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 500;
}

.footer-links ul li a:hover {
    opacity: 1;
    color: var(--gold);
    padding-left: 10px;
    transform: translateX(5px);
}

.footer-links ul li a i {
    color: var(--emerald);
    font-size: 18px;
}

.footer-bottom {
    text-align: center;
    padding-top: 40px;
    border-top: 1px solid rgba(255, 255, 255, 0.15);
    opacity: 0.9;
    font-size: 16px;
    position: relative;
    z-index: 2;
}

.footer-bottom p {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

/* ================= ANIMATIONS ================= */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(50px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes fadeInLeft {
    from { opacity: 0; transform: translateX(-80px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(80px); }
    to { opacity: 1; transform: translateX(0); }
}

/* ================= RESPONSIVE ================= */
@media (max-width: 1400px) {
    .hero-main-content {
        max-width: 1200px;
        padding: 0 30px;
    }
    
    .hero-text h1 {
        font-size: 3.8rem;
    }
}

@media (max-width: 1200px) {
    .hero-main-content {
        flex-direction: column;
        text-align: center;
        gap: 50px;
        padding-top: 60px;
    }
    
    .hero-text {
        padding-right: 0;
    }
    
    .hero-text .urdu-text {
        text-align: center;
        border-right: none;
        border-bottom: 4px solid var(--gold);
    }
    
    .daily-cards {
        flex: 0 0 auto;
        width: 100%;
        max-width: 800px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .footer-content {
        grid-template-columns: 1fr 1fr;
        gap: 50px;
    }
}

@media (max-width: 992px) {
    .prayer-times-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding: 0 20px;
    }
    
    .dashboard-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .section-header h2 {
        font-size: 2.8rem;
    }
    
    .hero-text h1 {
        font-size: 3.2rem;
    }
}

@media (max-width: 768px) {
    .nav-links {
        display: none;
    }
    
    .prayer-times-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .hero-text h1 {
        font-size: 2.5rem;
    }
    
    .hero-text p {
        font-size: 1.2rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .section-header h2 {
        font-size: 2.3rem;
    }
}

@media (max-width: 576px) {
    .prayer-times-grid {
        grid-template-columns: 1fr;
        max-width: 400px;
    }
    
    .dashboard-section,
    .stats-section,
    .footer {
        padding-left: 20px;
        padding-right: 20px;
    }
    
    .hero-text h1 {
        font-size: 2rem;
    }
    
    .glass-card {
        padding: 25px;
    }
    
    .arabic {
        font-size: 24px;
    }
}

/* Scroll animation classes */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(50px) scale(0.95);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.animate-on-scroll.visible {
    opacity: 1;
    transform: translateY(0) scale(1);
}
</style>

<!-- ================= HERO SECTION ================= -->
<div class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="navbar-brand">
                <img src="images/logo.jpeg" alt="Logo">
                <span>Soulful Deen</span>
            </a>
            <ul class="nav-links">
    <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
    <li><a href="/quran/search"><i class="fas fa-book-quran"></i> Quran</a></li>
    <li><a href="/hadith/search"><i class="fas fa-book-open"></i> Hadith</a></li>
    <li><a href="/chat"><i class="fas fa-robot"></i> AI Bot</a></li>

    @auth
        @if(auth()->user()->isAdmin())
            <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-shield-halved"></i> Admin</a></li>
        @endif
        <li><a href="{{ route('profile.show') }}"><i class="fas fa-user"></i> Profile</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:none;border:none;color:#fff;font-family:'Poppins';font-weight:600;font-size:16px;cursor:pointer;display:flex;align-items:center;gap:8px;padding:8px 0;">
                    <i class="fas fa-sign-out-alt" style="color:#f1c40f;font-size:18px;"></i> Logout
                </button>
            </form>
        </li>
    @else
        <li><a href="/register"><i class="fas fa-user-plus"></i> Register</a></li>
        <li><a href="/login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
    @endauth
</ul>
        </div>
    </nav>

    <!-- PRAYER TIMES -->
    <div class="prayer-times-section">
        <div class="prayer-times-grid">
            <div class="prayer-card" style="--i:1">
                <i class="fas fa-cloud-sun"></i>
                <h6>Fajr</h6>
                <p><span>{{ $timings['Fajr'] }}</span></p>
            </div>
            <div class="prayer-card" style="--i:2">
                <i class="fas fa-sun"></i>
                <h6>Dhuhr</h6>
                <p><span>{{ $timings['Dhuhr'] }}</span></p>
               
            </div>
            <div class="prayer-card" style="--i:3">
                <i class="fas fa-sun"></i>
                <h6>Asr</h6>
                <p><span> {{ $timings['Asr'] }}</span></p>
               
            </div>
            <div class="prayer-card" style="--i:4">
                <i class="fas fa-cloud-moon"></i>
                <h6>Maghrib</h6>
                <p><span> {{ $timings['Maghrib'] }}</span></p>
                            </div>
            <div class="prayer-card" style="--i:5">
                <i class="fas fa-moon"></i>
                <h6>Isha</h6>
                <p><span> {{ $timings['Isha'] }}</span></p>
                
            </div>
        </div>
    </div>

    <!-- HERO MAIN CONTENT -->
    <div class="hero-main-content">
        <div class="hero-text">
            <h1>Welcome to<br>Soulful Deen</h1>
            <p>
                Your comprehensive Islamic digital platform for Quran, Hadith, 
                guidance and spiritual peace in the modern age.
            </p>
            <div class="urdu-text">
                قرآن، حدیث، رہنمائی اور سکون
            </div>
            
            <div class="cta-buttons">
                <a href="/quran/search" class="btn-primary">
                    <i class="fas fa-book-quran"></i>
                    Explore Quran
                </a>
                <a href="/chat" class="btn-secondary">
                    <i class="fas fa-robot"></i>
                    AI Assistant
                </a>
            </div>
        </div>

        <!-- RIGHT: DAILY AYAT & HADITH -->

        <div class="daily-cards">
            <div class="glass-card">
              <span class="label">Ayat of the Day</span>
              <div class="arabic">
    <p class="arabic">
        {{ $ayat->arabic ?? 'No Ayat Found' }}
    </p>
    <p class="urdu">
        {{ $ayat->urdu ?? 'No Translation Found' }}
    </p>
    <p class="English">
        {{ $ayat->english ?? 'No Translation Found' }}
    </p>
    <p class="Reference">
        <small style="display:block;margin-top:15px;opacity:.8">
        {{ $ayat->reference ?? 'No Reference Found' }}
      </small>
    </p>
     </div>
            </div>
                  <div class="glass-card">
            <span class="label">📖 Hadith of the Day</span>
            <div class="hadees-box">
       <p class="arabic">
        {{ $hadees->arabic ?? 'No Hadees Found' }}
    </p>                
    <p class="urdu">
        {{ $hadees->urdu ?? 'No Translation Found' }}
    </p>
    <p class="English">
        {{ $hadees->english ?? 'No Translation Found' }}        
    </p>
    <p class="Reference">
        {{ $hadees->reference ?? 'No Reference Found' }}
    </p>
</div>
        </div>
    </div>
</div>

<!-- DASHBOARD SECTION -->
<section class="dashboard-section">
    <div class="section-header">
        <h2>Islamic Resources & Tools</h2>
        <p>Explore our comprehensive collection of Islamic knowledge and spiritual guidance</p>
    </div>

    <div class="dashboard-grid">
        <div class="dashboard-card" style="--i:1">
            <div class="icon">🕌</div>
            <h5>Islamic Guidance</h5>
            <p>Get authentic Islamic guidance on daily matters and questions with verified sources</p>
            <a href="/guidance" class="btn-explore">
                Explore <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card" style="--i:2">
            <div class="icon">🤖</div>
            <h5>AI Deen Bot</h5>
            <p>Chat with our Islamic AI assistant for instant answers to your religious questions</p>
            <a href="/chat" class="btn-explore">
                Start Chat <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card" style="--i:3">
            <div class="icon">📖</div>
            <h5>Holy Quran</h5>
            <p>Read, search and understand Quran with multiple translations and tafsir</p>
            <a href="/quran/search" class="btn-explore">
                Read Now <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card" style="--i:4">
            <div class="icon">📚</div>
            <h5>Hadith Collection</h5>
            <p>Browse authentic hadith from Sahih Bukhari, Muslim and other collections</p>
            <a href="/hadith/search" class="btn-explore">
                Browse <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card" style="--i:5">
            <div class="icon">📿</div>
            <h5>Daily Duas</h5>
            <p>Learn and memorize essential Islamic supplications for every occasion</p>
            <a href="/duas" class="btn-explore">
                Learn <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card" style="--i:6">
            <div class="icon">🕋</div>
            <h5>Namaz Guide</h5>
            <p>Step-by-step prayer guide with timings, methods and learning resources</p>
            <a href="/namaz" class="btn-explore">
                View Guide <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card" style="--i:7">
            <div class="icon">📅</div>
            <h5>Islamic Calendar</h5>
            <p>Track Islamic dates, events and important occasions with notifications</p>
            <a href="/calendar" class="btn-explore">
                View Calendar <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card" style="--i:8">
            <div class="icon">🧭</div>
            <h5>Qibla Finder</h5>
            <p>Find accurate Qibla direction from anywhere with precise compass</p>
            <a href="/qibla" class="btn-explore">
                Find Qibla <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- STATS SECTION -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-card" style="--i:1">
            <i class="fas fa-book-quran"></i>
            <h3>6,236</h3>
            <p>Quranic Verses</p>
        </div>
        <div class="stat-card" style="--i:2">
            <i class="fas fa-scroll"></i>
            <h3>7,000+</h3>
            <p>Authentic Hadith</p>
        </div>
        <div class="stat-card" style="--i:3">
            <i class="fas fa-users"></i>
            <h3>50,000+</h3>
            <p>Active Users</p>
        </div>
        <div class="stat-card" style="--i:4">
            <i class="fas fa-mosque"></i>
            <h3>114</h3>
            <p>Quran Surahs</p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h3>🌙 Soulful Deen</h3>
            <p>
                Your trusted companion for Islamic knowledge and spiritual growth. 
                We provide authentic resources to help you strengthen your faith and 
                connect with Allah in the modern world.
            </p>
        </div>

        <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="/about"><i class="fas fa-info-circle"></i> About Us</a></li>
                <li><a href="/contact"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="/privacy"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                <li><a href="/terms"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
            </ul>
        </div>

        <div class="footer-links">
            <h4>Resources</h4>
            <ul>
                <li><a href="/quran"><i class="fas fa-book-quran"></i> Quran</a></li>
                <li><a href="/hadith"><i class="fas fa-book-open"></i> Hadith</a></li>
                <li><a href="/duas"><i class="fas fa-hands-praying"></i> Duas</a></li>
                <li><a href="/articles"><i class="fas fa-newspaper"></i> Articles</a></li>
            </ul>
        </div>

        <div class="footer-links">
            <h4>Connect</h4>
            <ul>
                <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2026 Soulful Deen. All rights reserved. | Built with ❤️ for the Muslim Ummah</p>
    </div>
</footer>

<script>
// Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Scroll animation for elements
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

// Add scroll animation to dashboard cards
document.querySelectorAll('.dashboard-card, .stat-card').forEach(card => {
    observer.observe(card);
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    });
});
</script>

@endsection