<?php


namespace Xervice\Service\Middleware\Security\Authenticator;


use Illuminate\Http\Request;

class BasicAuthAuthenticator implements AuthenticatorInterface
{
    const HEADER = 'Authorization';

    /**
     * @var \Xervice\Service\Middleware\Security\Validator\ValidatorCollection
     */
    private $validatorCollection;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public function isAuth(Request $request): bool
    {
        $basicAuth = $request->header(self::HEADER);
        $token = $this->getToken($basicAuth);


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