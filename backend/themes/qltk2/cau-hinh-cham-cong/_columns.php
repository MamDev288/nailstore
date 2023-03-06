<?php

use backend\models\search\CauHinhChamCongSearch;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $searchModel CauHinhChamCongSearch */

return [

    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
        'header' => 'STT',
        'headerOptions' => ['class' => 'text-primary']
    ],
        // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'format' => ['datetime', 'php:H:i:s'],
        'attribute'=>'standard_time',
        'filter' => '<input type="time" id="standard_time" name="CauHinhChamCongSearch[standard_time]"
       min="00:00:00" max="23:00:00" step="2" class="form-control">'
    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'format' => ['datetime', 'php:H:i:s'],
        'attribute'=>'start_time',
        'filter' => '<input type="time" id="start_time" name="CauHinhChamCongSearch[start_time]"
       min="00:00:00" max="23:00:00" step="2" class="form-control">'
    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'format' => ['datetime', 'php:H:i:s'],
        'attribute'=>'end_time',
        'filter' => '<input type="time" id="end_time" name="CauHinhChamCongSearch[end_time]"
       min="00:00:00" max="23:00:00" step="2" class="form-control">'
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'type',
        'filter' => Html::activeDropDownList($searchModel, 'type', [
            'in' => 'in',
            'out' => 'out'
        ], ['prompt' => '-- Chọn --', 'class' => 'form-control'])
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'shift',
        'filter' => Html::activeDropDownList($searchModel, 'shift', [
            'Sáng' => 'Sáng',
            'Chiều' => 'Chiều',
            'Tăng ca' => 'Tăng ca'
        ], ['prompt' => '-- Chọn --', 'class' => 'form-control'])
    ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'active',
    // ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data) {
            return Html::a('<i class="fa fa-edit"></i>',Url::to(['update', 'id' => $data->id]), [
                'role' => 'modal-remote','data-toggle' => 'tooltip','id'=>'select2', 'data-value' => $data->id]);
        },
        'format' => 'raw',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xóa',
        'value' => function($data){
            return Html::a('<i class="fa fa-trash"></i>', '#', ['class' => ' text-danger btn-delete', 'data-value' => $data->id ]);
        },
        'format' => 'raw',
    ],

];