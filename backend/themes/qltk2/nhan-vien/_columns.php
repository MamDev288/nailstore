<?php

use backend\models\search\QuanLyNhanVienPhongBanSearch;
use yii\helpers\Url;
use \backend\models\NhanVien;
use yii\helpers\Html;
/** @var $searchModel QuanLyNhanVienPhongBanSearch */
return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],

    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'STT',
        'headerOptions' => ['width' => '1%', 'class' => 'text-nowrap text-primary'],
    ],
    [
        'attribute' => 'anh_nguoi_dung',
        'format' => 'html',
        'label' => 'Ảnh đại diện',
        'value' => function ($data) {
            return Html::img('.' . $data->anh_nguoi_dung, ['height' => '120px']);
        },
        'contentOptions' => ['class' => 'text-center'],
        'filter' => false
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'hoten',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'username',

    ],    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'gioi_tinh',
        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['class' => 'text-center'],
        'value' => function ($data){
            return $data->gioi_tinh==0 ? "Nam": "Nữ";
        },
        'filter' => Html::activeDropDownList($searchModel, 'gioi_tinh',[ 0 => "Nam",1 => "Nữ" ], ['class'=>'form-control','prompt' => '----']),
        'format' => 'raw',

    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'attribute'=>'ngay_sinh',
        'format' => ['datetime', 'php:d/m/Y'],
        'filter' => \common\models\myAPI::activeDateFieldNoLabel($searchModel, 'ngay_sinh', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Từ ngày'])

    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'dien_thoai',
        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['class' => 'text-center'],

    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ten_phong_ban',
        'contentOptions' => ['class' => 'vcenter'],
        'headerOptions' => ['width' => '1%'],
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'trang_thai',
        'value' => function ($data){
            return NhanVien::layTrangThaiCoMau()[$data->trang_thai] ?? "";
        },
        'format' => 'raw',
        'filter' => Html::activeDropDownList($searchModel, 'trang_thai', NhanVien::layTrangThai(), ['class'=>'form-control','prompt' => '-- Tất cả --']),
        'contentOptions' => ['class' => 'vcenter text-center'],
        'headerOptions' => ['width' => '1%'],


    ],
//
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'email',
//    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function($data){
            return (Html::a('<i class="fa fa-eye"></i>', Url::to(['view', 'id' => $data->id]), ['role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2', 'class' => 'text-primary', 'data-value' => $data->id]));
        },
        'format' => 'raw',
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data){
            return Html::a('<i class="fa fa-edit"></i>',['update','id' => $data->id], ['data-value' => $data->id,'class'=>'btn-sua-nhan-vien', 'role' => 'modal-remote']);
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
