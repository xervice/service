<?php


namespace Xervice\Service\Controller;


use Laravel\Lumen\Routing\Controller;
use Xervice\Core\Locator\Dynamic\DynamicLocator;


abstract class AbstractController extends Controller
{
    use DynamicLocator;
}