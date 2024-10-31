<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Shetabit\Visitor\Middleware\LogVisits;

class LogVisitsForAllRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route() && count($request->route()->parameters()) > 0) {
            foreach ($request->route()->parameters() as $parameter) {
                if ($parameter instanceof \Illuminate\Database\Eloquent\Model) {
                    return app(LogVisits::class)->handle($request, $next);
                }
            }
        }
        visitor()->visit();

        return $next($request);
    }
}
