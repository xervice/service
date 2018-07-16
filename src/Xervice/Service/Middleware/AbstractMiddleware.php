<?php
declare(strict_types=1);


namespace Xervice\Service\Middleware;


use Closure;
use Illuminate\Http\Request;
use Xervice\Core\Locator\AbstractWithLocator;
use Xervice\Core\Locator\Dynamic\DynamicLocator;

abstract class AbstractMiddleware extends AbstractWithLocator
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    abstract public function handle(Request $request, Closure $next);
}