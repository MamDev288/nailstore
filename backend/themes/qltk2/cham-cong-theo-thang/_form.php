<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NhanVien */
/* @var $phongban backend\models\PhongBan */
/* @var $new_phongban backend\models\PhongBan */

/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
<script src="assets/js/scripts.bundle.js"></script>
<style>
    body{
        background:#eee;
    }
    .form-control {
        border-radius: 0;
        box-shadow: none;
        border-color: #d2d6de
    }

    .select2-hidden-accessible {
        border: 0 !important;
        clip: rect(0 0 0 0) !important;
        height: 1px !important;
        margin: -1px !important;
        overflow: hidden !important;
        padding: 0 !important;
        position: absolute !important;
        width: 1px !important
    }

    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
    }

    .select2-container--default .select2-selection--single,
    .select2-selection .select2-selection--single {
        border: 1px solid #d2d6de;
        border-radius: 0;
        padding: 6px 12px;
        height: 34px
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 4px
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 28px;
        user-select: none;
        -webkit-user-select: none
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-right: 10px
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 0;
        padding-right: 0;
        height: auto;
        margin-top: -3px
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 28px
    }

    .select2-container--default .select2-selection--single,
    .select2-selection .select2-selection--single {
        border: 1px solid #d2d6de;
        border-radius: 0 !important;
        padding: 6px 12px;
        height: 40px !important
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 6px !important;
        right: 1px;
        width: 20px
    }

</style>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            closeOnSelect: false
        });
    });
</script>

<div class="nhan-vien-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<!--    <label class="control-label" for="nhanvien-username">Phòng ban</label>-->
<!--    <select name="phongban_id[]" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Chọn phòng ban" style="width: 100%;" tabindex="-1" aria-hidden="true">-->
<?php //foreach ($phongban as $phongban): ?>
<!--            <option value="--><?//=?><!--" >--><?//=?><!--</option>-->
<!--        --><?php //endforeach;?>
<!--    </select>-->

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anh_nguoi_dung')->fileInput(
        [
            'id'=>'anh_nguoi_dung',
            'onchange' => 'readURL(this)'
        ]);
    ?>

    <?= $form->field($model, 'hoten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dien_thoai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cmnd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngay_cap')->textInput() ?>

    <?= $form->field($model, 'dia_chi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngay_sinh')->textInput() ?>

    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'trinh_do_id')->textInput() ?>

    <?= $form->field($model, 'ngay_nop_ho_so')->textInput() ?>

    <?= $form->field($model, 'noi_cap')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ngay_chinh_thuc')->textInput() ?>

    <?= $form->field($model, 'so_tai_khoan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngan_hang_id')->textInput() ?>

    <?= $form->field($model, 'chu_tai_khoan')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
