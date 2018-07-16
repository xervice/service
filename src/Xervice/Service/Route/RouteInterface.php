<?php
declare(strict_types=1);


namespace Xervice\Service\Route;


use Laravel\Lumen\Routing\Router;

interface RouteInterface
{
    /**
     * @param \Laravel\Lumen\Routing\Router $router
     */
    public function register(Router $router);
}