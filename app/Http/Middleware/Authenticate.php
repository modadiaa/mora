<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Request;
class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('dashboard.login');
        }else{
            return route('login');

        }


    }


   /* protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if( Request::is('dashboard/*')){
                return route('dashboard.login');

            }else{
                return route('login');

            }
        }


    }*/





}
