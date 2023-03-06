<?php

namespace console\controllers;

use backend\services\LogService;
use backend\services\PhongBanService;
use backend\services\QueueService;
use backend\services\VaiTroService;
use yii\console\Controller;

class QueueController extends Controller
{
    public function actionIndex()
    {
        return QueueService::runQueue();
    }
}