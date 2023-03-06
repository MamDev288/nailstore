<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\components\Grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use backend\models\TrangThaiPhongVan;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PhongVanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$type = Yii::$app->request->get('type');
$this->title = ($type != TrangThaiPhongVan::TYPE_PV3 ? Yii::t('app', 'Phỏng vấn') : "").($type == TrangThaiPhongVan::TYPE_PV1 ? " Lần 1" : ($type == TrangThaiPhongVan::TYPE_PV2 ? " Lần 2" : ($type == TrangThaiPhongVan::TYPE_PV3 ? "Thử việc" : "")));
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="phong-van-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    (is_null($type) || $type == TrangThaiPhongVan::TYPE_PV1 ? Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                        ['role' => 'modal-remote', 'title' => 'Thêm phỏng vấn', 'class' => 'btn btn-default']) : '')
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách '.$this->title,
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
