<?php

use Xervice\DataProvider\DataProviderConfig;

$config[DataProviderConfig::DATA_PROVIDER_PATHS] = [
    __DIR__ . '/../src/*/*/schema'
];

$config[DataProviderConfig::DATA_PROVIDER_GENERATED_PATH] = __DIR__ . '/../src/Generated';