<?php

namespace Bantenprov\User\Http\Middleware;

use Closure;

/**
 * The UserMiddleware class.
 *
 * @package Bantenprov\User
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class UserMiddleware
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
        return $next($request);
    }
}
