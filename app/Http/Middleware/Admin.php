<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->isadmin() ) // giriş yapıldı mı?
        {
            return $next($request); // evet ise devam et
        }
        return Redirect::to('/')->withErrors(['msg', 'Bu alana yetkiniz nulunmamaktadır.']); // değilse ana sayfaya yolla
    }
}
