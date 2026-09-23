<?php

namespace App\Http\Controllers;

use App\Models\Hadees;
use Illuminate\Http\Request;

class hadeescontroller extends Controller
{
    public function create()
    {
        return view('admin.hadees');
    }
    
      public function store(Request $request)
    {
        $request->validate([
            'arabic' => 'required',
            'urdu'   => 'required',
            'english' => 'required',
            'reference' => 'required',
        ]);

        Hadees::create([
            'arabic' => $request->arabic,
            'urdu'   => $request->urdu,
            'english' => $request->english,
            'reference' => $request->reference,
        ]);

        return back()->with('success', 'Hadees saved successfully');
    }
    
}
