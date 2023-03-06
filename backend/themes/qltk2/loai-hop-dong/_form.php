<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LoaiHopDong */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loai-hop-dong-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thoi_han')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList([
        \backend\helpers\ConstHelper::LOAI_HOP_DONG => 'Loại hợp đồng',
        \backend\helpers\ConstHelper::TEN_HOP_DONG => 'Tên hợp đồng',
    ]) ?>

    <?= $form->field($model, 'don_vi_tinh')->dropDownList(['Tháng' => 'Tháng', 'Năm' => 'Năm',], ['prompt' => '']) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
