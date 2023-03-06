<?php

use backend\models\DuyetDonDangKiTuyenDung;
use backend\models\TuyenDungDkNhuCauNs;
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\search\QuanLyTuyenDungNhuCauNsUserSearch;
use \common\models\myAPI;
use \backend\helpers\DateTimeHelper;
use \backend\models\DuyetDonDangKiTuyenDungVaiTro;

/** @var $searchModel QuanLyTuyenDungNhuCauNsUserSearch */
/** @var $type */

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'STT',
        'headerOptions' => ['width' => '1%', 'class' => 'text-nowrap text-primary'],
    ],
        // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'id',
    // ],

    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ten_phong_ban',
        'header' => 'Phòng ban/Khối',
        'headerOptions' => ['class' => 'text-nowrap text-primary'],
        'value' => function($data){
            /** @var $data \backend\models\QuanLyTuyenDungNhuCauNsUser */
            return "<span><strong>Phòng:</strong> ".$data->ten_phong_ban."</span><br>
                     ".($data->khoi != ''  ? "<span><strong>Khối: </strong>".$data->khoi."</span>" : '');
        },
        'format' => 'raw',
        'filter' => Html::activeInput('text', $searchModel, 'phongban_khoi', ['class' => 'form-control','placeholder' => 'Nhập phòng ban \ Khối'])
    ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'khoi',
//        'header' => 'Khối',
//        'headerOptions' => ['class' => 'text-nowrap text-primary', 'width' => '1%'],
//        'contentOptions' => ['class' => 'text-nowrap']
//    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'so_luong_nv_tuyen_them',
        'header' => 'Số lượng',
        'headerOptions' => ['class' => 'text-nowrap text-primary'],
        'contentOptions' => ['width' => '1%', 'class' => 'text-nowrap'],
        'value' => function($data){
            /** @var $data \backend\models\QuanLyTuyenDungNhuCauNsUser */
            return "<span><strong>Hiện tại: </strong>".$data->so_luong_nv_hien_tai."</span><br>
                     <span><strong>Thêm</strong>: ".$data->so_luong_nv_tuyen_them."</span>";
        },
        'format' => 'raw',
        'filter' => false
         ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'ten_nguoi_lap',
//        'header' => 'Người thực hiện',
//        'headerOptions' => ['width' => '1%', 'class' => 'text-primary text-nowrap'],
//        'contentOptions' => ['class' => 'text-nowrap']
//    ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'created',
//        'header' => 'Ngày thực hiện',
//        'headerOptions' => ['width' => '1%','class' => 'text-primary text-nowrap'],
//        'contentOptions' => ['class' => 'text-nowrap text-center'],
//        'value' => function($data){
//            /** @var $data TuyenDungDkNhuCauNs */
//            return date('d/m/Y', strtotime($data->created));
//        },
//        'filter' => myAPI::activeDateFieldNoLabel($searchModel, 'created', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Từ ngày'])
//            .myAPI::activeDateFieldNoLabel($searchModel, 'created_to', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Đến ngày']),
//
//    ],


    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ten_nguoi_duyet',
        'header' => 'Người duyệt',
        'headerOptions' => ['width' => '1%','class' => 'text-primary text-nowrap'],
        'contentOptions' => ['class' => 'text-nowrap'],
        'value' => function($data){
            $donDuyet = \backend\services\TuyenDungDkNhuCauNsService::getDonTuyenDung($data->id);
            $strNguoiDuyet = "";
            foreach ($donDuyet as $item){
                $strNguoiDuyet .= \backend\services\TuyenDungDkNhuCauNsService::getNguoiDuyetDonTuyenDung($item)."<br>";
            }
            return $strNguoiDuyet;
        },
        'format' => 'raw',
        'filter' => Html::activeInput('text', $searchModel, 'ten_nguoi_duyet', ['class' => 'form-control','placeholder' => 'Họ tên người duyệt'])


    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'attribute'=>'thoi_gian_duyet',
        'format' => ['datetime', "php:d/m/Y"],
        'header' => 'Ngày duyệt',
        'value' => function($data){
            /** @var $data TuyenDungDkNhuCauNs */
            return isset($data->thoi_gian_duyet) ? date('m/d/Y', strtotime($data->thoi_gian_duyet)) : '';
        },
        'filter' => myAPI::activeDateFieldNoLabel($searchModel, 'thoi_gian_duyet', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Từ ngày'])
            .myAPI::activeDateFieldNoLabel($searchModel, 'thoi_gian_duyet_den', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Đến ngày']),

    ],
     [
         'class'=>'\backend\components\Grid\DataColumn',
         'attribute'=>'trang_thai',
         'header' => 'Trạng thái',
         'headerOptions' => ['width' => '1%','class' => 'text-primary text-nowrap'],
         'contentOptions' => ['class' => 'text-nowrap'],
         'value' => function($data){
                /** @var $data TuyenDungDkNhuCauNs */
                return $data->trang_thai != TuyenDungDkNhuCauNs::CHO_DUYET ?
                    TuyenDungDkNhuCauNs::getListTrangThai()[$data->trang_thai]."<br><span><strong>Ngày: </strong>".DateTimeHelper::formatDate($data->thoi_gian_duyet)."</span>" ?? "" :
                    TuyenDungDkNhuCauNs::getListTrangThai()[$data->trang_thai];
         },
         'filter' => $type == '' ? Html::activeDropDownList($searchModel, 'trang_thai', TuyenDungDkNhuCauNs::getListTrangThaiNoColor(), ['class'=>'form-control','prompt' => '-- Chọn trạng thái --']) : '',
         'format' => 'raw',
         'visible' => $type == '' ? true : false,
     ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'active',
    // ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'header' => 'KH tuyển dụng',
        'value' => function($data){
            return ($data->trang_thai == TuyenDungDkNhuCauNs::DA_DUYET) ?
                ($data->kh_ngay_lap_ke_hoach == '' ? Html::a('<i class="fa fa-calendar"></i> Lập kế hoạch', Url::toRoute(["ke-hoach-tuyen-dung/update", "id" => $data->id]), ['data-toggle' => 'tooltip','id'=>'select2',
                    'role' => 'modal-remote','class' => 'text-success', 'data-value' => $data->id]) :
                "<span class='text-muted'>Đã lập kế hoạch<br>(".DateTimeHelper::formatDate($data->kh_ngay_lap_ke_hoach).")</span>" ): '';
        },
        'format' => 'raw',
        'contentOptions' => ['class' => 'text-nowrap'],
        'headerOptions' => ['class' => 'text-primary text-nowrap', 'width' => '1%'],
        'visible' => $type != 'cho_duyet',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'header' => 'Duyệt đơn',
        'value' => function($data) {
            return $data->isChoPhepDuyet ? \yii\bootstrap\Html::a('<i class="fa fa-clock-o"></i> Duyệt', Url::to(['duyet-don-dang-ki-tuyen-dung/loadformduyetphieu', 'id' => $data->id, 'type' => DuyetDonDangKiTuyenDung::TUYEN_DUNG]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2', 'data-value' => $data->id, 'class' => 'btn btn-warning'] ) : '';
        },
        'format' => 'raw',
        'headerOptions' => ['width' => '1%', 'class' => 'text-center  text-nowrap text-primary'],
        'contentOptions' => ['class' => 'text-center text-nowrap'],
        'visible' => $type == 'cho_duyet' || !isset($type),
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
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data) {
            return $data->trang_thai == TuyenDungDkNhuCauNs::CHO_DUYET ?\yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2']) : '';
        },
        'format' => 'raw',
        'visible' => !($type == 'da_duyet'),
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xóa',
        'value' => function($data){
            return $data->trang_thai == TuyenDungDkNhuCauNs::CHO_DUYET ? Html::a('<i class="fa fa-trash"></i>', '#', ['class' => ' text-danger btn-delete', 'data-value' => $data->id ]) : '';
        },
        'format' => 'raw',
        'visible' => !($type == 'da_duyet'),
    ],

];   