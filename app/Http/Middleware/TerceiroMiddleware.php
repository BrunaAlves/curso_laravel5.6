<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class TerceiroMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $nome, $idade)
    {
        Log::debug("Passando pelo TerceiroMiddleware [nome = $nome, $idade]");
        return $next($request);
    }
}
