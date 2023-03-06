<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\VaiTro */
/* @var $chucNangs array */
?>
<div class="vai-tro-update">

    <?= $this->render('_form', [
        'model' => $model,
        'chucNangs' => $chucNangs
    ]) ?>

</div>
