<?php


namespace Xervice\Service\Middleware\Security\Validator;


use Xervice\Service\Middleware\Security\Exception\AuthenticationFailed;

class StaticValidator implements ValidatorInterface
{
    /**
     * @var array
     */
    private $tokenList;

    /**
     * StaticTokenValidator constructor.
     *
     * @param array $tokenList
     */
    public function __construct(array $tokenList)
    {
        $this->tokenList = $tokenList;
    }

    /**
     * @param string $token
     *
     * @throws \Xervice\Service\Middleware\Security\Exception\AuthenticationFailed
     */
    public function validate(string $token): void
    {
        if (!in_array($token, $this->tokenList)) {
            throw new AuthenticationFailed();
        }
    }
}