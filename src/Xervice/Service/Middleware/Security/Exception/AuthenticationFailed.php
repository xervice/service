<?php


namespace Xervice\Service\Middleware\Security\Exception;


use Throwable;
use Xervice\Core\Exception\XerviceException;

class AuthenticationFailed extends XerviceException
{
    /**
     * AuthenticationFailed constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable $previous
     */
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        if ($message == '') {
            $message = 'Authentication failed';
        }
        parent::__construct($message, $code, $previous);
    }

}