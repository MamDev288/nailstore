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
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'anh_nguoi_dung',
        'format' => 'html',
        'label' => 'Ảnh đại diện',
        'value' => function ($data) {
            return Html::img('.' . $data->anh_nguoi_dung, ['height' => '120px']);
        },
        'headerOptions' => ['width' => '1%', 'class' => 'text-center'],
        'contentOptions' => ['class' => 'text-center'],
        'filter' => false
    ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'hoten',
        'contentOptions' => ['class' => 'vcenter']
    ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'username',
        'contentOptions' => ['class' => 'vcenter'],

    ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'dien_thoai',
        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['class' => 'text-center'],

    ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'trang_thai',
        'value' => function ($data) {
            return NhanVien::layTrangThaiCoMau()[$data->trang_thai] ?? "";
        },
        'format' => 'raw',
        'filter' => Html::activeDropDownList($searchModel, 'trang_thai', NhanVien::layTrangThai(), ['class' => 'form-control', 'prompt' => '-- Tất cả --']),
        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['class' => 'text-center'],
    ],
//
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'email',
//    ],
    [
        'class' => '\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function ($data) {
            return (Html::a('<i class="fa fa-eye"></i>', Url::to(['view', 'id' => $data->id]), ['role' => 'modal-remote', 'data-toggle' => 'tooltip', 'id' => 'select2', 'class' => 'text-primary', 'data-value' => $data->id]));
        },
        'format' => 'raw',
    ],
    [
        'class' => '\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function ($data) {
            return Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $data->id], ['data-value' => $data->id, 'class' => 'btn-sua-nhan-vien', 'role' => 'modal-remote']);
        },
        'format' => 'raw',
    ],
    [
        'class' => '\backend\components\Grid\ActionColumn',
        'header' => 'Xoá',
        'value' => function ($data) {
            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['ung-vien/delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ],
];
