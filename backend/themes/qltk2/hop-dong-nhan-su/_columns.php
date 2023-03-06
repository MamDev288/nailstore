<?php
use yii\helpers\Url;
use \common\models\myAPI;

/** @var $searchModel */

return [

    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'STT',
    ],
        // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'id',
    // ],

//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'nhanSu',
//        'header' => 'Nhân sự',
//        'value' => function($model){
//            return $model->nhanSu->username;
//        }
//    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ten_hop_dong',
        'header' => 'Tên hợp đồng',


    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'loai_hop_dong',
        'header' => 'Loại hợp đồng',

    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'hoten',
        'header' => 'Họ Tên',

    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'don_vi_ky_hop_dong',
        'header' => 'Đơn vị ký hợp đồng',


    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'nguoi_dai_dien_ky',
        'header' => 'Người đại diện ký',


    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'attribute'=>'ngay_hieu_luc',
        'header' => 'Ngày hiệu lực',
        'format' => ['datetime', 'php:d/m/Y'],
        'value' => function($data){
                return $data->ngay_hieu_luc != '' ?date('d/m/Y', strtotime($data->ngay_hieu_luc)) : '';
        },
        'filter' => myAPI::activeDateFieldNoLabel($searchModel, 'ngay_hieu_luc', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Từ ngày'])
            .myAPI::activeDateFieldNoLabel($searchModel, 'ngay_hieu_luc_den', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Đến ngày']),


    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'attribute'=>'ngay_het_han',
        'header' => 'Ngày hết hạn',
        'value' => function($data){
                return $data->ngay_het_han != '' ?date('d/m/Y', strtotime($data->ngay_het_han)) : '';
        },
        'filter' => myAPI::activeDateFieldNoLabel($searchModel, 'ngay_het_han', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Từ ngày'])
            .myAPI::activeDateFieldNoLabel($searchModel, 'ngay_het_han_den', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Đến ngày']),



    ],

//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'ngay_thuc_hien',
//    ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'ngay_het_han',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'active',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'ngay_hieu_luc',
    // ],
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
    ],


    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data) {
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2']);
        },
        'format' => 'raw',
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Hủy',
        'value' => function($data){
            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ],
];   