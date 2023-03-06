<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
?>
<div class="product-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'describe:ntext',
            'price_in',
            'image',
            'category_id',
            'active',
            'sku',
            'source_id',
            'price_out',
            'price_display',
            'discount',
            'view',
            'created_at',
            'update_at',
            'created_by',
            'update_by',
        ],
    ]) ?>
<?=$btnAdd?>
<?=$btnClose?>
</div>
