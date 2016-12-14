# Omnipay: Pingpp

[Ping++ 官方文档](https://www.pingxx.com/api)


## Progress

开发中，预计全部完成时间，12月底

## Introduction

Terminology

[Omnipay](http://omnipay.thephpleague.com/)


## Usage

### Preparation

```php
require './vendor/autoload.php';

use Omnipay\Omnipay;
use Omnipay\Pingpp\Common\Helpers;
use Omnipay\Pingpp\Common\Channels;

$skLiveKey = 'sk_test_iv5yr1HWLOqHjbjTq1KWLmD4';
$appId = 'app_9SSaPOaDuPCKvHSy';
$channel = Channels::ALIPAY_WAP;
```

## Initialize

```php
try {
    /**
     * @var $gateway \Omnipay\Pingpp\Gateway
     */
    $gateway = Omnipay::create('Pingpp');
    $gateway->initialize(array(
        'apiKey' => $skLiveKey,
        'privateKey' => file_get_contents(PINGPP_ASSET_DIR.'/sample_rsa_private_key.pem') // optional
    ));
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

### Create Charge (创建 Charge)

```php
$transaction = $gateway->purchase(array(
    'appId' => $appId,
    'transactionId' => Helpers::generateTransactionId(),
    'channel' => $channel,
    'channelExtraFields' => array( // optional
        'app_pay' => true
    ),
    'subject' => 'Here is demo subject',
    'body' => 'Here is demo body',
    'description' => 'Here is demo description', // optional
    'amount' => 0.01,
    'currency' => 'cny',
    'returnUrl' => 'http://yourdomain.com/path/to/awesome/return.php', // optional
    'cancelUrl' => 'http://yourdomain.com/path/to/awesome/cancel.php', // optional
    'notifyUrl' => 'http://yourdomain.com/path/to/awesome/notify.php', // optional
    'metadata' => array('foo' => 'bar'), // optional
    'timeExpire' => time() + 3600, // optional
    'clientIp' => '127.0.0.1',
));

/**
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

**note:** 以下 `$response` 的方法支持同上。

### Fetch Charge (查询单笔 Charge)

```php
$transaction = $gateway->fetchTransaction();
$transaction->setTransactionReference('ch_DaHuXHjHeX98GO84COzbfTiP');
$response = $transaction->send();
```

### Fetch Charge List (查询 Charge 列表)

```php
$transaction = $gateway->fetchTransactionList(array(
    'appId' => 'app_9SSaPOaDuPCKvHSy',
    'channel' => Channels::ALIPAY,
    'paid' => 0,
    'refunded' => 0,
    'createdFrom' => 1481116461,
    'createdTo' => 1477723630,
    'limit' => 2,
));
$response = $transaction->send();
```

### Refund (创建退款)
```php
$refund = $gateway->refund(array(
    'amount'                   => '10.00',
    'transactionReference'     => 'ch_DaHuXHjHeX98GO84COzbfTiP',
    'description'              => 'test refund description',
    'metadata'                 => [],
));
$response = $refund->send();
```