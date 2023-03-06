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

        <?= \backend\components\ColumnsWidget::widget(['columns' => [4, 4, 4], 'columnLabels' => [
            $form->field($model, 'hoten')->textInput(['placeholder' => 'Họ tên']),
            $form->field($model, 'dien_thoai')->textInput(['type' => 'number', 'placeholder' => 'Điện thoại']),
            $form->field($model, 'email')->textInput(['type' => 'email', 'placeholder' => 'Email']),
            myAPI::activeDateField($form, $model, 'ngay_sinh', 'Ngày sinh', date('Y', strtotime('-60 years')) . ':' . date('Y', strtotime('-18 years')), ['class' => 'form-control  created-date-field', 'autocomplete' => 'off']),
            $form->field($model, 'dia_chi')->textInput(['placeholder' => 'Địa chỉ'])->label('Địa chỉ'),
            $form->field($model, 'gioi_tinh')->radioList(['0' => 'Nam', '1' => 'Nữ'], [])->label('Giới tính'),
            $form->field($model, 'cmnd')->textInput(['placeholder' => 'Căn cước công dân'])->label('Căn cước công dân/CMND'),
            myAPI::activeDateField($form, $model, 'ngay_cap', 'Ngày cấp', '1960:' . '2100', ['class' => 'form-control  created-date-field', 'autocomplete' => 'off', 'placeholder' => 'Ngày cấp']),
            $form->field($model, 'noi_cap')->textInput(['placeholder' => 'Nơi cấp CMND/CCCD'])->label('Nơi Cấp'),
            $form->field($model, 'dia_chi_cu_the_thuong_tru')->textInput(['placeholder' => $model->getAttributeLabel('dia_chi_cu_the_thuong_tru')])->label('Địa chỉ thường trú'),
            $form->field($model, 'dia_chi_hien_tai')->textInput(['placeholder' => $model->getAttributeLabel('dia_chi_hien_tai')])->label('Địa chỉ hiện tại'),
            $form->field($model, 'trinh_do_van_hoa')->textInput(['placeholder' => 'Trình độ văn hóa'])->label('Trình độ văn hoóa'),
            $form->field($model, 'trinh_do_id', ["template" => "{label}<div class='input-group'>{input}<a class='input-group-addon' role='modal-remote' href='" . \yii\helpers\Url::toRoute(['trinh-do-chuyen-mon/create', 'back_url' => $model->isNewRecord ? 'ung-vien/create' : 'ung-vien/update', 'id' => $model->id]) . "' ><i class='fa fa-plus'></i></a></div>"])->widget(\backend\components\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\services\DanhMucService::getAllTrinhDoChuyenMon(), 'id', 'name')
            ])->label('Trình độ học vấn '),
            $form->field($model, 'khoa')->textInput(['placeholder' => $model->getAttributeLabel('khoa')])->label('Khoa/ Nghành học'),
            $form->field($model, 'nam_tot_nghiep')->textInput(['placeholder' => $model->getAttributeLabel('nam_tot_nghiep')])->label('Năm tốt nghiệp'),
            $form->field($model, 'xep_loai')->dropDownList([
                    null,
                    \backend\models\UngVien::XEPLOAI_TRUNGBINH  => \backend\models\UngVien::XEPLOAI_TRUNGBINH,
                \backend\models\UngVien::XEPLOAI_KHA  => \backend\models\UngVien::XEPLOAI_KHA,
                \backend\models\UngVien::XEPLOAI_GIOI  => \backend\models\UngVien::XEPLOAI_GIOI,
            ])->label('Xếp loại'),
            $form->field($model, 'noi_dao_tao')->textInput(['placeholder' => $model->getAttributeLabel('noi_dao_tao')])->label('Nơi đào tạo'),
        ]]) ?>
    </div>


    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'newavatar')->fileInput(['onchange' => 'readURL(this)'])->label('Ảnh đại diện') ?>
        </div>
        <?php if (!empty($model->anh_nguoi_dung)): ?>
            <div class="col-md-4">
                <img id="anh_nguoi_dung" class="image-profile img-rounded mt-5" style="max-width: 100%;"
                     src="<?= '.' . $model->anh_nguoi_dung ?>">
            </div>
        <?php endif; ?>
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
