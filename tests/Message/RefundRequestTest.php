<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;

class RefundRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request
            ->setTransactionReference('ch_14ynXPmPqzb1SCCeXDX9yTOC')
            ->setAmount('10.00')
            ->setDescription('test refund description');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/charges/ch_14ynXPmPqzb1SCCeXDX9yTOC/refunds', $this->request->getEndpoint());
    }

    public function testAmount()
    {
        $data = $this->request->getData();
        $this->assertSame(1000, $data['amount']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('RefundSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('RefundOutOfTimeFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('退款时间超出渠道 cnp_u 允许的最晚退款时间', $response->getMessage());
    }
}
