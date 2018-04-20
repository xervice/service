<?php


namespace Xervice\Service\Lumen;


use Laravel\Lumen\Application;

class ApplicationBridge extends Application
{
    /**
     * Overwrite default error handler from laravel
     */
    protected function registerErrorHandling()
    {

    }
}