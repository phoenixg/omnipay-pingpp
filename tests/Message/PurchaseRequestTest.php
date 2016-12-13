<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Pingpp\Common\Channels;
use Omnipay\Tests\TestCase;
use Omnipay\Pingpp\Common\Helpers;

class PurchaseRequestTest extends TestCase
{
    protected $transactionId;

    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->transactionId = Helpers::generateTransactionId();
        $this->request->initialize(
            array(
                'appId' => PINGPP_APP_ID,
                'transactionId' => $this->transactionId,
                'channel' => Channels::ALIPAY_WAP,
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
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame($this->transactionId, $data['order_no']);
        $this->assertSame(array('id' => PINGPP_APP_ID), $data['app']);
        $this->assertSame(Channels::ALIPAY_WAP, $data['channel']);
        $this->assertSame(1, $data['amount']);
        $this->assertSame('127.0.0.1', $data['client_ip']);
        $this->assertSame('cny', $data['currency']);
        $this->assertSame('Here is demo subject', $data['subject']);
        $this->assertSame('Here is demo body', $data['body']);
        $this->assertSame('Here is demo description', $data['description']);
        $this->assertSame(array('foo' => 'bar'), $data['metadata']);
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     * @expectedExceptionMessage The appId parameter is required
     */
    public function testAppIdRequired()
    {
        $this->request->setAppId(null);
        $this->request->getData();
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('ch_14ynXPmPqzb1SCCeXDX9yTOC', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('提供了无效的 API KEY: sk_test_*************************。', $response->getMessage());
    }
}
