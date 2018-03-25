<?php


namespace App\Api\Route;


use App\Api\Controller\IndexController;
use Laravel\Lumen\Routing\Router;
use Xervice\Service\Route\RouteInterface;

class ApiRouteProvider implements RouteInterface
{
    /**
     * @param \Laravel\Lumen\Routing\Router $router
     *
     * @return mixed
     */
    public function register(Router $router)
    {
        $router->get('/', IndexController::class . '@IndexAction');
    }
}