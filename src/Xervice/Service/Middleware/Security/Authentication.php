<?php
declare(strict_types=1);


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
     * @return mixed|\Xervice\Service\Middleware\Security\Response\SecurityUnauthorizedResponse
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function handle(Request $request, Closure $next)
    {
        $authenticator = $this->getFactory()->createAuthenticator();
        if (!$authenticator->isAuth($request)) {
            $response = $this->getFactory()->createSecurityUnauthorizedResponse();
            $response->setSecurityResponse($request);

            return response()->json(
                $response->getData(),
                401
            );
        }

        return $next($request);
    }

}