<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\components\Grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TuyenDungDkNhuCauNsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var $type */

$this->title = 'Kế hoạch tuyển dụng'.($type == 'cho_duyet' ? " chờ duyệt" : ($type == 'da_duyet' ? ' đã duyệt' : ''));
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>


<div class="tuyen-dung-dk-nhu-cau-ns-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
                isset($type) ?
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Khôi phục lưới', ['index', 'type' => $type],
                        ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Khôi phục lưới']):
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Khôi phục lưới', ['index'],
                        ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Khôi phục lưới'])
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Kế hoạch tuyển dụng'.($type == 'cho_duyet' ? " chờ duyệt" : ($type == 'da_duyet' ? ' đã duyệt' : '')),
            ]
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "size" => "modal-lg",
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/backend/themes/qltk2/ke-hoach-tuyen-dung/asset/tuyen-dung.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/backend/themes/qltk2/assets/global/scripts/main.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]); ?>



