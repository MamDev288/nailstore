<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\LoaiHopDong */
?>
<div class="loai-hop-dong-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'thoi_han',
            'don_vi_tinh',
        ],
    ]) ?>

</div>
