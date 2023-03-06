<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'id',
    // ],

    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],

    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ten_phong_ban',

    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ho_ten_nguoi_lam_don',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'loai_nghi',
    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'attribute'=>'nghi_tu_ngay',
    ],
    [
        'class'=>'\backend\components\Grid\DateColumn',
        'attribute'=>'nghi_den_ngay',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header'=> 'Trạng thái',
        'value'=> function($data) {
            /** @var $data \backend\models\DuyetNghiPhepUser */
            return \backend\models\DuyetNghiPhepUser::getListTrangThai()[$data->trang_thai] ?? '';
        },
        'format'=>'raw',
    ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Duyệt đơn',
        'value' => function($data) {
            return $data->trang_thai == 2 ? \yii\bootstrap\Html::a('<span class=" text-warning"><i class="fa fa-refresh"></i> Duyệt</span>', ['loadformduyetphieu', 'id' => $data->id], [
                'role' => 'modal-remote'] ) : '';
        },
        'format' => 'raw',
    ],

];   