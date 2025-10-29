<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminRequestLogging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isAdmin = str_starts_with($request->path(), 'admin');
        if (! $isAdmin) {
            return $next($request);
        }

        $requestTime = microtime(true);
        $requestId = bin2hex(random_bytes(8));

        DB::enableQueryLog();

        $context = [
            'id' => $requestId,
            'method' => $request->method(),
            'path' => '/' . ltrim($request->path(), '/'),
            'ip' => $request->ip(),
            'query' => $request->query(),
        ];

        Log::channel('admin')->info('admin.request.start', $context);

        $response = $next($request);

        $durationMs = (int) ((microtime(true) - $requestTime) * 1000);
        $queries = DB::getQueryLog();
        $queryCount = count($queries);
        $queryTimeMs = array_reduce($queries, function ($sum, $q) {
            return $sum + (int) (($q['time'] ?? 0));
        }, 0);

        $response->headers->set('X-Admin-Request-Id', $requestId);
        $response->headers->set('X-Admin-Request-Time', (string) $durationMs);
        $response->headers->set('X-Admin-Query-Count', (string) $queryCount);
        $response->headers->set('X-Admin-Query-Time', (string) $queryTimeMs);

        Log::channel('admin')->info('admin.request.end', $context + [
            'status' => $response->getStatusCode(),
            'duration_ms' => $durationMs,
            'query_count' => $queryCount,
            'query_time_ms' => $queryTimeMs,
        ]);

        return $response;
    }
}
