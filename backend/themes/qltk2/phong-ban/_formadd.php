<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PhongBan */

?>
<div class="phong-ban-create">
    <?= $this->render('_form', [
        'model' => $model,
        'nhanVienInPhongBan' => $nhanVienInPhongBan,
        'nhanVienNotInPhongBan' => $nhanVienNotInPhongBan,
        'type' => 'add-nhan-vien'
    ]) ?>
</div>