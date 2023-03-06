<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ChiTietBaoHiemNhanSu */
/* @var $form yii\widgets\ActiveForm */
/* @var $nhanvien */
/* @var $bao_hiem_nhan_su_id */
?>

<div class="chi-tiet-bao-hiem-nhan-su-form">

    <?php
    $saveOptions = [
        'type' => 'text',
        'label' => '<label>Saved Value: </label>',
        'class' => 'kv-saved',
        'readonly' => true,
        'tabindex' => 1000
    ];
    $readOnlyOptions = [
        'readonly' => true,
    ];
    ?>
    <?php $form = ActiveForm::begin(['options' => ['id' => 'chi-tiet-bao-hiem-nhan-su-form'], 'action' => \yii\helpers\BaseUrl::to(['chi-tiet-bao-hiem-nhan-su/' . ($model->isNewRecord ? 'create' : 'update'), 'id' => $model->id ?? null])]); ?>
    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'id', ['template' => "{input}"])->hiddenInput() ?>
    <?php endif; ?>
    <?= \backend\components\ColumnsWidget::widget(['columns' => [4, 4, 4], 'columnLabels' => [
        $form->field($model, 'nhan_su_phong_ban_id')->widget(\backend\components\Select2::className(), [
            'data' => $nhanvien,
            'language' => 'vi',
            'options' => ['placeholder' => '--- Chọn nhân sự ---', 'readonly' => !$model->isNewRecord],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]),

        $form->field($model, 'hop_dong_nhan_su_id',
            ['template' => "{label}<div class='input-group'>{input} <a class='input-group-addon' role='modal-remote' href='" . \yii\helpers\Url::toRoute(['hop-dong-nhan-su/create', 'back_url' => \yii\helpers\Url::to([$model->isNewRecord ? 'chi-tiet-bao-hiem-nhan-su/create' : 'chi-tiet-bao-hiem-nhan-su/update', 'id' => $model->id])]) . "'><i class='fa  fa-plus'></i></a></div>"])
            ->widget(\backend\components\Select2::className(), [
                'data' => $listHopDongNhanSus,
                'language' => 'vi',
                'options' => ['placeholder' => '-- Chọn hợp đồng nhân sự'],
                'pluginOptions' => [
                        'allowClear' => true
                ],
            ]),
        $form->field($model, 'so_tien_dong')->widget(\backend\components\MoneyControl::className(), []),
        $form->field($model, 'doanh_nghiep_dong')->widget(\backend\components\MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'nguoi_lao_dong_dong')->widget(\backend\components\MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'tong_nop')->widget(\backend\components\MoneyControl::className(), []),
        $form->field($model, 'he_so_doanh_nghiep_dong')->widget(\backend\components\NumberControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'he_so_nguoi_lao_dong_dong')->widget(\backend\components\NumberControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
    ]]) ?>

    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'bao_hiem_nhan_su_id')->hiddenInput(['template' => '{input}'])->label(false); ?>
    
    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
