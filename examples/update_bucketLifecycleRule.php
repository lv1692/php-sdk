<?php
require_once __DIR__ . '/../autoload.php';

use Qiniu\Auth;

// 控制台获取密钥：https://portal.qiniu.com/user/key
$accessKey = getenv('QINIU_ACCESS_KEY');
$secretKey = getenv('QINIU_SECRET_KEY');

$auth = new Auth($accessKey, $secretKey);
$config = new \Qiniu\Config();
$bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);

// 存储空间 - 更新生命周期规则
// 参考文档：https://developer.qiniu.com/kodo/manual/3699/life-cycle-management

$bucket = 'xxxx';
$name = 'demo';
$prefix = 'test';
$delete_after_days = 90;
$to_line_after_days =80;

list($Info, $err) = $bucketManager->updateBucketLifecycleRule(
    $bucket,
    $name,
    $prefix,
    $delete_after_days,
    $to_line_after_days
);
if ($err) {
    print_r($err);
} else {
    print_r($Info);
}
