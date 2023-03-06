<?php

use backend\models\search\KeHoachTuyenDungSearch;
use backend\models\TuyenDungDkNhuCauNs;
use backend\models\KeHoachTuyenDung;
use \backend\models\DuyetDonDangKiTuyenDung;
use yii\helpers\Url;
use yii\helpers\Html;
use \common\models\myAPI;

/** @var $searchModel KeHoachTuyenDungSearch */
/** @var $type */

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'STT',
        'headerOptions' => ['width' => '1%', 'class' => 'text-nowrap text-primary'],
    ],
//         [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'id',
//     ],

    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ten_phong_ban',
        'header' => 'Phòng ban',
        'headerOptions' => ['class' => 'text-nowrap text-primary'],
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'khoi',
        'header' => 'Khối',
        'headerOptions' => ['class' => 'text-nowrap text-primary', 'width' => '1%'],
        'contentOptions' => ['class' => 'text-nowrap']
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ten_nguoi_lap_ke_hoach',
        'header' => 'Người lập kế hoạch',
        'headerOptions' => ['class' => 'text-nowrap text-primary', 'width' => '1%'],
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'kh_ngay_lap_ke_hoach',
        'header' => 'Ngày lập kế hoạch',
        'headerOptions' => ['width' => '1%','class' => 'text-primary text-nowrap'],
        'contentOptions' => ['class' => 'text-nowrap text-center'],
        'value' => function($data){
            /** @var $data TuyenDungDkNhuCauNs */
            return date('d/m/Y', strtotime($data->kh_ngay_lap_ke_hoach));
        },
        'filter' => myAPI::activeDateFieldNoLabel($searchModel, 'kh_ngay_lap_ke_hoach', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Từ ngày'])
            .myAPI::activeDateFieldNoLabel($searchModel, 'kh_ngay_lap_ke_hoach_den', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Đến ngày']),

    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'kh_de_xuat_cb_pv_chuyen_mon',
        'header' => 'Cán bộ phỏng vấn',
        'headerOptions' => ['class' => 'text-nowrap text-primary', 'width' => '1%'],
        'contentOptions' => ['class' => 'text-nowrap text-left']
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'kh_hinh_thuc_tuyen_dung',
        'header' => 'Hình thức tuyển dụng',
        'headerOptions' => ['class' => 'text-nowrap text-primary', 'width' => '1%'],
        'contentOptions' => ['class' => 'text-left'],
        'filter' => Html::activeDropDownList($searchModel, 'kh_hinh_thuc_tuyen_dung', TuyenDungDkNhuCauNs::getHinhThucTuyenDung(),['class'=>'form-control','prompt' => '-- Chọn hình thức --'])
         ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'trang_thai',
        'header' => 'Trạng thái',
        'headerOptions' => ['width' => '1%','class' => 'text-primary text-nowrap'],
        'contentOptions' => ['class' => 'text-nowrap'],
        'value' => function($data){
            /** @var $data \backend\models\QuanLyTuyenDungNhuCauNsUser*/
            return TuyenDungDkNhuCauNs::getListTrangThaiKH()[$data->kh_trang_thai] ?? "";
        },
        'filter' => Html::activeDropDownList($searchModel, 'trang_thai', TuyenDungDkNhuCauNs::getListTrangThaiKHNoColor(), ['class'=>'form-control','prompt' => '-- Chọn trạng thái --']),
        'format' => 'raw',
        'visible' => $type != 'da_duyet' ? true : false,
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function($data){
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::to(['view', 'id' => $data->dang_ki_tuyen_dung_nhu_cau_id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary',
                'data-value' => $data->dang_ki_tuyen_dung_nhu_cau_id
            ]);
        },
        'format' => 'raw',

    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Duyệt đơn',
        'value' => function($data) {
    /** @var $data \backend\models\DuyetKeHoachTuyenDung */
            return $data->kh_trang_thai == KeHoachTuyenDung::KH_CHO_DUYET ? \yii\bootstrap\Html::a('<i class="fa fa-clock-o"></i> Duyệt',  Url::to(['duyet-don-dang-ki-tuyen-dung/loadformduyetphieu', 'id' => $data->dang_ki_tuyen_dung_nhu_cau_id, 'type' => DuyetDonDangKiTuyenDung::KE_HOACH]), [
                'role' => 'modal-remote','data-toggle' => 'tooltip','id'=>'select2', 'data-value' => $data->dang_ki_tuyen_dung_nhu_cau_id, 'class' => 'btn btn-warning'] ) : '';
        },
        'format' => 'raw',
        'visible' => $type == 'cho_duyet',
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data) {
            return $data->kh_trang_thai == KeHoachTuyenDung::KH_CHO_DUYET ? Html::a('<i class="fa fa-edit"></i>',Url::to(['update', 'id' => $data->dang_ki_tuyen_dung_nhu_cau_id]), [
                'role' => 'modal-remote','data-toggle' => 'tooltip','id'=>'select2', 'data-value' => $data->dang_ki_tuyen_dung_nhu_cau_id]) : '';
        },
        'format' => 'raw',
        'visible' => $type == 'da_duyet' ? false : true,
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xóa',
        'value' => function($data){
            return $data->kh_trang_thai == KeHoachTuyenDung::KH_CHO_DUYET ? Html::a('<i class="fa fa-trash"></i>', '#', ['class' => ' text-danger btn-delete', 'data-value' => $data->dang_ki_tuyen_dung_nhu_cau_id ]) : '';
        },
        'format' => 'raw',
        'visible' => $type == 'da_duyet' ? false : true,
    ],

];   