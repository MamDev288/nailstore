<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\KeHoachTuyenDung */
/* @var $hinhThucDangKi array */
?>
<div class="ke-hoach-tuyen-dung-create">
    <?= $this->render('_form', [
        'model' => $model,
        'hinhThucDangKi' => $hinhThucDangKi
    ]) ?>
</div>
