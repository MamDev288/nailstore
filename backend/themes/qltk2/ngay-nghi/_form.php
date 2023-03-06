<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NgayNghi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ngay-nghi-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'loai_ngay_nghi')->dropDownList([ 'Nghỉ thường niên' => 'Nghỉ thường niên', 'Nghỉ cố định' => 'Nghỉ cố định', ], ['prompt' => 'Loại ngày nghỉ']) ?>

    <?= $form->field($model, 'ngay_nghi')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'vn',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => [
            'class' => 'form-control field-ngay_nghi',
//            'value '=> date("Y-m-d"),
            'disabled' => false
        ]
    ])
    ?>

    <?= $form->field($model, 'ngay_lam_bu')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'vn',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => [
            'class' => 'form-control field-ngay_lam_bu',
//            'value '=> date("Y-m-d"),
            'disabled' => false
        ]
    ])
    ?>

    <?= $form->field($model, 'thu_trong_tuan')->dropDownList([ 'Thứ 2' => 'Thứ 2', 'Thứ 3' => 'Thứ 3', 'Thứ 4' => 'Thứ 4', 'Thứ 5' => 'Thứ 5', 'Thứ 6' => 'Thứ 6', 'Thứ 7' => 'Thứ 7', 'Chủ nhật' => 'Chủ nhật', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'nghi_co_luong')->checkBox(['label' => 'Nghỉ có lương','data-size'=>'small', 'class'=>'bs_switch'

        ,'style'=>'margin-bottom:4px;', 'id'=>'nghi_co_luong']) ?>
    <?= $form->field($model, 'phan_tram_huong_luong')->textInput() ?>

    <?= $form->field($model, 'kieu_nghi_trong_ngay')->dropDownList([ 'Sáng' => 'Sáng', 'Chiều' => 'Chiều', 'Cả Ngày' => 'Cả Ngày', ], ['prompt' => 'Buổi nghỉ trong ngày']) ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<?php
$script = <<<JS
$( "#ngaynghi-loai_ngay_nghi" ).change(function() {
      if ($(this).val() == 'Nghỉ thường niên') {
       $('.field-ngaynghi-ngay_nghi').hide();
       $('.field-ngaynghi-thu_trong_tuan').show();
       $('.field-ngaynghi-nghi_co_luong').hide();
       $('.field-ngaynghi-phan_tram_huong_luong').hide();
       $('.field-ngaynghi-kieu_nghi_trong_ngay').show();

      } else {
       $('.field-ngaynghi-ngay_nghi').show();
       $('.field-ngaynghi-thu_trong_tuan').hide();
       $('.field-ngaynghi-nghi_co_luong').show();
       $('.field-ngaynghi-phan_tram_huong_luong').show();
       $('.field-ngaynghi-kieu_nghi_trong_ngay').show();
       
      }
    });
JS;
$this->registerJs($script,\yii\web\View::POS_HEAD);