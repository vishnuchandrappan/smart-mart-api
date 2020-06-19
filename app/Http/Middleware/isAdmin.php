<?php

namespace App\Http\Middleware;

use App\Http\Responses\ErrorResponse;
use Closure;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth("api")->user()->user_type != '1') {
            return new ErrorResponse('Unauthorized', 401);
        }
        return $next($request);
    }
}
