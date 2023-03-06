<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DuyetNghiPhep */
?>
<div class="duyet-nghi-phep-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nghi_phep_id',
            'trang_thai',
            'created_at',
            'updated_at',
            'user_duyet_id',
            'duyet_nghi_phep_id',
            'ghi_chu:ntext',
        ],
    ]) ?>

</div>
