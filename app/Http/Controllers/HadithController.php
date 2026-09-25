<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HadithController extends Controller
{
    /**
     * Base API URL and key
     */
    protected function apiBase()
    {
        return 'https://hadithapi.com/api';
    }

    protected function apiKey()
    {
        // return config('services.hadithapi.key', env('HADITH_API_KEY'));
            return config('services.hadithapi.key');

    }

    /**
     * The 6 authentic books metadata (for sidebar + navigation)
     */
    public static function booksMeta()
    {
        return [
            [
                'slug' => 'sahih-bukhari',
                'name' => 'Sahih Bukhari',
                'arabic' => 'صحيح البخاري',
                'author' => 'Imam Muhammad al-Bukhari',
                'total_hadiths' => 7563,
                'total_books' => 97,
                'reliability' => 'Sahih (Authentic)',
                'description' => 'The most authentic book after the Quran, compiled by Imam Bukhari (d. 256 AH).',
            ],
            [
                'slug' => 'sahih-muslim',
                'name' => 'Sahih Muslim',
                'arabic' => 'صحيح مسلم',
                'author' => 'Imam Muslim ibn al-Hajjaj',
                'total_hadiths' => 7500,
                'total_books' => 56,
                'reliability' => 'Sahih (Authentic)',
                'description' => 'Second most authentic collection, known for its precise organisation by Imam Muslim (d. 261 AH).',
            ],
            [
                'slug' => 'abu-dawood',
                'name' => 'Sunan Abu Dawud',
                'arabic' => 'سنن أبي داود',
                'author' => 'Imam Abu Dawud as-Sijistani',
                'total_hadiths' => 5274,
                'total_books' => 43,
                'reliability' => 'Hasan/Sahih',
                'description' => 'Focused on legal (fiqh) hadiths, compiled by Imam Abu Dawud (d. 275 AH).',
            ],
           
            [
                'slug' => 'nasai',
                'name' => "Sunan an-Nasa'i",
                'arabic' => 'سنن النسائي',
                'author' => "Imam Ahmad an-Nasa'i",
                'total_hadiths' => 5758,
                'total_books' => 51,
                'reliability' => 'Sahih/Hasan',
                'description' => 'Strictest in narrator criticism, compiled by Imam an-Nasa\'i (d. 303 AH).',
            ],
             [
                'slug' => 'tirmidhi',
                'name' => "Jami' at-Tirmidhi",
                'arabic' => 'جامع الترمذي',
                'author' => 'Imam Abu Isa at-Tirmidhi',
                'total_hadiths' => 3956,
                'total_books' => 49,
                'reliability' => 'Hasan/Sahih',
                'description' => 'Unique for grading each hadith, compiled by Imam at-Tirmidhi (d. 279 AH).',
            ],
            [
                'slug' => 'ibnu-majah',
                'name' => 'Sunan Ibn Majah',
                'arabic' => 'سنن ابن ماجه',
                'author' => 'Imam Ibn Majah al-Qazwini',
                'total_hadiths' => 4341,
                'total_books' => 37,
                'reliability' => 'Hasan/Sahih/Da\'if',
                'description' => 'The sixth book of the Sunnah, compiled by Imam Ibn Majah (d. 273 AH).',
            ],
        ];
    }

    /**
     * Landing page — shows all 6 books
     */
    public function index()
    {
        $books = self::booksMeta();
        return view('hadith.index', compact('books'));
    }

    /**
     * Hadith reader page — sidebar + viewer
     * URL: /hadith/{bookSlug}?book=1&page=1
     */
    public function show(Request $request, $bookSlug)
    {
        $books = self::booksMeta();
        $book = collect($books)->firstWhere('slug', $bookSlug);

        if (!$book) {
            return redirect()->route('hadith.index')->with('error', 'Book not found');
        }

        // Book number (1..97 for Bukhari, etc.) and page
        $bookNumber = (int) $request->get('book', 1);
        $page       = (int) $request->get('page', 1);

        // Load chapters for this book (book list)
        $chapters = $this->getChapters($bookSlug);

        // Load hadiths for the selected chapter
        $hadiths = $this->getHadithsByChapter($bookSlug, $bookNumber, $page);

        return view('hadith.reader', compact(
            'books', 'book', 'chapters',
            'bookNumber', 'page', 'hadiths'
        ));
    }

    /**
     * API: get chapters of a book
     * Returns array of chapter objects
     */
    public function getChapters($bookSlug)
    {
        $cacheKey = "hadith_chapters_{$bookSlug}";

        return Cache::remember($cacheKey, now()->addDay(), function () use ($bookSlug) {
            try {
                $res = Http::timeout(20)->get($this->apiBase() . '/books', [
                    'apiKey' => $this->apiKey(),
                ]);

                if (!$res->successful()) return [];

                $data = $res->json();
                $allBooks = $data['books'] ?? [];

                // Filter by slug
                $matched = collect($allBooks)->firstWhere('bookSlug', $bookSlug);

                return $matched['chapters'] ?? [];
            } catch (\Exception $e) {
                // \Log::error('Hadith chapters fetch failed: ' . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * API: fetch hadiths for a specific chapter + pagination
     */
    public function getHadithsByChapter($bookSlug, $chapterNumber = 1, $page = 1)
    {
        $cacheKey = "hadith_{$bookSlug}_ch{$chapterNumber}_p{$page}";

        return Cache::remember($cacheKey, now()->addHours(12), function () use ($bookSlug, $chapterNumber, $page) {
            try {
                $res = Http::timeout(20)->get($this->apiBase() . '/hadiths', [
                    'apiKey'   => $this->apiKey(),
                    'book'     => $bookSlug,
                    'chapter'  => $chapterNumber,
                    'page'     => $page,
                    'paginate' => 20,
                ]);

                if (!$res->successful()) {
                    return ['data' => [], 'total' => 0, 'last_page' => 1];
                }

                $json = $res->json();

                $hadiths   = $json['hadiths']['data'] ?? [];
                $total     = $json['hadiths']['total'] ?? 0;
                $lastPage  = $json['hadiths']['last_page'] ?? 1;

                return [
                    'data'      => $hadiths,
                    'total'     => $total,
                    'last_page' => $lastPage,
                    'current'   => $page,
                ];
            } catch (\Exception $e) {
                // \Log::error('Hadith fetch failed: ' . $e->getMessage());
                return ['data' => [], 'total' => 0, 'last_page' => 1];
            }
        });
    }

    /**
     * AJAX: JSON endpoint for hadiths (used by frontend pagination)
     * URL: /hadith/{bookSlug}/json?book=1&page=1
     */
    public function getHadithsJson(Request $request, $bookSlug)
    {
        $bookNumber = (int) $request->get('book', 1);
        $page       = (int) $request->get('page', 1);

        try {
            $result = $this->getHadithsByChapter($bookSlug, $bookNumber, $page);

            if (empty($result['data'])) {
                return response()->json([
                    'success' => false,
                    'error'   => 'No hadiths found for this chapter/page.'
                ], 404);
            }

            $hadiths = [];
            foreach ($result['data'] as $h) {
                $hadiths[] = [
                    'hadith_number'  => $h['hadithNumber'] ?? null,
                    'arabic'         => $h['hadithArabic'] ?? '',
                    'english'        => $h['hadithEnglish'] ?? '',
                    'urdu'           => $h['hadithUrdu'] ?? '',
                    'narrator'       => $h['englishNarrator'] ?? ($h['hadithNarratedBy'] ?? ''),
                    'book_name'      => $h['book']['bookName'] ?? '',
                    'book_slug'      => $h['book']['bookSlug'] ?? $bookSlug,
                    'chapter_name'   => $h['chapter']['chapterName'] ?? '',
                    'chapter_arabic' => $h['chapter']['chapterArabic'] ?? '',
                    'status'         => $h['status'] ?? '',
                    'grade'          => $h['hadithGrade'] ?? '',
                ];
            }

            return response()->json([
                'success'     => true,
                'page'        => $page,
                'total'       => $result['total'],
                'last_page'   => $result['last_page'],
                'hadiths'     => $hadiths,
                'total_found' => count($hadiths),
            ]);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return response()->json([
                'success' => false,
                'error'   => 'Cannot connect to Hadith API. Check server internet access.'
            ], 503);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search hadiths by keyword
     * URL: /hadith/search?q=patience&book=sahih-bukhari
     */
    /**
 * Search hadiths by keyword
 * URL: /hadith/search?q=patience&book=sahih-bukhari
 *
 * NOTE: HadithAPI's free tier does NOT support server-side text search —
 * passing &hadith=keyword is ignored and returns ALL hadiths.
 * So we paginate through chapters and filter locally.
 */
public function search(Request $request)
{
    $query    = trim((string) $request->get('q', ''));
    $bookSlug = $request->get('book', 'sahih-bukhari');
    $page     = max(1, (int) $request->get('page', 1));

    $books = self::booksMeta();
    $book  = collect($books)->firstWhere('slug', $bookSlug) ?? $books[0];

    $results   = [];
    $total     = 0;
    $scanned   = 0;
    $truncated = false;
    $lastPage  = 1;

    // No keyword — just a book selected (or page loaded fresh):
    // show 20 hadiths from chapter 1 of that book, paginated.
    if ($query === '') {
        $default = $this->getHadithsByChapter($bookSlug, 1, $page);

        $results  = $default['data'] ?? [];
        $total    = $default['total'] ?? 0;
        $lastPage = $default['last_page'] ?? 1;

        return view('hadith.search', compact(
            'books', 'book', 'query', 'results', 'total', 'bookSlug',
            'scanned', 'truncated', 'page', 'lastPage'
        ));
    }

    if (mb_strlen($query) >= 2) {

        $cacheKey = 'hadith_search_v2_' . md5($bookSlug . '|' . mb_strtolower($query));

        $cached = Cache::remember($cacheKey, now()->addHours(12), function () use ($bookSlug, $query, &$scanned, &$truncated) {

            $chapters = $this->getChapters($bookSlug);

            if (empty($chapters)) {
                return ['matches' => [], 'scanned' => 0, 'truncated' => false];
            }

            $needle  = mb_strtolower($query);
            $matches = [];

            $maxChaptersToScan = 40;
            $chapterCount = 0;

            foreach ($chapters as $ch) {
                if ($chapterCount >= $maxChaptersToScan) {
                    $truncated = true;
                    break;
                }
                $chapterCount++;

                $chapterNum = (int) ($ch['chapterNumber'] ?? 0);
                if ($chapterNum < 1) continue;

                try {
                    $res = Http::timeout(20)->get($this->apiBase() . '/hadiths', [
                        'apiKey'   => $this->apiKey(),
                        'book'     => $bookSlug,
                        'chapter'  => $chapterNum,
                        'paginate' => 100,
                    ]);

                    if (!$res->successful()) continue;

                    $json = $res->json();
                    $hadiths = $json['hadiths']['data'] ?? [];
                    $scanned += count($hadiths);

                    foreach ($hadiths as $h) {
                        $en = mb_strtolower($h['hadithEnglish'] ?? '');
                        $ar = $h['hadithArabic'] ?? '';
                        $ur = $h['hadithUrdu'] ?? '';

                        if (
                            mb_strpos($en, $needle) !== false ||
                            mb_strpos(mb_strtolower($ur), $needle) !== false ||
                            ($this->isArabic($query) && mb_strpos($ar, $query) !== false)
                        ) {
                            $matches[] = $h;

                            if (count($matches) >= 100) {
                                $truncated = true;
                                break 2;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }

            return [
                'matches'   => $matches,
                'scanned'   => $scanned,
                'truncated' => $truncated,
            ];
        });

        $results   = $cached['matches'] ?? [];
        $scanned   = $cached['scanned'] ?? 0;
        $truncated = $cached['truncated'] ?? false;
        $total     = count($results);
    }

    return view('hadith.search', compact(
        'books', 'book', 'query', 'results', 'total', 'bookSlug',
        'scanned', 'truncated', 'page', 'lastPage'
    ));
}
/**
 * Detect if a string contains Arabic characters
 */
protected function isArabic($str)
{
    return preg_match('/\p{Arabic}/u', $str) === 1;
}
    // public function search(Request $request)
    // {
    //     $query = trim((string) $request->get('q', ''));
    //     $bookSlug = $request->get('book', 'sahih-bukhari');

    //     $books = self::booksMeta();
    //     $book  = collect($books)->firstWhere('slug', $bookSlug) ?? $books[0];

    //     $results = [];
    //     $total = 0;

    //     if ($query !== '') {
    //         $cacheKey = 'hadith_search_' . md5($bookSlug . '|' . $query);

    //         $data = Cache::remember($cacheKey, now()->addHours(6), function () use ($bookSlug, $query) {
    //             try {
    //                 $res = Http::timeout(25)->get($this->apiBase() . '/hadiths', [
    //                     'apiKey' => $this->apiKey(),
    //                     'book'   => $bookSlug,
    //                     'hadith' => $query,
    //                 ]);
    //                 if (!$res->successful()) return [];
    //                 return $res->json()['hadiths']['data'] ?? [];
    //             } catch (\Exception $e) {
    //                 return [];
    //             }
    //         });

    //         $results = $data;
    //         $total = count($results);
    //     }

    //     return view('hadith.search', compact(
    //         'books', 'book', 'query', 'results', 'total', 'bookSlug'
    //     ));
    // }

    /**
     * Get all 6 books as JSON (used elsewhere)
     */
    public function getBooksJson()
    {
        return response()->json([
            'success' => true,
            'books'   => self::booksMeta(),
        ]);
    }
}