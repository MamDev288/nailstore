<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
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
        'attribute'=>'name',
    ],
    [
        'class'=>'\backend\components\Grid\NumberColumn',
        'attribute'=>'thoi_han',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'don_vi_tinh',
    ],
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
        'width' => '5%'
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data) {
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2']);
        },
        'format' => 'raw',
        'width' => '5%'
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xóa',
        'width' => '5%',
        'format' => 'raw',
        'value' => function($data) {
            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
        },
    ],
];   