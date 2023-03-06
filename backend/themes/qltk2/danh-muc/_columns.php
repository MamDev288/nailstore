<?php
use yii\helpers\Url;

/* @var $searchModel backend\models\search\DanhMucSearch */

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
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'type',
        'filter' => \yii\helpers\Html::activeDropDownList($searchModel, 'type', \backend\models\DanhMuc::getDanhMuc(),
            ['class' => 'form-control', 'prompt' => 'Tất cả'])
    ],
    [
        'class' => '\backend\components\Grid\ActionColumn',
        'value' => function($data){
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update','id'=>$data->id]), ['class' => 'text-gray','role'=>'modal-remote','title'=>'Cập nhật', 'data-toggle'=>'tooltip']);
        },
        'label' => 'Sửa',
        'format' => 'raw',
    ],
    [
        'class' => '\backend\components\Grid\ActionColumn',
        'header' => 'Hủy',
        'headerOptions' => ['class' => 'text-center text-primary', 'width' => '1%'],
        'contentOptions' => ['class' => 'text-center'],
        'value' => function($data){
            $model = \backend\models\DanhMuc::findOne($data->id);
            if($model->active == 1)
                return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['danh-muc/delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ],
//    [
//        'class' => '\backend\components\Grid\ActionColumn',
//        'header' => 'Khôi phục',
//        'headerOptions' => ['class' => 'text-center text-primary', 'width' => '1%'],
//        'contentOptions' => ['class' => 'text-center'],
//        'value' => function($data){
//            $model = \backend\models\DanhMuc::findOne($data->id);
//            if($model->active == 0)
//                return \yii\bootstrap\Html::a('<i class="fa fa-repeat"></i>',Url::toRoute(['danh-muc/back-up', 'id' => $data->id]), ['class' => 'text-gray','role'=>'modal-remote','title'=>'Khôi phục', 'data-toggle'=>'tooltip']);
//        },
//        'format' => 'raw'
//    ]

];   
