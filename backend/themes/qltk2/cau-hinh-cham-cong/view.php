<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CauHinhChamCong */
?>
<div class="cau-hinh-cham-cong-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'standard_time',
            'start_time',
            'end_time',
            'type',
            'shift',
        ],
    ]) ?>

</div>
