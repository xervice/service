<?php


namespace Xervice\Service;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;
use Xervice\Service\Handler\Handler\DebugHandler;
use Xervice\Service\Handler\Handler\ErrorHandler;
use Xervice\Service\Handler\Handler\ExceptionHandler;
use Xervice\Service\Handler\HandlerCollection;
use Xervice\Service\Lumen\ApplicationBridge;
use Xervice\Service\Middleware\Security\Validator\ValidatorCollection;
use Xervice\Service\Route\RouterCollection;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class ServiceDependencyProvider extends AbstractProvider
{
    const APPLICATION = 'application';

    const APP_SERVICE_PROVIDER = 'app.service.provider';

    const APP_ROUTE_COLLECTION = 'app.route.collection';

    const APP_HANDLER = 'app.handler';

    const APP_SECURITY_VALIDATOR_COLLECTION = 'app.security.validator.collection';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    public function handleDependencies(DependencyProviderInterface $container)
    {
        $this->setApplication($container);
        $this->setApplicationServiceProvider($container);
        $this->setRouteCollection($container);
        $this->setSecurityValidatorCollection($container);
        $this->setHandlerCollection($container);
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     *
     * @return \Xervice\Service\Middleware\Security\Validator\ValidatorInterface[]
     */
    protected function getBasicAuthValidator(DependencyProviderInterface $container)
    {
        return [];
    }

    /**
     * @return \Xervice\Service\Handler\HandlerInterface[]
     */
    protected function getHandler()
    {
        return [
            new ErrorHandler(),
            new ExceptionHandler(),
            new DebugHandler()
        ];
    }

    /**
     * @return \Xervice\Service\Route\RouteInterface[]
     */
    protected function getRouteProvider()
    {
        return [];
    }

    /**
     * @return \Xervice\Service\Service\ServiceProviderInterface[]
     */
    protected function getApplicationServiceProvider()
    {
        return [];
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    private function setApplication(DependencyProviderInterface $container): void
    {
        $container[self::APPLICATION] = function (DependencyProviderInterface $container) {
            return new ApplicationBridge();
        };
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    private function setApplicationServiceProvider(DependencyProviderInterface $container): void
    {
        $container[self::APP_SERVICE_PROVIDER] = function (DependencyProviderInterface $container) {
            return $this->getApplicationServiceProvider();
        };
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    private function setRouteCollection(DependencyProviderInterface $container): void
    {
        $container[self::APP_ROUTE_COLLECTION] = function (DependencyProviderInterface $container) {
            return new RouterCollection(
                $this->getRouteProvider()
            );
        };
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     *
     * @return \Xervice\Core\Dependency\DependencyProviderInterface
     */
    private function setSecurityValidatorCollection(DependencyProviderInterface $container)
    {
        $container[self::APP_SECURITY_VALIDATOR_COLLECTION] = function (DependencyProviderInterface $container) {
            return new ValidatorCollection(
                $this->getBasicAuthValidator($container)
            );
        };
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $container
     */
    private function setHandlerCollection(DependencyProviderInterface $container): void
    {
        $container[self::APP_HANDLER] = function (DependencyProviderInterface $container) {
            return new HandlerCollection(
                $this->getHandler()
            );
        };
    }
}