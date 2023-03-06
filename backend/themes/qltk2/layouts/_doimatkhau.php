<?php
/**
 * Created by PhpStorm.
 * User: hungluong
 * Date: 7/24/17
 * Time: 8:57 AM
 */?>

<link rel="stylesheet" href="backend/assets/css/doi-mat-khau.css">
<?php \yii\bootstrap\Modal::begin([
    'id' => 'modal-doimatkhau',
    'size' => \yii\bootstrap\Modal::SIZE_SMALL,
    'header' => '<h4 class="modal-title">Đổi mật khẩu</h4>',
    'footer' => \common\models\myAPI::getBtnCloseModal().\yii\bootstrap\Html::a('<i class="fa fa-save"></i> Thực hiện', '#', ['class' => 'btn btn-primary btn-thuchiendoimatkhau'])
])?>
<?php $form = \yii\bootstrap\ActiveForm::begin([
    'options' => ['id' => 'form-doimatkhau']
])?>
<div class="thongbao"></div>
<div class="form-group">
    <?=\yii\bootstrap\Html::label('Mật khẩu cũ', 'mat-khau-cu') ?>
    <i class="fa fa-eye eye-icon" id="xem-mat-khau-cu"></i>
    <?=\yii\bootstrap\Html::textInput('matkhaucu', null, ['type' => 'password', 'class' => 'form-control input-field', 'id' => 'mat-khau-cu'])?>
</div>
<div class="form-group">
    <?=\yii\bootstrap\Html::label('Mật khẩu mới', 'mat-khau-moi')?>
    <i class="fa fa-eye eye-icon" id="xem-mat-khau-moi"></i>
    <?=\yii\bootstrap\Html::textInput('matkhaumoi', null, ['type' => 'password', 'class' => 'form-control input-field', 'id' => 'mat-khau-moi'])?>
</div>
<div class="form-group">
    <?=\yii\bootstrap\Html::label('Nhập lại ', 'mat-khau-moi')?>
    <i class="fa fa-eye eye-icon" id="xem-mat-khau-nhap-lai"></i>
    <?=\yii\bootstrap\Html::textInput('nhaplaimatkhaumoi', null, ['type' => 'password', 'class' => 'form-control input-field', 'id' => 'nhap-lai-matkhaumoi'])?>
</div>
<?php \yii\bootstrap\ActiveForm::end() ?>
<?php \yii\bootstrap\Modal::end(); ?>
