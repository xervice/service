<?php


namespace Xervice\Service\Handler;


interface HandlerInterface
{
    /**
     * @param bool $isDebug
     */
    public function handle(bool $isDebug) : void;
}