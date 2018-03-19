<?php


namespace Xervice\Service\Application;


use Laravel\Lumen\Application as LumenApplication;
use Xervice\Service\Bootstrap\ApplicationBootstrapInterface;

class Application
{
    /**
     * @var \Laravel\Lumen\Application
     */
    private $app;

    /**
     * @var \Xervice\Service\Bootstrap\ApplicationBootstrapInterface
     */
    private $bootstrap;

    /**
     * Application constructor.
     *
     * @param \Laravel\Lumen\Application $app
     * @param \Xervice\Service\Bootstrap\ApplicationBootstrapInterface $bootstrap
     */
    public function __construct(
        LumenApplication $app,
        ApplicationBootstrapInterface $bootstrap
    ) {
        $this->app = $app;
        $this->bootstrap = $bootstrap;
    }

    /**
     * @return \Xervice\Service\Application\Application
     */
    public function boot() : Application
    {
        $this->bootstrap->boot($this->app);

        return $this;
    }

    public function run() : void
    {
        $this->app->run();
    }
}