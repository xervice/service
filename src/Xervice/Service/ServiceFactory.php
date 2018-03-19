<?php


namespace Xervice\Service;


use Xervice\Core\Factory\AbstractFactory;
use Xervice\Service\Application\Application;
use Xervice\Service\Bootstrap\ApplicationBootstrap;

/**
 * @method \Xervice\Service\ServiceConfig getConfig()
 */
class ServiceFactory extends AbstractFactory
{
    /**
     * @return \Xervice\Service\Application\Application
     */
    public function createApplication()
    {
        return new Application(
            $this->getExternalApplication(),
            $this->createApplicationBootstrap()
        );
    }

    /**
     * @return \Xervice\Service\Bootstrap\ApplicationBootstrap
     */
    public function createApplicationBootstrap()
    {
        return new ApplicationBootstrap();
    }

    /**
     * @return \Laravel\Lumen\Application
     */
    public function getExternalApplication()
    {
        return $this->getDependency(ServiceDependencyProvider::APPLICATION);
    }
}