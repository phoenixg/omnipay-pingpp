<?php
/**
 * Pingpp Fetch Batch Refund Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Fetch Batch Refund Request.
 *
 * @see https://www.pingxx.com/api#查询-batch-refund-对象
 */
class FetchBatchRefundRequest extends AbstractRequest
{
    /**
     * Get the batch refund reference.
     *
     * @return mixed
     */
    public function getBatchRefundReference()
    {
        return $this->getParameter('batchRefundReference');
    }

    /**
     * Set the batch refund reference.
     *
     * @param  $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBatchRefundReference($value)
    {
        return $this->setParameter('batchRefundReference', $value);
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('batchRefundReference');

        $data = array();

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/batch_refunds/'.$this->getBatchRefundReference();
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}
