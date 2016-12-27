<?php
/**
 * Pingpp Fetch Batch Transfer Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Fetch Batch Transfer Request.
 *
 * @link https://www.pingxx.com/api#查询-batch-transfer-对象
 */
class FetchBatchTransferRequest extends AbstractRequest
{
    /**
     * Get the batch transfer reference.
     *
     * @return mixed
     */
    public function getBatchTransferReference()
    {
        return $this->getParameter('batchTransferReference');
    }

    /**
     * Set the batch transfer reference.
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBatchTransferReference($value)
    {
        return $this->setParameter('batchTransferReference', $value);
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('batchTransferReference');

        $data = array();

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/batch_transfers/'.$this->getBatchTransferReference();
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}
