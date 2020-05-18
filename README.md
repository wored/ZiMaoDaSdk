<h1 align="center"> 自贸达新接口推送报关订单SDK</h1>

## 安装

```shell
$ composer require wored/zimaoda-sdk -vvv
```

## 使用
```php
<?php

use \Wored\ZiMaoDaSdk\ZiMaoDaSdk;

$config = [
    'appkey'    => '23127495',
    'appsecret' => '9ef80935a28d3f4c766ac9337b052129',
    'format'    => 'JSON',
    'rootUrl'   => 'http://115.29.193.18/webAPI/order',
];

// 实例化自贸达sdk
$zimaoda = new ZiMaoDaSdk($config);

```
> 订单信息创建到自贸达
```php
<?php
   $order = [
       'orderNumber'        => 'Order20180808',//必选	Order20180808	订单号
       'orderDate'          => '2020-05-18 12:12:12',//必选	2018-08-08 08:08:08	订单时间 格式 yyyy-MM-dd hh:mm:ss
       'payTime'            => '2020-05-18 13:12:12',//条件必填(条件为:需报关订单必填)	2018-08-08 08:08:08	支付时间 格式 yyyy-MM-dd hh:mm:ss
       'totalAmount'        => 100.66,//	BigDecimal	必选	100.66	订单总金额=实付金额(payment)+订单折扣(discount)
       'payment'            => 100.66,//	BigDecimal	必选	100.66	订单付款金额,实付金额
       'postAmount'         => 0,//BigDecimal	必选	0	邮费,如果没有邮费,可填0
       'insuredAmount'      => 0,//	BigDecimal	可选	0	订单保价金额，无则填0
       'insuredFee'         => 0,//	BigDecimal	可选	0	订单保费金额，无则填0
       'discount'           => 0,//	BigDecimal	必选	0	优惠金额,可填0
   //    'dfPayment'          => '',//	BigDecimal	可选	100	到付金额
       'tradeFrom'          => '自贸达天猫旗舰店',//	String	必选	自贸达天猫旗舰店	订单来源,描述订单来源,一般填店铺名称
       'paymentType'        => 'ZFB',//	String	条件必填(条件为:需报关订单必填)	ZFB	描述付款方式,目前支持: [ ZFB:支付宝（中国）网络技术有限公司;  YZF:易智付科技（北京）有限公司;  WX:财付通支付科技有限公司;  UNION:广州银联网络支付有限公司;  WYB:网易宝有限公司;  SNYF:南京苏宁易付宝网络科技有限公司;  GZHLB:广州合利宝支付科技有限公司;  GHT:北京高汇通商业管理有限公司;  HF:上海汇付数据服务有限公司;  SMSW:商盟商务服务有限公司;  HJ:广州市汇聚支付电子科技有限公司;  TL:通联支付网络服务股份有限公司;  XHTD:福建自贸试验区平潭片区鑫海通达供应链管理有限公司;  YJF:重庆易极付科技有限公司;  BF:宝付网络科技(上海)有限公司;  LKL:拉卡拉支付股份有限公司;  ]
       'expressCompanyCode' => 'YTO',//	String	可选	YTO	物流公司编码
       'consignee'          => '张三',//	String	必选	张三	收货人姓名
       'province'           => '河南省',//	String	必选	河南省	收货人省份
       'city'               => '郑州市',//	String	必选	郑州市	收货人城市
       'cityarea'           => '管城区',//	String	必选	管城区	收货人行政区
       'address'            => '经开区第九大街与经北一路交叉口',//	String(最大不能超过60字符)	必选	经开区第九大街与经北一路交叉口	收货人详细地址
       'mobilePhone'        => '13166668888',//	String	必选	13166668888	手机号
       'telephone'          => '',//	String	可选	0371-63593666	电话号码
       'zip'                => '',//	String	可选	450000	邮编
       'buyerMessage'       => '',//	String	可选	请尽快发货	买家留言
       'identityType'       => '1',//	String	条件必填(条件为:需报关订单必填)	1	订购人证件类型[1-身份证]
       'identityCode'       => '410111198909238888',//	String	条件必填(条件为:需报关订单必填)	410111198909238888	订购人证件号
       'subscriber'         => '马云',//	String	必选	马云	订购人姓名
       'payNo'              => time() . rand(10000, 99999),//	String	条件必填(条件为:需报关订单必填)	2012345678987654321	支付单号
       'payId'              => '',//	String	可选	fengqingyang	订购人在购物平台的id
       'extendField1'       => '',//	String	可选	不填写默认需要报关,填写1不报关	是否需要报关
       'extendField2'       => '4101W68131',//	String	可选	4101W68131	电商平台代码(如不填写，默认取店铺上的电商平台代码)
       'extendField3'       => '',//	String	可选	xx	包裹打包备注
       'items'              => [
           [
               'articleId'     => '14434',//	Long	必选	314	在自贸达系统中,产品的唯一ID,可以找自贸达客服提供
               'itemId'        => 0,//	String	可选	314	客户系统中的产品ID，如不提供articleId，则articleId填0；itemId必填，系统会根据itemId查找客户的产品
               'productNumber' => '44944',//	String	必选	44944	产品编码,一般与海关备案编码一致
               'productName'   => 'Osteo葡萄糖胺软骨素MSM复合营养囊片',//	String	必选	Osteo葡萄糖胺软骨素MSM复合营养囊片	货品中文名称,需正确填写,会影响到仓库打包、小票打印等信息
               'skuNumber'     => '44944',//	String	必选	44944	sku编码,可以是自己的系统定义,也可以和productNumber一致
               'skuName'       => 'Osteo葡萄糖胺软骨素MSM复合营养囊片',//	String	必选	Osteo葡萄糖胺软骨素MSM复合营养囊片	sku名称,自己系统定义的名字,也可以和productName一致
               'price'         => 50.33,//	BigDecimal	必选	50.33	含税价格
               'quantity'      => 2,//	Integer	必选	2	订购数量,数量必须>0
               'amount'        => 100.66,//	BigDecimal	必选	100.66	产品总金额,产品单价*数量
               'discountFee'   => 0,//	BigDecimal	必选	0	总优惠金额,默认0
               'deliveryType'  => 1,//	Integer	可选	1	产品发货仓 1:保税区发货; 2:直邮发货; 3:其他发货(国内仓),默认1保税区发货
               'batch'         => '',//	String	可选	20220101	产品效期效期,格式:yyyyMMdd
           ]
       ],
   ];
   $zimaoda->createOrUpdateOrder('create',$order);  
```
> 取消订单
```php
<?php
   $order = [
       'orderNumber' => 'Order20180808',
       'orderStatus' => 'B2C_REFUND_STATUES',
   ];
   $zimaoda->refundOrder($order);  

```
> 查询运单信息
```php
<?php
   $order = [
       'orderNumber' => 'Order20180808',
   ];
   $zimaoda->emsInfo($order);  

```
## License

MIT