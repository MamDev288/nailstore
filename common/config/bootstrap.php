<?php
\Yii::$container->set('yii\data\Pagination', [
//    'pageSizeLimit' => [1, 21],
    'defaultPageSize' => 50
]);
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@ajaxcrud', dirname(dirname(__DIR__)).'/vendor/johnitvn/yii2-ajaxcrud/src');
Yii::setAlias('@npm', dirname(__DIR__).'/node_modules');
Yii::setAlias('@backend\zklib', dirname(dirname(__DIR__)) . '/backend/zklib');
Yii::setAlias('@Carbon', dirname(dirname(__DIR__)) . '/vendor/nesbot/carbon/src/Carbon/');
Yii::setAlias('@kartik/date', dirname(dirname(__DIR__)) . '/vendor/kartik-v/yii2-widget-datepicker/src/');
Yii::setAlias('@Swift_SmtpTransport', dirname(dirname(__DIR__)) . '/vendor/swiftmailer/swiftmailer/lib/classes/Swift/SmtpTransport.php');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');


