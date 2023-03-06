<?php

use backend\components\TimePickerWidget;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CauHinhChamCong */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cau-hinh-cham-cong-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= TimePickerWidget::TimePicker($form, $model, 'standard_time') ?>

        </div>
        <div class="col-md-6">
            <?= TimePickerWidget::TimePicker($form, $model, 'start_time') ?>

        </div>
        <div class="col-md-6">
            <?= TimePickerWidget::TimePicker($form, $model, 'end_time') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'type')->dropDownList([ 'in' => 'In', 'out' => 'Out', ], ['prompt' => '']) ?>

        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'shift')->dropDownList([ 'Sáng' => 'Sáng', 'Chiều' => 'Chiều', 'Tăng ca' => 'Tăng ca', ], ['prompt' => '']) ?>
        </div>
    </div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
