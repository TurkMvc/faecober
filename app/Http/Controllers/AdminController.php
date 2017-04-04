<?php

namespace App\Http\Controllers;

use App\Haber;

use Auth;
use Storage;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Image;

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
         */   // burada önemli olan kısım database e aktarırken olan kısım ondan işaretledim!!!!
        $validator= Validator::make($request->all(), [
            'baslik'=> 'required|max:255',
            'icerik'=> 'required',
            'resim'=>'required|mimes:jpeg,jpg,png,gif'
            ]);

        if ($validator->fails())
        {
            return response([
                'baslik'=>'Başarısız',
                'icerik'=>'Bazı alanlar boş.']
            );
        }
        if(Input::file('resim')->isValid())
        {
            $file=Input::file('resim');
            $destinationPath="img/haber".str_slug($request->baslik);
            $extention=Input::file('resim')->getClientOriginalExtension();
            $fileName=str_slug($request->baslik).'.'.$extention;
            Storage::disk('uploads')->makeDirectory($destinationPath);
            Image::make($file->getRealPath()->resize(300,300)->save('uploads/'.$destinationPath.'/'.$fileName));
            $request->merge(['kullanici_id'=>Auth::user()->id, 'slug'=>str_slug($request->baslik)]);
            Haber::create($request->all());
            return response([
                'baslik'=>'Başarılı',
                'icerik'=>'denemeBaşarılı bir şekilde kaydedildi.','code'=>200],200);
        }
         return response(['icerik'=>'resim valid değil','code'=>1]);
      /*  if($request->baslik==null){
       *     return response(['baslik'=>'Başarısız','msg'=>'Bazı alanlar boş.']); // TODO laravel 3. video 45 den itibaren bu izle bu sorunu çöz
       * }
       */

    }
}
