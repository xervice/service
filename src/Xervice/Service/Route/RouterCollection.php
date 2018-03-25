<?php


namespace Xervice\Service\Route;


class RouterCollection implements \Iterator, \Countable
{
    /**
     * @var \Xervice\Service\Route\RouteInterface[]
     */
    private $collection;

    /**
     * @var int
     */
    private $position;

    /**
     * RouterCollection constructor.
     *
     * @param \Xervice\Service\Route\RouteInterface[] $collection
     */
    public function __construct(array $collection)
    {
        foreach ($collection as $route) {
            $this->add($route);
        }
    }

    /**
     * @param \Xervice\Service\Route\RouteInterface $route
     */
    public function add(RouteInterface $route)
    {
        $this->collection[] = $route;
    }

    /**
     * @return \Xervice\Service\Route\RouteInterface
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