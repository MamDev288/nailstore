<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\myAPI;

/* @var $this yii\web\View */
/* @var $model backend\models\NhanVien */
/* @var $phongban backend\models\PhongBan */
/* @var $new_phongban backend\models\PhongBan */
/* @var $listPhongBans backend\models\PhongBan[] */

/* @var $form yii\widgets\ActiveForm */
?>
<link rel="stylesheet" href="backend/assets/css/thong-tin-ca-nhan.css">
<div class="nhan-vien-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <input type="hidden" value="<?= $model->id ?>" id="id_user">
                <?= $form->field($model, 'hoten')->textInput(['placeholder' => 'Họ tên']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'dien_thoai')->textInput(['type' => 'number', 'placeholder' => 'Điện thoại']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'email')->textInput(['type' => 'email', 'placeholder' => 'Email']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= myAPI::activeDateField($form, $model, 'ngay_sinh', 'Ngày sinh', '1960:' . '2100', ['class' => 'form-control  created-date-field', 'autocomplete' => 'off']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'dia_chi')->textInput(['placeholder' => 'Địa chỉ']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'gioi_tinh')->radioList(['0' => 'Nam', '1' => 'Nữ'], []); ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'cmnd')->textInput(['placeholder' => 'Căn cước công dân']) ?>
            </div>
            <div class="col-md-4">
                <?= myAPI::activeDateField($form, $model, 'ngay_cap', 'Ngày cấp', '1960:' . '2100', ['class' => 'form-control  created-date-field', 'autocomplete' => 'off', 'placeholder' => 'Ngày cấp']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'noi_cap')->textInput(['placeholder' => 'Nơi cấp CMND/CCCD']) ?>
            </div>
        </div>
        <?= \backend\components\ColumnsWidget::widget([
            'columns' => [4, 4, 4],
            'columnLabels' => [
                $form->field($model, 'so_tai_khoan')->textInput(),
                $form->field($model, 'chu_tai_khoan')->textInput(),
                $form->field($model,'trang_thai')->dropDownList([\backend\models\User::TRANG_THAI_HOAT_DONG => 'Hoạt động', \backend\models\User::TRANG_THAI_THOI_VIEC => 'Thôi việc'])
            ]
        ]) ?>
        <?php if(!$model->isNewRecord): ?>
        <?= \backend\components\ColumnsWidget::widget([
            'columns' => [4, 4, 4],
            'columnLabels' => [
                $form->field($model, 'phong_ban_id')->widget(\backend\components\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map($listPhongBans, 'id' , 'name'),
                    'language' => 'vi',
                    'options' => ['placeholder' => '-- Chọn phòng ban --', 'readonly' => !$model->isNewRecord],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
                $form->field($model, 'chuc_danh_id', ['template' => "{label}<div class='input-group'>{input}<a class='input-group-addon' role='modal-remote' href='" . \yii\helpers\Url::toRoute(['chuc-danh/create', 'back_url' => \yii\helpers\Url::to([$model->isNewRecord ? 'nhan-vien/create' : 'nhan-vien/update', 'id' => $model->id])]) . "' ><i class='fa fa-plus'></i></a></div>"])->widget(\backend\components\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\services\DanhMucService::getAllChucDanh(), 'id' , 'name'),
                    'language' => 'vi',
                    'options' => ['placeholder' => '-- Chọn chức danh --', 'readonly' => !$model->isNewRecord],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ])
            ]
        ]) ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'username')->textInput(['placeholder' => 'Tên đăng nhập']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'newPassword')->textInput(['type' => 'password', 'placeholder' => 'Mật khẩu mới', 'autocomplete' => 'off']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'retypeNewPassword')->textInput(['type' => 'password', 'placeholder' => 'Nhập lại mật khẩu mới', 'autocomplete' => 'off']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'newavatar')->fileInput(['onchange' => 'readURL(this)'])->label('Ảnh đại diện') ?>
            </div>
            <div class="col-md-4">
                <img id="anh_nguoi_dung" class="image-profile img-rounded mt-5" style="max-width: 100%;"
                     src="<?= '.' . $model->anh_nguoi_dung ?>">
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<script>
    $('#anh_nguoi_dung').click(function () {
        $('#nhanvien-newavatar').click()
    })

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#anh_nguoi_dung')
                    .attr('src', e.target.result)
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
