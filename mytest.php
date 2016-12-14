<?php
/**
@author: phoenix
@date: 2016/11/29
@time: 上午11:57
 *
    // 100%完全兼容，更为优雅（处理 success url) 的sdk替代 ，更为健壮（unit test)，国际化, 更科学的传参设计
    // why and when?  一键从 stripe 切换，命名更为一致
    // 承诺保持升级
 */



try {




    // 发送红包
//    $redEnvelope = $gateway->redEnvelope(array(
//        'appId' => $appId,
//        'transactionId' => Helpers::generateRedEnvelopeTransactionId(),
//        'channel'     => Channels::WX, // only support "wx", "wx_pub" channel
//        'subject' => 'Here is demo subject',
//        'body' => 'Here is demo body',
//        'description' => 'Here is demo description', // optional
//        'amount' => 0.01, // 0.01 RMB
//        'currency' => 'cny',
//        'sender' =>  'Sender Name', // 商户名称，最多 32 个字节
//        'receiver' => 'Wechat Openid',
//        'metadata' => array(['foo' => 'bar']), // optional
//    ));
//
//    /**
//     * @var \Omnipay\Pingpp\Message\Response $response
//     */
//    $response = $redEnvelope->send();
//    if ($response->isSuccessful()) {
//        echo json_encode($response->getData());die;
//    }

    // // 查询单笔红包
//    $redEnvelopeTransaction = $gateway->fetchRedEnvelope();
//    $redEnvelopeTransaction->setTransactionReference('red_KCabLO58W5G0rX90iT0az5a9');
//    $response = $redEnvelopeTransaction->send();
//    $data = $response->getData();
//    echo json_encode($data);die;

    // 查询红包列表
//    $redEnvelopeList = $gateway->fetchRedEnvelopeList(array(
//        'appId' => $appId,
//        'limit' => 2,
//    ));
//    $response = $redEnvelopeList->send();
//    $data = $response->getData();
//    echo json_encode($data);die;

    // // 创建 Transfer
//    $transfer = $gateway->transfer(array(
//        'appId' => $appId,
//        'channel' => Channels::WX_PUB, // only support "unionpay", "wx_pub" channel
//        'channelExtraFields' => array( // optional, different by channel
//            'user_name' => 'User Name',
//            'force_check' => true
//        ),
//        'transactionId' => Helpers::generateTransferTransactionId(Channels::WX_PUB),
//        'description' => 'testing',
//        'amount' => 0.01, // 0.01 RMB
//        'currency' => 'cny',
//        'type' => 'b2c',
//        'receiver' => 'Wechat Openid', // optional, different by channel
//        'metadata' => array('foo' => 'bar'), // optional
//    ));
//
//    /**
//     * @var \Omnipay\Pingpp\Message\Response $response
//     */
//    $response = $transfer->send();
//    if ($response->isSuccessful()) {
//        $reference_id = $response->getTransactionReference();
//        echo json_encode($response->getData());die;
//    }

    // // 查询单笔 Transfer
//    $transfer = $gateway->fetchTransfer();
//    $transfer->setTransactionReference('ch_DaHuXHjHeX98GO84COzbfTiP');
//    $response = $transfer->send();
//    $data = $response->getData();
//    echo json_encode($data);die;

    // 查询 Transfer 列表
//    $transferList = $gateway->fetchTransferList(array(
//        'appId' => $appId,
//        'limit' => 2,
//    ));
//    $response = $transferList->send();
//    $data = $response->getData();
//    echo json_encode($data);die;

    // 取消 Transfer
//    $cancel = $gateway->cancelTransfer(array(
//        'transactionReference'     => 'tr_0eTi1OGqr9iH0i9CePf1a9C0', // only support "unionpay" channel
//    ));
//    $response = $cancel->send();

    

} catch (RuntimeException $e) {
    echo 'RuntimeException'.PHP_EOL.$e->getMessage();
} catch (Exception $e) {
    echo 'Exception'.PHP_EOL.$e->getMessage();
}

