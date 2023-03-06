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
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'name',
    ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'header' => 'Đối tượng',
        'format' => 'raw',
        'value' => function($data) {
            return $data->objectLink ? "<a role='modal-remote' href='$data->objectLink'>". $data->objectName."</a>" : null;
        }
    ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'ghi_chu',
    ],
    // [
    // 'class'=>'\backend\components\Grid\DataColumn',
    // 'attribute'=>'object_id',
    // ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'status',
        'format' => 'raw',
        'value' => function($data){
            return \backend\services\QueueService::getQueueLabelColor($data->status);
        }
    ],
    // [
    // 'class'=>'\backend\components\Grid\DataColumn',
    // 'attribute'=>'active',
    // ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'created_by',
        'value' => function ($data) {
            return $data->createdBy->hoten ?? null;
        }
    ],
    // [
    // 'class'=>'\backend\components\Grid\DataColumn',
    // 'attribute'=>'updated_by',
    // ],
    [
        'class' => '\backend\components\Grid\DateColumn',
        'attribute' => 'created_at',
    ],
    // [
    // 'class'=>'\backend\components\Grid\DataColumn',
    // 'attribute'=>'updated_at',
    // ],
    [
        'class' => '\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function ($data) {
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::to(['view', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip', 'id' => 'select2',
                'class' => 'text-primary btn-xem-chi-tiet-phieu-dang-ki',
                'data-value' => $data->id
            ]);
        },
        'format' => 'raw',
    ],
    [
        'class' => '\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function ($data) {
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>', Url::to(['update', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip', 'id' => 'select2']);
        },
        'format' => 'raw',
    ],
    [
        'class' => '\backend\components\Grid\ActionColumn',
        'header' => 'Hủy',
        'value' => function ($data) {
            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ],

];   