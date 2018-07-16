<?php
declare(strict_types=1);


namespace Xervice\Service\Lumen;


use Laravel\Lumen\Application;
use Xervice\Core\Factory\FactoryInterface;
use Xervice\Core\Locator\Dynamic\DynamicLocator;
use Xervice\Service\Lumen\ExceptionHandler\XerviceExceptionHandler;

/**
 * @method \Xervice\Service\ServiceFactory getFactory()
 */
class ApplicationBridge extends Application
{
    use DynamicLocator;

    /**
     * @return mixed
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    protected function resolveExceptionHandler()
    {
        return $this->getFactory()->createXerviceExceptionHandler();
    }

}