<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
        'header' => 'STT',
        'headerOptions' => ['class' => 'text-primary']
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'name',
        'label' => 'Tên'
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ghi_chu',
        'headerOptions' => ['width' => '3%']
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'value' => function($data){
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update','id'=>$data->id]), ['class' => 'text-gray']);
        },
        'label' => 'Sửa',
        'format' => 'raw',
        'width' => '5%'
    ],
];   
