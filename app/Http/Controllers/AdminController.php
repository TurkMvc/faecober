<?php

namespace App\Http\Controllers;

use App\Haber;
use App\Http\Requests;
use Auth;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Storage;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

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
            $slug=str_slug($request->baslik);
            if (Haber::where('slug',str_slug($request->baslik))->count()>0){
                $now = str_slug(Carbon::now());
                $slug = $slug.'-'.$now;
            }
            $file=Input::file('resim');
            $destinationPath="img/haber/".$slug;
            $extension=Input::file('resim')->getClientOriginalExtension();
            $fileName=str_slug($request->baslik).'.'.$extension;
            Storage::disk('uploads')->makeDirectory($destinationPath);
            Image::make($file->getRealPath())->resize(300,300)
                    ->save(storage_path('uploads/'.$destinationPath.'/'.$fileName));

            $request->merge(['kullanici_id'=>Auth::user()->id, 'slug'=>$slug]);
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
