<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;

class FetchBatchTransferRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchBatchTransferRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setBatchTransferReference('batch_no_20160801001');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/batch_transfers/batch_no_20160801001', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
         $this->setMockHttpResponse('FetchBatchTransferSuccess.txt');
         $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

}
