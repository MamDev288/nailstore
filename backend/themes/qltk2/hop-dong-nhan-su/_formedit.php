<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\HopDongNhanSu */
/* @var $form yii\widgets\ActiveForm */
/* @var $loaihopdong  */
/* @var $nhansu  */

?>

<div class="hop-dong-nhan-su-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'loai_hop_dong_id')->dropDownList(  ArrayHelper::map($loaihopdong, 'id','name'), ['prompt' => '--Chọn Loại Hợp Đồng--']) ?>


    <?= $form->field($model, 'ngay_hieu_luc')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'vn',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => [
            'class' => 'form-control',
//            'value '=> date("Y-m-d"),
            'disabled' => false
        ]
    ])
    ?>
    <?= $form->field($model, 'ngay_thuc_hien')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'vn',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => [
            'class' => 'form-control',
//            'value '=> date("Y-m-d"),
            'disabled' => false
        ]
    ])
    ?>
    <?= $form->field($model, 'ngay_het_han')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'vn',
            'dateFormat' => 'yyyy-MM-dd',
           'options' => [
               'class' => 'form-control',
//                'value '=> date("Y-m-d"),
                'disabled' => false
           ]
        ])
        ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
