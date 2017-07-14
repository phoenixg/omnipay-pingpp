<?php
/**
 * Created by PhpStorm.
 * User: phx
 * Date: 2017/7/14
 * Time: 下午4:12
 */

$channel = 'your_channel';

if ($channel == 'alipay') {
    return [
        [
            // 必须，接收者支付宝账号。
            'account' => 'account01@alipay.com',

            // 必须，金额，单位为分。
            'amount' => 5000,

            // 必须，接收者姓名。
            'name' => '张三',

            // 可选，批量企业付款描述，最多 200 字节。
            // 'description' => '描述',

            // 可选，账户类型，alipay 2.0 渠道会用到此字段，取值范围： 1、ALIPAY_USERID：支付宝账号对应的支付宝唯一用户号。以2088开头的16位纯数字组成。 2、ALIPAY_LOGONID（默认值）：支付宝登录号，支持邮箱和手机号格式。
            // 'account_type' => 'ALIPAY_LOGONID',

            // 可选，订单号， 1 ~ 64 位不能重复的数字字母组合。
            // 'order_no' => '123456789'
        ],
        [
            'account' => 'account02@alipay.com',
            'amount'  => 3000,
            'name'    => '李四'
        ]
    ];
}

if ($channel == 'wx_pub') {
    return [
        [
            // 必须，接收者 id，为用户在 wx_pub 下的 open_id。
            'open_id' => 'openidxxxxxxxxxxxx',

            // 必须，金额，单位为分。
            'amount' => 5000,

            // 可选，收款人姓名。当该参数为空，则不校验收款人姓名。
            // 'name' => '张三',

            // 可选，批量企业付款描述，最多 99 个英文和数字的组合或最多 33 个中文字符，不可以包含特殊字符。不填默认使用外层参数中的 description。
            // 'description' => '描述',

            // 可选，是否强制校验收款人姓名。布尔类型，仅当 name 参数不为空时该参数生效。
            // 'force_check' => false,

            // 可选，订单号， 1 ~ 32 位不能重复的数字字母组合。
            // 'order_no' => '123456789'
        ],
        [
            'open_id' => 'openidxxxxxxxxxxxx',
            'amount'  => 5000,
        ]
    ];
}


if ($channel == 'jdpay') {
    return [
        [
            // 必须，接收者银行卡账号。
            'account' => '656565656565656565656565',

            // 必须，金额，单位为分。
            'amount' => 5000,

            // 必须，接收者姓名。
            'name' => '张三',

            // 必须，4位，开户银行编号。具体值参考此链接：https://www.pingxx.com/api#%E9%93%B6%E8%A1%8C%E7%BC%96%E5%8F%B7%E8%AF%B4%E6%98%8E
            'open_bank_code' => '0308',

            // 可选，批量付款描述，最多 100 个 Unicode 字符。
            // 'description' => '描述',

            // 可选，订单号，jdpay 限长1-64位不能重复的数字字母组合。
            // 'order_no' => '12345678'
        ],
        [
            'account'           => '656565656565656565656565',
            'amount'            => 3000,
            'name'              => '李四',
            'open_bank_code'    => '0308',
        ]
    ];
}

if ($channel == 'unionpay') {
    return [
        [
            // 必须，接收者银行卡账号。
            'account' => '656565656565656565656565',

            // 必须，金额，单位为分。
            'amount' => 5000,

            // 必须，接收者姓名。
            'name' => '张三',

            // 可选，批量企业付款描述，最多 200 字节。
            // 'description' => '描述',

            /**
             * open_bank_code 和 open_bank 两个参数必传一个，建议使用 open_bank_code ，若都传参则优先使用 open_bank_code 读取规则。
             * 具体值参考此链接：https://www.pingxx.com/api#%E9%93%B6%E8%A1%8C%E7%BC%96%E5%8F%B7%E8%AF%B4%E6%98%8E
             */

            // 条件可选，1~50位，开户银行。
            'open_bank' => '招商银行',

            // 条件可选，4位，开户银行编号。
            'open_bank_code' => '0308',

            // 可选，订单号， 1 ~ 16 位数字。
            // 'order_no' => '123456789'
        ],
        [
            'account'           => '656565656565656565656565',
            'amount'            => 3000,
            'name'              => '李四',
            'open_bank'         => '招商银行',
            'open_bank_code'    => '0308',
        ]
    ];
}

if ($channel == 'allinpay') {
    return [
        [
            // 必须，接收者银行卡账号。
            'account' => '656565656565656565656565',

            // 必须，金额，单位为分。
            'amount' => 5000,

            // 必须，接收者姓名。
            'name' => '张三',

            // 必须，4位，开户银行编号。具体值参考此链接：https://www.pingxx.com/api#%E9%93%B6%E8%A1%8C%E7%BC%96%E5%8F%B7%E8%AF%B4%E6%98%8E
            'open_bank_code' => '0308',

            // 可选，批量付款描述，最多 30 个 Unicode 字符。
            // 'description' => '描述',

            // 可选，业务代码，allinpay 渠道会用到此字段，5位，根据通联业务人员提供，不填使用通联提供默认值09900。
            // 'business_code' => '09900',

            // 可选，银行卡号类型，allinpay 渠道会用到此字段，0：银行卡、1：存折，不填默认使用银行卡。
            // 'card_type' => 0,

            // 可选，订单号， 20 ~ 40 位不能重复的数字字母组合（必须以通联的商户号开头，建议组合格式：通联商户号 + 时间戳 + 固定位数顺序流水号，不包含+号），这里不传的话程序会调用商户的通联商户号加上随机数自动生成 order_no。
            // 'order_no' => '321101234554321098765432112'
        ],
        [
            'account'           => '656565656565656565656565',
            'amount'            => 3000,
            'name'              => '李四',
            'open_bank_code'    => '0308',
        ]
    ];
}
