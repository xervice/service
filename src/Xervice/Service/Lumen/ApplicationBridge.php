<?php


namespace Xervice\Service\Lumen;


use Laravel\Lumen\Application;
use Xervice\Core\Locator\Dynamic\DynamicLocator;
use Xervice\Service\Lumen\ExceptionHandler\XerviceExceptionHandler;

class ApplicationBridge extends Application
{
    use DynamicLocator;

    /**
     * @return mixed
     */
    protected function resolveExceptionHandler()
    {
        return $this->getFactory()->createXerviceExceptionHandler();
    }

}