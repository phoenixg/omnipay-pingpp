<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;

class FetchBatchRefundRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchBatchRefundRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setBatchRefundReference('batch_refund_20160801001');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/batch_refunds/batch_refund_20160801001', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
         $this->setMockHttpResponse('FetchBatchRefundSuccess.txt');
         $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

}
