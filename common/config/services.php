<?php

return [
    \common\services\PhongBanServiceInterface::ServiceName => [
        'class' => \common\services\PhongBanService::className(),
    ],
    \common\services\QuanLyPhongBanServiceInterface::ServiceName => [
        'class' => \common\services\QuanLyPhongBanService::className(),
    ],
    \common\services\PhanQuyenServiceInterface::ServiceName => [
        'class' => \common\services\PhanQuyenService::className()
    ]
];