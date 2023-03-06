<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\NghiPhepSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nghi-phep-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nhan_vien_phong_ban_id') ?>

    <?= $form->field($model, 'nghi_tu_ngay') ?>

    <?= $form->field($model, 'nghi_den_ngay') ?>

    <?= $form->field($model, 'ly_do') ?>

    <?php // echo $form->field($model, 'nguoi_lam_don_id') ?>

    <?php // echo $form->field($model, 'truong_bo_phan_id') ?>

    <?php // echo $form->field($model, 'trang_thai') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'noi_dung') ?>

    <?php // echo $form->field($model, 'ghi_chu') ?>

    <?php // echo $form->field($model, 'ngay_de_nghi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
