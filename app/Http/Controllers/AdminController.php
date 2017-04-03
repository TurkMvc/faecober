<?php

namespace App\Http\Controllers;

use App\Haber;

use Auth;
use Validator;
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
        /*
         * $validator = Validator::make(
         *   ['name' => 'Dayle'],
         *   ['name' => 'required|min:5']
         * );
         */   // burada önemli olan kısım database e eaktarırken olan kısım ondan işaretledim!!!!

        $validator= Validator::make($request->all(), [
            'baslik'=> 'required|max:255',
            'icerik'=> 'required'
            ]);
            if ($validator->fails()){
                return response([
                    'baslik'=>'Başarısız',
                    'icerik'=>'Bazı alanlar boş.']
                );
            }

      /*  if($request->baslik==null){
       *     return response(['baslik'=>'Başarısız','msg'=>'Bazı alanlar boş.']); // TODO laravel 3. video 45 den itibaren bu izle bu sorunu çöz
       * }
       */
        $request->merge(['kullanici_id'=>Auth::user()->id, 'slug'=>str_slug($request->baslik)]);
        Haber::create($request->all());
        return response([
            'baslik'=>'Başarılı',
            'icerik'=>'denemeBaşarılı bir şekilde kaydedildi.','code'=>200],200);
    }
}
