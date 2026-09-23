<?php

namespace App\Http\Controllers;

class QiblaController extends Controller
{
    /**
     * Qibla finder page — all calculation happens client-side
     * (needs live browser GPS + device orientation APIs).
     */
    public function index()
    {
        return view('qibla.index');
    }
}