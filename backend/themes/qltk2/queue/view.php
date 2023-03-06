<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Queue */
?>
<div class="queue-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'ghi_chu:ntext',
            [
                'label' => 'Đối tượng',
                'format' => 'raw',
                'value' => $model->objectLink ? "<a role='modal-remote' href='$model->objectLink'>". $model->objectName."</a>" : null
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => \backend\services\QueueService::getQueueLabelColor($model->status),
            ],
            [
                'attribute' => 'created_by',
                'value' => $model->createdBy ? $model->createdBy->hoten : null,
            ],
            [
                'attribute' => 'updated_by',
                'value' => $model->updatedBy ? $model->updatedBy->hoten : null,
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
