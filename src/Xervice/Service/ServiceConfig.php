<?php
declare(strict_types=1);


namespace Xervice\Service;


use Xervice\Core\Config\AbstractConfig;

class ServiceConfig extends AbstractConfig
{
    const STATIC_API_TOKEN_LIST = 'static.api.token.list';

    const DEBUG_ACTIVE = 'debug.active';

    /**
     * @return array
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function getStaticApiToken() : array
    {
        return $this->get(self::STATIC_API_TOKEN_LIST, []);
    }

    /**
     * @return bool
     * @throws \Xervice\Config\Exception\ConfigNotFound
     */
    public function isDebug() : bool
    {
        return $this->get(self::DEBUG_ACTIVE, false);
    }
}