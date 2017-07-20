<?php
namespace Omnipay\Pingpp\Common;

/**
 * Pingpp Channels
 *
 * A definition channel list from Ping++.
 * The channel field is need during charge/red envelope/transfer creation request,
 * and is returned within corresponding object.
 *
 * @package Omnipay\Pingpp\Common
 * @link    https://www.pingxx.com/api#支付渠道属性值
 */
abstract class Channels
{
    /**
     * 支付宝 APP 支付
     * alipay app payment channel
     */
    const ALIPAY = 'alipay';

    /**
     * 支付宝手机网页支付
     * alipay wap payment channel
     */
    const ALIPAY_WAP = 'alipay_wap';
    
    /**
     * 支付宝即时到账支付，即支付宝 PC 网页支付
     * alipay pc direct payment channel
     */
    const ALIPAY_PC_DIRECT = 'alipay_pc_direct';
    
    /**
     * 支付宝当面付，即支付宝扫码支付
     * alipay face to face payment channel, ie. alipay qr
     */
    const ALIPAY_QR = 'alipay_qr';
    
    /**
     * 百度钱包移动快捷支付，即百度钱包 APP 支付
     * baidu app payment channel, ie. bfb app
     */
    const BFB = 'bfb';
    
    /**
     * 百度钱包手机网页支付
     * baidu wap payment channel
     */
    const BFB_WAP = 'bfb_wap';
    
    /**
     * 银联企业网银支付，即 B2B 银联 PC 网页支付
     * b2b pc payment channel
     */
    const CP_B2B = 'cp_b2b';

    /**
     * 银联支付，即银联 APP 支付（2015 年 1 月 1 日后的银联新商户使用。若有疑问，请与 Ping++ 或者相关的收单行联系）
     * upacp payment channel ( This is a channel open for merchant joining upacp after 20150101 )
     */
    const UPACP = 'upacp';
    
    /**
     * 银联手机网页支付（2015 年 1 月 1 日后的银联新商户使用。若有疑问，请与 Ping++ 或者相关的收单行联系）
     * upacp_wap payment channel ( This is a channel open for merchant joining upacp after 20150101 )
     */
    const UPACP_WAP = 'upacp_wap';
    
    /**
     * 银联网关支付，即银联 PC 网页支付
     * upacp pc payment channel
     */
    const UPACP_PC = 'upacp_pc';
    
    /**
     * 微信 APP 支付
     * wechat app payment channel
     */
    const WX = 'wx';
    
    /**
     * 微信公众号支付
     * wechat pub payment and transfer channel
     */
    const WX_PUB = 'wx_pub';

    /**
     * 微信公众号扫码支付
     * wechat pub qr payment channel
     */
    const WX_PUB_QR = 'wx_pub_qr';

    /**
     * 微信 WAP 支付（此渠道仅针对特定客户开放）
     * wechat wap payment channel (only available to special merchants)
     */
    const WX_WAP = 'wx_wap';

    /**
     * 微信小程序支付
     */
    const WX_LITE = 'wx_lite';

    /**
     * 易宝手机网页支付
     * yeepay wap payment channel
     */
    const YEEPAY_WAP = 'yeepay_wap';

    /**
     * 京东支付（Transfer）
     */
    const JDPAY = 'jdpay';

    /**
     * 京东手机网页支付
     * jdpay wap payment channel
     */
    const JDPAY_WAP = 'jdpay_wap';

    /**
     * 分期乐支付
     * FenQiLe payment channel
     */
    const FQLPAY_WAP = 'fqlpay_wap';

    /**
     * 量化派支付
     * LiangHuaPai payment channel
     */
    const QGBC_WAP = 'qgbc_wap';

    /**
     * 招行一网通
     * cmb wallet payment channel
     */
    const CMB_WALLET = 'cmb_wallet';

    /**
     * Apple Pay payment channel
     */
    const APPLEPAY_UPACP = 'applepay_upacp';

    /**
     * 么么贷
     * MeMeDai payment channel
     */
    const MMDPAY_WAP = 'mmdpay_wap';

    /**
     * QQ 钱包支付
     * QQ wallet payment channel
     */
    const QPAY = 'qpay';

    /**
     * unionpay
     * unionpay transfer channel
     */
    const UNIONPAY = 'unionpay';

    /**
     * 通联代付(Transfer)
     */
    const ALLINPAY = 'allinpay';

    /**
     * 线下扫码（主扫）
     */
    const ISV_QR = 'isv_qr';

    /**
     * 线下扫码（被扫）
     */
    const ISV_SCAN = 'isv_scan';

    /**
     * 线下扫码（固定码）
     */
    const ISV_WAP = 'isv_wap';

}