<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DuyetDonDangKiTuyenDung */
?>
<div class="duyet-don-dang-ki-tuyen-dung-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dang_ki_tuyen_dung_nhu_cau_id',
            'trang_thai',
            'created',
            'updated',
            'user_duyet_id',
            'vai_tro_id',
        ],
    ]) ?>

</div>
