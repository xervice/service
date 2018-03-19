<?php


namespace Xervice\Service\Route;


use Laravel\Lumen\Application;

interface RouteProviderInterface
{
    /**
     * @param \Laravel\Lumen\Application $app
     */
    public function register(Application $app);
}