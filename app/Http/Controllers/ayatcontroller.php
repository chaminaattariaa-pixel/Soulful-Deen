<?php

namespace App\Http\Controllers;

use App\Models\ayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ayatcontroller extends Controller
{
      public function create()
    {
        return view('admin.ayat');
    }
    
      public function store(Request $request)
    {
        $request->validate([
            'arabic' => 'required',
            'urdu'   => 'required',
            'english' => 'required',
            'reference' => 'required',
        ]);

        ayat::create([
            'arabic' => $request->arabic,
            'urdu'   => $request->urdu,
            'english' => $request->english,
            'reference' => $request->reference,
        ]);

        return back()->with('success', 'Ayat saved successfully');
    }

    // Show ayat on website
    // public function show(){
    //  $ayat = Cache::remember('ayat_of_the_day', 60 * 60 * 24, function () {
    //     return ayat::inRandomOrder()->first();
    // });
    //     dd($ayat); // check if you get a record

    // return view('dashboard', compact('ayat'));
        
    // }
}
