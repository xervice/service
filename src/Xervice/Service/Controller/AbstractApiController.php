<?php


namespace Xervice\Service\Controller;


use Xervice\DataProvider\DataProvider\AbstractDataProvider;
use Xervice\Service\Application\Response\ApiResponse;

abstract class AbstractApiController extends AbstractController
{
    /**
     * @param \Xervice\DataProvider\DataProvider\AbstractDataProvider $dataProvider
     *
     * @return string
     */
    public function jsonResponse(AbstractDataProvider $dataProvider)
    {
        $response = new ApiResponse();
        $response->setDataProvider($dataProvider);
        return $response;
    }
}