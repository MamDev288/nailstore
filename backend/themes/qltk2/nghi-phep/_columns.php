<?php

use backend\helpers\DateTimeHelper;
use backend\models\NghiPhep;
use backend\models\NhanVien;
use yii\helpers\Url;

use yii\helpers\VarDumper;
/** @var $searchModel */
return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'id',
    // ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'nhan_vien_phong_ban_id',
//    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'nguoiLamDon.hoten',
        'headerOptions'=>["class"=>"text-primary"]
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'Nhan_vien',
        'header' => 'Phòng ban',
        'value' => function($data){
            return   $data->nhanVienPhongBan->phongBan->name ??  null ;
        },
        'headerOptions'=>["class"=>"text-primary"]
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'type',
        'header'=> 'Loại nghỉ',
        'headerOptions'=>["class"=>"text-primary"],
        'value' => function($data){
            return NghiPhep::getLoaiNghi()[$data->type] ?? null;
        },
        'filter' => \yii\helpers\Html::activeDropDownList($searchModel, 'type', NghiPhep::getLoaiNghi(), ['prompt' => '--Chọn loại nghỉ--', 'class' => 'form-control']),
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'loai_nghi',
        'header'=> 'Kiểu nghỉ',
        'headerOptions'=>["class"=>"text-primary"]
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'nghi_tu_ngay',
        'contentOptions' => ['class' => 'text-center text-nowrap', 'width' => '1%'],
        'headerOptions' => ['class' => 'text-nowrap']
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'nghi_den_ngay',
        'contentOptions' => ['class' => 'text-center text-nowrap', 'width' => '1%'],
        'headerOptions' => ['class' => 'text-nowrap']
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ly_do',
    ],

//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'nguoiLamDon',
//     ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'trang_thai',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'active',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'user_id',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'created',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'updated',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'noi_dung',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'ghi_chu',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'ngay_de_nghi',
    // ],
    [
        'attribute'=> 'status',
        'headerOptions' => ['width' => '1%', 'class' => 'text-center  text-nowrap text-primary'],
        'contentOptions' => ['class' => 'text-center'],
        'value'=> function($data) {
            /** @var $data \backend\models\NghiPhep */
            return \backend\models\NghiPhep::getListTrangThai()[$data->trang_thai];
        },
        'format'=>'raw',
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