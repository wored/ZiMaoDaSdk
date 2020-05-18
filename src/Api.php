<?php

namespace Wored\ZiMaoDaSdk;


use Hanson\Foundation\AbstractAPI;
use Psr\Http\Message\ResponseInterface;

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
        $response = $this->https_request($requestUrl, $body);
        return json_decode($response, true);
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

    /**
     * http 请求
     * @param $url 请求的链接url
     * @param null $data 请求的参数，参数为空get请求，参数不为空post请求
     * @return mixed
     */
    public function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}