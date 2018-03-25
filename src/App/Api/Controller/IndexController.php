<?php


namespace App\Api\Controller;


use DataProvider\ApiResponseDataProvider;
use Illuminate\Http\Request;
use Xervice\Service\Controller\AbstractApiController;

class IndexController extends AbstractApiController
{

    public function indexAction(Request $request)
    {
        $message = new ApiResponseDataProvider();
        $message->setStatus(200);
        $message->setType('Test');
        return $this->jsonResponse($message);
    }
}