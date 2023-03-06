<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Tạo mới sản phẩm');

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

?>
<div class="product-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
