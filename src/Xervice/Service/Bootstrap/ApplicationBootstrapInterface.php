<?php


namespace Xervice\Service\Bootstrap;


use Laravel\Lumen\Application;

interface ApplicationBootstrapInterface
{
    /**
     * @param \Laravel\Lumen\Application $app
     */
    public function boot(Application $app) : void;
}