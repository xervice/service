<?php


namespace Xervice\Service\Controller;


use Illuminate\Http\Request;
use Xervice\DataProvider\DataProvider\AbstractDataProvider;
use Xervice\Service\Application\Response\ApiResponse;
use Xervice\Service\Controller\Exception\ApiControllerException;

abstract class AbstractApiController extends AbstractController
{
    /**
     * @var \Xervice\DataProvider\DataProvider\AbstractDataProvider
     */
    private $dataProvider;

    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * @param \Illuminate\Http\Request $request
     * @param string $method
     *
     * @return \Xervice\Service\Application\Response\ApiResponse
     * @throws \Xervice\Service\Controller\Exception\ApiControllerException
     */
    public function apiAction(Request $request, string $method)
    {
        $this->request = $request;

        $jsonBody = $request->getContent();
        $data = json_decode($jsonBody, true);

        if (!$data || !isset($data['class']) || !isset($data['data'])) {
            throw new ApiControllerException('Request body is no valid json' . PHP_EOL . $jsonBody);
        }

        $class = $data['class'];
        $this->dataProvider = new $class();
        $this->dataProvider->fromArray($data['data']);

        $method .= 'Action';

        if (!method_exists($this, $method)) {
            throw new ApiControllerException('API method not found ' . $method);
        }

        return $this->$method($this->dataProvider);
    }

    /**
     * @param \Xervice\DataProvider\DataProvider\AbstractDataProvider $dataProvider
     * @param int $statusCode
     *
     * @return \Xervice\Service\Application\Response\ApiResponse
     */
    public function jsonResponse(AbstractDataProvider $dataProvider, int $statusCode = 200): ApiResponse
    {
        $response = new ApiResponse();
        $response->setStatusCode($statusCode);
        $response->setDataProvider($dataProvider);
        return $response;
    }
}