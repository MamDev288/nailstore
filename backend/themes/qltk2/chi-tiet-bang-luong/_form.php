<?php

use backend\services\PhongBanService;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\components\MoneyControl;
use backend\components\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\ChiTietBangLuong */
/* @var $form yii\widgets\ActiveForm */
/* @var $listPhongBanNhanViens \backend\models\ChiTietPhongBanNhanVien[] */
/* @var $listHopDongNhanSus \backend\models\QuanLyHopDongNhanSu[] */
?>

<div class="chi-tiet-bang-luong-form">
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
    <?php $form = ActiveForm::begin(['options' => ['id' => 'chi-tiet-bang-luong-form'], 'action' => \yii\helpers\BaseUrl::to(['chi-tiet-bang-luong/' . ($model->isNewRecord ? 'create' : 'update'), 'id' => $model->id ?? null])]); ?>
    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'id', ['template' => "{input}"])->hiddenInput() ?>
    <?php endif; ?>
    <?= \backend\components\ColumnsWidget::widget(['columns' => [4, 4, 4], 'columnLabels' => [
        $form->field($model, 'nhan_su_phong_ban_id')->widget(\backend\components\Select2::className(), [
            'data' => $listPhongBanNhanViens,
            'language' => 'vi',
            'options' => ['placeholder' => '-- Chọn nhân sự --', 'readonly' => !$model->isNewRecord],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]),
        $form->field($model, 'hop_dong_nhan_su_id',
            ['template' => "{label}<div class='input-group'>{input}<a class='input-group-addon' role='modal-remote' href='" . \yii\helpers\Url::toRoute(['hop-dong-nhan-su/create', 'back_url' => \yii\helpers\Url::to([$model->isNewRecord ? 'chi-tiet-bang-luong/create' : 'chi-tiet-bang-luong/update', 'id' => $model->id])]) . "' ><i class='fa fa-plus'></i></a></div>"])
            ->widget(\backend\components\Select2::className(), [
                'data' => $listHopDongNhanSus,
                'language' => 'vi',
                'options' => ['placeholder' => '-- Chọn hợp đồng nhân sự --'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]),
        $form->field($model, 'luong_dong_bhxh')->widget(MoneyControl::className(), []),
        $form->field($model, 'luong_cung')->widget(MoneyControl::className(), []),
        $form->field($model, 'luong_mem')->widget(MoneyControl::className(), []),
        $form->field($model, 'so_cong_thuc_te')->widget(NumberControl::className(), []),
        $form->field($model, 'luong_mot_ngay_cong')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'luong_theo_so_cong_thuc_te')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'thuong')->widget(MoneyControl::className(), []),
        $form->field($model, 'ngay_cong_huong_phu_cap_an_trua')->widget(NumberControl::className(), []),
        $form->field($model, 'tien_phu_cap_an_trua_1_bua')->widget(MoneyControl::className(), []),
        $form->field($model, 'tien_phu_cap_an_trua')->widget(MoneyControl::className(), []),
        $form->field($model, 'so_nam_cong_tac')->widget(NumberControl::className(), []),
        $form->field($model, 'phu_cap_tham_nien_1_nam')->widget(MoneyControl::className(), []),
        $form->field($model, 'phu_cap_tham_nien')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'phu_cap_xang_xe')->widget(MoneyControl::className(), []),
        $form->field($model, 'tong_phu_cap')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'tong_luong')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'BHXH')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'BHYT')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'BHTN')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'thue_TNCN')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'tong_cong_giam_tru')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'luong_thuc_te')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'cong_doan')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'phu_cap_tien_an_di_cong_tac')->widget(MoneyControl::className(), []),
        $form->field($model, 'phu_cap_khac')->widget(MoneyControl::className(), []),
        $form->field($model, 'tien_phat')->widget(MoneyControl::className(), []),
        $form->field($model, 'thuc_tra')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
        $form->field($model, 'tong_luong_full_cong')->widget(MoneyControl::className(), [
            'displayOptions' => $readOnlyOptions
        ]),
    ]]) ?>

    <?php if (!empty($model->nhan_su_phong_ban_id) &&
        PhongBanService::getKhoiLogisticsByPhongBanNhanVienId($model->nhan_su_phong_ban_id)): ?>
        <hr/>
        <h3>Lương khối Logistics</h3>
        <?= \backend\components\ColumnsWidget::widget(['columns' => [6, 6], 'columnLabels' => [
            $form->field($model, 'npt')->widget(NumberControl::className(), []),
            $form->field($model, 'thu_nhap_chiu_thue')->widget(MoneyControl::className(), [
                'displayOptions' => $readOnlyOptions
            ]),
        ]]); ?>
        <?= \backend\components\ColumnsWidget::widget(['columns' => [4, 4, 4], 'columnLabels' => [
            $form->field($model, 'khoan_giam_tru_ban_than')->widget(MoneyControl::className(), []),
            $form->field($model, 'khoan_giam_tru_npt')->widget(MoneyControl::className(), [
                'displayOptions' => $readOnlyOptions
            ]),
            $form->field($model, 'khoan_giam_tru_bhxh')->widget(MoneyControl::className(), [
                'displayOptions' => $readOnlyOptions
            ]),
        ]]); ?>
        <?= \backend\components\ColumnsWidget::widget(['columns' => [6, 6], 'columnLabels' => [
            $form->field($model, 'tntt')->widget(MoneyControl::className(), [
                'displayOptions' => $readOnlyOptions
            ]),
            $form->field($model, 'tncn')->widget(MoneyControl::className(), [
                'displayOptions' => $readOnlyOptions
            ]),
        ]]); ?>
    <?php endif; ?>

    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'bang_luong_id')->hiddenInput(['template' => '{input}'])->label(false); ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
