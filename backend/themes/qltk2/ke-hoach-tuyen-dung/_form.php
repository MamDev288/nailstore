<?php

use backend\components\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use \backend\models\KhHinhThucDangKy;
use \backend\models\DanhMuc;
use \common\models\myAPI;
use \backend\models\TuyenDungDkNhuCauNs;

/* @var $this yii\web\View */
/* @var $model backend\models\TuyenDungDkNhuCauNs */
/* @var $form yii\widgets\ActiveForm */
/* @var $hinhThucDangKi */
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12">
            <h4><strong>Hình thức đăng ký</strong></h4>
            <?= Html::checkboxList('KhHinhThucDangKy[]', $hinhThucDangKi, ArrayHelper::map(DanhMuc::find()->andFilterWhere(['type' => DanhMuc::HINH_THUC_DANG_KI])->all(), 'name', 'name'),
                ['prompt' => '', 'class' => 'list-block-hinh-thuc-dk']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'kh_nguoi_lap_ke_hoach_id')->widget(Select2::className(), [
                'data' => ArrayHelper::map(\backend\models\NhanVien::find()->all(), 'id', 'hoten'),
                'language' => 'vi',
                'options' => ['placeholder' => '--Chọn người lập kế hoạch--'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'vi_tri_tuyen_dung_id')->textInput(['disabled' => true, 'value' => $model->viTriTuyenDung->vi_tri ?? null])->label('Chức danh')?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'phong_ban_id')->dropDownList(ArrayHelper::map(
                TuyenDungDkNhuCauNs::getTenPhongBan($model), 'id', 'name'), ['prompt' => '-- Chọn người phòng ban--'])->label('Phòng/Khối')
            ?>
        </div>
        <div class="col-md-3">
            <?= myAPI::activeDateField($form ,$model, 'kh_ngay_lap_ke_hoach', 'Ngày lập kế hoạch', '2000:'.'2100', ['class' => 'form-control  created-date-field','autocomplete' => 'off']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'vi_tri_tuyen_dung_id')->textInput(['disabled' => true, 'value' => $model->viTriTuyenDung->vi_tri ?? null])?>
        </div>
        <div class="col-md-3">
            <div class="col-md-6" style="padding: 0 5px 0 0;">
                <?= $form->field($model, 'so_luong_nv_hien_tai')->textInput(['disabled' => true, 'class' => 'form-control text-right',
                    'value' => number_format($model->so_luong_nv_hien_tai, 0, ',', '.')])?>
            </div>
            <div class="col-md-6" style="padding: 0 0 0 5px;">
                <?= $form->field($model, 'so_luong_nv_tuyen_them')->textInput(['disabled' => true, 'class' => 'form-control text-right',
                    'value' => number_format($model->so_luong_nv_tuyen_them, 0, ',', '.')])?>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'muc_luong_du_kien')->textInput(['disabled' => true, 'class' => 'form-control text-right',
                'value' => number_format($model->muc_luong_du_kien, 0, ',', '.').' VNĐ'])?>
        </div>
        <div class="col-md-12">
            <h4><strong>Mô tả công việc</strong></h4>
            <?= $model->mo_ta_cong_viec ?>
        </div>
        <div class="col-md-12">
            <h4><strong>Tiêu chuẩn ứng viên</strong></h4>
            <?= $model->tieu_chuan_ung_vien ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'kh_de_xuat_cb_pv_chuyen_mon')->widget(Select2::className(), [
                'data' => ArrayHelper::map(\backend\models\NhanVien::find()->all(), 'hoten', 'hoten'),
                'language' => 'vi',
                'options' => ['placeholder' => '-- Cán bộ phỏng vấn --'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label('<h4><strong>Đề xuất cán bộ PV chuyên môn</strong></h4>')
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'kh_hinh_thuc_tuyen_dung')->dropDownList(TuyenDungDkNhuCauNs::getHinhThucTuyenDung(), ['prompt' => '-- Hình thức tuyển dụng --'])->label('<h4><strong>Hình thức tuyển dụng</strong></h4>')
            ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'kh_tien_trinh_bo_sung_nhan_su')->textArea(['row' => 2])->label('<h4><strong>Tiến trình bổ sung nhân sự</strong></h4>')
            ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>