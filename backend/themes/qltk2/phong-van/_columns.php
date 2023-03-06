<?php

use backend\services\TrangThaiPhongVanService;
use yii\helpers\Url;
/** @var $searchModel \backend\models\search\PhongVanSearch */

return [
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
        'attribute'=>'ung_vien_id',
        'value' => function ($data) {
            return $data->ungVien->hoten ?? null;
        }
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'tuyen_dung_dk_nhu_cau_ns_id',
        'value' => function($data) {
            return \backend\services\TuyenDungDkNhuCauNsService::getNameTuyenDungDkNhuCauNsDaDuyetById($data->tuyen_dung_dk_nhu_cau_ns_id);
        }
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'header'=> 'Tình trạng',
        'headerOptions'=> ['class'=>'text-primary text-center'],
        'contentOptions'=> ['class'=>'text-center'],
        'format' => 'raw',
        'value' => function($data) {
            return \backend\services\TrangThaiPhongVanService::getTrangThaiPhongVanStatusLabelColor($data->trangThaiPhongVan->status ?? null);
        },
        'filter' => \yii\helpers\Html::activeDropDownList($searchModel, 'trang_thai', TrangThaiPhongVanService::getTrangThaiPhongVanStatusOptions(), ['class'=>'form-control','prompt' => '----']),

    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'headerOptions'=> ['class'=>'text-primary'],
        'header'=> 'Người phỏng vấn',
        'format' => 'raw',
        'value' => function($data) {
            return $data->tuyenDungDkNhuCauNs->deXuatNguoiPhongVan->hoten ?? null;
        }
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'created_by',
        'value' => function($data) {
            return $data->createdBy->hoten ?? "";
        }
    ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'updated_by',
    // ],
     [
         'class'=>'\backend\components\Grid\DateColumn',
         'attribute'=>'created_at',
     ],
    // [
        // 'class'=>'\backend\components\Grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xem',
        'value' => function($data){
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['view', 'id' => $data->id]), [
                'data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary',
                'data-value' => $data->id,
                'role' => 'modal-remote',
                'data-modal-size' => 'large'
            ]);
        },
        'format' => 'raw',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data) {
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::toRoute(['update', 'id' => $data->id]), [
                'data-toggle' => 'tooltip','id'=>'select2', 'role'=>'modal-remote']);
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