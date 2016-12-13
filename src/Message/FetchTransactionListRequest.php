<?php
/**
 * Pingpp Fetch Transaction List Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Fetch Transaction List Request.
 *
 * @see https://www.pingxx.com/api#查询-charge-对象列表
 */
class FetchTransactionListRequest extends AbstractRequest
{
    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->getParameter('limit');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setLimit($value)
    {
        return $this->setParameter('limit', $value);
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
    public function getPaid()
    {
        return $this->getParameter('paid');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPaid($value)
    {
        return $this->setParameter('paid', $value);
    }

    /**
     * @return mixed
     */
    public function getRefunded()
    {
        return $this->getParameter('refunded');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setRefunded($value)
    {
        return $this->setParameter('refunded', $value);
    }

    /**
     * @return mixed
     */
    public function getCreatedFrom()
    {
        return $this->getParameter('createdFrom');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCreatedFrom($value)
    {
        return $this->setParameter('createdFrom', $value);
    }

    /**
     * @return mixed
     */
    public function getCreatedTo()
    {
        return $this->getParameter('createdTo');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCreatedTo($value)
    {
        return $this->setParameter('createdTo', $value);
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = array();

        if ($this->getAppId()) {
            $data['app'] = array('id' => $this->getAppId());
        }

        if ($this->getLimit()) {
            $data['limit'] = $this->getLimit();
        }

        if ($this->getChannel()) {
            $data['channel'] = $this->getChannel();
        }

        if ($this->getPaid()) {
            $data['paid'] = $this->getPaid();
        }

        if ($this->getRefunded()) {
            $data['refunded'] = $this->getRefunded();
        }

        if ($this->getCreatedFrom()) {
            $data['created']['gte'] = $this->getCreatedFrom();
        }

        if ($this->getCreatedTo()) {
            $data['created']['lte'] = $this->getCreatedTo();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/charges?'.http_build_query($this->getData());
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}
