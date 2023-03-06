<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BangLuong */
/* @var $form yii\widgets\ActiveForm */
/* @var $allNhanSu \backend\models\NhanVien[] */
?>

<div class="bang-luong-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'user_id')->widget(\backend\components\Select2::className(),[
            'data' => $allNhanSu
    ]) ?>

    <?= $form->field($model, 'thang')->textInput() ?>

    <?= $form->field($model, 'nam')->textInput() ?>

    <?= $form->field($model, 'trang_thai')->dropDownList([ 'Lưu nháp' => 'Lưu nháp', 'Chốt luong' => 'Chốt luong', ], ['prompt' => '']) ?>

    <?= \common\models\myAPI::activeDateField($form, $model, 'created', 'Ngày tạo', '2000:'.'2100', ['class' => 'form-control  created-date-field','autocomplete' => 'off']) ?>

    <?= \common\models\myAPI::activeDateField($form, $model, 'ngay_cham_luong', 'Ngày chấm lương', '2000:'.'2100', ['class' => 'form-control  created-date-field','autocomplete' => 'off']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
