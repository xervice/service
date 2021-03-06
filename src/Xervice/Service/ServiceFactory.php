<?php
declare(strict_types=1);


namespace Xervice\Service;


use Xervice\Core\Factory\AbstractFactory;
use Xervice\Service\Application\Application;
use Xervice\Service\Bootstrap\ApplicationBootstrap;
use Xervice\Service\Handler\HandlerProvider;
use Xervice\Service\Lumen\ExceptionHandler\XerviceExceptionHandler;
use Xervice\Service\Middleware\Security\Authenticator\BasicAuthAuthenticator;
use Xervice\Service\Middleware\Security\Response\SecurityUnauthorizedResponse;
use Xervice\Service\Route\RouteProvider;
use Xervice\Service\Service\ServiceProvider;

/**
 * @method \Xervice\Service\ServiceConfig getConfig()
 */
class ServiceFactory extends AbstractFactory
{
    /**
     * @return \Xervice\Service\Middleware\Security\Response\SecurityUnauthorizedResponseInterface
     */
    public function createSecurityUnauthorizedResponse()
    {
        return new SecurityUnauthorizedResponse();
    }

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
        return new ApplicationBootstrap(
            $this->createRouteProvider(),
            $this->createServiceProvider()
        );
    }

    /**
     * @return \Xervice\Service\Middleware\Security\Authenticator\BasicAuthAuthenticator
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function createAuthenticator()
    {
        return new BasicAuthAuthenticator(
            $this->getValidatorCollection()
        );
    }

    /**
     * @return \Xervice\Service\Middleware\Security\Validator\ValidatorCollection
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function getValidatorCollection()
    {
        return $this->getDependency(ServiceDependencyProvider::APP_SECURITY_VALIDATOR_COLLECTION);
    }

    /**
     * @return \Xervice\Service\Route\RouteProvider
     */
    public function createRouteProvider()
    {
        return new RouteProvider(
            $this->getRouteCollection()
        );
    }

    /**
     * @return \Xervice\Service\Service\ServiceProvider
     */
    public function createServiceProvider()
    {
        return new ServiceProvider(
            $this->getDependency(ServiceDependencyProvider::APP_SERVICE_PROVIDER)
        );
    }

    /**
     * @return \Xervice\Service\Lumen\ExceptionHandler\XerviceExceptionHandler
     */
    public function createXerviceExceptionHandler()
    {
        return new XerviceExceptionHandler();
    }

    /**
     * @return \Xervice\Service\Handler\HandlerProvider
     */
    public function createHandlerProvider()
    {
        return new HandlerProvider(
            $this->getHandlerCollection()
        );
    }

    /**
     * @return \Xervice\Service\Handler\HandlerCollection
     */
    public function getHandlerCollection()
    {
        return $this->getDependency(ServiceDependencyProvider::APP_HANDLER);
    }

    /**
     * @return \Xervice\Service\Route\RouterCollection
     */
    public function getRouteCollection()
    {
        return $this->getDependency(ServiceDependencyProvider::APP_ROUTE_COLLECTION);
    }

    /**
     * @return \Laravel\Lumen\Application
     */
    public function getExternalApplication()
    {
        return $this->getDependency(ServiceDependencyProvider::APPLICATION);
    }
}