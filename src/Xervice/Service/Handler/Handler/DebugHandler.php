<?php


namespace Xervice\Service\Handler\Handler;


use Symfony\Component\Debug\Debug;
use Xervice\Service\Handler\HandlerInterface;

class DebugHandler implements HandlerInterface
{
    /**
     * @param bool $isDebug
     */
    public function handle(bool $isDebug): void
    {
        if ($isDebug) {
            putenv("APP_DEBUG=true");
            Debug::enable();
        }
    }

}