<?php


namespace Xervice\Service\Controller;


use Illuminate\Http\Request;
use Xervice\DataProvider\DataProvider\AbstractDataProvider;
use Xervice\Service\Application\Response\ApiResponse;

abstract class AbstractApiController extends AbstractController
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var \Xervice\DataProvider\DataProvider\AbstractDataProvider
     */
    private $dataProvider;

    /**
     * AbstractApiController constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $jsonBody = $this->request->getContent();
        $data = json_decode($jsonBody, true);

        if ($data && isset($data['class']) && isset($data['data'])) {
            $class = $data['class'];
            $this->dataProvider = new $class();
            $this->dataProvider->fromArray($data['data']);
        }

        $method = str_replace('Action', '', $name);

        $this->$method($this->dataProvider);
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

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