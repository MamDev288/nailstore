<?php

use backend\components\TimePickerWidget;
use backend\models\NghiPhep;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\NghiPhep */
/* @var $form yii\widgets\ActiveForm */
/* @var $listLyDoNghis \backend\models\DanhMuc[] */
/* @var $type */


?>

<div class="nghi-phep-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= \backend\components\ColumnsWidget::widget(['columns' => [6,6], 'columnLabels' => [
            $form->field($model, 'nghi_tu_ngay')->widget(DatePicker::className(), [
                'type' => 3,
                'id' => 'nghi_tu_ngay',
//        'value' => '23-Feb-1982 10:10',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]),
        $form->field($model, 'nghi_den_ngay')->widget(DatePicker::className(), [
            'type' => 3,
            'id' => 'nghi_den_ngay',
//        'value' => '23-Feb-1982 10:10',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]),
        $form->field($model, 'so_phut')->widget(\backend\components\NumberControl::className(), []),
        $form->field($model, 'ly_do')->widget(\backend\components\Select2::className(), [
            'data' => \yii\helpers\ArrayHelper::map($listLyDoNghis, 'name', 'name'),
            'language' => 'vi',
            'options' => ['placeholder' => '-- Chọn lý do --'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])
    ]]) ?>
    <div class="row">
        <div class="col-md-12">

            <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>

        </div>
    </div>
    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>
</div>
