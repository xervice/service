<?php


namespace Xervice\Service;


use Laravel\Lumen\Application;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class ServiceDependencyProvider extends AbstractProvider
{
    const APPLICATION = 'application';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container)
    {
        $this->setApplication($container);
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    protected function setApplication(DependencyProviderInterface $container): void
    {
        $container[self::APPLICATION] = function (DependencyProviderInterface $container) {
            return new Application();
        };
    }
}