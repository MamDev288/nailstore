<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BangLuong */
/* @var $allNhanSu backend\models\NhanVien[] */

?>
<div class="bang-luong-create">
    <?= $this->render('_form', [
        'model' => $model,
        'allNhanSu' => $allNhanSu
    ]) ?>
</div>
