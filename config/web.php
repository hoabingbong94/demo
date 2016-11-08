<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'          =>'vi',
    //Cau hinh module
    'modules' => [
        'app90phut' => [
            'class' => 'app\modules\app90phut\Module',
        ],
        'app433' => [
            'class' => 'app\modules\app433\Module',
            'layout'=>'post'
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout'=>'default'
        ],

        'saoplus' => [
            'class' => 'app\modules\saoplus\Module',
            'layout'=> 'site'
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xsaf22323rsdfs',
        ],
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
         'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['admin/user/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
       /* 'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
        //'rules' => $router
        ],*/
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
//            'userTable' => 'Admin',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'db2' => require(__DIR__ . '/db90phut.php'),
        'db3' => require(__DIR__ . '/dbsaoplus.php'),
    
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
