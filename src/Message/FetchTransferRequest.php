<?php
/**
 * Pingpp Fetch Transfer Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Fetch Transfer Request.
 *
 * @link https://www.pingxx.com/api#查询-transfer-对象
 */
class FetchTransferRequest extends AbstractRequest
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
        return $this->endpoint.'/transfers/'.$this->getTransactionReference();
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}
