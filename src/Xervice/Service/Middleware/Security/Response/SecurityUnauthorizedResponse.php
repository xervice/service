<?php


namespace Xervice\Service\Middleware\Security\Response;


use DataProvider\ApiAuthenticationFailedDataProvider;
use Illuminate\Http\Request;
use Xervice\Service\Application\Response\ApiResponse;

class SecurityUnauthorizedResponse extends ApiResponse implements SecurityUnauthorizedResponseInterface
{
    const STATUS_CODE = 403;

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function setSecurityResponse(Request $request)
    {
        $message = new ApiAuthenticationFailedDataProvider();
        $message->setStatus(self::STATUS_CODE);
        $message->setMessage('Authentication failed');

        $this->setStatusCode(self::STATUS_CODE);

        $this->setDataProvider($message);
    }

}