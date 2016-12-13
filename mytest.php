<?php
/**
@author: phoenix
@date: 2016/11/29
@time: 上午11:57
 *
    // 100%完全兼容，更为优雅（处理 success url) 的sdk替代 ，更为健壮（unit test)，国际化, 更科学的传参设计
    // why and when?  一键从 stripe 切换
    // 承诺保持升级
 */



try {



    // // 查询 Charge 列表
//        $transaction = $gateway->fetchTransactionList(array(
//            'appId' => 'app_9SSaPOaDuPCKvHSy',
//            'channel' => Channels::ALIPAY,
//            'paid' => 0,
//            'refunded' => 0,
//            'createdFrom' => 1481116461,
//            'createdTo' => 1477723630,
//            'limit' => 2,
//        ));
//        $response = $transaction->send();
//        $data = $response->getData();
//        echo json_encode($data);die;


    // 退款
//    $refund = $gateway->refund(array(
//        'amount'                   => '10.00',
//        'transactionReference'     => 'ch_DaHuXHjHeX98GO84COzbfTiP',
//        'description'              => 'test refund description',
//        'metadata'                 => [],
//    ));
//    $response = $refund->send();
//    if ($response->isSuccessful()) {
//        $refund_id = $response->getTransactionReference();
//        echo "Transaction reference = " . $refund_id . PHP_EOL;
//    } else {
//        print_r($response->getMessage());
//        echo 'fail';
//    }


    // // 单笔退款查询
    /**
     * @var \Omnipay\Pingpp\Message\FetchRefundRequest $refund
     */
//    $refund = $gateway->fetchRefund(array(
//        'transactionReference' => 'ch_qDun9KKC0uz9G0KSGKaHKybP',
//        'refundReference' => 're_Ouz5GSfv1Gm1S4WzTCaXXPSK_',
//    ));
//    // $refund->setTransactionReference('ch_qDun9KKC0uz9G0KSGKaHKybP');
//    // $refund->setRefundReference('re_Ouz5GSfv1Gm1S4WzTCaXXPSK_');
//    $response = $refund->send();
//    $data = $response->getData();
//    echo json_encode($data);die;

    // 查询退款列表
//    $refundList = $gateway->fetchRefundList(array(
//        'transactionReference' => 'ch_qDun9KKC0uz9G0KSGKaHKybP',
//        'limit' => 2,
//    ));
//    $response = $refundList->send();
//    $data = $response->getData();
//    echo json_encode($data);die;


    // 创建批量退款
//    $batchRefund = $gateway->batchRefund(array(
//        'app'          => $appId,
//        'batchRefundReference'      => Helpers::generateBatchRefundReference(),
//        'chargeIdList' => array(
//            'ch_L8qn10mLmr1GS8e5OODmHaL4',
//            'ch_fdOmHaLmLmr1GOD4qn1dS8e5',
//        ),
//        'description'  => 'Batch refund description.', // optional
//        'metadata'     => array( // optional
//            'foo' => 'bar'
//        ),
//    ));
//    $response = $batchRefund->send();
//    if ($response->isSuccessful()) {
//        echo $response->getData();
//    } else {
//        print_r($response->getMessage());
//        echo 'fail';
//    }

    // // 查询单个批量退款批次号
    /**
     * @var \Omnipay\Pingpp\Message\FetchBatchRefundRequest $batchRefund
     */
//    $batchRefund = $gateway->fetchBatchRefund();
//    $batchRefund->setBatchRefundReference('batch_refund_20160801001');
//    $response = $batchRefund->send();
//    $data = $response->getData();
//    echo json_encode($data);die;

    // 查询批量退款列表
//    $batchRefundList = $gateway->fetchBatchRefundList(array(
//        'appId' => $appId,
//        'limit' => 2,
//    ));
//    $response = $batchRefundList->send();
//    $data = $response->getData();
//    echo json_encode($data);die;

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

