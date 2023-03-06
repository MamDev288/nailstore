<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\User;
use backend\models\PhongBan;
use common\widgets\select2\Select2;
use backend\models\PhongBanNhanVien;
/* @var $this yii\web\View */
/* @var $model backend\models\QuanLyPhongBan */
/* @var $modelpbnv PhongBanNhanVien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row phong-ban-form">
    <?php $form = ActiveForm::begin();  ?>
    <div class="col-md-6">
        <?= $form->field($model, 'id')->textInput(['type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'name')->textInput(['disabled' => true])->label('Tên bộ phận / phòng ban') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'phong_ban_cha')->textInput(['disabled' => true])->label('Nhóm') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'truong_phong')->textInput(['disabled' => true])->label('Trưởng phòng hiện tại') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'truong_phong_id')->dropDownList( ArrayHelper::map(
            $modelpbnv, 'nhan_vien_id', 'hoten'), ['prompt' => '--Chọn Trưởng Phòng--'])->label("Trưởng phòng mới")
        ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
