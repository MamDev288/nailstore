<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ThayDoiLuong */
?>
<div class="thay-doi-luong-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'luong_dong_bao_hiem',
            'user.hoten',
            'user.username',
            'created',
            'luong_thang',
            'luong_mem',
        ],
    ]) ?>

</div>
