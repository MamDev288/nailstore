<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ThayDoiLuong */
/* @var $form yii\widgets\ActiveForm */
/* @var $hop_dong_nhan_su_id  */
?>

<div class="thay-doi-luong-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'luong_dong_bao_hiem')->textInput(['maxlength' => true]) ?>


    <input type="hidden" name="ThayDoiLuong[hop_dong_nhan_su_id]" value="<?= Yii::$app->request->get('hop_dong_nhan_su_id') ?? \backend\models\ThayDoiLuong::find()->where(['id'=>$model->id])->one()->hop_dong_nhan_su_id ?>">

    <?= $form->field($model, 'luong_thang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'luong_mem')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
