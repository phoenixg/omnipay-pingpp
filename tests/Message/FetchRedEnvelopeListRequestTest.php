<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;

class FetchRedEnvelopeListRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchRedEnvelopeListRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setAppId(PINGPP_APP_ID);
        $this->request->setLimit(2);
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/red_envelopes?appId='.PINGPP_APP_ID.'&limit=2', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
         $this->setMockHttpResponse('FetchRedEnvelopeListSuccess.txt');
         $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

}