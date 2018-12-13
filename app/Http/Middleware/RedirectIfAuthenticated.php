<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Request;
class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        $prefix = Request::segment(1);//Grab the prefix for seller/merchants and redirect to requested page
        if(Auth::guard($guard)->check()){
            if($guard == 'users'){
                if($prefix=='seller'){
                    return redirect('seller/dashboard');
                }else if($prefix=='merchants'){
                    return redirect('merchants/dashboard');
                }else if($prefix=='affiliates'){
                    return redirect('affiliates/dashboard');
                }else{
                    return redirect('dashboard'); 
                }
            }else if($guard == 'admin'){
                return redirect('admin/dashboard');
            }
        }
        return $next($request);
    }
}
