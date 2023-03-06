<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DuyetDonDangKiTuyenDung */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="duyet-don-dang-ki-tuyen-dung-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dang_ki_tuyen_dung_nhu_cau_id')->textInput() ?>

    <?= $form->field($model, 'trang_thai')->dropDownList([ 'Chờ duyệt' => 'Chờ duyệt', 'Đã duyệt' => 'Đã duyệt', 'Không duyệt' => 'Không duyệt', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <?= $form->field($model, 'user_duyet_id')->textInput() ?>

    <?= $form->field($model, 'vai_tro_id')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
