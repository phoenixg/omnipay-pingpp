# Omnipay: Pingpp

[![Latest Stable Version](https://poser.pugx.org/phoenixg/omnipay-pingpp/version.png)](https://packagist.org/packages/phoenixg/omnipay-pingpp)
[![Total Downloads](https://poser.pugx.org/phoenixg/omnipay-pingpp/d/total.png)](https://packagist.org/packages/phoenixg/omnipay-pingpp)

## Introduction

**Ping++ driver for the Omnipay PHP payment processing library**


[Ping++](https://www.pingxx.com/api) is a Chinese leading payment integration service provider,
which support various mainstream payment gateways in China, eg. Alipay, Wechat Pay, UnionPay,
Apple Pay, QQ Wallet, YeePay, Baidu Wallet, JDPay, etc.

[Omnipay](http://omnipay.thephpleague.com/) is a framework agnostic, multi-gateway payment processing library for PHP.
It has a clear and consistent API, and is fully unit tested. This package implements Ping++ support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "phoenixg/omnipay-pingpp": "^1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Usage

The following gateways are provided by this package:

* Pingpp

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

### Initialization
```php
require './vendor/autoload.php';

use Omnipay\Omnipay;
use Omnipay\Pingpp\Common\Helpers;
use Omnipay\Pingpp\Common\Channels;

/**
 * Get key and App ID in Ping++ Dashboard: https://dashboard.pingxx.com/
 */
$skLiveKey = 'sk_live_************************';
$appId = 'app_****************';

/**
 * The payment channel you have configured in Ping++
 */
$channel = Channels::ALIPAY_WAP;

try {
    /**
     * @var $gateway \Omnipay\Pingpp\Gateway
     */
    $gateway = Omnipay::create('Pingpp');
    $gateway->initialize(array(
        'apiKey' => $skLiveKey, // if test key is passed, all transactions will happen in test mode
        'privateKey' => file_get_contents(PINGPP_ASSET_DIR.'/sample_rsa_private_key.pem') // optional, see: https://help.pingxx.com/article/123161/
    ));
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

### API List 

| METHOD | INTRODUCTION | 
| :--- | :------- | 
| `$gateway->purchase()` | 创建 Charge |
| `$gateway->fetchTransaction()` | 查询单笔 Charge |
| `$gateway->fetchTransactionList()` | 查询 Charge 列表 |
| `$gateway->reverse()` | 撤销 Charge（仅支持isv线下渠道，如已支付会退款） |
| `$gateway->refund()` | 创建退款 |
| `$gateway->fetchRefund()` | 查询单笔退款 |
| `$gateway->fetchRefundList()` | 查询退款列表 |
| `$gateway->batchRefund()` | 创建批量退款 |
| `$gateway->fetchBatchRefund()`| 查询单个批量退款批次号 |
| `$gateway->fetchBatchRefundList()` | 查询批量退款列表 |
| `$gateway->redEnvelope()` | 发送红包 |
| `$gateway->fetchRedEnvelope()` | 查询单笔红包 |
| `$gateway->fetchRedEnvelopeList()` | 查询红包列表 |
| `$gateway->transfer()` | 创建转账 |
| `$gateway->cancelTransfer()` | 取消转账 |
| `$gateway->fetchTransfer()` | 查询单笔转账 |
| `$gateway->fetchTransferList()` | 查询转账列表 |
| `$gateway->batchTransfer()` | 创建批量转账 |
| `$gateway->fetchBatchTransfer()` | 查询单个批量转账批次号 |
| `$gateway->cancelBatchTransfer()` | 取消批量转账 |
| `$gateway->fetchEvent()` | 查询 Event 事件（已废弃）|

### Create Charge (创建 Charge)

`channelExtraFields` 参数参考 `src/Common/ChargeChannelExtras.php` 的说明

```php
/**
 * @var \Omnipay\Pingpp\Message\PurchaseRequest $transaction
 */
$transaction = $gateway->purchase(array(
    'appId' => $appId,
    'transactionId' => Helpers::generateTransactionId(),
    'channel' => $channel,
    'channelExtraFields' => array( // optional
        'app_pay' => true
    ),
    'subject' => 'Demo subject',
    'body' => 'Demo body',
    'description' => 'Demo description', // optional
    'amount' => 0.01,
    'currency' => 'cny',
    'clientIp' => '127.0.0.1',
    'timeExpire' => time() + 3600, // optional
    'metadata' => array('foo' => 'bar'), // optional
    'returnUrl' => 'http://yourdomain.com/path/to/awesome/return.php', // optional
    'cancelUrl' => 'http://yourdomain.com/path/to/awesome/cancel.php', // optional
    'notifyUrl' => 'http://yourdomain.com/path/to/awesome/notify.php', // optional
));

/**
 * 以下 $response 的方法支持同上
 * @var \Omnipay\Pingpp\Message\Response $response
 */
$response = $transaction->send();
if ($response->isSuccessful()) {
    $reference_id = $response->getTransactionReference();
    echo "Transaction reference = " . $reference_id .PHP_EOL;
    echo json_encode($response->getData());die;
} else {
    echo $response->getMessage();
}
```

### Fetch Charge (查询单笔 Charge)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchTransactionRequest $transaction
 */
$transaction = $gateway->fetchTransaction();
$transaction->setTransactionReference('ch_DaHuXHjHeX98GO84COzbfTiP');
$response = $transaction->send();
```

### Reverse Charge (撤销单笔 Charge，只支持isv_*线下渠道。如已付款，则撤销会退款)
```php
/**
 * @var \Omnipay\Pingpp\Message\ReverseTransactionRequest $transaction
 */
$transaction = $gateway->reverse();
$transaction->setTransactionReference('ch_DaHuXHjHeX98GO84COzbfTiP');
$response = $transaction->send();
```

### Fetch Charge List (查询 Charge 列表)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchTransactionListRequest $transactionList
 */
$transactionList = $gateway->fetchTransactionList(array(
    'appId' => $appId,
    'channel' => Channels::ALIPAY,
    'paid' => 0,
    'refunded' => 0,
    'createdFrom' => 1481116461,
    'createdTo' => 1477723630,
    'limit' => 5,
));
$response = $transactionList->send();
```

### Refund (创建退款)
```php
/**
 * @var \Omnipay\Pingpp\Message\RefundRequest $refund
 */
$refund = $gateway->refund(array(
    'amount'               => '10.00',
    'transactionReference' => 'ch_DaHuXHjHeX98GO84COzbfTiP',
    'description'          => 'Demo refund description',
    'metadata'             => array('foo' => 'bar'), // optional
));
$response = $refund->send();
```

### Fetch Refund (查询单笔退款)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchRefundRequest $refund
 */
$refund = $gateway->fetchRefund(array(
    'transactionReference' => 'ch_qDun9KKC0uz9G0KSGKaHKybP',
    'refundReference' => 're_Ouz5GSfv1Gm1S4WzTCaXXPSKs',
));
$response = $refund->send();
```

### Fetch Refund List (查询退款列表)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchRefundListRequest $refundList
 */
$refundList = $gateway->fetchRefundList(array(
    'transactionReference' => 'ch_qDun9KKC0uz9G0KSGKaHKybP',
    'limit' => 5,
));
$response = $refundList->send();
```

### Batch Refund (创建批量退款)
```php
/**
 * @var \Omnipay\Pingpp\Message\BatchRefundRequest $batchRefund
 */
$batchRefund = $gateway->batchRefund(array(
    'app'          => $appId,
    'batchRefundReference'      => Helpers::generateBatchRefundReference(),
    'chargeIdList' => array(
        'ch_L8qn10mLmr1GS8e5OODmHaL4',
        'ch_fdOmHaLmLmr1GOD4qn1dS8e5',
    ),
    'description'  => 'Demo batch refund description.', // optional
    'metadata'     => array('foo' => 'bar'), // optional
));
$response = $batchRefund->send();
```

### Fetch Batch Refund (查询单个批量退款批次号)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchBatchRefundRequest $batchRefund
 */
$batchRefund = $gateway->fetchBatchRefund();
$batchRefund->setBatchRefundReference('batch_refund_20160801001');
$response = $batchRefund->send();
```

### Fetch Batch Refund List (查询批量退款列表)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchBatchRefundListRequest $batchRefundList
 */
$batchRefundList = $gateway->fetchBatchRefundList(array(
    'appId' => $appId,
    'limit' => 5,
));
$response = $batchRefundList->send();
```

### Red Envelope (发送红包)
```php
/**
 * @var \Omnipay\Pingpp\Message\RedEnvelopeRequest $redEnvelope
 */
$redEnvelope = $gateway->redEnvelope(array(
    'appId' => $appId,
    'transactionId' => Helpers::generateRedEnvelopeTransactionId(),
    'channel'     => Channels::WX, // only support "wx", "wx_pub" channel
    'subject' => 'Demo subject',
    'body' => 'Demo body',
    'description' => 'Demo description', // optional
    'amount' => 0.01,
    'currency' => 'cny',
    'sender' =>  'Sender Name', // merchant name
    'receiver' => 'Wechat Openid',
    'metadata' => array('foo' => 'bar'), // optional
));
$response = $redEnvelope->send();
```

### Fetch Red Envelope (查询单笔红包)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchRedEnvelopeRequest $redEnvelopeTransaction
 */
$redEnvelope = $gateway->fetchRedEnvelope();
$redEnvelope->setTransactionReference('red_KCabLO58W5G0rX90iT0az5a9');
$response = $redEnvelope->send();
```

### Fetch Red Envelope List (查询红包列表)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchRedEnvelopeListRequest $redEnvelopeList
 */
$redEnvelopeList = $gateway->fetchRedEnvelopeList(array(
    'appId' => $appId,
    'limit' => 5,
));
$response = $redEnvelopeList->send();
```

### Transfer (创建转账)

`channelExtraFields` 参数参考 `src/Common/TransferExtras.php` 的说明

如果返回 `请求来源存在风险，请联系Ping++。` 报错， 是因为没有在 Ping++ 管理平台配置 IP 白名单， 默认是强制开启的。

```php
/**
 * @var \Omnipay\Pingpp\Message\TransferRequest $transfer
 */
$transfer = $gateway->transfer(array(
    'appId' => $appId,
    'channel' => Channels::WX_PUB, // only support "unionpay", "wx_pub" channel
    'channelExtraFields' => array( // optional, different by channel
        'user_name' => 'User Name',
        'force_check' => true
    ),
    'transactionId' => Helpers::generateTransferTransactionId(Channels::WX_PUB),
    'description' => 'Demo description',
    'amount' => 0.01,
    'currency' => 'cny',
    'type' => 'b2c',
    'receiver' => 'Wechat Openid', // optional, different by channel
    'metadata' => array('foo' => 'bar'), // optional
));
$response = $transfer->send();
```

### Cancel Transfer (取消转账)
```php
/**
 * @var \Omnipay\Pingpp\Message\CancelTransferRequest $cancel
 */
$cancel = $gateway->cancelTransfer();
$cancel->setTransactionReference('tr_0eTi1OGqr9iH0i9CePf1a9C0'); // only support "unionpay" channel
$response = $cancel->send();
```

### Fetch Transfer (查询单笔转账)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchTransferRequest $transfer
 */
$transfer = $gateway->fetchTransfer();
$transfer->setTransactionReference('tr_HqbzHCvLOaL4La1ezHfDWTqH');
$response = $transfer->send();
```

### Fetch Transfer List (查询转账列表)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchTransferListRequest $transferList
 */
$transferList = $gateway->fetchTransferList(array(
    'appId' => $appId,
    'limit' => 5,
));
$response = $transferList->send();
```

### Batch Transfer (创建批量转账)

`recipients` 参数参考 `src/Common/BatchTransferRecipients.php` 的说明

```php
/**
 * @var \Omnipay\Pingpp\Message\BatchTransferRequest $batchTransfer
 */
$batchTransfer = $gateway->batchTransfer(array(
    'app' => $appId,
    'batchTransferReference' => Helpers::generateBatchTransferReference(),
    'recipients' => array(
        array(
            'account' => 'alipay account for receiver',
            'amount' => 0.01,
            'name' => 'receiver name A',
            'description' => '', // optional
        ),
        array(
            'account' => 'alipay account for receiver',
            'amount' => 0.01,
            'name' => 'receiver name B',
            'description' => '', // optional
        }
    ),
    'channel' => Channels::ALIPAY, // only support "alipay", "unionpay" channel
    'amount' => 0.02,
    'description'  => 'Demo batch transfer description.',
    'currency' => 'cny',
    'type' => 'b2c',
    'metadata'     => array('foo' => 'bar'), // optional
));
$response = $batchTransfer->send();
```

### Fetch Batch Transfer (查询单个批量转账批次号)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchBatchTransferRequest $batchTransfer
 */
$batchTransfer = $gateway->fetchBatchTransfer();
$batchTransfer->setBatchTransferReference('batch_no_20160801001');
$response = $batchTransfer->send();
```

### Cancel Batch Transfer (取消批量转账)
```php
/**
 * @var \Omnipay\Pingpp\Message\CancelBatchTransferRequest $cancel
 */
$cancel = $gateway->cancelBatchTransfer();
$cancel->setTransactionReference('batch_no_20160801001');
$response = $cancel->send();
```

### Fetch Event (查询 Event 事件)
```php
/**
 * @var \Omnipay\Pingpp\Message\FetchEventRequest $event
 */
$event = $gateway->fetchEvent();
$event->setEventReference('evt_lqVSy5gbL0A68pS8YKvJzdWZ');
$response = $event->send();
```

## Webhooks

To configure your webhooks URL, simply login Ping++ Dashboard, for more information, check out: [docs](https://www.pingxx.com/docs/webhooks/webhooks)

Code below shows how you can verify whether the webhooks you receive is sent by Ping++:

```php
// Retrieve signature in header
$signature = $headers['X-Pingplusplus-Signature'] ?: null;

// Get the Ping++ RSA Public Key in Dashboard
$pub_key_contents = file_get_contents(__DIR__ . "/pingpp_rsa_public_key.pem");

if (openssl_verify(file_get_contents('php://input'), base64_decode($signature), $pub_key_contents, 'sha256')) {
    // Congrats! This request is from Ping++
    exit;
} 

http_response_code(400);
```

## pingpp.js

The minimum integration for PC payment is simple, first you need to load [pingpp.js](https://github.com/PingPlusPlus/pingpp-js/blob/master/dist/pingpp.js) , 
then test with code below:

```html
<div class="app">
    <label><input id="amount" type="text" placeholder="金 额"/></label>
    <span class="up" onclick="wap_pay('upacp_pc')">银联网页支付</span>
    <span class="up" onclick="wap_pay('alipay_pc_direct')">支付宝网页支付</span>
    <span class="up" onclick="wap_pay('cp_b2b')">企业网银支付</span>
</div>

<script>
    function wap_pay(channel) {
        var amount = document.getElementById('amount').value * 100;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost:8000/test.php", true);
        xhr.setRequestHeader("Content-type", "application/json");
        xhr.send(JSON.stringify({
            channel: channel,
            amount: amount
        }));
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                pingppPc.createPayment(xhr.responseText, function(result, err) {
                    console.log(result);
                    console.log(err.msg);
                    console.log(err.extra);
                });
            }
        }
    }
</script>
```

## Test Mode

Pingpp accounts have test-mode API keys as well as live-mode API keys. These keys can be active
at the same time. Data created with test-mode credentials will never hit the real payment channel networks
and will never cost anyone money.

Unlike some gateways, there is no test mode endpoint separate to the live mode endpoint, the
Pingpp API endpoint is the same for test and for live.



## FAQ

### Is it compatible with Ping++ official SDK?

Yes. It's 100% compatible with official API.

### Why use omnipay-pingpp instead of Ping++ official SDK?

- It's simpler, more elegant, more consistantly designed
  简单，优雅，一致的设计
- The implementation to the official API is more covered than SDK
  对官方常用 API 的实现比 SDK 覆盖更多
- It's fully unit tested
  完全的单元测试
- It's easier to switch between Chinese and other payment gateways (like Paypal) if you're running global business
  国内国外支付网关的切换变得一致和流畅
- 你需要一个聚合了国内主流渠道的支付网关，并且希望它遵循一套合理的标准
- 你没有打算使用 Ping++ 账户系统和商户系统的复杂接口（本类库没有集成那些接口, KISS）
- 你希望世界是简单的，可能只提供你需要关心的那些参数即可，你不打算了解每一个很可能不会用到的支付参数


## Terminology

- `transactionId` is the Merchant’s reference to the transaction - so typically the ID of the payment record in the Merchant Site’s database. In Ping++, it's often called `order_no`.
- `transactionReference` is the Payment Gateway’s reference to the transaction. In Ping++, it's often called `Charge Id`, `Red Envelope Id`, `Transfer Id`.
- `returnUrl` is used by drivers when they need to tell the Payment Gateway where to redirect the customer following a transaction. Typically this is used by off-site ‘redirect’ gateway integrations. In Ping++, it's called differently by various payment channels.
- `notifyUrl` is used by drivers to tell the Payment Gateway where to send their server-to-server notification, informing the Merchant Site about the outcome of a transaction. In Ping++, it's called differently by various payment channels.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/phoenixg/omnipay-pingpp/issues),
or better yet, fork the library and submit a pull request.

## Stargazers over time

[![Stargazers over time](https://starchart.cc/phoenixg/omnipay-pingpp.svg)](https://starchart.cc/phoenixg/omnipay-pingpp)
