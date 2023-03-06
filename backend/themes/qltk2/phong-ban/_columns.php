<?php
use yii\helpers\Url;
use \yii\helpers\Html;

return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'STT',
        'headerOptions' => ['class' => 'text-primary', 'width' => '1%']
    ],
        // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'name',
        'label' => 'Tên bộ phận / phòng ban',
        'format' => 'raw',
        'value' => function($data){
            return $data->prefix_level_name;
        }
    ],
    [
        'header' => 'Nhân sự',
        'value' => function($data){
            return \yii\helpers\Html::a('<i class="fa fa-users"></i>'.'('.$data->so_luong_nhan_vien.')',  Url::toRoute(['phong-ban/them-nhan-vien', 'id' => $data->id]), [
                'class' => 'text-primary',
                'data-value' => $data->id,
                'role' => 'modal-remote',
                'data-toggle' => 'tooltip',
            ]);
        },
        'format' => 'raw',
        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['class' => 'text-primary', 'width' => '1%']
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'truong_phong',
        'header' => 'Trưởng Phòng',
        'headerOptions' => ['class' => 'text-primary', 'width' => '1%'],
        'value' => function($data){
            return \yii\helpers\Html::a(isset($data->truong_phong) ? $data->truong_phong : 'Thêm trưởng phòng', ['dieu-chinh-truong-phong', 'id' => $data->id], ['data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary',
                'data-modal-size' => 'large',
                'role' => 'modal-remote'
            ]);
        },
        'format' => 'raw'
    ],

//    [
//        'header' => 'Thay TP',
//        'value' => function($data){
//            return \yii\helpers\Html::a('<i class="fa fa-exchange"></i>', Url::toRoute(['phong-ban/thay-truong-phong', 'id' => $data->id]), [
//                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2',
//                'class' => 'text-primary btn-xem-chi-tiet-phong-ban',
//                'data-value' => $data->id
//            ]);
//        },
//        'format' => 'raw',
//        'contentOptions' => ['class' => 'text-center'],
//        'headerOptions' => ['class' => 'text-primary', 'width' => '1%']
//    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function($data){
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['phong-ban/view', 'id' => $data->id]), [
                'data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary btn-xem-chi-tiet-phong-ban',
                'data-value' => $data->id,
                'role' => 'modal-remote',
                'data-modal-size' => 'large'
            ]);
        },
        'format' => 'raw',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data) {
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::toRoute(['phong-ban/update', 'id' => $data->id]), [
                'data-toggle' => 'tooltip','id'=>'select2', 'class'=>'btn-sua-phong-ban', 'role'=>'modal-remote']);
        },
        'format' => 'raw',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xóa',
        'value' => function($data){

            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ],
];
