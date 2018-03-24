<?php


namespace Xervice\Service\Service;


use Illuminate\Support\ServiceProvider as LumenServiceProvider;
use Laravel\Lumen\Application;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @var ServiceProviderInterface[]
     */
    private $serviceProvider;

    /**
     * ServiceProvider constructor.
     *
     * @param ServiceProviderInterface[] $serviceProvider
     */
    public function __construct(array $serviceProvider)
    {
        $this->serviceProvider = $serviceProvider;
    }

    /**
     * @param \Laravel\Lumen\Application $app
     */
    public function register(Application $app)
    {
        foreach ($this->serviceProvider as $serviceProvider) {
            $serviceProvider->register($app);
        }
    }

}