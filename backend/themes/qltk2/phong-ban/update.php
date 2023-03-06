<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PhongBan */
/* @var $modelpbnv backend\models\PhongBanNhanVien */
?>
<div class="phong-ban-update">
    <?= $this->render('_form', [
        'model' => $model,
        'modelpbnv' => $modelpbnv,
        'nhanVienInPhongBan' => $nhanVienInPhongBan,
        'nhanVienNotInPhongBan' => $nhanVienNotInPhongBan
    ]) ?>

</div>
