<?php

/**
 * Pingpp Batch Refund Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Batch Refund Request.
 *
 * @package Omnipay\Pingpp\Message
 */
class BatchRefundRequest extends AbstractRequest
{
    /**
     * Get the batch no.
     *
     * @return mixed
     */
    public function getBatchRefundReference()
    {
        return $this->getParameter('batchRefundReference');
    }

    /**
     * Set the batch no.
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBatchRefundReference($value)
    {
        return $this->setParameter('batchRefundReference', $value);
    }

    /**
     * Get the charge id list.
     *
     * @return mixed
     */
    public function getChargeIdList()
    {
        return $this->getParameter('chargeIdList');
    }

    /**
     * Set the charge id list.
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setChargeIdList($value)
    {
        return $this->setParameter('chargeIdList', $value);
    }

    public function getData()
    {
        $this->validate('appId', 'batchRefundReference', 'chargeIdList');

        $data = array();

        $data['app'] = $this->getAppId();
        $data['batch_no'] = $this->getBatchRefundReference();
        $data['charges'] = $this->getChargeIdList();

        if ($this->getDescription()) {
            $data['description'] = $this->getDescription();
        }

        if ($this->getMetadata()) {
            $data['metadata'] = $this->getMetadata();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/batch_refunds';
    }
}
