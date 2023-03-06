<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\form\VaiTroForm */
/* @var $chucNangs array */
?>
<div class="vai-tro-create">
    <?= $this->render('_form', [
        'model' => $model,
        'chucNangs' => $chucNangs
    ]) ?>
</div>
