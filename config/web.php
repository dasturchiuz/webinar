<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
<<<<<<< HEAD
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'KR6_Em728RNicL0uP9vS_dH4mgtzYUB8',
=======
    'name' => 'Alior.UZ',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Tashkent',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'defaultRoute' => 'product',

    'modules' => [
        'messages' => [
            'class' => 'dasturchiuz\chatroom\messages\Module',
            'roles' => ['salopm', 'dunyo'],
            'layout'=>'main'
        ],

        'administration' => [
            'class' => 'app\modules\administration\Administration',
            'layout' => 'main',
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
        ],
        'wishlist' => [
            'class' => 'halumein\wishlist\Module',
        ],
        'filemanager' => [
            'class' => 'pendalf89\filemanager\Module',
            // Upload routes
            'routes' => [
                // Base absolute path to web directory
                'baseUrl' => function () {
                    return \yii\helpers\Url::base();
                },
                // Base web directory url
                'basePath' => \Yii::$app->basePath . '\web',
                // Path for uploaded files in web directory
                'uploadPath' => 'uploads',
            ],

        ],
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'uploads/store', //path to origin images
            'imagesCachePath' => 'uploads/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            'placeHolderPath' => '@webroot/uploads/no-image.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
            'imageCompressionQuality' => 100, // Optional. Default value is 85.
        ],


    ],
    'components' => [
        'boot3remove' => [
            'class' => 'app\components\bootstrapunset\UnsetBootstrapFromMultiSelect'
        ],
        'pusher' => [
            'class' => 'app\components\Pusherone',
            'appId' => '726109',
            'appKey' => 'da79edcbc293f44f34f4',
            'appSecret' => 'fe5cfa0adc6ad443b0b1',
            'options' => ['encrypted' => true, 'cluster' => 'ap2']
        ],
        'wishlist' => [
            'class' => 'halumein\wishlist\Wishlist'
        ],
        'imagemanager' => [
            'class' => 'noam148\imagemanager\components\ImageManagerGetPath',
            //set media path (outside the web folder is possible)
            'mediaPath' => '/uploadts',
            //path relative web folder. In case of multiple environments (frontend, backend) add more paths
            'cachePath' => ['assets/images'],//, '../../frontend/web/assets/images'
            //use filename (seo friendly) for resized images else use a hash
            'useFilename' => true,
            //show full url (for example in case of a API)
            'absoluteUrl' => false,
            'databaseComponent' => 'db' // The used database component by the image manager, this defaults to the Yii::$app->db component
        ],
        'assetManager' => [
            'bundles' => [
                'halumein\wishlist\assets\WidgetAsset' => [//
                    'depends' => [
                        'yii\web\JqueryAsset',
                    ]
                ],
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],

            ],
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '0KHOnkEdrkSiJNYpEF17zUv6lkQGTWGb',

        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                'site/*',
                'admin/*',
                'some-controller/some-action',
                // The actions listed here will be allowed to everyone including guests.
                // So, 'admin/*' should not appear here in the production, of course.
                // But in the earlier stages of your development, you may probably want to
                // add a lot of actions here until you finally completed setting up rbac,
                // otherwise you may not even take a first step.
            ]
        ],
        'as beforeRequest' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['index'],
                ],
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
            'denyCallback' => function () {
                return Yii::$app->response->redirect(['account/index']);
            },
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
>>>>>>> origin/master
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
<<<<<<< HEAD
            'loginUrl' => ['auth/login']
=======
            'loginUrl' => '/account/login' // set your login path here

>>>>>>> origin/master
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
<<<<<<< HEAD
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com',
//                'username' => 'merespect4077@gmail.com',
//                'password' => 'Ytit@2018',
//                'port' => '587',
//                'encryption' => 'tls',
//            ],
//            'viewPath' => '@common/mail',
            // 'useFileTransport' => false;
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.

//            'useFileTransport' => true,
        ],
        'db' => $db,
        
=======
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'dasturchiuz@gmail.com',
                'password' => 'Dilshod@#123',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            'enableStrictParsing' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                /*'shop/<action:cart|order>'=>'shop/<action>',
                'shop/<category:[\w_-]+>/<id:[\d]+>'=>'shop/show',
                'shop/<category:[\w_-]+>'=>'shop/category',
                'shop'=>'shop/index',*/

                'product/<action: search>' => 'product/<action>',
                'product/index' => 'product/index',
                'product/search' => 'product/search',
                'product/quikview' => 'product/quikview',
                'product/<slug>' => 'product/slug',
                'shop/<store>/<action>/<slug>' => 'shop/pro',
                'shop/<slug:\w+>/<action:\w+>' => 'shop/<action>',
                'shop/<slug:\w+>' => 'shop/magazin',

                'page/<action:contact>' => 'page/<action>',
                'page/<slug>' => 'page/slug',
                //'page/<slug>'=>'page/slug',


                'product/category/<slug>' => 'product/category',
                'product/category/product/<slug>' => 'product/slug',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<id:([0-9])+>/images/image-by-item-and-alias' => 'yii2images/images/image-by-item-and-alias',
            ),
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['xatoliklar'],
                    'logFile' => '@app/runtime/logs/xatolik.log',
                ],
            ],
        ],
        'db' => $db,
        /*
>>>>>>> origin/master
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
<<<<<<< HEAD
        
    ],

    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    /*$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];*/

=======
        */
    ],
    'params' => $params,
];

if (true) {//YII_ENV_DEV
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '213.230.121.219', '::1'],
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
>>>>>>> origin/master

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
<<<<<<< HEAD
        //'allowedIPs' => ['127.0.0.1', '::1'],
=======
        'allowedIPs' => ['127.0.0.1', '213.230.121.219', '::1'],
>>>>>>> origin/master
    ];
}

return $config;
