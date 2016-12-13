<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;
use Omnipay\Pingpp\Common\Helpers;

class BatchRefundRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new BatchRefundRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request
            ->setAppId(PINGPP_APP_ID)
            ->setBatchRefundReference(Helpers::generateBatchRefundReference())
            ->setChargeIdList([ 'ch_L8qn10mLmr1GS8e5OODmHaL4', 'ch_fdOmHaLmLmr1GOD4qn1dS8e5', ])
            ->setDescription('Batch refund description')
            ->setMetadata([ 'foo' => 'bar' ]);
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/batch_refunds', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('BatchRefundSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('BatchRefundFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('some message', $response->getMessage());
    }
}
