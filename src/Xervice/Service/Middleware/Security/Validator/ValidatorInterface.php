<?php


namespace Xervice\Service\Middleware\Security\Validator;


interface ValidatorInterface
{
    /**
     * @param string $token
     */
    public function validate(string $token) : void;
}