<?php
/**
 * Pingpp Fetch Refund Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Fetch Refund Request.
 *
 * @see https://www.pingxx.com/api#查询-refund-对象
 */
class FetchRefundRequest extends AbstractRequest
{
    /**
     * Get the refund reference.
     *
     * @return string
     */
    public function getRefundReference()
    {
        return $this->getParameter('refundReference');
    }

    /**
     * Set the refund reference.
     *
     * @return FetchRefundRequest provides a fluent interface.
     */
    public function setRefundReference($value)
    {
        return $this->setParameter('refundReference', $value);
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('refundReference');

        $data = array();

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/charges/'.$this->getTransactionReference().'/refunds/'.$this->getRefundReference();
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}
