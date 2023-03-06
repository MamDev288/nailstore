<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
?>
<div class="user-update">
        <?= $this->render('_form', [
            'model' => $model,
            'vaitros' => $vaitros,
            'vaitrouser' => $vaitrouser,

        ]) ?>


</div>
