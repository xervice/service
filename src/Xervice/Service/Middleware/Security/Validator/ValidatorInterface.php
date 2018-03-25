<?php


namespace Xervice\Service\Middleware\Security\Validator;


interface ValidatorInterface
{
    /**
     * @param string $token
     *
     * @throws \Xervice\Service\Middleware\Security\Exception\AuthenticationFailed
     */
    public function validate(string $token) : void;
}