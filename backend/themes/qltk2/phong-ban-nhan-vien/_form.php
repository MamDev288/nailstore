<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\User;
use backend\models\PhongBan;

/* @var $this yii\web\View */
/* @var $model backend\models\PhongBanNhanVien */
/* @var $phongban backend\models\PhongBan */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="phong-ban-nhan-vien-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nhan_vien_id')->dropDownList( ArrayHelper::map(User::find()->andFilterWhere(['active'=>1])->all(), 'id', 'username')) ?>

    <?= $form->field($model, 'phong_ban_id')->dropDownList( ArrayHelper::map(PhongBan::find()->andFilterWhere(['active'=>1])->all(), 'id', 'name'), ['prompt' => '--Chọn Phòng Ban--']) ?>

    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'chuc_danh_id')->textInput() ?>

    <?= $form->field($model, 'luong_co_ban')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
