<?php

use yii\helpers\Url;
use common\models\myAPI;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],

    [
        'class' => '\backend\components\Grid\DataColumn',
        'attribute' => 'Ho_ten',
        'headerOptions' => ['width' => '170px'],
        'contentOptions' => ['width' => '170px']
    ],
    [
        'class' => '\backend\components\Grid\DateColumn',
        'attribute' => 'thang',
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm',
                'startView' => 'year',
                'minViewMode' => 'months',
            ],
        ],
        'format' => ['datetime', 'php:m/Y'],
        'filterType' => \kartik\grid\GridView::FILTER_DATE
    ],
    [
        'class' => '\backend\components\Grid\NumberColumn',
        'attribute' => 'tong_so_cong',

    ],
    [
        'class' => '\backend\components\Grid\NumberColumn',
        'attribute' => 'so_phut_di_muon',
        'value' => function ($data) {
            return $data->so_phut_di_muon;
        }

    ],
    [
        'class' => '\backend\components\Grid\NumberColumn',
        'attribute' => 'so_cong_bi_tru',

    ],
    [
        'class' => '\backend\components\Grid\CurrencyColumn',
        'attribute' => 'so_tien_phat',
        'value' => function ($data) {
            return $data->so_tien_phat;
        }

    ],
    [
        'class' => '\backend\components\Grid\NumberColumn',
        'attribute' => 'so_lan_quen_check_in'

    ],
    [
        'class' => '\backend\components\Grid\NumberColumn',
        'attribute' => 'so_lan_quen_check_out',

    ],
    [
        'class' => '\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function ($data) {
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::to(['view', 'uid' => $data->nhan_vien_id, 'thang' => $data->thang]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip', 'id' => 'select2',
                'class' => 'text-primary btn-xem-chi-tiet',
                'data-value' => $data->id
            ]);
        },
        'format' => 'raw',
    ]
];
