<?php


namespace Xervice\Service;


use Laravel\Lumen\Application;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;
use Xervice\Service\Route\RouterCollection;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class ServiceDependencyProvider extends AbstractProvider
{
    const APPLICATION = 'application';

    const APP_SERVICE_PROVIDER = 'app.service.provider';

    const APP_ROUTE_COLLECTION = 'app.route.collection';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container)
    {
        $this->setApplication($container);
        $this->setApplicationServiceProvider($container);
        $this->setRouteCollection($container);
    }

    /**
     * @return \Xervice\Service\Route\RouteInterface[]
     */
    protected function getRouteProvider()
    {
        return [];
    }

    /**
     * @return \Illuminate\Support\ServiceProvider[]
     */
    protected function getApplicationServiceProvider()
    {
        return [];
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    private function setApplication(DependencyProviderInterface $container): void
    {
        $container[self::APPLICATION] = function (DependencyProviderInterface $container) {
            return new Application();
        };
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    private function setApplicationServiceProvider(DependencyProviderInterface $container): void
    {
        $container[self::APP_SERVICE_PROVIDER] = function (DependencyProviderInterface $container) {
            return $this->getApplicationServiceProvider();
        };
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    private function setRouteCollection(DependencyProviderInterface $container): void
    {
        $container[self::APP_ROUTE_COLLECTION] = function (DependencyProviderInterface $container) {
            return new RouterCollection(
                $this->getRouteProvider()
            );
        };
    }
}