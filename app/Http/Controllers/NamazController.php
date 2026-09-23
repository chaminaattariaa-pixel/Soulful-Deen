<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class NamazController extends Controller
{
    // ==========================================================
    // NAMAZ GUIDE  —  /namaz
    // ==========================================================
    public function index()
    {
        // The five daily prayers
        $prayers = [
            [
                'slug'      => 'fajr',
                'name'      => 'Fajr',
                'arabic'    => 'الفجر',
                'icon'      => '🌅',
                'time'      => 'Dawn — before sunrise',
                'rakats'    => '2 Sunnah (Mu\'akkadah) + 2 Fard',
                'hadith'    => 'Whoever prays the two cool prayers (Fajr and Asr) will enter Paradise.',
                'reference' => 'Bukhari 555',
            ],
            [
                'slug'      => 'dhuhr',
                'name'      => 'Dhuhr',
                'arabic'    => 'الظهر',
                'icon'      => '☀️',
                'time'      => 'After midday — until Asr',
                'rakats'    => '4 Sunnah + 4 Fard + 2 Sunnah + 2 Nafl',
                'hadith'    => 'The one who observes the four rak\'ahs before Dhuhr and four after will be protected from Hellfire.',
                'reference' => 'Tirmidhi 428',
            ],
            [
                'slug'      => 'asr',
                'name'      => 'Asr',
                'arabic'    => 'العصر',
                'icon'      => '🌤️',
                'time'      => 'Late afternoon — before sunset',
                'rakats'    => '4 Sunnah (Ghair Mu\'akkadah) + 4 Fard',
                'hadith'    => 'Whoever misses the Asr prayer is like one who has lost his family and wealth.',
                'reference' => 'Bukhari 552',
            ],
            [
                'slug'      => 'maghrib',
                'name'      => 'Maghrib',
                'arabic'    => 'المغرب',
                'icon'      => '🌆',
                'time'      => 'Just after sunset',
                'rakats'    => '3 Fard + 2 Sunnah + 2 Nafl',
                'hadith'    => 'My Ummah will remain upon goodness as long as they do not delay Maghrib until the stars appear.',
                'reference' => 'Abu Dawud 418',
            ],
            [
                'slug'      => 'isha',
                'name'      => 'Isha',
                'arabic'    => 'العشاء',
                'icon'      => '🌙',
                'time'      => 'Night — before midnight',
                'rakats'    => '4 Sunnah (Ghair Mu\'akkadah) + 4 Fard + 2 Sunnah + 3 Witr + 2 Nafl',
                'hadith'    => 'Whoever prays Isha in congregation, it is as if he prayed half the night.',
                'reference' => 'Muslim 656',
            ],
        ];

        // Steps of salah
        $steps = [
            [
                'step'      => 1,
                'title'     => 'Niyyah (Intention)',
                'arabic'    => 'نَوَيْتُ أَنْ أُصَلِّيَ لِلَّهِ تَعَالَى',
                'urdu'      => 'میں نے اللہ تعالیٰ کے لیے نماز پڑھنے کا ارادہ کیا۔',
                'english'   => 'I intend to pray for the sake of Allah the Most High.',
                'desc'      => 'Make a firm intention in the heart for the specific prayer. The intention does not need to be spoken aloud.',
                'reference' => 'Bukhari 1',
            ],
            [
                'step'      => 2,
                'title'     => 'Takbir al-Ihram',
                'arabic'    => 'اللَّهُ أَكْبَرُ',
                'urdu'      => 'اللہ سب سے بڑا ہے۔',
                'english'   => 'Allah is the Greatest.',
                'desc'      => 'Raise both hands to the ears (or shoulders) and say "Allahu Akbar" to begin the prayer.',
                'reference' => 'Bukhari 735',
            ],
            [
                'step'      => 3,
                'title'     => 'Qiyam & Thana',
                'arabic'    => 'سُبْحَانَكَ اللَّهُمَّ وَبِحَمْدِكَ وَتَبَارَكَ اسْمُكَ وَتَعَالَى جَدُّكَ وَلاَ إِلَهَ غَيْرُكَ',
                'urdu'      => 'اے اللہ! تو پاک ہے، تیری حمد ہے، تیرا نام بابرکت ہے، تیری شان بلند ہے اور تیرے سوا کوئی معبود نہیں۔',
                'english'   => 'Glory be to You O Allah, and praise. Blessed is Your name, exalted is Your majesty, and there is no god but You.',
                'desc'      => 'Stand facing the Qibla, fold hands on the chest, and recite the opening supplication (Thana), then Surah al-Fatihah and a short surah.',
                'reference' => 'Abu Dawud 775',
            ],
            [
                'step'      => 4,
                'title'     => 'Ruku (Bowing)',
                'arabic'    => 'سُبْحَانَ رَبِّيَ الْعَظِيمِ',
                'urdu'      => 'پاک ہے میرا رب جو عظیم ہے۔',
                'english'   => 'Glory be to my Lord, the Most Great.',
                'desc'      => 'Bow with your back straight, hands on knees, and recite this three times.',
                'reference' => 'Muslim 772',
            ],
            [
                'step'      => 5,
                'title'     => 'Sujud (Prostration)',
                'arabic'    => 'سُبْحَانَ رَبِّيَ الأَعْلَى',
                'urdu'      => 'پاک ہے میرا رب جو بلند ہے۔',
                'english'   => 'Glory be to my Lord, the Most High.',
                'desc'      => 'Prostrate with seven body parts touching the ground: forehead with nose, both palms, both knees, and toes of both feet. Recite three times.',
                'reference' => 'Muslim 482',
            ],
            [
                'step'      => 6,
                'title'     => 'Tashahhud',
                'arabic'    => 'التَّحِيَّاتُ لِلَّهِ وَالصَّلَوَاتُ وَالطَّيِّبَاتُ',
                'urdu'      => 'تمام زبانی، بدنی اور مالی عبادتیں اللہ کے لیے ہیں۔',
                'english'   => 'All greetings, prayers and good deeds are for Allah.',
                'desc'      => 'Sit after the second rak\'ah and the last rak\'ah, recite Tashahhud, then Durood Ibrahim, then a dua, and end with Tasleem.',
                'reference' => 'Bukhari 831',
            ],
            [
                'step'      => 7,
                'title'     => 'Tasleem (Ending)',
                'arabic'    => 'السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ',
                'urdu'      => 'تم پر سلامتی ہو اور اللہ کی رحمت۔',
                'english'   => 'Peace be upon you and the mercy of Allah.',
                'desc'      => 'Turn your face to the right, then to the left, saying this salaam each time to conclude the prayer.',
                'reference' => 'Muslim 582',
            ],
        ];

        // Common mistakes
        $mistakes = [
            ['title' => 'Rushing the prayer',            'desc' => 'Moving too quickly through ruku and sujud without pausing for the tasbih.', 'fix' => 'Pause long enough to say "Subhana Rabbiyal-\'Adheem" three times calmly.'],
            ['title' => 'Not facing the Qibla',          'desc' => 'Praying in a direction other than the Ka\'bah.', 'fix' => 'Use the Qibla Finder page or a reliable compass before praying.'],
            ['title' => 'Missing the Fajr Sunnah',       'desc' => 'Skipping the two emphasised Sunnah of Fajr.', 'fix' => 'The Prophet ﷺ never left them, even while travelling — pray them.'],
            ['title' => 'Talking during salah',          'desc' => 'Speaking to others while praying.', 'fix' => 'Salah is a private conversation with Allah — remain silent and attentive.'],
            ['title' => 'Not covering the awrah',        'desc' => 'Praying with clothing that does not properly cover the body.', 'fix' => 'Men cover navel to knee; women cover all but face and hands.'],
            ['title' => 'Losing concentration (khushu)', 'desc' => 'Mind wandering during prayer.', 'fix' => 'Pray as if you see Allah; remember you are standing before Him.'],
        ];

        return view('namaz.index', compact('prayers', 'steps', 'mistakes'));
    }

    // ==========================================================
    // NAMAZ TIMINGS  —  /namaz-timings
    // ==========================================================
    public function timings()
    {
        // Default city / method (users can override via query string)
        $city    = request('city', 'Karachi');
        $country = request('country', 'Pakistan');
        $method  = (int) request('method', 1); // 1 = Univ. of Islamic Sciences, Karachi

        $timings = null;
        $error   = null;
        $today   = null;

        try {
            // Cache for 1 hour per city+country+method combo
            $cacheKey = 'namaz_timings_' . md5(strtolower($city . '|' . $country . '|' . $method));

            $data = Cache::remember($cacheKey, 3600, function () use ($city, $country, $method) {
                $base = env('ALADHAN_API_BASE', 'https://api.aladhan.com/v1');

                $response = Http::timeout(10)->get($base . '/timingsByCity', [
                    'city'    => $city,
                    'country' => $country,
                    'method'  => $method,
                ]);

                if (! $response->successful()) {
                    throw new \Exception('AlAdhan API returned ' . $response->status());
                }

                return $response->json();
            });

            if (! empty($data['data']['timings'])) {
                $timings = $data['data']['timings'];
                $today = [
                    'gregorian' => $data['data']['date']['readable'] ?? now()->format('l, F j, Y'),
                    'hijri'     => ($data['data']['date']['hijri']['day']    ?? '') . ' ' .
                                   ($data['data']['date']['hijri']['month']['en'] ?? '') . ' ' .
                                   ($data['data']['date']['hijri']['year'] ?? '') . ' AH',
                    'timezone'  => $data['data']['meta']['timezone'] ?? '',
                    'city'      => $city,
                    'country'   => $country,
                ];
            } else {
                $error = 'No timings returned for ' . $city . ', ' . $country . '.';
            }
        } catch (\Throwable $e) {
            $error = 'Unable to load prayer times: ' . $e->getMessage();
        }

        // Popular cities for autocomplete
        $popularCities = [
            ['city' => 'Karachi',      'country' => 'Pakistan'],
            ['city' => 'Lahore',       'country' => 'Pakistan'],
            ['city' => 'Islamabad',    'country' => 'Pakistan'],
            ['city' => 'Peshawar',     'country' => 'Pakistan'],
            ['city' => 'Quetta',       'country' => 'Pakistan'],
            ['city' => 'Multan',       'country' => 'Pakistan'],
            ['city' => 'Makkah',       'country' => 'Saudi Arabia'],
            ['city' => 'Madinah',      'country' => 'Saudi Arabia'],
            ['city' => 'Dubai',        'country' => 'United Arab Emirates'],
            ['city' => 'Istanbul',     'country' => 'Turkey'],
            ['city' => 'London',       'country' => 'United Kingdom'],
            ['city' => 'New York',     'country' => 'United States'],
            ['city' => 'Toronto',      'country' => 'Canada'],
            ['city' => 'Delhi',        'country' => 'India'],
            ['city' => 'Dhaka',        'country' => 'Bangladesh'],
            ['city' => 'Jakarta',      'country' => 'Indonesia'],
            ['city' => 'Kuala Lumpur', 'country' => 'Malaysia'],
        ];

        // Calculation methods supported by AlAdhan
        $methods = [
            1  => 'University of Islamic Sciences, Karachi',
            2  => 'Islamic Society of North America (ISNA)',
            3  => 'Muslim World League',
            4  => 'Umm al-Qura University, Makkah',
            5  => 'Egyptian General Authority of Survey',
            7  => 'Institute of Geophysics, University of Tehran',
            8  => 'Gulf Region',
            9  => 'Kuwait',
            10 => 'Qatar',
            11 => 'Majlis Ugama Islam Singapura',
            12 => 'Union Organization islamic de France',
            13 => 'Diyanet İşleri Başkanlığı, Turkey',
            14 => 'Spiritual Administration of Muslims of Russia',
            15 => 'Moonsighting Committee Worldwide',
            16 => 'Dubai (unofficial)',
            17 => 'JAKIM (Malaysia)',
            18 => 'Tunisia',
            19 => 'Algeria',
            20 => 'KEMENAG (Indonesia)',
            21 => 'Morocco',
            22 => 'Portugal',
            23 => 'Jordan',
        ];

        return view('namaz.timings', compact(
            'timings',
            'today',
            'error',
            'city',
            'country',
            'method',
            'popularCities',
            'methods'
        ));
    }
}