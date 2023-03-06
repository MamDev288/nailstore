<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\NgayNghi */
?>
<div class="ngay-nghi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ngay_nghi',
            'thu_trong_tuan',
            'loai_ngay_nghi',
            'nghi_co_luong',
            'phan_tram_huong_luong',
            'kieu_nghi_trong_ngay',
            'ngay_lam_bu',
        ],
    ]) ?>

</div>
