<?php
/**
 * Created by PhpStorm.
 * User: phx
 * Date: 2017/7/14
 * Time: 下午4:20
 */

use Omnipay\Pingpp\Common\Channels;

$channel = 'your_charge_channel';
if ($channel == Channels::ALIPAY) {
    return [
        // 可选，开放平台返回的包含账户信息的 token（授权令牌，商户在一定时间内对支付宝某些服务的访问权限）。通过授权登录后获取的  alipay_open_id ，作为该参数的  value ，登录授权账户即会为支付账户，32 位字符串。
        //'extern_token'  => '',

        // 可选，是否发起实名校验，T 代表发起实名校验；F 代表不发起实名校验。
        'rn_check'      => 'T',
    ];
}

if ($channel == Channels::ALIPAY_PC_DIRECT) {
    return [
        // 必须，支付成功的回调地址，在本地测试不要写 localhost ，请写 127.0.0.1。URL 后面不要加自定义参数。
        'success_url' => 'http://example.com/success',

        // 可选，是否开启防钓鱼网站的验证参数（如果已申请开通防钓鱼时间戳验证，则此字段必填）。
        'enable_anti_phishing_key' => false,

        // 可选，客户端 IP ，用户在创建交易时，该用户当前所使用机器的IP（如果商户申请后台开通防钓鱼IP地址检查选项，此字段必填，校验用）。
        //'exter_invoke_ip' => '8.8.8.8',
    ];
}

if ($channel == Channels::ALIPAY_WAP) {
    return [
        // 必须，支付成功的回调地址，在本地测试不要写 localhost ，请写 127.0.0.1。URL 后面不要加自定义参数。
        'success_url' => 'http://example.com/success',

        // 可选，支付取消的回调地址， app_pay 为true时，该字段无效，在本地测试不要写 localhost ，请写 127.0.0.1。URL 后面不要加自定义参数。
        'cancel_url' => 'http://example.com/cancel',

        // 可选，2016 年 6 月 16 日之前登录 Ping++ 管理平台填写支付宝手机网站的渠道参数的旧接口商户，需要更新接口时设置此参数值为true，6月16号后接入的新接口商户不需要设置该参数。
        //'new_version' => true,

        // 可选，是否使用支付宝客户端支付，该参数为true时，调用客户端支付。
        //'app_pay' => true,
    ];
}

if ($channel == Channels::APPLEPAY_UPACP) {
    return [];
}

if ($channel == Channels::BFB_WAP) {
    return [
        // 必须，支付成功的回调地址，在本地测试不要写 localhost ，请写 127.0.0.1。URL 后面不要加自定义参数。
        'result_url' => 'http://example.com/success',

        // 必须，是否需要登录百度钱包来进行支付。
        'bfb_login' => true,
    ];
}

if ($channel == Channels::CMB_WALLET) {
    return [
        // 必须，交易完成跳转的地址。
        'result_url' => 'http://example.com/success',

        /**
         * 对于 p_no, seq , m_uid , mobile 这几个参数：
         * 1. 这几个参数是用户自定义的。
         * 2. 对于同一个终端用户每次请求 charge 务必使用同一套参数（确保每个参数都不变），
         * 任意参数变更都会导致用户重新签约，同一个用户和招行重新签约的次数有限制，超限制就会无法签约 ，导致用户无法使用。
         */

        // 必须，客户协议号，不超过 30 位的纯数字字符串。
        'p_no' => 'your p_no',

        // 必须，协议开通请求流水号，不超过 20 位的纯数字字符串，请保证系统内唯一。
        'seq' => 'your seq',

        // 必须，协议用户 ID，不超过 20 位的纯数字字符串。
        'm_uid' => 'your m_uid',

        // 必须，协议手机号，11 位数字。
        'mobile' => 'your mobile',
    ];
}

if ($channel == Channels::FQLPAY_WAP) {
    return [
        // 必须，子商户编号，需要提交该订单商户的所属子商户编号。
        'c_merch_id' => 'your c_merch_id',

        // 可选，前端回调地址，交易完成跳转的链接，不能带自定义参数。
        'return_url' => 'http://example.com/success',
    ];
}

if ($channel == Channels::JDPAY_WAP) {
    return [
        // 必须，支付完成的回调地址。
        'success_url' => 'http://example.com/success',

        // 必须，支付失败页面跳转路径。
        'fail_url' => 'http://example.com/fail',

        // 可选，用户交易令牌，用于识别用户信息，支付成功后会调用 success_url 返回给商户。商户可以记录这个  token 值，当用户再次支付的时候传入该  token ，用户无需再次输入银行卡信息，直接输入短信验证码进行支付。32 位字符串。
        //'token' => 'dsafadsfasdfadsjuyhfnhujkijunhaf',

        // 可选，订单类型，值为0表示实物商品订单，值为 1 代表虚拟商品订单，该参数默认值为 0 。
        'order_type' => 0,

        // 可选，设置是否通过手机端发起支付，值为  true 时调用手机 h5 支付页面，值为  false 时调用 PC 端支付页面，该参数默认值为  true 。
        'is_mobile' => true,

        // 可选，用户账号类型，取值只能为：BIZ。传参存在问题请参考 帮助中心：https://help.pingxx.com/article/1012535/。
        //'user_type' => 'BIZ',

        // 可选，商户的用户账号。传参存在问题请参考 帮助中心：https://help.pingxx.com/article/1012535/。
        //'user_id' => 'your user_id',
    ];
}

if ($channel == Channels::MMDPAY_WAP) {
    return [
        // 必须，手机号。
        'phone' => 'your phone',

        // 必须，身份证号。
        'id_no' => 'your id_no',

        // 必须，真实姓名。
        'name' => 'your name',
    ];
}

if ($channel == Channels::QGBC_WAP) {
    return [
        // 必须，手机号码。
        'phone' => 'your phone',

        // 可选，交易完成跳转的地址。
        'return_url' => 'http://example.com/success',

        // 可选，分期参数，0 代表不分期，1 代表分 3 期，2 代表分 6 期，3 代表分 9 期，4 代表分 12 期。
        'term' => 0,

        // 可选，账户激活中状态跳转链接。
        'activate_url' => 'http://example.com/activate_url',

        // 可选，是否显示量化派页面顶部 header，即是否显示 H5 顶部标题栏，默认为  true 时显示。
        'has_header' => true,
    ];
}

if ($channel == Channels::QPAY) {
    return [
        // 必须，客户端设备类型，取值范围: "ios" ，"android"。
        'device' => 'ios',
    ];
}

if ($channel == Channels::UPACP) {
    return [
    ];
}

if ($channel == Channels::UPACP_PC) {
    return [
        // 必须，支付成功的回调地址，在本地测试不要写 localhost ，请写 127.0.0.1。URL 后面不要加自定义参数。
        'result_url' => 'http://example.com/success',
    ];
}

if ($channel == Channels::UPACP_WAP) {
    return [
        // 必须，支付成功的回调地址，在本地测试不要写 localhost ，请写 127.0.0.1。URL 后面不要加自定义参数。
        'result_url' => 'http://example.com/success',
    ];
}

if ($channel == Channels::WX) {
    return [
        // 可选，指定支付方式，指定不能使用信用卡支付可设置为 no_credit 。
        'limit_pay' => 'no_credit',

        // 可选，商品标记，代金券或立减优惠功能的参数。
        //'goods_tag' => 'your goods_tag',
    ];
}

if ($channel == Channels::WX_LITE) {
    return [
        // 可选，指定支付方式，指定不能使用信用卡支付可设置为 no_credit 。
        'limit_pay' => 'no_credit',

        // 可选，商品标记，代金券或立减优惠功能的参数。
        //'goods_tag' => 'your goods_tag',

        // 必须，用户在商户 appid 下的唯一标识。
        'open_id' => 'openidxxxxxxxxxxxx',
    ];
}

if ($channel == Channels::WX_PUB) {
    return [
        // 可选，指定支付方式，指定不能使用信用卡支付可设置为 no_credit 。
        'limit_pay' => 'no_credit',

        // 可选，商品标记，代金券或立减优惠功能的参数。
        //'goods_tag' => 'your goods_tag',

        // 必须，用户在商户 appid 下的唯一标识。
        'open_id' => 'openidxxxxxxxxxxxx',
    ];
}

if ($channel == Channels::WX_PUB_QR) {
    return [
        // 可选，指定支付方式，指定不能使用信用卡支付可设置为 no_credit 。
        'limit_pay' => 'no_credit',

        // 可选，商品标记，代金券或立减优惠功能的参数。
        //'goods_tag' => 'your goods_tag',

        // 必须，商品 ID，1-32 位字符串。此 id 为二维码中包含的商品 ID，商户可自定义。
        'product_id' => 'your product id',
    ];
}

if ($channel == Channels::WX_WAP) {
    return [
        // 可选，支付完成的回调地址。
        'result_url' => 'http://example.com/success',

        // 可选，商品标记，代金券或立减优惠功能的参数。
        //'goods_tag' => 'your goods_tag',
    ];
}

if ($channel == Channels::YEEPAY_WAP) {
    return [
        // 必须，商品类别码，商品类别码参考链接 ：https://www.pingxx.com/api#%E6%98%93%E5%AE%9D%E6%94%AF%E4%BB%98%E5%95%86%E5%93%81%E7%B1%BB%E5%9E%8B%E7%A0%81 。
        'product_category' => '1',

        // 必须，用户标识,商户生成的用户账号唯一标识，最长 50 位字符串。
        'identity_id' => 'your identity_id',

        // 必须，用户标识类型，用户标识类型参考链接：https://www.pingxx.com/api#%E6%98%93%E5%AE%9D%E6%94%AF%E4%BB%98%E7%94%A8%E6%88%B7%E6%A0%87%E8%AF%86%E7%B1%BB%E5%9E%8B%E7%A0%81 。
        'identity_type' => 1,

        // 必须，终端类型，对应取值 0:IMEI, 1:MAC, 2:UUID, 3:other。
        'terminal_type' => 1,

        // 必须，终端 ID。
        'terminal_id' => 'your terminal_id',

        // 必须，用户使用的移动终端的 UserAgent 信息。
        'user_ua' => 'your user_ua',

        // 必须，前台通知地址。
        'result_url' => 'http://example.com/success',
    ];
}




