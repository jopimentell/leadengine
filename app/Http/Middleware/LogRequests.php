<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    public function handle(Request $request, Closure $next): Response
    {
        $start = microtime(true);

        $response = $next($request);

        $duration = round((microtime(true) - $start) * 1000, 2);

        // Log apenas requisições relevantes (AJAX, API, leads)
        if ($request->expectsJson() || $request->is('*/filtrar') || $request->is('*/lead/*')) {
            Log::channel('app')->info('Request', [
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
                'duration_ms' => $duration,
                'status' => $response->getStatusCode(),
            ]);
        }

        // Alerta de performance (requisições > 2 segundos)
        if ($duration > 2000) {
            Log::channel('performance')->warning('Requisição lenta', [
                'url' => $request->fullUrl(),
                'duration_ms' => $duration,
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
            ]);
        }

        return $response;
    }
}
