<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Xervice\Core\Locator\Locator;

require __DIR__ . '/../vendor/autoload.php';

putenv("APPLICATION_PATH=".dirname(__DIR__));

$locator = Locator::getInstance();
$locator->service()->facade()->registerHandler();
$locator->service()->facade()->startApplication();
