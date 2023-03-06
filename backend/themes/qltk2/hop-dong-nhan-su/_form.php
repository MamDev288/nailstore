<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use     yii\helpers\ArrayHelper;
use backend\components\Select2;
use \common\models\myAPI;

/* @var $this yii\web\View */
/* @var $model backend\models\HopDongNhanSu */
/* @var $form yii\widgets\ActiveForm */
/* @var $loaihopdong */
/* @var $tenHopDong */
/* @var $nhansu */

?>

<div class="hop-dong-nhan-su-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= \backend\components\ColumnsWidget::widget(['columns' => [4, 4, 4], 'columnLabels' => [
        $form->field($model, 'loai_hop_dong_id')->widget(Select2::className(), [
            'data' => ArrayHelper::map($loaihopdong, 'id', 'name'),
            'language' => 'vi',
            'options' => ['placeholder' => '--Chọn Loại Hợp Đồng--'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]),
        $form->field($model, 'ten_hop_dong_id')->widget(Select2::className(), [
            'data' => ArrayHelper::map($tenHopDong, 'id', 'name'),
            'language' => 'vi',
            'options' => ['placeholder' => '--Chọn Tên hợp đồng--'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]),
        $form->field($model, 'nhan_su_id')->widget(Select2::className(), [
            'data' => ArrayHelper::map(\backend\models\NhanVien::find()->all(), 'id', 'hoten'),
            'language' => 'vi',
            'options' => ['placeholder' => '--Chọn Nhân Sự--'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])
    ]]) ?>

    <?= \backend\components\ColumnsWidget::widget(['columns' => [8, 4], 'columnLabels' => [
        $form->field($model, 'don_vi_ky_hop_dong')->dropDownList(
                [
                        'Công ty TNHH Thương Mại và Logistics Thái Bình Dương' => 'Công ty TNHH Thương Mại và Logistics Thái Bình Dương',
                        'Công ty Cổ phần Tập đoàn T&H Việt Nam' => 'Công ty Cổ phần Tập đoàn T&H Việt Nam'
                ]
        ),
        $form->field($model, 'nguoi_dai_dien_ky_id')->widget(Select2::className(), [
            'data' => ArrayHelper::map(\backend\models\NhanVien::find()->all(), 'id', 'hoten'),
            'language' => 'vi',
            'options' => ['placeholder' => '--Chọn Người đại diện --'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]),
    ]]) ?>

    <?= \backend\components\ColumnsWidget::widget(['columns' => [4, 4, 4], 'columnLabels' => [
        myAPI::activeDateField($form, $model, 'ngay_hieu_luc', 'Ngày hiệu lực', '2000:' . '2100', ['class' => 'form-control  created-date-field', 'autocomplete' => 'off']),
        myAPI::activeDateField($form, $model, 'ngay_thuc_hien', 'Ngày thực hiện', '2000:' . '2100', ['class' => 'form-control  created-date-field', 'autocomplete' => 'off']),
        myAPI::activeDateField($form, $model, 'ngay_het_han', 'Ngày hết hạn', '2000:' . '2100', ['class' => 'form-control  created-date-field', 'autocomplete' => 'off']),
        $form->field($model, 'luong_co_ban')->textInput(['type' => 'text', 'value' => \backend\helpers\NumberHelper::formatNumber($model->luong_co_ban)]),
        $form->field($model, 'luong_dong_bao_hiem')->textInput(['type' => 'text', 'value' => \backend\helpers\NumberHelper::formatNumber($model->luong_dong_bao_hiem)]),
        $form->field($model, 'ty_le_huong_luong')->textInput(['type' => 'text', 'value' => \backend\helpers\NumberHelper::formatNumber($model->ty_le_huong_luong, 2)])
    ]]) ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'uploadFile')->fileInput() ?>
            <?= Html::a($model->file_dinh_kem, '.' . $model->file_dinh_kem, ['target' => '_blank']) ?>
        </div>
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $('#hopdongnhansu-luong_co_ban').on('keyup', function () {
        if ($('#hopdongnhansu-luong_co_ban').val() === '') {
            $("#hopdongnhansu-luong_co_ban").val('0')
        }

        var n = parseInt($(this).val().replace(/\D/g, ''), 10);
        $(this).val(n.toLocaleString("vi-VN"));
    });
    $('#hopdongnhansu-luong_dong_bao_hiem').on('keyup', function () {
        if ($('#hopdongnhansu-luong_dong_bao_hiem').val() === '') {
            $("#hopdongnhansu-luong_dong_bao_hiem").val('0')
        }

        var n = parseInt($(this).val().replace(/\D/g, ''), 10);
        $(this).val(n.toLocaleString("vi-VN"));
    });
</script>
