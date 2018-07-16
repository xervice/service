<?php
declare(strict_types=1);


namespace Xervice\Service\Route;


use Laravel\Lumen\Application;
use Xervice\Service\Route\RouterCollection;

class RouteProvider implements RouteProviderInterface
{
    /**
     * @var \Xervice\Service\Route\RouterCollection
     */
    private $routeCollection;

    /**
     * RouteProvider constructor.
     *
     * @param \Xervice\Service\Route\RouterCollection $routeCollection
     */
    public function __construct(RouterCollection $routeCollection)
    {
        $this->routeCollection = $routeCollection;
    }

    /**
     * @param \Laravel\Lumen\Application $app
     */
    public function register(Application $app)
    {
        foreach ($this->routeCollection as $route) {
            $route->register($app->router);
        }
    }

}