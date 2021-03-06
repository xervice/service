<?php
declare(strict_types=1);


namespace Xervice\Service\Bootstrap;


use Laravel\Lumen\Application;
use Xervice\Service\Route\RouteProviderInterface;
use Xervice\Service\Service\ServiceProviderInterface;

class ApplicationBootstrap implements ApplicationBootstrapInterface
{
    /**
     * @var \Xervice\Service\Route\RouteProviderInterface
     */
    private $routeProvider;

    /**
     * @var \Xervice\Service\Service\ServiceProviderInterface
     */
    private $serviceProvider;

    /**
     * ApplicationBootstrap constructor.
     *
     * @param \Xervice\Service\Route\RouteProviderInterface $routeProvider
     * @param \Xervice\Service\Service\ServiceProviderInterface $serviceProvider
     */
    public function __construct(
        RouteProviderInterface $routeProvider,
        ServiceProviderInterface $serviceProvider
    ) {
        $this->routeProvider = $routeProvider;
        $this->serviceProvider = $serviceProvider;
    }

    /**
     * @param \Laravel\Lumen\Application $app
     */
    public function boot(Application $app): void
    {
        $this->serviceProvider->register($app);
        $this->routeProvider->register($app);
    }

}