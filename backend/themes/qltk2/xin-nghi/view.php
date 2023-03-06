<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\NghiPhep */
?>
<div class="nghi-phep-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'loai_nghi',
            'nghi_tu_ngay',
            'nghi_den_ngay',
            'ly_do:ntext',
            'nguoiLamDon.hoten',
            'trang_thai',
            'ghi_chu:ntext',
        ],
    ]) ?>

</div>
