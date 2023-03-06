<?php

use backend\helpers\NumberHelper;
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
        'attribute'=>'thang_nam',
        'format' => ['datetime', 'php:m/Y'],
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'autoClose' => true,
                'format' => 'yyyy-mm',
                'startView' => 'year',
                'minViewMode' => 'months'
            ]
        ],
        'filterType' => \kartik\grid\GridView::FILTER_DATE
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'hoten',
    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'attribute'=>'created',
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'autoClose' => true,
                'format' => 'yyyy-mm-dd',
                'startView' => 'year',
                'minViewMode' => 'days'
            ]
        ],
        'filterType' => \kartik\grid\GridView::FILTER_DATE
    ],
    [
        'class'=>'\backend\components\Grid\CurrencyColumn',
        'attribute'=>'tong_tien',
    ],

//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'updated',
//    ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'user_created_id',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'user_updated_id',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'ghi_chu',
//     ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function($data){
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::to(['view', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary btn-xem-chi-tiet-phieu-dang-ki',
                'data-value' => $data->id
            ]);
        },
        'format' => 'raw',
    ],


//    [
//        'header' => 'Sửa',
//        'value' => function($data) {
//            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update', 'id' => $data->id]), [
//                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2']);
//        },
//        'format' => 'raw',
//        'headerOptions' => ['width' => '3%', 'class' => 'text-center text-primary'],
//        'contentOptions' => ['class' => 'text-center']
//    ],

//    [
//        'class' => 'kartik\grid\ActionColumn',
//        'dropdown' => false,
//        'template' => '{delete}',
//        'vAlign'=>'top',
//        'urlCreator' => function($action, $model, $key, $index) {
//            return Url::to([$action,'id'=>$key]);
//        },
//        'contentOptions' => ['class' => 'text-nowrap'],
//        'deleteOptions'=>[
//            'icon' => '<i class="fa fa-trash text-danger"></i>',
//            'role'=>'modal-remote','title'=>'Delete',
//            'data-confirm'=>false, 'data-method'=>'post',
//            'data-request-method'=>'post',
//            'data-toggle'=>'tooltip',
//            'data-confirm-title'=>'Are you sure?',
//            'data-confirm-message'=>'Bạn có chắc chắn xóa bản ghi này ?'],
//        'headerOptions' =>['class' => 'text-primary']
//    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Hủy',
        'value' => function($data){

            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ],

];   