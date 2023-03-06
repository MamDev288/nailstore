<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\NhanVien */
/* @var $listPhongBans backend\models\PhongBan[] */
/* @var $phongban  */

?>
<div class="nhan-vien-create">
    <?= $this->render('_form', [
        'model' => $model,
//        'phongban' => $phongban,
    ]) ?>
</div>
