<?php
require_once __DIR__ . '/../autoload.php';

use \Qiniu\Auth;

// 控制台获取密钥：https://portal.qiniu.com/user/key
$accessKey = getenv('QINIU_ACCESS_KEY');
$secretKey = getenv('QINIU_SECRET_KEY');
$bucket = getenv('QINIU_TEST_BUCKET');


$auth = new Auth($accessKey, $secretKey);
$config = new \Qiniu\Config();
$bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);

// 批量修改文件存储类型，每次最多不能超过 1000 个

$keys = array(
    'qiniu.mp4',
    'qiniu.png',
    'qiniu.jpg'
);

$keyTypePairs = array();

// type=0表示普通存储，type=1表示低频存储
foreach ($keys as $key) {
    $keyTypePairs[$key] = 1;
}

$ops = $bucketManager->buildBatchChangeType($bucket, $keyTypePairs);
list($ret, $err) = $bucketManager->batch($ops);
if ($err) {
    print_r($err);
} else {
    print_r($ret);
}
