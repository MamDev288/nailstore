<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PhongVan */
/* @var $form yii\widgets\ActiveForm */
/* @var $listUngViens backend\models\UngVien[] */
?>

<div class="phong-van-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= \backend\components\ColumnsWidget::widget(['columns' => [6, 6],
        'columnLabels' => [$form->field($model, 'ung_vien_id')->widget(\backend\components\Select2::className(), [
            'data' => \yii\helpers\ArrayHelper::map($listUngViens, 'id', 'hoten'),
            'options' => ['placeholder' => '-- Chọn ứng viên --', 'disabled' => !$model->isNewRecord],
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]),
            $form->field($model, 'tuyen_dung_dk_nhu_cau_ns_id')->widget(\backend\components\Select2::className(), [
                'data' => \backend\services\TuyenDungDkNhuCauNsService::getTuyenDungDkNhuCauNsDaDuyetOptions(),
                'options' => ['placeholder' => '-- Chọn phiếu tuyển dụng --', 'disabled' => !$model->isNewRecord],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ])
        ]
    ]) ?>
    <?= $form->field($model, 'uploadFile')->fileInput(['accept' => "image/png, image/jpeg, image/jpg, .doc,.docx, pdf"]) ?>
    <?= Html::a($model->cv, '.' . $model->cv, ['target' => '_blank']) ?>
    <?= \backend\components\ColumnsWidget::widget(['columns' => [4, 4, 4], 'columnLabels' => [
        $form->field($model, 'status')->dropDownList([
            \backend\models\TrangThaiPhongVan::STATUS_PROCESSING => 'Đang tiến hành',
            \backend\models\TrangThaiPhongVan::STATUS_FAILED => 'Không qua',
            \backend\models\TrangThaiPhongVan::STATUS_SUCCESS => 'Đã qua',
        ]),
        $form->field($model, 'diem_dat_duoc')->textInput(['type' => 'number']),
        $form->field($model, 'ngay_phong_van')->widget(\kartik\datetime\DateTimePicker::className(), [
            'pluginOptions' => ['language' => 'vi', 'autoclose' => true,]
        ])
    ]]) ?>
    <?=$form->field($model, 'ghi_chu')->textarea()?>





    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
