<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PhongBanNhanVien */
?>
<div class="phong-ban-nhan-vien-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'phong_ban_id',
                'value' => $model->phongBan->name,
            ],
            [
                'attribute' => 'nhan_vien_id',
                'value' => $model->nhanVien->username,
            ],
            [
                'attribute' => 'truong_phong',
                'value' => $model->truong_phong==1? 'Là trưởng Phòng': 'Là Nhân viên',
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->username,
            ],

            'created:date',
            'ghi_chu:ntext',
            'chuc_danh_id',
            'chuc_danh_id',
            'luong_co_ban'
        ],
    ]) ?>

</div>
