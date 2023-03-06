<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'format' => ["datetime", "php:d/m/Y"],
        'attribute'=>'ngay_nghi',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'thu_trong_tuan',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'loai_ngay_nghi',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'format' => 'raw',
        'value' => function($data){
            return $data->nghi_co_luong ? "<i class='fa fa-check text-success'></i>" : "";
        },
        'attribute'=>'nghi_co_luong',
        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['class' => 'text-center'],
    ],
    [
        'class'=>'\backend\components\Grid\NumberColumn',
        'attribute'=>'phan_tram_huong_luong',
    ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'kieu_nghi_trong_ngay',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'active',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'update_by',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'update_at',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'create_at',
    // ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function($data){
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['view', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary btn-xem-chi-tiet',
                'data-value' => $data->id
            ]);
        },
        'format' => 'raw',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data) {
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::toRoute(['update', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip']);
        },
        'format' => 'raw',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Hủy',
        'value' => function($data){
            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ],

];   