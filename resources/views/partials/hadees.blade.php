@extends('layouts') 
@section('content')
    <style>
        body{
            background:#f4f7f9;
            font-family: Arial, sans-serif;
        }
        .hadees-box{
            width:70%;
            margin:100px auto;
            background:#ffffff;
            padding:30px;
            border-radius:10px;
            text-align:center;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
        .arabic{
            font-size:28px;
            margin-bottom:15px;
        }
        .urdu{
            font-size:18px;
            color:#444;
        }
    </style>
<div class="hadees-box">
    <h2>Hadees of the Day</h2>      
    {{-- Arabic Hadees --}}
    <p class="arabic">
        {{ $hadees->arabic ?? 'No Hadees Found' }}

    </p>                
    <p class="urdu">
        {{ $hadees->urdu ?? 'No Translation Found' }}

    </p>
    <p class="English">
        {{ $hadees->english ?? 'No Translation Found' }}        
    </p>
    <p class="Reference">
        {{ $hadees->reference ?? 'No Reference Found' }}
    </p>
</div>