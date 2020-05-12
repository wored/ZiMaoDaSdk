<?php

namespace Wored\ZiMaoDaSdk;


use Hanson\Foundation\Foundation;

/***
 * Class ZiMaoDaSdk
 * @package \Wored\ZiMaoDaSdk
 *
 */
class ZiMaoDaSdk extends Foundation
{
    protected $providers = [
        ServiceProvider::class
    ];

    public function __construct($config)
    {
        $config['debug'] = $config['debug'] ?? false;
        parent::__construct($config);
    }
}