<?php


namespace Xervice\Service\Controller;


use Xervice\DataProvider\DataProvider\AbstractDataProvider;

abstract class AbstractApiController extends AbstractController
{
    /**
     * @param \Xervice\DataProvider\DataProvider\AbstractDataProvider $dataProvider
     *
     * @return string
     */
    public function jsonResponse(AbstractDataProvider $dataProvider)
    {
        return json_encode($dataProvider->toArray());
    }
}