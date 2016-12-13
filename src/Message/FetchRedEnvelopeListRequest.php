<?php
/**
 * Pingpp Fetch Red Envelope List Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Fetch Red Envelope List Request.
 *
 * @link https://www.pingxx.com/api#查询-red-envelope-对象列表
 */
class FetchRedEnvelopeListRequest extends AbstractRequest
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

        $data['app'] = $this->getAppId();

        if ($this->getLimit()) {
            $data['per_page'] = $this->getLimit();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/red_envelopes?'.http_build_query($this->getData());
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}
