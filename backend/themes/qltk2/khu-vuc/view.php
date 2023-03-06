<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KhuVuc */
?>
<div class="khu-vuc-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
