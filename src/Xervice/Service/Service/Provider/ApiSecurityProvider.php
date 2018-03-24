<?php


namespace Xervice\Service\Service\Provider;


use Laravel\Lumen\Application;
use Xervice\Service\Middleware\Security\Authentication;
use Xervice\Service\Service\AbstractServiceProvider;
use Xervice\Service\Service\ServiceProviderInterface;

class ApiSecurityProvider implements ServiceProviderInterface
{
    /**
     * @param \Laravel\Lumen\Application $app
     *
     * @return mixed
     */
    public function register(Application $app)
    {
        $app->middleware(Authentication::class);
    }

}