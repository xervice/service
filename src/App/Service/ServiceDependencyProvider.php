<?php


namespace App\Service;


use App\Api\Route\ApiRouteProvider;
use Xervice\Service\Service\Provider\ApiSecurityProvider;
use Xervice\Service\ServiceDependencyProvider as XerviceServiceDependencyProvider;

class ServiceDependencyProvider extends XerviceServiceDependencyProvider
{
    /**
     * @return \Xervice\Service\Route\RouteInterface[]
     */
    protected function getRouteProvider()
    {
        return [
            new ApiRouteProvider()
        ];
    }

    /**
     * @return \Xervice\Service\Service\ServiceProviderInterface[]
     */
    protected function getApplicationServiceProvider()
    {
        return [
            new ApiSecurityProvider()
        ];
    }

}