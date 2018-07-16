<?php
declare(strict_types=1);


namespace Xervice\Service\Lumen\ExceptionHandler;


use DataProvider\ApiExceptionDataProvider;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Lumen\Exceptions\Handler;
use Xervice\Core\Exception\XerviceException;
use Xervice\Core\Locator\Dynamic\DynamicLocator;


class XerviceExceptionHandler extends Handler
{
    use DynamicLocator;

    protected $dontReport = [
        XerviceException::class
    ];

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Exception $e
     *
     * @return \Illuminate\Http\Response
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function render($request, Exception $e): Response
    {
        $dataProvider = new ApiExceptionDataProvider();
        $dataProvider->setStatus($e->getCode())
            ->setException(get_class($e))
            ->setMessage($e->getMessage());

        if ($this->getFacade()->isDebug()) {
            $dataProvider->setTrace($e->getTraceAsString());
        }

        $response = new JsonResponse();
        if (method_exists($e, 'getStatusCode')) {
            $response->setStatusCode($e->getStatusCode());
        } else {
            $response->setStatusCode(500);
        }

        $response->setData($dataProvider->toArray());

        return $response;
    }


}