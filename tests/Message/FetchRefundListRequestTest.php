<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;

class FetchRefundListRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchBatchRefundListRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setTransactionReference('ch_qDun9KKC0uz9G0KSGKaHKybP');
        $this->request->setLimit(2);
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/charges/ch_qDun9KKC0uz9G0KSGKaHKybP/refunds?limit=2', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
         $this->setMockHttpResponse('FetchRefundListSuccess.txt');
         $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('ch_qDun9KKC0uz9G0KSGKaHKybP', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('FetchRefundListFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('未找到 charge : ch_qDun9KKC0uz9G0KSGKaHKybP。', $response->getMessage());
    }
}
