<?php
namespace XerviceTest\Service;

use Xervice\Config\XerviceConfig;
use Xervice\Core\Locator\Locator;
use Xervice\Service\ServiceConfig;

class FacadeTest extends \Codeception\Test\Unit
{
    /**
     * @var \Xervice\Service\ServiceFacade
     */
    protected $facade;
    
    protected function _before()
    {
        $this->facade = Locator::getInstance()->service()->facade();
    }

    protected function _after()
    {
    }

    /**
     * @group Xervice
     * @group Service
     * @group Facade
     * @group Integration
     */
    public function testIsDebug()
    {
        XerviceConfig::getInstance()->getConfig()->set(ServiceConfig::DEBUG_ACTIVE, true);
        $this->assertTrue($this->facade->isDebug());

        XerviceConfig::getInstance()->getConfig()->set(ServiceConfig::DEBUG_ACTIVE, false);
        $this->assertFalse($this->facade->isDebug());
    }
}