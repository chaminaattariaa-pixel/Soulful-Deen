<?php

namespace App\Http\Controllers;

class IslamicCalendarController extends Controller
{
    public function index()
    {
        // Hijri month names
        $hijriMonths = [
            1  => 'Muharram',
            2  => 'Safar',
            3  => 'Rabi\' al-Awwal',
            4  => 'Rabi\' al-Thani',
            5  => 'Jumada al-Awwal',
            6  => 'Jumada al-Thani',
            7  => 'Rajab',
            8  => 'Sha\'ban',
            9  => 'Ramadan',
            10 => 'Shawwal',
            11 => 'Dhu al-Qi\'dah',
            12 => 'Dhu al-Hijjah',
        ];

        // Islamic events (Hijri date based)
        $islamicEvents = [
            ['month' => 1,  'day' => 1,  'name' => 'Islamic New Year',   'icon' => '🌙', 'desc' => 'First day of Muharram, beginning of the Hijri year.'],
            ['month' => 1,  'day' => 10, 'name' => 'Day of Ashura',      'icon' => '🕯️', 'desc' => 'The 10th of Muharram, a day of fasting and reflection.'],
            ['month' => 3,  'day' => 12, 'name' => 'Mawlid al-Nabi',     'icon' => '🕌', 'desc' => 'Birth of Prophet Muhammad (PBUH).'],
            ['month' => 7,  'day' => 27, 'name' => 'Isra & Mi\'raj',     'icon' => '✨', 'desc' => 'The night journey of Prophet Muhammad (PBUH).'],
            ['month' => 8,  'day' => 15, 'name' => 'Shab-e-Barat',       'icon' => '🌌', 'desc' => 'The 15th of Sha\'ban, night of forgiveness.'],
            ['month' => 9,  'day' => 1,  'name' => 'Ramadan Begins',     'icon' => '🌙', 'desc' => 'First day of the holy month of fasting.'],
            ['month' => 9,  'day' => 27, 'name' => 'Laylat al-Qadr',     'icon' => '⭐', 'desc' => 'The Night of Power (estimated).'],
            ['month' => 10, 'day' => 1,  'name' => 'Eid al-Fitr',        'icon' => '🎉', 'desc' => 'Festival marking the end of Ramadan.'],
            ['month' => 12, 'day' => 9,  'name' => 'Day of Arafah',      'icon' => '🕋', 'desc' => 'The most important day of Hajj.'],
            ['month' => 12, 'day' => 10, 'name' => 'Eid al-Adha',        'icon' => '🐑', 'desc' => 'Festival of Sacrifice.'],
        ];

        // NOTE: We deliberately do NOT compute "today's" Hijri day/month/year
        // here in PHP. The frontend converts dates to Hijri using the browser's
        // own Intl API (en-US-u-ca-islamic-umalqura) for calendar navigation.
        // PHP's intl extension ships a different, independently versioned copy
        // of the Umm al-Qura (ICU) data than browsers do, and the two can
        // disagree by a day — which is what was causing the "wrong" calendar
        // date. The client computes the Hijri "today" once, on load, and reuses
        // that single value for both the badge and the calendar grid.
        //
        // The values below are only a *fallback seed* for the client; the JS
        // overwrites them immediately on load with the browser's Hijri date.

        $fallbackHijriYear  = 1447;
        $fallbackHijriMonth = 1; // Muharram

        return view('calendar.index', compact(
            'hijriMonths',
            'islamicEvents',
            'fallbackHijriYear',
            'fallbackHijriMonth',
        ));
    }
}