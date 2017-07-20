<?php
/**
 * Created by PhpStorm.
 * User: phx
 * Date: 2017/7/20
 * Time: 下午4:12
 */
use Omnipay\Pingpp\Common\Channels;

$channel = 'your_transfer_channel';

if ($channel == Channels::ALIPAY) {
    return [
        // 必须，收款人姓名，1~50位。
        'recipient_name' => '张三',

        // 可选，收款方账户类型。可取值：1、 ALIPAY_USERID ：支付宝账号对应的支付宝唯一用户号。以2088开头的16位纯数字组成。 2、 ALIPAY_LOGONID （默认值）：支付宝登录号，支持邮箱和手机号格式。
        //'recipient_account_type'    => 'ALIPAY_LOGONID'
    ];
}

if ($channel == Channels::ALLINPAY) {
    return [
        // 必须，1~32位，收款人银行卡号或者存折号。
        'card_number' => '6228480402564890011',

        // 必须，1~100位，收款人姓名。
        'user_name' => '张三',

        // 必须，4位，开户银行编号，详情请参考 企业付款（银行卡）银行编号说明：https://www.pingxx.com/api#%E9%93%B6%E8%A1%8C%E7%BC%96%E5%8F%B7%E8%AF%B4%E6%98%8E。
        'open_bank_code' => '0103',

        // 可选，5位，业务代码，根据通联业务人员提供，不填使用通联提供默认值09900。
        // 'business_code' => '09900',

        // 可选，1位，银行卡号类型，0：银行卡、1：存折，不填默认使用银行卡。
        // 'card_type' => 0,
    ];
}

if ($channel == Channels::JDPAY) {
    return [
        // 必须，1~32位，收款人银行卡号或者存折号。
        'card_number' => '6228480402564890011',

        // 必须，1~100位，收款人姓名。
        'user_name' => '张三',

        // 必须，4位，开户银行编号，详情请参考 企业付款（银行卡）银行编号说明：https://www.pingxx.com/api#%E9%93%B6%E8%A1%8C%E7%BC%96%E5%8F%B7%E8%AF%B4%E6%98%8E。
        'open_bank_code' => '0103',
    ];
}

if ($channel == Channels::UNIONPAY) {
    return [
        // 必须，1~32位，收款人银行卡号或者存折号。
        'card_number' => '6228480402564890011',

        // 必须，1~100位，收款人姓名。
        'user_name' => '张三',

        /**
         * open_bank_code 和 open_bank 两个参数必传一个，建议使用 open_bank_code ，若都传参则优先使用 open_bank_code 读取规则；prov 和 city 均为可选参数，如果不传参，则使用默认值 "上海" 给渠道接口。
         */

        // 条件可选，4位，开户银行编号，详情请参考 企业付款（银行卡）银行编号说明：https://www.pingxx.com/api#%E9%93%B6%E8%A1%8C%E7%BC%96%E5%8F%B7%E8%AF%B4%E6%98%8E。
        'open_bank_code' => '0103',

        // 条件可选，1~50位，开户银行，详情请参考 企业付款（银行卡）银行编号说明：https://www.pingxx.com/api#%E9%93%B6%E8%A1%8C%E7%BC%96%E5%8F%B7%E8%AF%B4%E6%98%8E。
        'open_bank' => '农业银行',

        // 可选，1～20位，省份。
        // 'prov' => '上海',

        // 可选，1～40位，城市。
        // 'city' => '上海',

        // 可选，1～80位，开户支行名称。
        // 'sub_bank'    => '上海沪东支行'
    ];
}

if ($channel == 'wx_pub') {
    return [
        // 可选，收款人姓名。当该参数为空，则不校验收款人姓名。
        // 'user_name' => '张三',

        // 可选，是否强制校验收款人姓名。仅当  user_name 参数不为空时该参数生效。
        // 'force_check'    => true
    ];
}
