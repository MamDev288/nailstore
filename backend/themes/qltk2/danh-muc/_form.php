<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DanhMuc */
/* @var $form yii\widgets\ActiveForm */
/* @var $quan_huyen [] */

?>

<div class="danh-muc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(\backend\models\DanhMuc::getDanhMuc(), ['prompt' => '--Chọn--']) ?>

    <?php if ($model->type === \backend\models\DanhMuc::DUONG_PHO):?>
        <div id="duong_pho">
            <?= $form->field($model, 'parent_id')->dropDownList($quan_huyen,['prompt'=>'--Chọn--'])->label('Quận huyện') ?>
        </div>
    <?php else: ?>
        <div class="hidden" id="parent_id">
            <?= $form->field($model, 'parent_id')->dropDownList($quan_huyen,['prompt'=>'--Chọn--'])->label('Quận huyện') ?>
        </div>
    <?php endif;?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
