<?php
declare(strict_types=1);


namespace Xervice\Service\Middleware\Security\Authenticator;


use Illuminate\Http\Request;
use Xervice\Service\Middleware\Security\Exception\AuthenticationFailed;
use Xervice\Service\Middleware\Security\Validator\ValidatorCollection;

class BasicAuthAuthenticator implements AuthenticatorInterface
{
    const HEADER = 'authorization';

    /**
     * @var \Xervice\Service\Middleware\Security\Validator\ValidatorCollection
     */
    private $validatorCollection;

    /**
     * BasicAuthAuthenticator constructor.
     *
     * @param \Xervice\Service\Middleware\Security\Validator\ValidatorCollection $validatorCollection
     */
    public function __construct(ValidatorCollection $validatorCollection)
    {
        $this->validatorCollection = $validatorCollection;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public function isAuth(Request $request): bool
    {
        $basicAuth = $request->header(self::HEADER, '');
        $token = $this->getToken($basicAuth);

        try {
            foreach ($this->validatorCollection as $validator) {
                $validator->validate($token);
            }

            return true;
        } catch (AuthenticationFailed $e) {
            return false;
        }
    }


    /**
     * @param string $basicAuth
     *
     * @return string
     */
    private function getToken(string $basicAuth) : string
    {
        return base64_decode(str_replace('Basic ', '', $basicAuth));
    }

}