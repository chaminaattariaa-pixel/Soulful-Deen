<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
    
class PrayerController extends Controller

{
    public function prayer(Request $request)
    {
        $city = $request->city ?? 'Karachi';   // default city
        $country = 'Pakistan';

        // Fetch timings from Aladhan API
        $response = Http::get('https://api.aladhan.com/v1/timingsByCity', [
            'city' => $city,
            'country' => $country,
            'method' => 2,   // Karachi method
            'school' => 1,   // Hanafi (Ahle Sunnat)
        ]);

        if ($response->successful()) {
            $data = $response->json()['data'];
            $timings = $data['timings'];
            $date = $data['date']['readable'];
        } else {
            $timings = [];
            $date = 'Error fetching data';
        }

        return view('prayer.index', compact('timings', 'city', 'date'));
    }
}


