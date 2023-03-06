<?php

use yii\widgets\DetailView;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NhanVien */
?>
<link rel="stylesheet" href="backend/assets/css/thong-tin-ca-nhan.css">
<link rel="stylesheet" href="backend/assets/css/image.css">
<link rel="stylesheet" href="backend/themes/qltk2/nhan-vien/asset/chi-tiet-nhan-vien.css">



<div class="bg-white mt-5 mb-5">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs custom-nav" role="tablist">
        <li role="presentation" class="active">
            <a href="#thong-tin-chung" aria-controls="thong-tin-chung" role="tab" data-toggle="tab"><h4>Thông tin chung</h4></a>
        </li>
        <li role="presentation">
            <a href="#tuyen-dung" aria-controls="tuyen-dung" role="tab" data-toggle="tab"><h4>Tuyển dụng</h4></a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="thong-tin-chung">
            <?= $this->render('partial-view/_thong-tin-chung', ['model' => $model]) ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="tuyen-dung">
            <?= $this->render('partial-view/_tuyen_dung', ['model' => $model]) ?>
        </div>
    </div>
</div>
