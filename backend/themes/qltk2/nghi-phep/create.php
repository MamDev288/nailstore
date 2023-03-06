<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\NghiPhep */
/* @var $type */
/* @var $listLyDoNghis \backend\models\DanhMuc[] */
?>
<div class="nghi-phep-create">
    <?= $this->render('_form', [
        'model' => $model,
        'listLyDoNghis' => $listLyDoNghis,
        'type' => $type
    ]) ?>
</div>
