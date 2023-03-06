<?php

use backend\services\ThayDoiLuongService;
use yii\helpers\Url;
use backend\helpers\NumberHelper;

/* @var $bangLuong \backend\models\BangLuong */
if(!isset($bangLuongCuaToi)) $bangLuongCuaToi = false;
$columns = [
//     [
//         'class' => 'kartik\grid\SerialColumn',
//         'width' => '30px',
//     ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'ten_phong_ban',
        'filter'=>false,
        'width' => '5%'
    ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'filter'=>false,
        'attribute' => 'hoten',
        'format' => 'raw',
        'value' => function($data) {
            return \yii\helpers\Html::a($data->hoten, ['nhan-vien/view','id' => $data->nhan_vien_id], ['role' => 'modal-remote', 'size' => 'large']);
        }
    ],

    [
        'label' => 'Lương cứng + mềm',
        'filter' => false,
        'class' => '\backend\components\Grid\CurrencyColumn',
//        'width' => '10%',
        'attribute' => 'luong_theo_so_cong_thuc_te',


    ],
    [
        'label' => 'Thưởng',
        'class' => '\backend\components\Grid\CurrencyColumn',
        'attribute' => 'thuong',
        'filter' => false,
//        'width' => '10%',

    ],
    [
        'label' => 'Phụ cấp',
        'class' => '\backend\components\Grid\CurrencyColumn',
//        'width' => '10%',
        'attribute' => 'tong_phu_cap',
        'filter' => false,

    ],
    [
        'label' => 'Các khoản giảm trừ',
        'class' => '\backend\components\Grid\CurrencyColumn',
//        'width' => '10%',
        'attribute' => 'tong_cong_giam_tru',
        'filter' => false,

    ],
    [
        'class' => '\backend\components\Grid\CurrencyColumn',
        'attribute' => 'luong_thuc_te',
        'filter'=>false,
    ],
    [
        'class' => '\backend\components\Grid\CurrencyColumn',
        'filter'=>false,
        'attribute' => 'cong_doan',
        'value' => function ($data) {
            return $data->cong_doan;
        }
    ],
    [
        'label' => 'Phụ cấp đặc biệt',
        'class' => '\backend\components\Grid\CurrencyColumn',
        'headerOptions' => ['class' => 'text-primary '],
        'value' => function ($data) {
            /** @var $data \backend\models\ChiTietBangLuongNhanVien */
            return $data->phu_cap_tien_an_di_cong_tac + $data->phu_cap_khac;
        },

    ],
    [
        'class' => '\backend\components\Grid\CurrencyColumn',
        'attribute' => 'tien_phat',
        'filter'=>false,
        'value' => function ($data) {
            return $data->tien_phat;
        }
    ], [
        'class' => '\backend\components\Grid\CurrencyColumn',
        'attribute' => 'thuc_tra',
        'filter'=>false,
        'value' => function ($data) {
            return $data->thuc_tra;
        }
    ],
    [
        'class' => '\backend\components\Grid\CurrencyColumn',
        'filter'=>false,
        'attribute' => 'tong_luong_full_cong',
        'value' => function ($data) {
            return $data->tong_luong_full_cong;
        }
    ],


//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'hoten',
//    ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'so_tai_khoan',
//    ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'luong_dong_bhxh',
//        'width'=>'1%'
//    ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'luong_thang',
//        'width'=>'1%'
//    ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'luong_mem',
//        'width'=>'1%'
//    ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'ngay_cong_quy_dinh',
//        'width'=>'1%'
//    ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'luong_mot_ngay_cong',
//    ],
//    [
//        'class'=>'\backend\components\Grid\DataColumn',
//        'attribute'=>'so_cong_thuc_te',
//    ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'luong_theo_so_cong_thuc_te',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'thuong_Logistics',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'thuong_Agent_Broker',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'ngay_cong_huong_phu_cap_an_trua',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'tien_phu_cap_an_trua',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'so_nam_cong_tac',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'phu_cap_tham_nien_1_nam',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'phu_cap_tham_nien',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'phu_cap_xang_xe',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'tong_phu_cap',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'BHXH',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'BHYT',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'BHTN',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'thue_TNCN',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'tong_cong_giam_tru',
//         'contentOptions' => ['class' => 'text-right']
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'luong_thuc_te',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'cong_doan',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'phu_cap_tien_an_di_cong_tac',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'phu_cap_khac',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'tien_phat',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'thuc_tra',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'ghi_chu',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'tong_luong',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'created',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'user_id',
//     ],
//

//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'tien_phu_cap_an_trua_1_bua',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'nhan_vien_id',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'tong_luong_full_cong',
//     ],
    [
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'status',
        'format' => 'raw',
        'filter' => false,
        'value' => function($data) {
            return \backend\services\ChiTietBangLuongService::getChiTietBangLuongStatusLabelColor($data->status);
        },
        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['class' => 'text-center'],
    ],
    ['header' => 'Xem',
        'class' => '\backend\components\Grid\ActionColumn',
    'value' => function ($data) use ($bangLuongCuaToi) {
        if($bangLuongCuaToi) {
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::to(['view-bang-luong', 'chi_tiet_bang_luong_id' => $data->id]), [
                 'data-toggle' => 'tooltip', 'id' => 'select2',
                'class' => 'text-primary btn-xem-chi-tiet-phieu-dang-ki',
                'data-value' => $data->id
            ]);
        }else{
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::to(['view', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip', 'id' => 'select2',
                'class' => 'text-primary btn-xem-chi-tiet-phieu-dang-ki',
                'data-value' => $data->id
            ]);
        }
    },
    'format' => 'raw',
],
];
if (isset($bangLuong)) {

    if (!\backend\services\BangLuongService::checkIsDaChotLuong($bangLuong)) {
        $columns = array_merge($columns, [
            [
                'class' => '\backend\components\Grid\ActionColumn',
                'header' => 'Sửa',
                'value' => function ($data) {
                    return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>', Url::to(['update', 'id' => $data->id]), [
                        'role' => 'modal-remote', 'data-toggle' => 'tooltip', 'id' => 'select2']);
                },
                'format' => 'raw',
            ],
            [
                'class' => '\backend\components\Grid\ActionColumn',
                'header' => 'Hủy',
                'value' => function ($data) {

                    return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
                },
                'format' => 'raw'
            ],
        ]);
    }
} else {
    array_unshift($columns,
        [
            'class' => '\backend\components\Grid\DataColumn',
            'attribute' => 'thang',
            'header' => 'Tháng',
            'headerOptions' => ['class' => 'text-primary '],

        ]);
}
return $columns;