<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DuyetNghiPhep */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="duyet-nghi-phep-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nghi_phep_id')->textInput() ?>

    <?= $form->field($model, 'trang_thai')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'user_duyet_id')->textInput() ?>

    <?= $form->field($model, 'duyet_nghi_phep_id')->textInput() ?>

    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
