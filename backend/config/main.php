<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['debug'],
    'modules' => ['gridview' => [ 'class' => '\kartik\grid\Module' ],
        [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['*'],]
        ],
    'components' => [
//        'webpusher' => [
//            'class' => 'bariew\yii2Pusher\Component',
//            'app_id' => '852603', // get your credentials on pusher.com
//            'key' => 'b74b2a7b6e7227ac3e8e',
//            'secret' => '120e83cf3ac7d305651d',
//            'options'   => [
//                'encrypted' => false,
//                'cluster' => "mt1"
//            ],
//        ],
//        'firebase' => [
//            'class'=>'grptx\Firebase\Firebase',
//            'credential_file'=>'backend/secure/sao-do-group-2af2353dee8c.json', // (see https://firebase.google.com/docs/admin/setup#add_firebase_to_your_app)
//            'database_uri'=>'https://sao-do-group.firebaseio.com/', // (optional)
//        ],
//        'mail' => [
//            'class' => 'yashop\ses\Mailer',
//            'access_key' => 'AKIAIF47GOAH7TA26BKQ',// '',//'AKIAJRGM5I5NSEIKG53A',
//            'secret_key' => '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',//'',//'Nq8TbCGeMtlVq5PPr/9900uo0sx2bUWVfmyPpEae',
//            //'host' => 'eu-west-1.amazonses.com' // not required
//        ],
//        'mailer' => [
//            'class' => 'boundstate\mailgun\Mailer',
//            'key' => 'f63796ff053dba3d0d4dc262fdd31826-6140bac2-7d69294a',
//            'domain' => 'app.ranvang.com',
//        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@backend/themes/qltk2'
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        /*'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],*/
    ],
    'params' => $params,

];


