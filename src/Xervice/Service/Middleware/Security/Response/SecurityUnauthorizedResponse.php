<?php


namespace Xervice\Service\Middleware\Security\Response;


use DataProvider\ApiAuthenticationFailedDataProvider;
use Illuminate\Http\Request;
use Xervice\Service\Application\Response\ApiResponse;

class SecurityUnauthorizedResponse extends ApiResponse implements SecurityUnauthorizedResponseInterface
{
    /**
     * @param \Illuminate\Http\Request $request
     */
    public function setSecurityResponse(Request $request)
    {
        $message = new ApiAuthenticationFailedDataProvider();
        $message->setStatus($this->getStatusCode());
        $message->setMessage('Authentication failed');

        $this->setDataProvider($message);
    }

}