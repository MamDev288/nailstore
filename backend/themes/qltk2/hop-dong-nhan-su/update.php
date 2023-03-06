<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HopDongNhanSu */
/* @var $loaihopdong  */
/* @var $tenHopDong  */
/* @var $nhansu  */

?>
<div class="hop-dong-nhan-su-update">

    <?= $this->render('_form', [
        'model' => $model,
        'loaihopdong' => $loaihopdong,
        'tenHopDong' => $tenHopDong,
        'nhansu' => $nhansu
    ]) ?>

</div>
