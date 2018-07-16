<?php
declare(strict_types=1);


namespace Xervice\Service\Application\Response;


use Illuminate\Http\JsonResponse;
use Xervice\DataProvider\DataProvider\AbstractDataProvider;

class ApiResponse extends JsonResponse
{
    /**
     * @param \Xervice\DataProvider\DataProvider\AbstractDataProvider $dataProvider
     *
     * @return \Xervice\Service\Application\Response\ApiResponse
     */
    public function setDataProvider(AbstractDataProvider $dataProvider)
    {
        $this->setData(
            [
                'class' => get_class($dataProvider),
                'data'  => $dataProvider->toArray()
            ]
        );
        if (method_exists($dataProvider, 'getStatus')) {
            $this->setStatusCode($dataProvider->getStatus());
        }

        return $this;
    }
}