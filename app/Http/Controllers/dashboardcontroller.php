<?php

namespace App\Http\Controllers;
use App\Models\ayat;
use App\Models\Hadees;
use Illuminate\Support\Facades\Cache;


use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
    public function show(){
     $ayat = Cache::remember('ayat_of_the_day', 60 * 60 * 24, function () {
        return ayat::inRandomOrder()->first();
    });
        // dd($ayat); // check if you get a record
        $hadees = Cache::remember('hadees_of_the_day', 60 * 60 * 24, function () {
       return Hadees::inRandomOrder()->first();
   });
    $city = 'Karachi';   // default city
          $country = 'Pakistan';
    
          // Fetch timings from Aladhan API
          $response = \Illuminate\Support\Facades\Http::get('https://api.aladhan.com/v1/timingsByCity',
         [
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
       // dd($hadees); // check if you get a record         
    return view('dashboard', compact('ayat','hadees','timings','city','date'));
    
  }
}
