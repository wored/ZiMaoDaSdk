<?php

namespace Wored\ZiMaoDaSdk;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slpcode\WangDianTongSdk\Basic\Basic;
use Slpcode\WangDianTongSdk\Goods\Goods;
use Slpcode\WangDianTongSdk\Purchase\Purchase;
use Slpcode\WangDianTongSdk\Refund\Refund;
use Slpcode\WangDianTongSdk\Stock\Stock;
use Slpcode\WangDianTongSdk\Trade\Trade;

class ServiceProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['api'] = function ($pimple) {
            return new Api($pimple);
        };
    }
}