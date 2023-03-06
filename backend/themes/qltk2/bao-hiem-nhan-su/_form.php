<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BaoHiemNhanSu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bao-hiem-nhan-su-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'thang')->textInput(['value' => date('m')]) ?>

    <?= $form->field($model, 'nam')->textInput(['value' => date('Y')]) ?>


    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
