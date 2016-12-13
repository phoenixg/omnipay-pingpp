<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;

class FetchBatchRefundListRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchBatchRefundListRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setAppId(PINGPP_APP_ID);
        $this->request->setLimit(2);
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/batch_refunds?appId='.PINGPP_APP_ID.'&limit=2', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
         $this->setMockHttpResponse('FetchBatchRefundListSuccess.txt');
         $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

}