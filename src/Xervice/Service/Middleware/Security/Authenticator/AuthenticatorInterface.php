<?php
declare(strict_types=1);


namespace Xervice\Service\Middleware\Security\Authenticator;


use Illuminate\Http\Request;

interface AuthenticatorInterface
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public function isAuth(Request $request) : bool;
}