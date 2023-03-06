<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PhongVan */
/* @var $listUngViens backend\models\UngVien[] */

?>
<div class="phong-van-create">
    <?= $this->render('_form', [
        'model' => $model,
        'listUngViens' => $listUngViens
    ]) ?>
</div>
