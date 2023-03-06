<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ChiTietBaoHiemNhanSu */
/* @var $nhanvien */
/* @var $bao_hiem_nhan_su_id  */


?>
<div class="chi-tiet-bao-hiem-nhan-su-update">
    <?= $this->render('_form', [
        'model' => $model,
        'nhanvien' =>$nhanvien,
        'listHopDongNhanSus' => $listHopDongNhanSus

    ]) ?>

</div>
