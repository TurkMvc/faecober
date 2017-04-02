<?php

namespace App\Http\Controllers;

use App\Haber;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function get_haberEkle()
    {
        return view('backend.pages.haberEkle');
    }

    public function post_haberEkle(Request $request)
    {
        $request->merge(['kullanici_id'=>Auth::user()->id, 'slug'=>str_slug($request->baslik)]);
        Haber::create($request->all());
        return 'basarili';
    }
}
