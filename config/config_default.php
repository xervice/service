<?php

use Xervice\DataProvider\DataProviderConfig;
use Xervice\Service\ServiceConfig;

$config[DataProviderConfig::DATA_PROVIDER_PATHS] = [
    __DIR__ . '/../src/*/*/schema'
];

$config[DataProviderConfig::DATA_PROVIDER_GENERATED_PATH] = __DIR__ . '/../src/Generated';


if (class_exists(ServiceConfig::class)) {
    $config[ServiceConfig::DEBUG_ACTIVE] = true;

    $config[ServiceConfig::STATIC_API_TOKEN_LIST] = [
        'test:test123'
    ];
}