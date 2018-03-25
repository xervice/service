<?php


namespace Xervice\Service\Middleware\Security;


use Closure;
use DataProvider\ApiAuthenticationFailedDataProvider;
use Illuminate\Http\Request;
use Xervice\Service\Application\Response\ApiResponse;
use Xervice\Service\Middleware\AbstractMiddleware;

/**
 * @method \Xervice\Service\ServiceFactory getFactory()
 */
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
        $authenticator = $this->getFactory()->createAuthenticator();
        if (!$authenticator->isAuth($request)) {
            $response = new ApiResponse();

            $message = new ApiAuthenticationFailedDataProvider();
            $message->setStatus(403);
            $message->setMessage('Authentication failed');

            return $response->setDataProvider($message);
        }

        return $next($request);
    }

}