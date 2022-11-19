<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has("idUser"))
            return redirect("/login")->with(["title" => "Login terlebih dahulu!", "icon" =>"error", "text" => ""]);
        return $next($request);
    }
}
