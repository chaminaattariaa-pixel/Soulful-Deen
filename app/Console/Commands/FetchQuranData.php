<?php

namespace App\Console\Commands;

use App\Models\Ayah;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchQuranData extends Command
{
    protected $signature = 'quran:fetch {surah?}';
    protected $description = 'Fetch Quran data from API';

    public function handle()
    {
        $surahNumber = $this->argument('surah');
        
        if ($surahNumber) {
            $this->fetchSurah($surahNumber);
        } else {
            // Fetch all surahs from 1 to 114
            for ($i = 1; $i <= 114; $i++) {
                $this->fetchSurah($i);
                sleep(1); // Be respectful to the API
            }
        }
        
        $this->info('Quran data fetched successfully!');
    }

    private function fetchSurah($surahNumber)
    {
        $this->info("Fetching Surah {$surahNumber}...");
        
        $arabic = Http::get("https://api.alquran.cloud/v1/surah/{$surahNumber}")->json();
        $urdu = Http::get("https://api.alquran.cloud/v1/surah/{$surahNumber}/ur.jalandhry")->json();
        $english = Http::get("https://api.alquran.cloud/v1/surah/{$surahNumber}/en.asad")->json();
        
        if (!isset($arabic['data']['ayahs'])) {
            $this->error("Failed to fetch Surah {$surahNumber}");
            return;
        }
        
        $arabicAyahs = $arabic['data']['ayahs'];
        $urduAyahs = $urdu['data']['ayahs'] ?? [];
        $englishAyahs = $english['data']['ayahs'] ?? [];
        
        foreach ($arabicAyahs as $index => $ayah) {
            Ayah::updateOrCreate(
                [
                    'surah_number' => $surahNumber,
                    'ayah_number' => $ayah['numberInSurah'],
                ],
                [
                    'arabic_text' => $ayah['text'],
                    'urdu_text' => $urduAyahs[$index]['text'] ?? null,
                    'english_text' => $englishAyahs[$index]['text'] ?? null,
                    'page' => $ayah['page'],
                    'juz' => $ayah['juz'],
                ]
            );
        }
        
        $this->info("Surah {$surahNumber} saved successfully!");
    }
}