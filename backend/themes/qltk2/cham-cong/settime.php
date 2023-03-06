<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ChamCong */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cham-cong-form">

    <?php $form = ActiveForm::begin(['action'=>'/new-hrm/index.php?r=cham-cong%2Fset-time']); ?>

<!--    <input type="text" name="year" placeholder="year">-->
<!--    <input type="text" name="month" placeholder="month">-->
    <input type="text" name="day" placeholder="day">
    <input type="text" name="hour" placeholder="hour">
    <input type="text" name="minute" placeholder="minute">
<!--    <input type="text" name="second" placeholder="second">-->



  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('SetTime' , ['class' =>'btn btn-success']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
