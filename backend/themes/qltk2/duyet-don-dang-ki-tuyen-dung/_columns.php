<?php

use backend\models\search\DuyetDonDangKiTuyenDungVaiTroSearch;
use backend\models\TuyenDungDkNhuCauNs;
use yii\helpers\Url;
use yii\helpers\Html;
use \common\models\myAPI;

/** @var $searchModel DuyetDonDangKiTuyenDungVaiTroSearch
 *
 */
/** @var $type */

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'STT',
        'headerOptions' => ['width' => '1%', 'class' => 'text-nowrap text-primary'],
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ten_phong_ban',
        'header' => 'Phòng ban',
        'headerOptions' => ['class' => 'text-nowrap text-primary'],
        'value' => function($data){
            /** @var $data \backend\models\DuyetDonDangKiTuyenDungVaiTro */
            return Html::a('<span class="badge badge-primary"> #'.$data->dang_ki_tuyen_dung_nhu_cau_id.'</span> '.$data->ten_phong_ban, Url::toRoute(['tuyen-dung-dk-nhu-cau-ns/xem-chi-tiet-phieu-duyet', 'id' => $data->dang_ki_tuyen_dung_nhu_cau_id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary'
            ]);
        },
        'format' => 'raw',
        'filter' => Html::activeInput('text', $searchModel, 'ten_phong_ban', ['class' => 'form-control'])
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'khoi',
//        'header' => 'Khối',
//        'headerOptions' => ['class' => 'text-nowrap text-primary', 'width' => '1%'],
//        'contentOptions' => ['class' => 'text-nowrap']
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'so_luong_nv_tuyen_them',
        'header' => 'Số lượng',
        'headerOptions' => ['class' => 'text-nowrap text-primary', 'width' => '1%'],
        'contentOptions' => ['class' => 'text-right'],
        'filter' => Html::activeInput('number', $searchModel, 'so_luong_nv_tuyen_them', ['class' => 'form-control', 'placeholder' => 'Từ']) .
            Html::activeInput('number', $searchModel, 'so_luong_nv_tuyen_them_den', ['class' => 'form-control', 'placeholder' => 'Đến'])
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'ten_nguoi_lap',
//        'header' => 'Người thực hiện',
//        'headerOptions' => ['width' => '1%', 'class' => 'text-primary text-nowrap'],
//        'contentOptions' => ['class' => 'text-nowrap']
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'created',
        'header' => 'Ngày thực hiện',
        'headerOptions' => ['width' => '1%', 'class' => 'text-primary text-nowrap'],
        'contentOptions' => ['class' => 'text-nowrap text-center'],
        'value' => function ($data) {
            /** @var $data TuyenDungDkNhuCauNs */
            return date('m/d/Y', strtotime($data->created));
        },
        'filter' => myAPI::activeDateFieldNoLabel($searchModel, 'created', (date('Y') - 3) . ':' . (date('Y') + 1), ['class' => 'form-control created-date-field', 'autocomplete' => 'off', 'placeholder' => 'Từ ngày'])
            . myAPI::activeDateFieldNoLabel($searchModel, 'created_to', (date('Y') - 3) . ':' . (date('Y') + 1), ['class' => 'form-control created-date-field', 'autocomplete' => 'off', 'placeholder' => 'Đến ngày']),

    ],


    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ten_nguoi_duyet',
        'header' => 'Người duyệt',
        'headerOptions' => ['width' => '1%', 'class' => 'text-primary text-nowrap'],
        'contentOptions' => ['class' => 'text-nowrap']
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'thoi_gian_duyet',
        'header' => 'Ngày duyệt',
        'headerOptions' => ['width' => '1%', 'class' => 'text-primary text-nowrap'],
        'contentOptions' => ['class' => 'text-nowrap text-center'],
        'value' => function ($data) {
            /** @var $data TuyenDungDkNhuCauNs */
            return isset($data->thoi_gian_duyet) ? date('m/d/Y', strtotime($data->thoi_gian_duyet)) : '';
        },
        'filter' => myAPI::activeDateFieldNoLabel($searchModel, 'thoi_gian_duyet', (date('Y') - 3) . ':' . (date('Y') + 1), ['class' => 'form-control created-date-field', 'autocomplete' => 'off', 'placeholder' => 'Từ ngày'])
            . myAPI::activeDateFieldNoLabel($searchModel, 'thoi_gian_duyet_den', (date('Y') - 3) . ':' . (date('Y') + 1), ['class' => 'form-control created-date-field', 'autocomplete' => 'off', 'placeholder' => 'Đến ngày']),

    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'trang_thai',
        'header' => 'Trạng thái',
        'headerOptions' => ['width' => '1%', 'class' => 'text-primary text-nowrap'],
        'contentOptions' => ['class' => 'text-nowrap'],
        'value' => function ($data) {
            /** @var $data TuyenDungDkNhuCauNs */
            return TuyenDungDkNhuCauNs::getListTrangThai()[$data->trang_thai];
        },
        'filter' => $type == '' ? Html::activeDropDownList($searchModel, 'trang_thai', TuyenDungDkNhuCauNs::getListTrangThaiNoColor(), ['class' => 'form-control', 'prompt' => '-- Chọn trạng thái --']) : '',
        'format' => 'raw',
        'visible' => $type == '' ? true : false,
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'active',
    // ],
    [
        'header' => 'Xem',
        'value' => function ($data) {
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['tuyen-dung-dk-nhu-cau-ns/xem-chi-tiet-phieu-duyet', 'id' => $data->dang_ki_tuyen_dung_nhu_cau_id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip', 'id' => 'select2',
                'class' => 'text-primary btn-xem-chi-tiet-phieu-dang-ki',
                'data-value' => $data->id
            ]);
        },
        'format' => 'raw',
        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['class' => 'text-primary', 'width' => '1%']
    ],
//    [
//        'header' => 'Lập KH',
//        'value' => function ($data) {
//            return $data->kh_ngay_lap_ke_hoach == '' ? \yii\helpers\Html::a('<i class="fa fa-calendar"></i>', '#', ['data-toggle' => 'tooltip', 'id' => 'select2',
//                'class' => 'text-primary btn-lap-ke-hoach-tuyen-dung',
//                'data-value' => $data->id
//            ]) : '';
//        },
//        'format' => 'raw',
//        'contentOptions' => ['class' => 'text-center'],
//        'headerOptions' => ['class' => 'text-primary text-nowrap', 'width' => '1%'],
//        'visible' => $type == 'da_duyet' ? true : false,
//    ],
    [
        'header' => 'Duyệt đơn',
        'value' => function($data) {
            return $data->trang_thai == TuyenDungDkNhuCauNs::CHO_DUYET ? \yii\bootstrap\Html::a('<span class=" text-warning"><i class="fa fa-refresh"></i> Duyệt</span>', '#', ['class' => 'btn-duyet-phieu',
                'data-toggle' => 'tooltip','id'=>'select2', 'data-value' => $data->id] ) : '';
        },
        'format' => 'raw',
        'headerOptions' => ['width' => '1%', 'class' => 'text-center  text-nowrap text-primary'],
        'contentOptions' => ['class' => 'text-center text-nowrap'],
        'visible' => $type == 'da_duyet' ? false : true,
    ],
//    [
//        'header' => 'Sửa',
//        'value' => function ($data) {
//            return $data->trang_thai == TuyenDungDkNhuCauNs::CHO_DUYET ? \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>', Url::to(['update', 'id' => $data->id]), [
//                'role' => 'modal-remote', 'data-toggle' => 'tooltip', 'id' => 'select2']) : '';
//        },
//        'format' => 'raw',
//        'headerOptions' => ['width' => '3%', 'class' => 'text-center text-primary'],
//        'contentOptions' => ['class' => 'text-center'],
//        'visible' => $type == 'da_duyet' ? false : true,
//    ],

//    [
//        'header' => 'Xóa',
//        'headerOptions' => ['class' => 'text-center text-primary', 'width' => '1%'],
//        'contentOptions' => ['class' => 'text-center'],
//        'value' => function ($data) {
//            return $data->trang_thai == TuyenDungDkNhuCauNs::CHO_DUYET ? Html::a('<i class="fa fa-trash"></i>', '#', ['class' => ' text-danger btn-delete', 'data-value' => $data->id]) : '';
//        },
//        'format' => 'raw',
//        'visible' => $type == 'da_duyet' ? false : true,
//    ],

];