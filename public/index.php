<?php

use Xervice\Core\Locator\Locator;

require __DIR__ . '/../vendor/autoload.php';

$locator = Locator::getInstance();
$locator->service()->facade()->startApplication();