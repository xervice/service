<?php


namespace Xervice\Service\Middleware\Security;


use Closure;
use Illuminate\Http\Request;
use Xervice\Service\Middleware\AbstractMiddleware;

class Authentication extends AbstractMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $basicAuth = $request->header('Authorization');
    }

}