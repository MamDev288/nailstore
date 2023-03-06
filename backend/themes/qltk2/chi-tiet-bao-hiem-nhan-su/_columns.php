<?php

use backend\helpers\NumberHelper;
use yii\helpers\Url;

return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
        'header' => 'STT'
    ],
        // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'id',
    // ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'bao_hiem_nhan_su_id',
//    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'Nhan_vien',
        'header' => 'Họ tên',
        'value' => function($data){
            $nhanvien = \backend\models\PhongBanNhanVien::find()->where(['id'=>$data->nhan_su_phong_ban_id])->with('phongBan')->with('nhanVien')->one();
            return ($nhanvien->nhanVien->hoten ?? '') . ' - '. ($nhanvien->phongBan->name ?? '');
        }
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'Chuc_danh',
        'header' => 'Chức danh',
        'value' => function($data){
            $nhanvien = \backend\models\PhongBanNhanVien::find()->where(['id'=>$data->nhan_su_phong_ban_id])->with('phongBan')->with('nhanVien')->one();
            return ($nhanvien->chucDanh->name ?? '');
        }
    ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'nhan_su_phong_ban_id',
//    ],
    [
        'class'=>'\backend\components\Grid\CurrencyColumn',
        'attribute'=>'so_tien_dong',
        'value' => function($data){
            return $data->so_tien_dong;
        }
    ],
    [
        'class'=>'\backend\components\Grid\CurrencyColumn',
        'attribute'=>'doanh_nghiep_dong',
    ],
    [
        'class'=>'\backend\components\Grid\CurrencyColumn',
        'attribute'=>'nguoi_lao_dong_dong',
    ],
     [
         'class'=>'\backend\components\Grid\CurrencyColumn',
         'attribute'=>'tong_nop',
     ],
    [
         'class'=>'\backend\components\Grid\DataColumn',
         'attribute'=>'ghi_chu',
     ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'he_so_doanh_nghiep_dong',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'he_so_nguoi_lao_dong_dong',
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
        'header' => 'Xoá',
        'value' => function($data){

            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
        },
        'format' => 'raw'
    ],
];   