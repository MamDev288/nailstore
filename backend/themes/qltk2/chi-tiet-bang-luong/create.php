<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ChiTietBangLuong */
/* @var $listPhongBanNhanViens \backend\models\ChiTietPhongBanNhanVien[] */
/* @var $listHopDongNhanSus \backend\models\QuanLyHopDongNhanSu[] */
?>
<div class="chi-tiet-bang-luong-create">
    <?= $this->render('_form', [
        'model' => $model,
        'listPhongBanNhanViens' => $listPhongBanNhanViens,
        'listHopDongNhanSus' => $listHopDongNhanSus
    ]) ?>
</div>
