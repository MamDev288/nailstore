<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\QuanLyTuyenDungNhuCauNsUser */
/* @var $form yii\widgets\ActiveForm */
/* @var $listNguoiPhongVan */
?>

<div class="tuyen-dung-dk-nhu-cau-ns-form">
    <?php $form = ActiveForm::begin(['id' => 'form-ke-hoach-tuyen-dung', 'action' => \yii\helpers\BaseUrl::to(['tuyen-dung-dk-nhu-cau-ns/' . ($model->isNewRecord ? 'create' : 'update'), 'id' => $model->id ?? null])]); ?>
    <div class="row">
        <div class="col-md-3">
            <?php if (!$model->isNewRecord): ?>
                <?= $form->field($model, 'id')->textInput(['type' => 'hidden'])->label(false) ?>
            <?php endif; ?>
            <?= $form->field($model, 'phong_ban_id')->dropDownList(ArrayHelper::map(
                \backend\models\TuyenDungDkNhuCauNs::getTenPhongBan($model), 'id', 'name'), ['prompt' => '-- Chọn Phòng Ban --'])->label('Phòng ban')
            ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'vi_tri_tuyen_dung_id', ['template' => "{label}<div class='input-group'>{input}<a class='input-group-addon' role='modal-remote' href='".\yii\helpers\Url::toRoute(['vi-tri-cong-viec/create', 'back_url' => $model->isNewRecord ? 'tuyen-dung-dk-nhu-cau-ns/create' : 'tuyen-dung-dk-nhu-cau-ns/update', 'id' => $model->id])."' ><i class='fa fa-plus'></i></a></div>"])->dropDownList(
                ArrayHelper::map(\backend\models\TuyenDungDkNhuCauNs::layDanhSachViTri(), 'id', 'vi_tri'), ['prompt' => '-- Chọn vị trí --'])->label('Vị trí tuyển dụng') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'so_luong_nv_hien_tai')->textInput(['type' => 'text', 'value' => \backend\helpers\NumberHelper::formatNumber($model->so_luong_nv_hien_tai)]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'so_luong_nv_tuyen_them')->textInput(['type' => 'text', 'value' => \backend\helpers\NumberHelper::formatNumber($model->so_luong_nv_tuyen_them)])->label('Số lượng tuyển thêm') ?>
        </div>
    </div>

    <?= $form->field($model, 'mo_ta_cong_viec')->textarea(['rows' => 3])->label('Mô tả công việc') ?>

    <?= $form->field($model, 'tieu_chuan_ung_vien')->textarea(['rows' => 3])->label('Yêu cầu công việc') ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'muc_luong_du_kien', ['template' => "{label}<div class='input-group'>{input}<span class='input-group-addon'>VNĐ</span></div>"])->textInput(['type' => 'currency',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->muc_luong_du_kien)])
                ->label('Mức lương dự kiến') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'de_xuat_nguoi_phong_van_id')->widget(\backend\components\Select2::className(), [
                'data' => $listNguoiPhongVan,
                'language' => 'vi',
                'options' => ['placeholder' => '-- Chọn Người phỏng vấn --'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'ly_do_bo_xung')->textarea(['rows' => 3]) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $('#tuyendungdknhucauns-muc_luong_du_kien').on('keyup', function () {
        if ($('#tuyendungdknhucauns-muc_luong_du_kien').val() === '') {
            $("#tuyendungdknhucauns-muc_luong_du_kien").val('0')
        }
        var n = parseInt($(this).val().replace(/\D/g, ''), 10);
        $(this).val(n.toLocaleString("vi-VN"));
    });
    $('#tuyendungdknhucauns-so_luong_nv_hien_tai').on('keyup', function () {

        if ($('#tuyendungdknhucauns-so_luong_nv_hien_tai').val() === '') {
            $("#tuyendungdknhucauns-so_luong_nv_hien_tai").val('0')
        }

        var soluong = $('#tuyendungdknhucauns-so_luong_nv_hien_tai').val()
        soluong = soluong.replace('.', '')

        $('.btn-luu-them-yeu-cau').prop('disabled', false)
        if (soluong.length > 4) {
            alertify.error("Số lượng nhân viên không được lớn hơn 10.000")
            $('.btn-luu-them-yeu-cau').prop('disabled', true)
        } else {
            $('.btn-luu-them-yeu-cau').prop('disabled', false)
        }
        var n = parseInt($(this).val().replace(/\D/g, ''), 10);
        $(this).val(n.toLocaleString("vi-VN"));
    });
    $('#tuyendungdknhucauns-so_luong_nv_tuyen_them').on('keyup', function () {
        if ($('#tuyendungdknhucauns-so_luong_nv_tuyen_them').val() === '') {
            $("#tuyendungdknhucauns-so_luong_nv_tuyen_them").val('0')
        }

        var soluong = $('#tuyendungdknhucauns-so_luong_nv_tuyen_them').val()
        soluong = soluong.replace('.', '')

        $('.btn-luu-them-yeu-cau').prop('disabled', false)
        if (soluong.length > 4) {
            alertify.error("Số lượng nhân viên không được lớn hơn 10.000")
            $('.btn-luu-them-yeu-cau').prop('disabled', true)
        } else {
            $('.btn-luu-them-yeu-cau').prop('disabled', false)
        }
        var n = parseInt($(this).val().replace(/\D/g, ''), 10);
        $(this).val(n.toLocaleString("vi-VN"));
    });

</script>
