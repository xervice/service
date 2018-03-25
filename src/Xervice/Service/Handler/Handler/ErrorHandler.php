<?php


namespace Xervice\Service\Handler\Handler;


use Symfony\Component\Debug\ErrorHandler as SymfonyErrorHandler;
use Xervice\Service\Handler\HandlerInterface;

class ErrorHandler implements HandlerInterface
{
    /**
     * @param bool $isDebug
     */
    public function handle(bool $isDebug): void
    {
        SymfonyErrorHandler::register();
    }

}