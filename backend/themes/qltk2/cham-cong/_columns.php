<?php
use yii\helpers\Url;
use \common\models\myAPI;
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
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'phong_ban_name',
        'width' =>'10%'
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'hoten',
    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'attribute'=>'date',
        'format' => ["datetime", "php:d/m/Y"],
        'filter' => myAPI::activeDateFieldNoLabel($searchModel, 'date_start', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Từ ngày'])
            .myAPI::activeDateFieldNoLabel($searchModel, 'date_end', (date('Y') - 3).':'.(date('Y') + 1),['class' => 'form-control created-date-field','autocomplete' => 'off', 'placeholder' => 'Đến ngày']),

    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'format' => ['datetime', 'php:H:i:s'],
        'attribute'=>'vao1',

    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'format' => ['datetime', 'php:H:i:s'],
        'attribute'=>'ra1',

    ],
     [
         'class'=>'\backend\components\Grid\DateColumn',
         'format' => ['datetime', 'php:H:i:s'],
         'attribute'=>'vao2',

     ],
     [
         'class'=>'\backend\components\Grid\DateColumn',
         'format' => ['datetime', 'php:H:i:s'],
         'attribute'=>'ra2',

     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'ty_le_cong_phat',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'tong_cong',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'created',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'updated',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'ghi_chu',
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'so_phut_di_muon',
//         'width' =>'1%'
//
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'so_cong_bi_tru',
//         'width' =>'1%'
//
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'so_tien_phat',
//         'width' =>'1%'
//
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'so_lan_quen_check_in',
//         'width' =>'1%'
//
//     ],
//     [
//         'class'=>'\backend\components\Grid\DataColumn',
//         'attribute'=>'so_lan_quen_check_out',
//         'width' =>'1%'
//
//     ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function($data){
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::to(['view','id'=>$data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary btn-xem-chi-tiet',
                'data-value' => $data->id
            ]);
        },
        'format' => 'raw',
    ]

];   