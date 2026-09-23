<?php
namespace App\Http\Controllers;
use App\Models\Hadith;
use App\Models\QuranVerse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function uploadQuranForm()
     { 
        return view('admin.upload_quran'); 
    }
    public function uploadQuran(Request $request)
    {
        $request->validate(['surah'=>'required|int','ayah'=>'required|int','arabic_text'=>'required']);
        QuranVerse::updateOrCreate(
            ['surah'=>$request->surah,'ayah'=>$request->ayah],
            $request->only(['arabic_text','translation_en','translation_ur','tafsir'])
        );
        return redirect()->back()->with('success','Verse saved.');
    }

    public function uploadHadithForm()
     {
         return view('admin.upload_hadith');
     }
    public function uploadHadith(Request $request)
    {
        $request->validate(['text_en'=>'required_without:text_ur','text_ur'=>'required_without:text_en']);
        Hadith::create($request->only(['book','narrator','text_ar','text_en','text_ur','reference']));
        return redirect()->back()->with('success','Hadith saved.');
    }
  
    public function dashboard() 
    { 
        return view('admin.dashboard');
     }
     public function admindashboard(Request $request)               
     {
        $request->validate([
            'surah' => 'required',
            'ayah' => 'required',
            'arabic_text' => 'required|string',
            'translation_en' => 'required|string',
            'translation_ur' => 'required|string',
            'tafsir' => 'nullable|string',
        ]);
     }
     public function home(){
        return view('admin.home');
     }
    public function manageUsers() 
    { 
        return view('admin.users');
    }
}
