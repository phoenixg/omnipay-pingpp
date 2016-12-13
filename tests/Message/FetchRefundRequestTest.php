<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;

class FetchRefundRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setTransactionReference('ch_qDun9KKC0uz9G0KSGKaHKybP');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/charges/ch_qDun9KKC0uz9G0KSGKaHKybP/refunds/re_Ouz5GSfv1Gm1S4WzTCaXXPSK', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
         $this->setMockHttpResponse('FetchRefundSuccess.txt');
         $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('ch_qDun9KKC0uz9G0KSGKaHKybP', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('FetchRefundFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('未找到 refund : re_Ouz5GSfv1Gm1S4WzTCaXXPSK_。', $response->getMessage());
    }
}
