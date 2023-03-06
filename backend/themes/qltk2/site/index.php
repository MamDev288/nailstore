<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'THGROUP');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center" style="padding-top: 170px;">
    <h1><strong>TRANG TỔNG QUAN</strong></h1>
    <h2><strong>(Đang cập nhật)</strong></h2>
    <h2><i>(Click vào menu để nhảy sang trang tương ứng)</i></h2>
    <div id="crud-datatable-pjax"></div>
</div>
<div id="ajaxCrudModal" class="fade modal" role="dialog" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/backend/themes/qltk2/assets/global/plugins/amcharts4/core.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/backend/themes/qltk2/assets/global/plugins/amcharts4/charts.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/backend/themes/qltk2/assets/global/plugins/amcharts4/themes/animated.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]); ?>
<?php \backend\components\JsBlock::begin() ?>
<script>
    $(document).ready(function () {
        (function ($) {
            $.fn.hasAttr = function (name) {
                return this.attr(name) !== undefined;
            };
        }(jQuery));
        if ($('#ajaxCrubModal').length > 0 && $('#ajaxCrudModal').length == 0) {
            modal = new ModalRemote('#ajaxCrubModal');
        } else {
            modal = new ModalRemote('#ajaxCrudModal');
        }

        // Catch click event on all buttons that want to open a modal
        $(document).on('click', '[role=\"modal-remote\"]', function (event) {
            event.preventDefault();
            // Open modal
            modal.open(this, null);
        });
    })
</script>
<?php \backend\components\JsBlock::end() ?>
