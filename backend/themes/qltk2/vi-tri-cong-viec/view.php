<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ViTriCongViec */
?>
<div class="vi-tri-cong-viec-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'vi_tri',
            [
                    'attribute' => 'phong_ban_id',
                    'value' => isset($model->phongBan) ? $model->phongBan->name : ''
            ],
        ],
    ]) ?>

</div>
