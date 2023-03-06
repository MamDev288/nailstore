<?php
/* @var $model \backend\models\PhongBanNhanVien */
?>
<div class="phong-ban-form">

<?php $form = \yii\widgets\ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label>Lý do xoá nhân sự khỏi phòng ban?</label>
                <select name="ly_do_nghi_viec" class="form-control">
                    <option value="1">Nghỉ việc</option>
                    <option value="2">Lý do khác</option>
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label>Ngày thực hiện</label>
                <?=\kartik\datetime\DateTimePicker::widget([
                    'name' => 'ngay_nghi_phep',
                    'type' => 3,
                    'id' => 'nghi_tu_ngay',
                    'value' => date('d/m/Y'),
                    'class' =>'col-md-6' ,
//        'value' => '23-Feb-1982 10:10',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'mm/dd/yyyy',
                        'singleDatePicker'=>true,
                        'showDropdowns'=>true
                    ]
                ]);?>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'ghi_chu')->textarea(['maxlength' => true])->label('Ghi chú'); ?>
        </div>
    </div>
<?php  \yii\widgets\ActiveForm::end(); ?>
</div>
