<?php
declare(strict_types=1);


namespace Xervice\Service\Middleware\Security\Validator;



class ValidatorCollection implements \Iterator, \Countable
{
    /**
     * @var \Xervice\Service\Middleware\Security\Validator\ValidatorInterface[]
     */
    private $collection;

    /**
     * @var int
     */
    private $position;

    /**
     * Collection constructor.
     *
     * @param \Xervice\Service\Middleware\Security\Validator\ValidatorInterface[] $collection
     */
    public function __construct(array $collection)
    {
        foreach ($collection as $validator) {
            $this->add($validator);
        }
    }

    /**
     * @param \Xervice\Service\Middleware\Security\Validator\ValidatorInterface $validator
     */
    public function add(ValidatorInterface $validator)
    {
        $this->collection[] = $validator;
    }

    /**
     * @return \Xervice\Service\Middleware\Security\Validator\ValidatorInterface
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