<?php

namespace Wored\ZiMaoDaSdk;


use Hanson\Foundation\AbstractAPI;
use Psr\Http\Message\ResponseInterface;

class Api extends AbstractAPI
{
    public $config;
    public $params;

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
        $this->params = [
            'nick'   => $this->config['nick'],
            'name'   => $this->config['name'],
            'format' => $this->config['format'],
        ];
    }

    /**
     * @param string $urlPath
     * @param array $params
     * @return mixed
     */
    public function request(string $urlPath, array $params)
    {
        $http = $this->getHttp();
        $params = array_merge($this->params, $params);
        $params['date'] = date('Y-m-d H:i:s', time());
        $params['sign'] = $this->sign($params);
        $requestUrl = $this->config['rootUrl'] . '/webAPI/' . $urlPath;
        $response = call_user_func_array([$http, 'POST'], [$requestUrl, $params]);
        return json_decode(strval($response->getBody()), true);
    }

    /**
     * 生成签名
     * @param array $request_params
     * @return string
     */
    public function sign(array $params)
    {
        $data = '';
        $data .= base64_encode($params['nick']);
        $data .= base64_encode($params['method']);
        $data .= base64_encode($params['date']);
        $data .= base64_encode($params['name']);
        $data .= base64_encode($params['orderNumber']);
        $data .= base64_encode($params['format']);
        return md5($data);
    }

    /**
     * @param $param
     * @param bool $root
     * @return string
     */
    public function paramToXml($param, $root = true)
    {
        if ($root) {
            $xml = '<?xml version="1.0" encoding="utf-8"?>';
        } else {
            $xml = '';
        }
        foreach ($param as $key => $vo) {
            if ($key === 'attributes') {//判断是否是属性字段
                continue;
            }
            if (!is_numeric($key)) {
                $xml .= "<{$key}";
                if (!empty($vo['attributes'])) {//添加属性
                    foreach ($vo['attributes'] as $item => $attribute) {
                        $xml .= " {$item}=\"{$attribute}\"";
                    }
                }
                $xml .= '>';
            }
            if (is_array($vo) and count($vo) > 0) {
                $xml .= $this->paramToXml($vo, false);
            } else {
                $xml .= $vo;
            }
            if (!is_numeric($key)) {
                $xml .= "</{$key}>";
            }
        }
        return $xml;
    }
}