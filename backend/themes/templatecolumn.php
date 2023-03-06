<?php
return[
    [
        'header' => 'Xem',
        'value' => function($data){
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::to(['view', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary btn-xem-chi-tiet-phieu-dang-ki',
                'data-value' => $data->id
            ]);
        },
        'format' => 'raw',
        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['class' => 'text-primary', 'width' => '1%']
    ],


    [
        'header' => 'Sửa',
        'value' => function($data) {
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2']);
        },
        'format' => 'raw',
        'headerOptions' => ['width' => '3%', 'class' => 'text-center text-primary'],
        'contentOptions' => ['class' => 'text-center']
    ],
    [
        'header' => 'Hủy',
        'vAlign'=>'top',
        'headerOptions' => ['class' => 'text-center text-primary', 'width' => '1%'],
        'contentOptions' => ['class' => 'text-center'],
        'value' => function($data){

            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ],
];