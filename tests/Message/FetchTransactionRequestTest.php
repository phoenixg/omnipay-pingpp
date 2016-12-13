<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;

class FetchTransactionRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setTransactionReference('ch_14ynXPmPqzb1SCCeXDX9yTOC');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/charges/ch_14ynXPmPqzb1SCCeXDX9yTOC', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
         $this->setMockHttpResponse('FetchTransactionSuccess.txt');
         $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('ch_14ynXPmPqzb1SCCeXDX9yTOC', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('FetchTransactionFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('未找到 charge : ch_14ynXPmPqzb1SCCeXDX9yTOc。', $response->getMessage());
    }
}
