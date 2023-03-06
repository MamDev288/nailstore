<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KeyFcm */
?>
<div class="key-fcm-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'key:ntext',
            'active',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
