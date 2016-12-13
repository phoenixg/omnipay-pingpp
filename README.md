# Omnipay: Pingpp

## Status

开发中，预计全部完成时间，12月底

## Ready

```php
require './vendor/autoload.php';

use Omnipay\Omnipay;
use Omnipay\Pingpp\Common\Helpers;
use Omnipay\Pingpp\Common\Channels;
use Omnipay\Common\Exception\RuntimeException;

$skLiveKey = 'sk_test_iv5yr1HWLOqHjbjTq1KWLmD4';
$appId = 'app_9SSaPOaDuPCKvHSy';
$channel = Channels::ALIPAY_WAP;
```

## Usage

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

    // 创建 Charge
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
        'amount' => 0.01, // 0.01 RMB
        'currency' => 'cny',
        'returnUrl' => 'http://www.yourdomain.com/path/to/awesome/return.php', // optional
        'cancelUrl' => 'http://www.yourdomain.com/path/to/awesome/cancel.php', // optional
        'notifyUrl' => 'http://www.yourdomain.com/path/to/awesome/notify.php', // optional
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

    // 查询单笔 Charge
    $transaction = $gateway->fetchTransaction();
    $transaction->setTransactionReference('ch_DaHuXHjHeX98GO84COzbfTiP');
    $response = $transaction->send();
    $data = $response->getData();

} catch (Exception $e) {
    echo $e->getMessage();
}

```

