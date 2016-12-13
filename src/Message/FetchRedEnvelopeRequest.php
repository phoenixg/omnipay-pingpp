<?php
/**
 * Pingpp Fetch Red Envelope Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Fetch Red Envelope Request.
 *
 * @see https://www.pingxx.com/api?language=cURL#查询-red-envelope-对象
 */
class FetchRedEnvelopeRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionReference');

        $data = array();

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/red_envelopes/'.$this->getTransactionReference();
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}
