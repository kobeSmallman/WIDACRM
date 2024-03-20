<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectUnauthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $routeName)
    {
        if (!Auth::check()) { 
            return redirect()->route('login');
        } 
        // $routeName = $request->route()->getName();
        $routeName = strtoupper($routeName);

        $user = Auth::user(); 

        $userPermissions = Permission::where('Employee_ID', $user->get_EmpID())->pluck('Page_ID');
 
        // Check if user has any permissions
        if (empty($userPermissions)) { 
            return redirect()->route('access.denied');
        }
         
        $requiredPageId = $this->getPageIdFromRoute($routeName);
        
        // Check if the required page ID is in the user's permissions
        if (!$userPermissions->contains($requiredPageId)) { 
            return redirect()->route('access.denied');
        }
 
        return $next($request);
    }   
    
    /**
     * Get the page ID based on the route name (you may have to adjust this logic).
     *
     * @param  string  $routeName
     * @return int|null
     */
    private function getPageIdFromRoute($routeName)
    {
        switch ($routeName) {
            case 'CLIENTS':
                return 1;
            case 'VENDORS':
                return 2;
            case 'NOTES':
                return 3;
            case 'ORDERS':
                return 4;
            case 'PAYMENT':
                return 5;
            case 'SYSTEMUSERS':
                return 6;
            case 'PERMISSIONS':
                return 7;  
            default:
                return null;
        }
    }
}
