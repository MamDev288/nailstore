<?php
use yii\helpers\Url;

return [

    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'STT',
        'width' => '30px',
        'headerOptions' => ['class' => 'text-primary'],
    ],

    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'nhom',
        'filter' => \yii\helpers\Html::activeDropDownList(
            $searchModel, 'nhom',
            \yii\helpers\ArrayHelper::map(
                \backend\models\ChucNang::find()->all(),
                'nhom', 'nhom'
            ), [
                'class' => 'form-control',
                'prompt' => 'Tất cả'
            ]
        )
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'controller_action',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'value' => function($data){
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update','id'=>$data->id]), ['class' => 'text-gray','role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip']);
        },
        'label' => 'Sửa',
        'format' => 'raw',
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xóa',
        'value' => function($data){
            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['chuc-nang/delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ]

];   
