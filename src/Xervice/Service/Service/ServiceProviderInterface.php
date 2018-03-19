<?php


namespace Xervice\Service\Service;


use Laravel\Lumen\Application;

interface ServiceProviderInterface
{
    /**
     * @param \Laravel\Lumen\Application $app
     */
    public function register(Application $app);
}