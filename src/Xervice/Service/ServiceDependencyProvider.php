<?php
declare(strict_types=1);


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
    public const APPLICATION = 'application';

    public const APP_SERVICE_PROVIDER = 'app.service.provider';

    public const APP_ROUTE_COLLECTION = 'app.route.collection';

    public const APP_HANDLER = 'app.handler';

    public const APP_SECURITY_VALIDATOR_COLLECTION = 'app.security.validator.collection';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $this->setApplication($dependencyProvider);
        $this->setApplicationServiceProvider($dependencyProvider);
        $this->setRouteCollection($dependencyProvider);
        $this->setSecurityValidatorCollection($dependencyProvider);
        $this->setHandlerCollection($dependencyProvider);
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     *
     * @return \Xervice\Service\Middleware\Security\Validator\ValidatorInterface[]
     */
    protected function getBasicAuthValidator(DependencyProviderInterface $dependencyProvider)
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
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    private function setApplication(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::APPLICATION] = function (DependencyProviderInterface $dependencyProvider) {
            return new ApplicationBridge();
        };
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    private function setApplicationServiceProvider(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::APP_SERVICE_PROVIDER] = function (DependencyProviderInterface $dependencyProvider) {
            return $this->getApplicationServiceProvider();
        };
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    private function setRouteCollection(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::APP_ROUTE_COLLECTION] = function (DependencyProviderInterface $dependencyProvider) {
            return new RouterCollection(
                $this->getRouteProvider()
            );
        };
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     *
     * @return \Xervice\Core\Dependency\DependencyProviderInterface
     */
    private function setSecurityValidatorCollection(DependencyProviderInterface $dependencyProvider)
    {
        $dependencyProvider[self::APP_SECURITY_VALIDATOR_COLLECTION] = function (DependencyProviderInterface $dependencyProvider) {
            return new ValidatorCollection(
                $this->getBasicAuthValidator($dependencyProvider)
            );
        };
    }

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    private function setHandlerCollection(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::APP_HANDLER] = function (DependencyProviderInterface $dependencyProvider) {
            return new HandlerCollection(
                $this->getHandler()
            );
        };
    }
}