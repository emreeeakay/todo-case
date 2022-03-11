<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UrlControl {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        if (!strstr($request->getUri(), 'http://127.0.0.1')) {
            return response(json_encode(['status' => 'yetkisiz kullanım”']), 403);
        }
        return $next($request);
        return $next($request);
    }
}
