<?php
use \backend\models\User;
use  yii\widgets\ActiveForm;

/** @var $model User*/
?>

<link rel="stylesheet" href="../../../assets/css/thong-tin-ca-nhan.css">

<?php $form = ActiveForm::begin(); ?>
<div class="rounded bg-white mt-5 mb-5">
    <input type="hidden" value="<?= $model->id ?>" id="id_user">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img style="width: 100%" class="img image-profile mt-5" src="<?= '.'.$model->anh_nguoi_dung ?>">
                <p><strong><?= $model->hoten ?></strong></p>
                <span class="text-black-50"><?= $model->email ?></span>
                <span></span>
            </div>
        </div>
        <div class="col-md-9 info-block">
            <div class="p-3 py-5">
                <div class="row mt-2">
                    <div class="col-md-6">
                        <?= $form->field($model, 'hoten')->textInput(['placeholder' => 'Họ tên']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'ngay_sinh')->widget(\kartik\date\DatePicker::className(),[
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]) ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <?= $form->field($model, 'dien_thoai')->textInput(['type'=>'number', 'placeholder' => 'Điện thoại']) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'email')->textInput(['type'=>'email', 'placeholder' => 'Email']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'so_tai_khoan')->textInput(['type'=>'number', 'placeholder' => 'Số tài khoản']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'chu_tai_khoan')->textInput(['placeholder' => 'Chủ tài khoản']) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'cmnd')->textInput(['placeholder' => 'Căn cước công dân']) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'dia_chi')->textInput(['placeholder' => 'Địa chỉ']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php ActiveForm::end(); ?>