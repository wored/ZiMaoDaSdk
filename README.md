<h1 align="center"> 自贸达推送报关订单SDK</h1>

## 安装

```shell
$ composer require wored/zimaoda-sdk -vvv
```

## 使用
```php
<?php

use \Wored\ZiMaoDaSdk\ZiMaoDaSdk;

$config = [
    'nick'    => 'XXXXXXX',
    'name'    => 'XXXXXXX',
    'format'  => 'xml',
    'rootUrl' => 'http://115.29.193.18',
];

// 实例化自贸达sdk
$zimaoda = new ZiMaoDaSdk($config);

```
> 订单信息创建到自贸达
```php
<?php
   $order['OWebOrder'] = [
       'orderNumber'    => 'XXXXXX',//必选	订单号
       'orderDate'      => 'XXXXXX',//必选	订单时间 格式 yyyy-MM-dd hh:mm:ss
       'totalAmount'    => 'XXXXXX',//必选	订单总金额 totalAmount=payment+discount
       'payment'        => 'XXXXXX',//必选	订单支付金额,实付金额
       'postAmount'     => 'XXXXXX',//必选	邮费，如果没有邮费，可填0
       'discount'       => 'XXXXXX',//必选	订单优惠总金额，可为0
       'tradeFrom'      => 'XXXXXX',//必选	订单来源，订单来源平台
       'payTime'        => 'XXXXXX',//必选	支付时间 格式 yyyy-MM-dd hh:mm:ss
       'paymentType'    => 'XXXXXX',//可选	描述付款方式，（订单如需报关，则必选）目前支持： ZFB:支付宝（中国）网络技术有限公司,  YZF:易智付科技（北京）有限公司,  WX:财付通支付科技有限公司,  UNION:广州银联网络支付有限公司,  WYB:网易宝有限公司,  SNYF:南京苏宁易付宝网络科技有限公司,  GZHLB:广州合利宝支付科技有限公司,  GHT:北京高汇通商业管理有限公司,  HF:上海汇付数据服务有限公司,  SMSW:商盟商务服务有限公司,  HJ:广州市汇聚支付电子科技有限公司,  TL:通联支付网络服务股份有限公司,  XHTD:福建自贸试验区平潭片区鑫海通达供应链管理有限公司,  YJF:重庆易极付科技有限公司,  BF:宝付网络科技(上海)有限公司,  LKL:拉卡拉支付股份有限公司,
       'payNo'          => 'XXXXXX',//可选	支付单号(订单如需报关，则必选)
       'consignee'      => 'XXXXXX',//必选	收货人姓名
       'province'       => 'XXXXXX',//必选	收货人省份
       'city'           => 'XXXXXX',//必选	收货人城市
       'cityarea'       => 'XXXXXX',//必选	收货人行政区
       'address'        => 'XXXXXX',//必选	收货人详细地址，长度不能大于60
       'mobilePhone'    => 'XXXXXX',//必选	手机号，mobilePhone和telephone必须有一个有值
       'telephone'      => 'XXXXXX',//可选	电话号码
       'zip'            => 'XXXXXX',//可选	邮编
       'buyerMessage'   => 'XXXXXX',//可选	买家留言
       'identityType'   => 'XXXXXX',//必选	证件类型[（1-身份证]
       'buyerNick'      => 'XXXXXX',//可选	购买人姓名，如不填，则用收货人姓名进行匹配
       'identityCode'   => 'XXXXXX',//必选	证件号（没有则留空），后续还需要客户方提供
       'identityStatus' => 0,//可选	身份证收集状态，如果identityCode 未填identityCode=0 ，identityCode如果已填 identityCode=1
       'isdirectmail'   => '',//可选	是否直邮[1 是;0 否],默认否
       'ePlatformCode'  => 'XXXXXX',//可选	电商平台代码(如不填写，默认取店铺上的电商平台代码)
       'isBG'           => 0,//必选	是否需报关 0 :需要报关 1：不需要报关，默认0
       'OWebOrderItems'=>[
           [
               'OWebOrderItem'=>[
                   'articleId'     => 1,//必选	在自贸达系统中，产品的唯一ID，可以找自贸达客服提供
                   'productNumber' => 'XXXXXX',//必选	产品编码，一般与海关备案编码一致
                   'productName'   => 'XXXXXX',//必选	货品中文名称，需正确填写，会影响到仓库打包、小票打印等信息
                   'skuNumber'     => 'XXXXXX',//必选	sku编码，可以是自己的系统定义,也可以和productNumber一致
                   'skuName'       => 'XXXXXX',//必选	sku名称,自己系统定义的名字,也可以和productName一致
                   'price'         => 'XXXXXX',//必选	价格
                   'orderCount'    => 'XXXXXX',//必选	订购数量,数量必须>0
                   'amount'        => 'XXXXXX',//必选	产品总金额，产品单价*数量
                   'discountFee'   => 0,//必填	总优惠金额，默认0   
               ] 
           ],
           [
               'OWebOrderItem'=>[
                   'articleId'     => 1,//必选	在自贸达系统中，产品的唯一ID，可以找自贸达客服提供
                   'productNumber' => 'XXXXXX',//必选	产品编码，一般与海关备案编码一致
                   'productName'   => 'XXXXXX',//必选	货品中文名称，需正确填写，会影响到仓库打包、小票打印等信息
                   'skuNumber'     => 'XXXXXX',//必选	sku编码，可以是自己的系统定义,也可以和productNumber一致
                   'skuName'       => 'XXXXXX',//必选	sku名称,自己系统定义的名字,也可以和productName一致
                   'price'         => 'XXXXXX',//必选	价格
                   'orderCount'    => 'XXXXXX',//必选	订购数量,数量必须>0
                   'amount'        => 'XXXXXX',//必选	产品总金额，产品单价*数量
                   'discountFee'   => 0,//必填	总优惠金额，默认0   
               ] 
           ]
       ]
   ];
   $zimaoda->createOrder($order);  
```
> 取消订单
```php
<?php
   $order['OWebOrderReFund'] = [
       'orderNumber'    => '1020190418789450',//必选	订单号
       'orderStatus'      => 'B2C_REFUND_STATUES',//订单状态：B2C_REFUND_STATUES
   ];
   $zimaoda->refundOrder($order);  

```

## License

MIT