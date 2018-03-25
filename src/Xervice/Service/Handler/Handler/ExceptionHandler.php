<?php


namespace Xervice\Service\Handler\Handler;


use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use Xervice\Service\Handler\HandlerInterface;

class ExceptionHandler implements HandlerInterface
{
    /**
     * @param bool $isDebug
     */
    public function handle(bool $isDebug): void
    {
        SymfonyExceptionHandler::register($isDebug);
    }


}