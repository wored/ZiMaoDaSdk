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

    /**
     * 订单信息创建到自贸达
     * 客户网站上的订单创建到ZMD报关系统，采用post方式传输，传入的数据为xml文件
     * @param array $order 以数组的信息拼装
     * @return mixed
     */
    public function createOrder(array $order)
    {
        $params = [
            'method'      => 'swapi.web.order.create',
            'orderDate'   => $order['OWebOrder']['orderDate'],
            'orderNumber' => $order['OWebOrder']['orderNumber'],
            'orderData'   => $this->api->paramToXml($order),
        ];
        return $this->api->request('createOrder', $params);
    }

    /**
     * 取消订单
     * 客户订单从自贸达系统取消，采用post方式传输，传入的数据为xml文件
     * @param array $order
     * @return mixed
     */
    public function refundOrder(array $order)
    {
        $params = [
            'method'      => 'swapi.web.order.refund',
            'orderNumber' => $order['OWebOrderReFund']['orderNumber'],
            'orderData'   => $this->api->paramToXml($order),
        ];
        return $this->api->request('refundOrder', $params);
    }
}