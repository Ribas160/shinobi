<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class BlockIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $position = Location::get();

        if ($position->countryName !== 'Israel') {
            abort(403, "You are restricted to access the site.");
        }

        return $next($request);
    }
}
