<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Pingpp\Common\Channels;
use Omnipay\Tests\TestCase;
use Omnipay\Pingpp\Common\Helpers;

class RedEnvelopeRequestTest extends TestCase
{
    protected $transactionId;

    public function setUp()
    {
        $this->request = new RedEnvelopeRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->transactionId = Helpers::generateRedEnvelopeTransactionId();
        $this->request->initialize(
            array(
                'appId' => PINGPP_APP_ID,
                'transactionId' => $this->transactionId,
                'channel'     => Channels::WX, // only support "wx", "wx_pub" channel
                'subject' => 'Here is demo subject',
                'body' => 'Here is demo body',
                'description' => 'Here is demo description', // optional
                'amount' => 0.01, // 0.01 RMB
                'currency' => 'cny',
                'sender' =>  'Sender Name', // 商户名称，最多 32 个字节
                'receiver' => 'Wechat Openid',
                'metadata' => array(['foo' => 'bar']), // optional
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame($this->transactionId, $data['order_no']);
        $this->assertSame(array('id' => PINGPP_APP_ID), $data['app']);
        $this->assertSame(Channels::WX, $data['channel']);
        $this->assertSame(1, $data['amount']);
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
        $this->setMockHttpResponse('RedEnvelopeSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
    }
}
