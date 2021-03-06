<?php
declare(strict_types=1);

namespace Xervice\Service\Middleware\Security\Response;

use Illuminate\Http\Request;

interface SecurityUnauthorizedResponseInterface
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function setSecurityResponse(Request $request);
}