<?php


namespace Xervice\Service;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Factory\AbstractFactory;
use Xervice\Service\Application\Application;
use Xervice\Service\Bootstrap\ApplicationBootstrap;
use Xervice\Service\Route\RouteProvider;
use Xervice\Service\Service\ServiceProvider;

/**
 * @method \Xervice\Service\ServiceConfig getConfig()
 */
class ServiceFactory extends AbstractFactory
{
    /**
     * @return \Xervice\Service\Application\Application
     */
    public function createApplication()
    {
        return new Application(
            $this->getExternalApplication(),
            $this->createApplicationBootstrap()
        );
    }

    /**
     * @return \Xervice\Service\Bootstrap\ApplicationBootstrap
     */
    public function createApplicationBootstrap()
    {
        return new ApplicationBootstrap(
            $this->createRouteProvider(),
            $this->createServiceProvider()
        );
    }

    /**
     * @return \Xervice\Service\Route\RouteProvider
     */
    public function createRouteProvider()
    {
        return new RouteProvider(
            $this->getRouteCollection()
        );
    }

    /**
     * @return \Xervice\Service\Service\ServiceProvider
     */
    public function createServiceProvider()
    {
        return new ServiceProvider(
            $this->getDependency(ServiceDependencyProvider::APP_SERVICE_PROVIDER)
        );
    }

    /**
     * @return \Xervice\Service\Route\RouterCollection
     */
    public function getRouteCollection()
    {
        return $this->getDependency(ServiceDependencyProvider::APP_ROUTE_COLLECTION);
    }

    /**
     * @return \Laravel\Lumen\Application
     */
    public function getExternalApplication()
    {
        return $this->getDependency(ServiceDependencyProvider::APPLICATION);
    }
}