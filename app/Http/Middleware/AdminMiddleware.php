<?php
namespace App\Http\Middleware;
use Closure;
use http\Exception;
use Illuminate\Auth\Middleware\Authenticate as Middleware;


use Illuminate\Http\Request;
class AdminMiddleware extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {

        try {
            $role = auth()->user()->role;
            if ($role != 'admin'){
                abort(403);
            }
        } catch (\Throwable $th)     {
            abort(403);
        }

        return $next($request);
    }
}
