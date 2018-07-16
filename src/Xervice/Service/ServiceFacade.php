<?php
declare(strict_types=1);


namespace Xervice\Service;


use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \Xervice\Service\ServiceFactory getFactory()
 * @method \Xervice\Service\ServiceConfig getConfig()
 */
class ServiceFacade extends AbstractFacade
{
    /**
     * Boot and run the application
     *
     * @api
     */
    public function startApplication()
    {
        $this->getFactory()->createApplication()
             ->boot()
             ->run();
    }

    /**
     */
    public function registerHandler()
    {
        $this->getFactory()->createHandlerProvider()->handle(
            $this->getConfig()->isDebug()
        );
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        return $this->getConfig()->isDebug();
    }
}