<?php

namespace Wored\ZiMaoDaSdk;


use Hanson\Foundation\AbstractAPI;
use Psr\Http\Message\ResponseInterface;

class Api extends AbstractAPI
{

    /**
     * Api constructor.
     * @param $appkey
     * @param $appsecret
     * @param $sid
     * @param $baseUrl
     */
    public function __construct(ZiMaoDaSdk $ziMaoDaSdk)
    {
        Helper::dd($ziMaoDaSdk->getConfig());
    }

    public function request($method, $url, $params)
    {

    }

    /**
     * 生成签名
     * @param array $request_params
     * @return string
     */
    public function sign(array $request_params)
    {

    }
}