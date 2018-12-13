<?php

namespace App\Http\Middleware;
use Request;
use Closure;
use Auth;
class Guest
{
    public function handle($request, Closure $next, $guard = null)
    {
        $prefix = Request::segment(1);//Grab the prefix for seller/merchants and redirect to requested page
        if($guard == 'users'){
            if($prefix=='seller'){
                if (!Auth::check()) {
                    return \Redirect::guest('seller/login');
                }
            }else if($prefix=='merchants'){
                if (!Auth::check()) {
                    return \Redirect::guest('merchants/login');
                }
            }else if($prefix=='affiliates'){
                if (!Auth::check()) {
                    return \Redirect::guest('affiliates/login');
                }
            }else{ 
                if (!Auth::check()) {
                    return \Redirect::guest('login');
                }
            }
        }else if($guard == 'admin'){
            if (!Auth::guard('admin')->check()) {
                return \Redirect::guest('admin/login');
            }
        }
        return $next($request);
    }
}
