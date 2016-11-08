<?php

date_default_timezone_set("Asia/Ho_Chi_Minh");
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
define("PathUpload", str_replace("\\", "/", __DIR__) . "/");

define("Path_Upload_90phut", str_replace("\\", "/", __DIR__) . "/" . "cms_upload/");
define("Path_Upload_Saoplus", str_replace("\\", "/", __DIR__) . "/" ."saoplus/");

require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../vendor/autoload.php');
$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
