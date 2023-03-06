<?php

use backend\helpers\DateTimeHelper;
use backend\components\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ChamCong */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cham-cong-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= \backend\components\ColumnsWidget::widget([
        'columns' => [6, 6],
        'columnLabels' => [
            $form->field($model, 'date')->widget(\kartik\date\DatePicker::className(), [
                'options' => [
                    'disabled' => !$model->isNewRecord
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]),
            $form->field($model, 'nhan_vien_id')->widget(\backend\components\Select2::className(), [
                'options' => ['disabled' => !$model->isNewRecord, 'placeholder' => 'Chọn nhân viên'],
                'pluginOptions' => ['allowClear' => true],
                'data' => \yii\helpers\ArrayHelper::map(\backend\services\PhongBanService::getAllNhanVienInAllPhongBan(['nhan_vien_id', 'hoten']), 'nhan_vien_id', 'hoten')]),
            $form->field($model, 'vao1')->widget(DateTimePicker::className(), [
                'name' => 'ChamCong[vao1]',
                'type' => 3,
                'id' => 'vao1',
                'language' => 'vi',
                'class' => 'col-md-6',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss',
                ]
            ]),
            $form->field($model, 'ra1')->widget(DateTimePicker::className(), [
                'name' => 'ChamCong[ra1]',
                'type' => 3,
                'id' => 'ra1',
                'class' => 'col-md-6',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]),
            $form->field($model, 'vao2')->widget(DateTimePicker::className(), [
                'name' => 'ChamCong[vao2]',
                'type' => 3,
                'id' => 'vao2',
                'class' => 'col-md-6',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]),
            $form->field($model, 'ra2')->widget(DateTimePicker::className(), [
                'name' => 'ChamCong[ra2]',
                'type' => 3,
                'id' => 'ra2',
                'class' => 'col-md-6',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]),
            $form->field($model, 'so_lan_quen_check_in')->widget(\backend\components\NumberControl::className()),
            $form->field($model, 'so_lan_quen_check_out')->widget(\backend\components\NumberControl::className()),
            $form->field($model, 'so_phut_di_muon')->widget(\backend\components\NumberControl::className()),
            $form->field($model, 'so_cong_bi_tru')->widget(\backend\components\NumberControl::className()),
            $form->field($model, 'so_tien_phat')->widget(\backend\components\MoneyControl::className()),
            $form->field($model, 'so_cong_chuan')->widget(\backend\components\NumberControl::className()),
        ]
    ]) ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>


    <?php ActiveForm::end(); ?>


</div>
