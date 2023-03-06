<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TuyenDungDkNhuCauNs */
?>
<div class="tuyen-dung-dk-nhu-cau-ns-update">

    <?= $this->render('_form', [
        'model' => $model,
        'listNguoiPhongVan' => $listNguoiPhongVan,
    ]) ?>

</div>
