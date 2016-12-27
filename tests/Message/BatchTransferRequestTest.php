<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;
use Omnipay\Pingpp\Common\Helpers;

class BatchTransferRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new BatchTransferRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request
            ->setAppId(PINGPP_APP_ID)
            ->setBatchTransferReference(Helpers::generateBatchTransferReference())
            ->setChannel('alipay')
            ->setAmount(0.02)
            ->setCurrency('cny')
            ->setType('b2c')
            ->setDescription('Batch transfer description')
            ->setMetadata([ 'foo' => 'bar' ]);
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/batch_transfers', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('BatchTransferSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('BatchTransferFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('some message', $response->getMessage());
    }
}
