<?php
/**
 * Pingpp Fetch Refund List Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Fetch Refund List Request.
 *
 * @see https://www.pingxx.com/api#查询-refund-对象列表
 */
class FetchRefundListRequest extends AbstractRequest
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
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = array();

        if ($this->getLimit()) {
            $data['limit'] = $this->getLimit();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/charges/'.$this->getTransactionReference().'/refunds?'.http_build_query($this->getData());
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}
