<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\PhongBan;
use backend\models\TuyenDungDkNhuCauNs;

/* @var $this yii\web\View */
/* @var $model_tuyen_dung backend\models\DuyetDonDangKiTuyenDungVaiTro */
/* @var $model backend\models\DuyetDonDangKiTuyenDung */
/* @var $type */
?>
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
        <h4><strong>Thông tin phiếu yêu cầu</strong></h4>
    </div>
    <div class="col-md-4">
        <span><strong>Phòng ban: </strong><?= $model_tuyen_dung->ten_phong_ban ?></span>
    </div>
    <div class="col-md-4">
        <span><strong>Vị trí tuyển dụng: </strong><?= $model_tuyen_dung->vi_tri ?></span>
    </div>
    <div class="col-md-4">
        <span><strong>Người PV: </strong><?= $model->dangKiTuyenDungNhuCau->kh_de_xuat_cb_pv_chuyen_mon ?></span>
    </div>
    <div class="col-md-4">
        <span><strong>Khối: </strong><?= $model_tuyen_dung->khoi ?></span>
    </div>
    <div class="col-md-8">
        <span><strong>Số lượng NV hiện tại: </strong><?= $model_tuyen_dung->so_luong_nv_hien_tai ?></span>
    </div>
    <div class="col-md-4">
        <span><strong>Mức lương: </strong><?= \backend\helpers\NumberHelper::formatNumber($model_tuyen_dung->muc_luong_du_kien)." VNĐ" ?></span>
    </div>
    <div class="col-md-8">
        <span><strong>Số lượng tuyển thêm: </strong><?= $model_tuyen_dung->so_luong_nv_tuyen_them ?></span>
    </div>
    <div class="col-md-12">
        <span><strong>Lý do bổ sung: </strong><?= $model_tuyen_dung->ly_do_bo_xung ?></span>
    </div>
    <div class="col-md-12">
        <h4><strong>Thông tin duyệt phiếu đăng ký</strong></h4>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'dang_ki_tuyen_dung_nhu_cau_id')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'trang_thai')->dropDownList(TuyenDungDkNhuCauNs::getListTrangThaiDuyetDon($type), ['prompt' => '-- Chọn trạng thái --']) ?>
    </div>
    <div class="col-md-4">
        <?= \common\models\myAPI::activeDateField($form ,$model, 'ngay_duyet', 'Ngày duyệt', '2000:'.'2100', ['class' => 'form-control  created-date-field','autocomplete' => 'off']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'user_duyet_id')->textInput(['disabled' => true, 'value' => $model->userDuyet->hoten]) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'ghi_chu')->textarea() ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

