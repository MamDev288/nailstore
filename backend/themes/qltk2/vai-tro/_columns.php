<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'STT',
        'width' => '5%',
        'headerOptions' => ['class' => 'text-primary'],
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'value' => function($data){
            return \yii\bootstrap\Html::a('<i class="fa fa-eye"></i>',Url::to(['view','id'=>$data->id]), ['class' => 'text-gray','role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip']);
        },
        'label' => 'Xem',
        'format' => 'raw',
        'width' => '5%',
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'value' => function($data){
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update','id'=>$data->id]), ['class' => 'text-gray','role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip']);
        },
        'label' => 'Sửa',
        'format' => 'raw',
        'width' => '5%',
    ],

];   