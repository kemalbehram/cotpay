<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class LangMiddleware
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
        $locale = Session::get('locale');
        \App::setlocale($locale);
        return $next($request);
    }
}
