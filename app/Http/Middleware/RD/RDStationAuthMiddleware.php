<?php

namespace App\Http\Middleware\RD;

use Closure;
use Illuminate\Http\Request;

class RDStationAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = true;
        if ($response === true){
            return $next($request);
        }
        return redirect()->route('rd.login');
    }
}
