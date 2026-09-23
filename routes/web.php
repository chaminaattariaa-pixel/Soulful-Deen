<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AyatController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\HadithController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\NamazController;
use App\Http\Controllers\PrayerController;
use App\Http\Controllers\hadeescontroller;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\QiblaController;
use App\Http\Controllers\IslamicCalendarController;
use App\Http\Controllers\DuaController;
use App\Http\Controllers\GuidanceController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

// ==================================================
// PUBLIC ROUTES
// ==================================================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

// ==================================================
// AUTHENTICATION (guests only)
// ==================================================
Route::middleware('guest')->group(function () {
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
});

// Logout — must be authenticated
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ==================================================
// USER AREA (authenticated)
// ==================================================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [dashboardcontroller::class, 'show'])->name('dashboard');

    // Profile
    Route::get('/profile',          [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit',     [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile',          [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// ==================================================
// ADMIN (auth + admin middleware)
// ==================================================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/',          [AdminController::class, 'index'])->name('index');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Ayat Management
        Route::get('/ayat',  [AyatController::class, 'create'])->name('ayat.create');
        Route::post('/ayat', [AyatController::class, 'store'])->name('ayat.store');

        // Hadees Management
        Route::get('/hadees',  [hadeescontroller::class, 'create'])->name('hadees.create');
        Route::post('/hadees', [hadeescontroller::class, 'store'])->name('hadees.store');

        // Quran Upload
        Route::get('/quran/upload',  [AdminController::class, 'uploadQuranForm'])->name('quran.upload.form');
        Route::post('/quran/upload', [AdminController::class, 'uploadQuran'])->name('quran.upload');

        // Hadith Upload
        Route::get('/hadith/upload',  [AdminController::class, 'uploadHadithForm'])->name('hadith.upload.form');
        Route::post('/hadith/upload', [AdminController::class, 'uploadHadith'])->name('hadith.upload');
    });

// ==================================================
// PRAYER & NAMAZ
// ==================================================
Route::get('/prayer-timings', [PrayerController::class, 'prayer'])->name('prayer.timings');
Route::get('/namaz',          [NamazController::class, 'index'])->name('namaz.index');
Route::get('/namaz-timings',  [NamazController::class, 'timings'])->name('namaz.timings');

// ==================================================
// CHATBOT
// ==================================================
Route::get('/chat',           [ChatbotController::class, 'index'])->name('chat.index');
Route::post('/api/chat/ask',  [ChatbotController::class, 'ask'])->name('chat.ask');

// ==================================================
// AYAT & HADEES (public content)
// ==================================================
Route::get('/ayat',   [AyatController::class, 'show'])->name('ayat.show');
Route::get('/hadees', [dashboardcontroller::class, 'showhadees'])->name('hadees.show');

// ==================================================
// QURAN ROUTES
// ==================================================
Route::prefix('quran')->name('quran.')->group(function () {
    Route::get('/surahs',                              [QuranController::class, 'getSurahs'])->name('surahs');
    Route::get('/surah/{surahNumber}',                 [QuranController::class, 'getSurah'])->name('surah');
    Route::get('/page',                                [QuranController::class, 'getAyahsByPage'])->name('page');
    Route::get('/juz',                                 [QuranController::class, 'getAyahsByJuz'])->name('juz');
    Route::get('/search',                              [QuranController::class, 'searchAyahs'])->name('search');
    Route::get('/ayah/{surahNumber}/{ayahNumber}',     [QuranController::class, 'getAyah'])->name('ayah');
    Route::get('/audio/{surahNumber}/{ayahNumber}',    [QuranController::class, 'getAyahAudio'])->name('audio');
    Route::get('/editions',                            [QuranController::class, 'getEditions'])->name('editions');
});

// ==================================================
// HADITH ROUTES
// ==================================================
Route::prefix('hadith')->name('hadith.')->group(function () {
    Route::get('/',                [HadithController::class, 'index'])->name('index');
    Route::get('/search',          [HadithController::class, 'search'])->name('search');
    Route::get('/books-json',      [HadithController::class, 'getBooksJson'])->name('books.json');
    Route::get('/{bookSlug}',      [HadithController::class, 'show'])->name('show');
    Route::get('/{bookSlug}/json', [HadithController::class, 'getHadithsJson'])->name('json');
});

// ==================================================
// OTHER FEATURE PAGES
// ==================================================
Route::get('/qibla',    [QiblaController::class, 'index'])->name('qibla');
Route::get('/calendar', [IslamicCalendarController::class, 'index'])->name('calendar');
Route::get('/duas',     [DuaController::class, 'index'])->name('duas.index');
Route::get('/guidance', [GuidanceController::class, 'index'])->name('guidance.index');

// ==================================================
// FALLBACK 404
// ==================================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});