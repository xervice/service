<?php


namespace Xervice\Service\Handler;


class HandlerProvider
{
    /**
     * @var \Xervice\Service\Handler\HandlerCollection
     */
    private $handlerCollection;

    /**
     * HandlerProvider constructor.
     *
     * @param \Xervice\Service\Handler\HandlerCollection $handlerCollection
     */
    public function __construct(HandlerCollection $handlerCollection)
    {
        $this->handlerCollection = $handlerCollection;
    }

    public function handle(bool $isDebug)
    {
        foreach ($this->handlerCollection as $handler) {
            $handler->handle($isDebug);
        }
    }
}