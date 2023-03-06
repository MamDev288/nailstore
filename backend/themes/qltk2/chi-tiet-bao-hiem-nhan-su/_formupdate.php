<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ChiTietBaoHiemNhanSu */
/* @var $form yii\widgets\ActiveForm */
/* @var $nhanvien  */
/* @var $bao_hiem_nhan_su_id */

?>

<div class="chi-tiet-bao-hiem-nhan-su-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nhan_su_phong_ban_id')->dropDownList(  $nhanvien) ?>

    <?= $form->field($model, 'so_tien_dong')->textInput(['maxlength' => true]) ?>

    <input type="hidden" name="ChiTietBaoHiemNhanSu[bao_hiem_nhan_su_id]" value="<?= $bao_hiem_nhan_su_id  ?>">

    <?= $form->field($model, 'doanh_nghiep_dong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nguoi_lao_dong_dong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tong_nop')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'he_so_doanh_nghiep_dong')->textInput() ?>

    <?= $form->field($model, 'he_so_nguoi_lao_dong_dong')->textInput() ?>


    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
