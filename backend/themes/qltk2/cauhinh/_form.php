<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Cauhinh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cauhinh-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=$form->field($model, 'name')->label('Tên');?>

    <?php if($model->isNewRecord):?>
        <?=$form->field($model, 'ghi_chu')->label('Ký hiệu');?>
    <?php endif; ?>
    <?php if($model->ckeditor == 1): ?>
        <?= $form->field($model, 'content')->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full'
        ]) ?>
    <?php elseif($model->ghi_chu == \backend\models\CauHinh::KEY_DANH_SACH_NHAN_SU_FULL_CONG || $model->ghi_chu == \backend\models\CauHinh::KEY_DANH_SACH_NHAN_SU_KHONG_HUONG_PHU_CAP_AN_TRUA): ?>
        <?= $form->field($model, 'content')->widget(\backend\components\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\services\NhanVienService::getAllNhanVien(['id', 'hoten']), 'id', 'hoten'),
            'language' => 'vi',
            'options' => ['placeholder' => '-- Chọn nhân sự --', 'multiple' => true],
        ]); ?>
    <?php elseif(in_array($model->ghi_chu, [\backend\models\CauHinh::KEY_ID_VAI_TRO_TRUONG_PHONG, \backend\models\CauHinh::KEY_ID_VAI_TRO_GIAM_DOC, \backend\models\CauHinh::KEY_ID_VAI_TRO_PHO_GIAM_DOC])): ?>
        <?= $form->field($model, 'content')->widget(\backend\components\Select2::className(), [
            'data' => \yii\helpers\ArrayHelper::map(\backend\services\VaiTroService::getAllVaiTro(['id', 'name']), 'id', 'name'),
            'language' => 'vi',
            'options' => ['placeholder' => '-- Chọn vai trò --'],
        ]); ?>
    <?php else: ?>
        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?php endif ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Thêm mới'
                : '<i class="fa fa-save"></i> Cập nhật',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
