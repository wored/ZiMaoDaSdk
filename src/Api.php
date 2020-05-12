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
        $http = $this->getHttp();

        $params = array_merge($this->systemParams(), $params);
        $params['sign'] = $this->sign($params);

        $baseUrl = Helper::finish($this->getBaseUrl(), '/');

        $link = $baseUrl . $url;

        /** @var ResponseInterface $response */
        $response = call_user_func_array([$http, $method], [$link, $params]);

        return json_decode(strval($response->getBody()), true);
    }

    /**
     * 生成签名
     * @param array $request_params
     * @return string
     */
    public function sign(array $request_params)
    {
        $sign = md5($this->pack($request_params) . $this->getAppsecret());
        return $sign;
    }
}