<?php

namespace App\Http\Middleware\RD;

use Closure;
use Illuminate\Http\Request;

class RDStationAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('rd_crm_token')) {
            return redirect()->route('rd.login');
        }
        return $next($request);
    }
}
