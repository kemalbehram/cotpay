<?php

namespace App\Http\Middleware\Client;

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
        if(Auth::check())
        {
            if(Auth::user()->level == 1)
            {
                return redirect(route('customer.index'));
            }
            elseif(Auth::user()->level == 2)
            {
                return redirect(route('merchant.index'));
            }
            
            elseif(Auth::user()->level == 3)
            {
                return redirect(route('business.index'));
            } 
        }
        else
        {
            return $next($request);
        }
    }
}
