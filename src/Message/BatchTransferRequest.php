<?php

/**
 * Pingpp Batch Transfer Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Batch Transfer Request.
 *
 * @package Omnipay\Pingpp\Message
 */
class BatchTransferRequest extends AbstractRequest
{
    /**
     * Get the batch no.
     *
     * @return mixed
     */
    public function getBatchTransferReference()
    {
        return $this->getParameter('batchTransferReference');
    }

    /**
     * Set the batch no.
     *
     * @param  $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBatchTransferReference($value)
    {
        return $this->setParameter('batchTransferReference', $value);
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->getParameter('channel');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setChannel($value)
    {
        return $this->setParameter('channel', $value);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->getParameter('type');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setType($value)
    {
        return $this->setParameter('type', $value);
    }

    /**
     * @return mixed
     */
    public function getReceiverList()
    {
        return $this->getParameter('receiverList');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setReceiverList($value)
    {
        return $this->setParameter('receiverList', $value);
    }

    public function getData()
    {
        $this->validate('appId', 'batchTransferReference', 'channel', 'description');

        $data = array();

        $data['app'] = $this->getAppId();
        $data['batch_no'] = $this->getBatchTransferReference();

        $data['channel'] = $this->getChannel();
        $data['amount'] = $this->getAmountInteger();
        $data['description'] = $this->getDescription();

        $data['recipients'] = $this->getReceiverList();
        $data['currency'] = strtolower($this->getCurrency());
        $data['type'] = $this->getType();

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
        return $this->endpoint.'/batch_transfers';
    }
}
