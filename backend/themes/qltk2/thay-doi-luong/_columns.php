<?php
use yii\helpers\Url;

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
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'loaiHopDong',
        'header' => 'Hợp Đồng',
        'value' => function($model){
            return 'Hợp Đồng Ngày : '. date('d/m/Y',strtotime($model->hopDongNhanSu->created));
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'luong_dong_bao_hiem',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'hop_dong_nhan_su_id',
//    ],

     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'luong_thang',
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'luong_mem',
     ],
    [
        'header' => 'Xem',
        'value' => function($data){
            return \yii\helpers\Html::a('<i class="fa fa-eye"></i>', Url::to(['view', 'id' => $data->id]), [
                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2',
                'class' => 'text-primary btn-xem-chi-tiet-phieu-dang-ki',
                'data-value' => $data->id
            ]);
        },
        'format' => 'raw',
        'contentOptions' => ['class' => 'text-center'],
        'headerOptions' => ['class' => 'text-primary', 'width' => '1%']
    ],


//    [
//        'header' => 'Sửa',
//        'value' => function($data) {
//            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::to(['update', 'id' => $data->id]), [
//                'role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2']);
//        },
//        'format' => 'raw',
//        'headerOptions' => ['width' => '3%', 'class' => 'text-center text-primary'],
//        'contentOptions' => ['class' => 'text-center']
//    ],
//    [
//        'class' => 'kartik\grid\ActionColumn',
//        'header' => 'Xóa',
//        'headerOptions' => ['width' => '3%', 'class' => 'text-center text-primary'],
//        'contentOptions' => ['class' => 'text-center'],
//        'dropdown' => false,
//        'template' => '{delete}',
//        'vAlign'=>'top',
//        'urlCreator' => function($action, $model, $key, $index) {
//            return Url::to([$action,'id'=>$key]);
//        },
//        'deleteOptions'=>[
//            'icon' => '<i class="fa fa-trash text-danger"></i>',
//            'role'=>'modal-remote','title'=>'Delete',
//            'data-confirm'=>false, 'data-method'=>'post',
//            'data-request-method'=>'post',
//            'data-toggle'=>'tooltip',
//            'data-confirm-title'=>'Are you sure?',
//            'data-confirm-message'=>'Bạn có chắc chắn xóa bản ghi này ?'],
//        'headerOptions' =>['class' => 'text-primary']
//    ],

];   