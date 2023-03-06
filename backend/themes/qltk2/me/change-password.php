<?php
use backend\models\form\ChangePasswordForm;
use yii\widgets\ActiveForm;
/** @var $model ChangePasswordForm*/
?>
<?php $form = ActiveForm::begin(); ?>
<div class="change-password-form">
    <?=\backend\components\ColumnsWidget::widget(['columns' => [12], 'columnLabels' => [
        $form->field($model,'oldPassword')->passwordInput(),
        $form->field($model,'newPassword')->passwordInput(),
        $form->field($model,'repeatPassword')->passwordInput(),
    ]])?>
</div>
<?php ActiveForm::end() ?>
