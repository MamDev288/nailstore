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
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'vi_tri',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'phong_ban_id',
        'value' => function($data){
            return isset($data->phongBan) ? $data->phongBan->name : '';
        }
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function($data){
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::to(['view', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary',
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
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Hủy',
        'value' => function($data){
            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ],

];   