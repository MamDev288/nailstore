<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\form\VaiTroForm */
/* @var $form backend\components\ActiveForm */
/* @var $chucNangs array */
?>

<div class="vai-tro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group row" style="height: 300px; overflow-y: scroll">
        <span class="col-sm-2 control-label checkbox checkbox-success" style="margin-top: 0"><?= Html::checkbox("", false, ['id' => 'permission-all', 'class' => 'chooseAll']) ?><label
                    for='permission-all'><h4><?= Yii::t('app', 'Chức năng') ?></h4></label></span>
        <div class="col-sm-10">
                <?php
                foreach ($chucNangs as $key => $value) {
                    echo "<div class='row'>";
                    echo "<div class='col-sm-5 text-left'><span class='checkbox checkbox-success checkbox-inline' style='margin-top: 0;'>" . Html::checkbox("", false, ['id' => "permission-all-{$key}", 'class' => 'chooseAll']) . "<label for='permission-all-{$key}' style='padding-left: 10px'><h5>{$key}</h5></label></span></div>";
                    echo "<div class='col-sm-7'>";
                    foreach ($value as $k => $val) {
                        echo $form->field($model, "chucNangs[{$val['id']}]", ['options' => ['style' => 'display:inline'], 'labelOptions' => ['class' => 'col-sm-12 control-label']])->checkbox(['value' => $val['id'], 'label' => $val['name']]);
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "<hr/>";
                }
                ?>
            <div class="help-block m-b-none"></div>
        </div>
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
<?php \backend\components\JsBlock::begin() ?>
<script>
    $(document).ready(function () {
        var chooseAll = $(".col-sm-10 .col-sm-5 .chooseAll");
        var middle = $(".col-sm-5 .chooseAll");
        var top = $("label .chooseAll");
        for( var i=0; i<middle.length; i++ ){
            chooseAll.push( middle[i] );
        }
        for( var i=0; i<top.length; i++ ){
            chooseAll.push( top[i] );
        }
        chooseAll.each(function(){
            var that = $(this);
            if( that.attr('id') == 'permission-all' ) {
                var checkboxs = $(this).parents("span").next().find("input[type=checkbox]");
            }else{
                var checkboxs = $(this).parents(".col-sm-5").next().find("input[type=checkbox]");
            }
            var atLeastOneUnchecked = false;
            checkboxs.each(function () {
                if( $(this).is(":checked") == false ){
                    atLeastOneUnchecked = true;
                }
            })
            if( atLeastOneUnchecked == false && that.is(":checked") == false ){
                that.trigger('click');
            }
        });

        $(".chooseAll").change(function () {
            var type = $(this).is(':checked');
            var checkboxs = $(this).parents("span").next().find("input[type=checkbox]");
            if( checkboxs.length == 0 ) {
                checkboxs = $(this).parents(".col-sm-5").next().find("input[type=checkbox]");
            }
            checkboxs.each(function () {
                if(type != $(this).is(':checked')){
                    $(this).trigger('click');
                }
            })
        })
    })
</script>
<?php \backend\components\JsBlock::end(); ?>
