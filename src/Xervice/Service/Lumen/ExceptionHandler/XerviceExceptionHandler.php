<?php


namespace Xervice\Service\Lumen\ExceptionHandler;


use DataProvider\ApiExceptionDataProvider;
use Exception;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Exceptions\Handler;
use Xervice\Core\Exception\XerviceException;


class XerviceExceptionHandler extends Handler
{
    protected $dontReport = [
        XerviceException::class
    ];

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $dataProvider = new ApiExceptionDataProvider();
        $dataProvider->setStatus(500)
            ->setException(get_class($e))
            ->setMessage($e->getMessage());

        $response = new JsonResponse();
        $response->setData($dataProvider->toArray());
        $response->send();
    }


}