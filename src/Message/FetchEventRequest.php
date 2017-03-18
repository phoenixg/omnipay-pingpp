<?php
/**
 * Pingpp Fetch Event Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Fetch Event Request.
 *
 * @link https://www.pingxx.com/api?language=cURL#查询-event-对象
 */
class FetchEventRequest extends AbstractRequest
{
    /**
     * Get the event reference.
     *
     * @return mixed
     */
    public function getEventReference()
    {
        return $this->getParameter('eventReference');
    }

    /**
     * Set the event reference.
     *
     * @param  $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setEventReference($value)
    {
        return $this->setParameter('eventReference', $value);
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('eventReference');

        $data = array();

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/events/'.$this->getEventReference();
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}
