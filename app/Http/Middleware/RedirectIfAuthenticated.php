<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        switch ($guard) {
            case 'authority':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('authority.dashboard');
                }
                break;
            case 'farmer':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('farmer.dashboard');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }
        return $next($request);
    }
//    public function handle($request, Closure $next, $guard = null) {
//        if (Auth::guard($guard)->check()) {
//            if ($guard == 'authority') {
//                return redirect('/authority');
//            } else if ($guard == 'farmer') {
//                return redirect('/farmer');
//            } else {
//                return redirect('/');
//            }
//        }
//        return $next($request);
//    }

}
