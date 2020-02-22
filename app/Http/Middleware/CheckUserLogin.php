<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class CheckUserLogin
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
        //
        $userName = $this->getSessionUserName();
        
        if (empty($userName)) {
            Session::put('backUrl', URL::previous());
            return redirect()->route('login');
        }

        return $next($request);
    }

    private function getSessionUserName(){
        $userName = Session::get('tentaikhoan');
        return $userName;
    }
    
}
