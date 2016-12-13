<?php

error_reporting(E_ALL | E_STRICT);

// include the composer autoloader
$autoloader = require __DIR__ . '/../vendor/autoload.php';

// autoload abstract TestCase classes in test directory
$autoloader->add('Omnipay', __DIR__);

define('PINGPP_ASSET_DIR', realpath(__DIR__ . '/Assets'));
define('PINGPP_SK_TEST_KEY', 'sk_test_iv5yr1HWLOqHjbjTq1KWLmD4');
define('PINGPP_SK_LIVE_KEY', '');
define('PINGPP_APP_ID', 'app_9SSaPOaDuPCKvHSy');
define('PINGPP_RSA_PRIVATE_KEY', PINGPP_ASSET_DIR . '/sample_rsa_private_key.pem');

