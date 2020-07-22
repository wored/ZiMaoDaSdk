<?php

namespace Wored\ZiMaoDaSdk;


use Hanson\Foundation\AbstractAPI;
use Hanson\Foundation\Http;

class Api extends AbstractAPI
{
    public $config;

    /**
     * Api constructor.
     * @param $appkey
     * @param $appsecret
     * @param $sid
     * @param $baseUrl
     */
    public function __construct(ZiMaoDaSdk $ziMaoDaSdk)
    {
        $this->config = $ziMaoDaSdk->getConfig();
    }

    /**
     * @param string $urlPath
     * @param array $params
     * @return mixed
     */
    public function request(string $method, array $order)
    {
        $params = [
            'appkey'    => $this->config['appkey'],
            'timestamp' => date('Y-m-d H:i:s'),
            'method'    => $method,
            'format'    => 'JSON',
        ];
        if (!empty($order['orderNumber'])) {
            $params['orderNumber'] = $order['orderNumber'];
        }
        $body = json_encode($order);
        $params['sign'] = $this->sign($params, $body);
        $requestUrl = $this->config['rootUrl'] . '?' . http_build_query($params);
        $http=new Http();
        $response=$http->json($requestUrl,$order);
        return json_decode(strval($response->getBody()), true);
    }

    /**
     * 生成签名
     * @param array $request_params
     * @return string
     */
    public function sign(array $params, string $body)
    {
        $str = '';
        ksort($params, SORT_STRING);
        foreach ($params as $k => $v) {
            $str .= $k . $v;
        }
        $str = $this->config['appsecret'] . $str . $body . $this->config['appsecret'];
        return strtoupper(md5($str));
    }
}