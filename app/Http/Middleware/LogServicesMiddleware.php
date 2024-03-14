<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogServicesMiddleware
{
    /**
     * Logs info about used services
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $user = $request->user() ? $request->user()->id : 'unauthenticated';
        $content = $response->headers->get('Content-Type') === 'application/json'
            ? json_decode($response->getContent(), true)
            : $response->getContent();
        logger('request', [
            'route' => $request->route()->getName(),
            'params' => $request->route()->parameters(),
            'body' => $request->input(),
            'status' => $response->getStatusCode(),
            'response' => $content,
            'user' => $user,
            'ip' => $request->ip(),
        ]);

        return $response;
    }
}
