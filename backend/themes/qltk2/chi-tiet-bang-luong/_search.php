<?php

use backend\components\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model backend\models\search\ChiTietBangLuongTungNhanVienSearch */
?>
<div class="ibox-heading search mt-2 pt-2">
    <?php $form = ActiveForm::begin([
        'action' => ['index', 'bang_luong' => \Yii::$app->request->get('bang_luong')],
        'method' => 'get'
    ]) ?>
    <?= \backend\components\ColumnsWidget::widget(['columns' => [3, 3, 3, 3], 'columnLabels' => [
        $form->field($model, 'ten_phong_ban', ['labelOptions' => ['class' => 'col-sm-4 control-label'], 'size' => 8])->widget(\backend\components\Select2::className(), [
            'data' => \yii\helpers\ArrayHelper::map(\backend\services\PhongBanService::getAllPhongBan(['name']), 'name', 'name'),
            'language' => 'vi',
            'options' => ['placeholder' => '-- Chọn phòng ban --'],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]),
        $form->field($model, 'hoten', ['labelOptions' => ['class' => 'col-sm-4 control-label'], 'size' => 8])->widget(\backend\components\Select2::className(), [
            'data' => \yii\helpers\ArrayHelper::map(\backend\services\NhanVienService::getAllNhanVien(['hoten']), 'hoten', 'hoten'),
            'language' => 'vi',
            'options' => ['placeholder' => '-- Chọn nhân viên --'],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]),
        $form->field($model, 'status', ['labelOptions' => ['class' => 'col-sm-4 control-label'], 'size' => 8])->dropDownList(
            \backend\services\ChiTietBangLuongService::getChiTietBangLuongStatusOptions()
        ),
        \backend\components\ColumnsWidget::widget(['columns' => [6, 6], 'columnLabels' => [
            Html::submitButton(Yii::t('app', 'Tìm kiếm'), ['class' => 'btn btn-primary btn-block']),
            Html::a(Yii::t('app', 'Đặt lại'), Url::to(['index', 'bang_luong' => \Yii::$app->request->get('bang_luong')]), ['class' => 'btn btn-default btn-block']),
        ]])
    ]]) ?>
    <?php ActiveForm::end(); ?>
</div>