<?php
declare(strict_types=1);


namespace Xervice\Service\Middleware\Security\Response;


use DataProvider\ApiAuthenticationFailedDataProvider;
use Illuminate\Http\Request;
use Xervice\Service\Application\Response\ApiResponse;

class SecurityUnauthorizedResponse extends ApiResponse implements SecurityUnauthorizedResponseInterface
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function setSecurityResponse(Request $request): void
    {
        $message = new ApiAuthenticationFailedDataProvider();
        $message->setStatus(401);
        $message->setMessage('Unauthorized');

        $this->setDataProvider($message);
    }

}