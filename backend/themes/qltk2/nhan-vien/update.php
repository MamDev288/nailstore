<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\NhanVien */
/* @var $listPhongBans backend\models\PhongBan[] */
/* @var $new_phongban backend\models\PhongBan */

?>
<div class="nhan-vien-create">
    <?= $this->render('_form', [
        'model' => $model,
        'listPhongBans' => $listPhongBans
//        'phongban' => $phongban,
//        'new_phongban' => $new_phongban
    ]) ?>
</div>
