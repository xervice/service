<?php


namespace Xervice\Service\Handler;


use Xervice\Service\Handler\HandlerInterface;

class HandlerCollection implements \Iterator, \Countable
{
    /**
     * @var \Xervice\Service\Handler\HandlerInterface[]
     */
    private $collection;

    /**
     * @var int
     */
    private $position;

    /**
     * Collection constructor.
     *
     * @param \Xervice\Service\Handler\HandlerInterface[] $collection
     */
    public function __construct(array $collection)
    {
        foreach ($collection as $handler) {
            $this->add($handler);
        }
    }

    /**
     * @param \Xervice\Service\Handler\HandlerInterface $handler
     */
    public function add(HandlerInterface $handler)
    {
        $this->collection[] = $handler;
    }

    /**
     * @return \Xervice\Service\Handler\HandlerInterface
     */
    public function current()
    {
        return $this->collection[$this->position];
    }

    public function next()
    {
        $this->position++;
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->collection[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return int
     */
    public function count()
    {
        return \count($this->collection);
    }
}