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
        'format'=> ['datetime', 'php:m/Y'],
        'attribute'=>'thang_nam',
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm',
                'startView'=>'year',
                'minViewMode'=>'months',
            ],
        ],
        'filterType' => \kartik\grid\GridView::FILTER_DATE
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'trang_thai',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'hoten',
    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'attribute'=>'created',
    ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'ngay_cham_luong',
    // ],
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


    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data) {
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2']);
        },
        'format' => 'raw',
    ],

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