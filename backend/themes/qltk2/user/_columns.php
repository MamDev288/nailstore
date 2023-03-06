<?php
use yii\helpers\Url;
/* @var $searchModel Backend\models\search\UserSearch */

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'header' => 'STT',
        'headerOptions' => ['class' => 'text-primary', 'width' => '3%']
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'username',
        'label' => 'Tên đăng nhập'
    ],
    // [
    // 'class'=>'\backend\components\Grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'hoten',
        'label' => 'Họ tên',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'ngay_sinh',
        'label' => 'Ngày sinh',
        'value' => function($data){
            return $data->ngay_sinh ? date('d/m/Y', strtotime($data->ngay_sinh)) : '';
        },
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'dien_thoai',
        'label' => 'Điện thoại',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'email',
    ],
    [
        'class'=>'\backend\components\Grid\DataColumn',
        'attribute'=>'vai_tro',
        'value' => function($data){
            return str_replace(',', '<br/>', $data->vai_tro);
        },
        'format' => 'raw',
        'label' => 'Vai trò',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xóa thiết bị',
        'value' => function($data) {
            return isset($data->userPhoneInfo) ? \yii\bootstrap\Html::a('<i class="fa fa-mobile"></i>',Url::toRoute(['user/delete-device', 'id' => $data->id]),
                [
                    'role' => 'modal-remote',
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip', 'data-confirm-title' => 'Thông báo',
                    'data-confirm-message' => 'Bạn có chắc chắn muốn xóa tài khoản trên thiết bị '.($data->userPhoneInfo->name ?? '').'?', 'data-original-title' => 'Hủy',
                    'class' => 'text-danger'
                ]) : null;
        },
        'format' => 'raw',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Sửa',
        'value' => function($data) {
            return \yii\bootstrap\Html::a('<i class="fa fa-edit"></i>',Url::toRoute(['user/update', 'id' => $data->id]), ['role' => 'modal-remote', 'data-toggle' => 'tooltip','id'=>'select2']);
        },
        'format' => 'raw',
    ],

    [
        'class'=>'\backend\components\Grid\ActionColumn',
        'header' => 'Xoá',
        'value' => function($data){
            return \common\models\myAPI::createDeleteBtnInGrid(Url::toRoute(['delete', 'id' => $data->id]));
        },
        'format' => 'raw',
    ],
];
?>

