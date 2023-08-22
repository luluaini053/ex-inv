<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        print_r($request->session());
        // if (! $request->expectsJson()) {
        // if (!$request->session()->exists('user')) {
        // if (!$request->session())
        if (!$request->session()) {
            // disini dia periksa jika request nya tidak mengingkan response json
            // akan dilempar ke halaman login
            // lebih baik periksa apakah request nya ada session atau tidak, lebih masuk akal seperti itu
            // dd("DONT GO HERE BOY");
            return route('login');
        }
        // dd("GO HERE BOY HELL YEAH");
    }
}
