<?php

namespace App\Http\Controllers;

use App\Models\Surah;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class QuranController extends Controller
{
    /**
     * Display all surahs from API
     */
    public function getSurahs()
    {
        try {
            // Fetch surahs directly from API
            $response = Http::get('https://api.alquran.cloud/v1/surah');
            
            if ($response->successful()) {
                $surahs = $response->json()['data'];
                return view('quran.surahs', compact('surahs'));
            }
            
            return view('quran.surahs')->with('error', 'Failed to fetch surahs');
        } catch (\Exception $e) {
            return view('quran.surahs')->with('error', 'Connection error: ' . $e->getMessage());
        }
    }

    /**
     * Get specific surah by number
     */
    public function getSurah($surahNumber, Request $request)
    {
        try {
            $page = $request->get('page', 1);
            $perPage = 20;
            
            // Fetch surah details from API
            $surahResponse = Http::get("https://api.alquran.cloud/v1/surah/{$surahNumber}");
            
            if (!$surahResponse->successful()) {
                return redirect()->route('quran.surahs')->with('error', 'Surah not found');
            }
            
            $surah = $surahResponse->json()['data'];
            
            // Fetch Arabic text
            $arabicResponse = Http::get("https://api.alquran.cloud/v1/surah/{$surahNumber}");
            
            // Fetch English translation (Sahih International)
            $englishResponse = Http::get("https://api.alquran.cloud/v1/surah/{$surahNumber}/en.sahih");
            
            // Fetch Urdu translation (optional)
            $urduResponse = Http::get("https://api.alquran.cloud/v1/surah/{$surahNumber}/ur.jalandhry");
            
            if (!$arabicResponse->successful()) {
                return redirect()->route('quran.surahs')->with('error', 'Failed to fetch surah data');
            }
            
            $arabicAyahs = $arabicResponse->json()['data']['ayahs'];
            $englishAyahs = $englishResponse->successful() ? $englishResponse->json()['data']['ayahs'] : [];
            $urduAyahs = $urduResponse->successful() ? $urduResponse->json()['data']['ayahs'] : [];
            
            // Combine ayahs with translations
            $ayahs = [];
            foreach ($arabicAyahs as $index => $ayah) {
                $ayahs[] = (object)[
                    'number' => $ayah['numberInSurah'],
                    'arabic' => $ayah['text'],
                    'english' => $englishAyahs[$index]['text'] ?? null,
                    'urdu' => $urduAyahs[$index]['text'] ?? null,
                    'page' => $ayah['page'],
                    'juz' => $ayah['juz']
                ];
            }
            
            // Manual pagination
            $totalAyahs = count($ayahs);
            $totalPages = ceil($totalAyahs / $perPage);
            $offset = ($page - 1) * $perPage;
            $paginatedAyahs = array_slice($ayahs, $offset, $perPage);
            
            if ($request->ajax()) {
                return response()->json([
                    'html' => view('quran.partials.ayahs', compact('paginatedAyahs', 'surah'))->render(),
                    'currentPage' => $page,
                    'totalPages' => $totalPages
                ]);
            }
            
            return view('quran.index', compact('paginatedAyahs', 'page', 'totalPages', 'surah', 'ayahs', 'totalAyahs'));
            
        } catch (\Exception $e) {
            return redirect()->route('quran.surahs')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Get ayahs by page number (traditional Quran pages)
     */
    public function getAyahsByPage(Request $request)
    {
        try {
            $page = (int) $request->get('page', 1);

            if ($page < 1 || $page > 604) {
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid page number. Must be between 1 and 604'
                ], 400);
            }

            // Fetch Arabic, English, and Urdu in parallel with timeout
            $arabicResponse = Http::timeout(15)->get(
                "https://api.alquran.cloud/v1/page/{$page}/quran-uthmani"
            );
            $englishResponse = Http::timeout(15)->get(
                "https://api.alquran.cloud/v1/page/{$page}/en.sahih"
            );
            $urduResponse = Http::timeout(15)->get(
                "https://api.alquran.cloud/v1/page/{$page}/ur.jalandhry"
            );

            if (!$arabicResponse->successful()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to fetch Arabic text from AlQuran API. Status: ' 
                            . $arabicResponse->status()
                ], 502);
            }

            $arabicData  = $arabicResponse->json()['data'] ?? null;
            $englishData = $englishResponse->successful() 
                        ? ($englishResponse->json()['data'] ?? null) 
                        : null;
            $urduData    = $urduResponse->successful()
                        ? ($urduResponse->json()['data'] ?? null)
                        : null;

            if (!$arabicData || empty($arabicData['ayahs'])) {
                return response()->json([
                    'success' => false,
                    'error' => 'No ayahs returned for page ' . $page
                ], 404);
            }

            $ayahs = [];
            foreach ($arabicData['ayahs'] as $index => $ayah) {
                $ayahs[] = [
                    'surah_number'       => $ayah['surah']['number'],
                    'surah_name'         => $ayah['surah']['name'],
                    'surah_english_name' => $ayah['surah']['englishName'],
                    'ayah_number'        => $ayah['numberInSurah'],
                    'arabic'             => $ayah['text'],
                    'english'            => $englishData['ayahs'][$index]['text'] ?? null,
                    'urdu'               => $urduData['ayahs'][$index]['text'] ?? null,
                    'juz'                => $ayah['juz'],
                    'page'               => $ayah['page'],
                ];
            }

            return response()->json([
                'success'     => true,
                'page'        => $page,
                'ayahs'       => $ayahs,
                'total_ayahs' => count($ayahs),
            ]);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return response()->json([
                'success' => false,
                'error'   => 'Cannot connect to Quran API. Check server internet access.'
            ], 503);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get ayahs by Juz (Para)
     */
    public function getAyahsByJuz(Request $request)
    {
        try {
            $juz = $request->get('juz', 1);
            $perPage = $request->get('per_page', 20);
            $page = $request->get('page', 1);
            
            if ($juz < 1 || $juz > 30) {
                return response()->json(['error' => 'Invalid Juz number. Juz range from 1 to 30'], 400);
            }
            
            // Fetch Juz data from API (Arabic, English, Urdu)
            $arabicResponse = Http::get("https://api.alquran.cloud/v1/juz/{$juz}/quran-uthmani");
            $englishResponse = Http::get("https://api.alquran.cloud/v1/juz/{$juz}/en.sahih");
            $urduResponse = Http::get("https://api.alquran.cloud/v1/juz/{$juz}/ur.jalandhry");
            
            if (!$arabicResponse->successful()) {
                return response()->json(['error' => 'Failed to fetch Juz data'], 404);
            }
            
            $arabicData = $arabicResponse->json()['data'];
            $englishData = $englishResponse->successful() ? $englishResponse->json()['data'] : null;
            $urduData = $urduResponse->successful() ? $urduResponse->json()['data'] : null;
            
            $ayahs = [];
            foreach ($arabicData['ayahs'] as $index => $ayah) {
                $ayahs[] = (object)[
                    'surah_number' => $ayah['surah']['number'],
                    'surah_name' => $ayah['surah']['name'],
                    'surah_english_name' => $ayah['surah']['englishName'],
                    'ayah_number' => $ayah['numberInSurah'],
                    'arabic' => $ayah['text'],
                    'english' => $englishData ? ($englishData['ayahs'][$index]['text'] ?? null) : null,
                    'urdu' => $urduData ? ($urduData['ayahs'][$index]['text'] ?? null) : null,
                    'page' => $ayah['page']
                ];
            }
            
            // Manual pagination
            $totalAyahs = count($ayahs);
            $totalPages = ceil($totalAyahs / $perPage);
            $offset = ($page - 1) * $perPage;
            $paginatedAyahs = array_slice($ayahs, $offset, $perPage);
            
            if ($request->ajax()) {
                return response()->json([
                    'html' => view('quran.partials.ayahs', compact('paginatedAyahs'))->render(),
                    'currentPage' => $page,
                    'totalPages' => $totalPages
                ]);
            }
            
            return view('quran.juz-view', compact('paginatedAyahs', 'page', 'totalPages', 'juz'));
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Search ayahs across Quran
     */
    public function searchAyahs(Request $request)
    {
        try {
            $query = $request->get('q');
            $language = $request->get('language', 'english'); // arabic, english, urdu
            
            if (!$query) {
                return redirect()->route('quran.surahs')->with('error', 'Please enter a search term');
            }
            
            return view('quran.search-results', compact('query'));
            
        } catch (\Exception $e) {
            return back()->with('error', 'Search error: ' . $e->getMessage());
        }
    }

    /**
     * Get specific ayah by Surah and Ayah number
     */
    public function getAyah($surahNumber, $ayahNumber, Request $request)
    {
        try {
            // Fetch specific ayah
            $response = Http::get("https://api.alquran.cloud/v1/ayah/{$surahNumber}:{$ayahNumber}/editions/quran-uthmani,en.sahih,ur.jalandhry");
            
            if (!$response->successful()) {
                return response()->json(['error' => 'Ayah not found'], 404);
            }
            
            $data = $response->json()['data'];
            
            $ayah = (object)[
                'surah_number' => $surahNumber,
                'ayah_number' => $ayahNumber,
                'arabic' => $data[0]['text'] ?? null,
                'english' => $data[1]['text'] ?? null,
                'urdu' => $data[2]['text'] ?? null,
                'page' => $data[0]['page'] ?? null,
                'juz' => $data[0]['juz'] ?? null
            ];
            
            if ($request->ajax()) {
                return response()->json(['success' => true, 'ayah' => $ayah]);
            }
            
            return view('quran.ayah-detail', compact('ayah'));
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Get all available editions/translations
     */
    public function getEditions()
    {
        try {
            $response = Http::get('https://api.alquran.cloud/v1/edition');
            
            if ($response->successful()) {
                $editions = $response->json()['data'];
                return response()->json($editions);
            }
            
            return response()->json(['error' => 'Failed to fetch editions'], 500);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Stream audio recitation for ayah
     */
    public function getAyahAudio($surahNumber, $ayahNumber)
    {
        try {
            $reciter = request()->get('reciter', 'ar.alafasy'); // Default: Alafasy
            
            // Audio URL format
            $audioUrl = "https://cdn.islamic.network/quran/audio/128/{$reciter}/{$surahNumber}_{$ayahNumber}.mp3";
            
            return response()->json([
                'success' => true,
                'audio_url' => $audioUrl,
                'surah' => $surahNumber,
                'ayah' => $ayahNumber
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}