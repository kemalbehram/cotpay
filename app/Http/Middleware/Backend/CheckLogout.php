<?php

namespace App\Http\Middleware\Backend;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogout
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
        if(Auth::guard('admin')->check())
        {
          return redirect('admin');
            
        }else{
            return $next($request);
        }
    }
}
