<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $phongban */
/* @var $error */


?>
<div class="phong-ban-nhan-vien-create">
    <?= $this->render('_formcreate', [
        'model' => $model,
        'phongban' => $phongban,
        'error' => $error,

    ]) ?>
</div>
