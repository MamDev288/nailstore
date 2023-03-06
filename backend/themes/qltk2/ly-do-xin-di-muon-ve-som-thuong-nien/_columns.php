<?php
use yii\helpers\Url;

/* @var $searchModel backend\models\search\TrinhDoChuyenMonSearch */
/* @var $data backend\models\TrinhDoChuyenMon */

return [

    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '1%',
        'header' => 'STT',
        'headerOptions' => ['class' => 'text-primary'],
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'value' => function($data){
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update','id'=>$data->id]), ['class' => 'text-gray','role'=>'modal-remote','title'=>'Cập nhật', 'data-toggle'=>'tooltip']);
        },
        'label' => 'Sửa',
        'format' => 'raw',
        'width' => '5%'
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xoá',
        'value' => function($data){
            $model = \backend\models\DanhMuc::findOne($data->id);
            if($model->active == 1)
                return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['trinh-do-chuyen-mon/delete', 'id' => $data->id]));
        },
        'format' => 'raw',
        'width' => '5%'
    ],

];
