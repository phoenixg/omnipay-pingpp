<?php
namespace Omnipay\Pingpp\Common;

/**
 * Pingpp Helpers
 * @package Omnipay\Pingpp\Common
 */
class Helpers
{
    /**
     * 生成兼容所有渠道的商户交易流水号
     *
     * A merchant transaction id generator compatible with
     * all Ping++ supported payment channels
     *
     * @link https://www.pingxx.com/api#创建-charge-对象
     * @param bool $short
     * @return string
     */
    public static function generateTransactionId($short = false)
    {
        /**
         * 10 digits, use this length when you need cmb_wallet payment channel
         */
        if ($short) return (string) time();

        /**
         * 20 digits, use this length as default
         */
        return (string) date('YmdHis') . rand(100000, 999999);
    }

    /**
     * 生成兼容 Ping++ 批量退款接口要求的批量退款批次号
     *
     * A batch refund reference id generator compatible with
     * all Ping++ supported payment channels
     *
     * @link https://www.pingxx.com/api#batch-refunds-批量退款
     * @return string
     */
    public static function generateBatchRefundReference()
    {
        return (string) 'batch_no_'.date('YmdHis').rand(0,9);
    }

    /**
     * 生成兼容 Ping++ 红包接口要求的商户交易流水号
     *
     * A merchant transaction id generator compatible with
     * all Ping++ supported red envelope channels
     *
     * Currently red envelope is only available to "wx" and "wx_pub" channels
     *
     * @return string
     */
    public static function generateRedEnvelopeTransactionId()
    {
        return date('YmdHis') . (microtime(true) % 1) * 1000 . mt_rand(0, 9999);
    }


    /**
     * 生成兼容 Ping++ Transfer 接口的交易流水号
     *
     * A merchant transaction id generator compatible with
     * all Ping++ supported transfer channels
     *
     * Currently transfer is only available to "wx_pub" and "unionpay" channels
     *
     * @param $channel
     * @return null|string
     */
    public static function generateTransferTransactionId($channel)
    {
        if ($channel == Channels::WX_PUB) {
            return (string) 'transfer_'.date('YmdHis').rand(0,9);
        }

        if ($channel == Channels::UNIONPAY) {
            return date('YmdHis') . rand(10, 99);
        }

        return null;
    }

}



