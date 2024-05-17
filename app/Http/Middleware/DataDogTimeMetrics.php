<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DataDog\DogStatsd;
class DataDogTimeMetrics
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $statsd = new DogStatsd(
            array('host' => '127.0.0.1',
                'port' => 8125,
            )
        );

        $startTime = microtime(true);

        $response = $next($request);

        $tags = [
            "status_code" => $response->getStatusCode(),
            "url" => $request->getSchemeAndHttpHost() . $request->getRequestUri()
        ];


        $statsd->microtiming(
            stat: 'laravel_request_time.timer',
            time: microtime(TRUE) - $startTime,
            tags: $tags
        );

        return $response;
    }
}
