<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      switch ($guard) {
        case 'gilde':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('gilde.dashboard');
            }
            break;

        case 'admin':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('admin.dashboard');
            }
            break;

        case 'organiser':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('organiser.dashboard');
            }
            break;

        case 'raadsheer':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('raadsheer.dashboard');
            }
            break;

        default:
            if (Auth::guard($guard)->check()) {
                return redirect()->route('gilde.dashboard');
            }
            break;
      }


        return $next($request);
    }
}
