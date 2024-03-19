<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CheckActivity
{
    public function handle($request, Closure $next)
    { 
        // Check if user is logged in and cookie is set
        if (Auth::check() && $request->cookie('logged_in')) {
            // Reset the expiration time of the cookie
            $cookie = cookie('logged_in', true, 60); // 60 minutes
            $response = $next($request)->withCookie($cookie);

            // Check for inactivity
            if (time() - strtotime(Session::get('last_activity')) > 3600) {  
                Auth::logout();
                Session::flush();
                return redirect('/login');
            }

            // Update last activity time
            Session::put('last_activity', now()); 
            return $response;
        }

        // If not logged in or cookie not set, proceed normally
        return $next($request);
    }
}
