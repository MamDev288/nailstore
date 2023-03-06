<?php

use backend\models\VaiTro;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= \backend\components\ColumnsWidget::widget([
            'columns' => [4, 4, 4],
        'columnLabels' => [
            $form->field($model, 'hoten')->textInput()->label('Họ tên'),
            $form->field($model, 'username')->textInput()->label('Tài khoản'),
            $form->field($model, 'password')->passwordInput()->label('Mật khẩu'),
            $form->field($model, 'dien_thoai')->textInput()->label('Điện thoại'),
            $form->field($model, 'email')->textInput()->label('Email'),
            $form->field($model, 'trang_thai')->dropDownList([\backend\models\User::TRANG_THAI_HOAT_DONG => 'Hoạt động', \backend\models\User::TRANG_THAI_THOI_VIEC => 'Thôi việc'])
        ]
    ]) ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'dia_chi')->textInput()->label('Địa chỉ')?>
        </div>
    </div>

    <h4>Vai trò</h4><hr/>
    <?= Html::checkboxList('Vaitrouser[]', $vaitros, ArrayHelper::map(VaiTro::find()->all(), 'id', 'name'),
        ['prompt' => '', 'class' => 'list-block']) ?>

    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
