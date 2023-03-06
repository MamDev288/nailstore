<?php

use backend\components\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model backend\models\search\ChiTietBangLuongTungNhanVienSearch */
?>
<div class="ibox-heading search mt-2 pt-2">
    <?php $form = ActiveForm::begin([
        'method' => 'get'
    ]) ?>
    <?= \backend\components\ColumnsWidget::widget(['columns' => [4, 4, 4], 'columnLabels' => [

        $form->field($model, 'thang', ['labelOptions' => ['class' => 'col-sm-4 control-label'], 'size' => 8])->dropDownList(
            \backend\models\NhanVien::month()
        )->label('Lọc theo tháng sinh'),
         $form->field($model, 'dia_chi', ['labelOptions' => ['class' => 'col-sm-4 control-label'], 'size' => 8])->textInput(),
        \backend\components\ColumnsWidget::widget(['columns' => [7, 5], 'columnLabels' => [
            Html::submitButton(Yii::t('app', 'Tìm kiếm'), ['class' => 'btn btn-primary btn-block']),
            Html::a(Yii::t('app', 'Đặt lại'), Url::to(['index', 'bang_luong' => \Yii::$app->request->get('bang_luong')]), ['class' => 'btn btn-default btn-block']),
        ]])
    ]]) ?>
    <?php ActiveForm::end(); ?>
</div>