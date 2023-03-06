<?php

use kartik\export\ExportMenu;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\components\Grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ChiTietBaoHiemNhanSuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $bao_hiem_nhan_su_id */
$this->title = 'Chi Tiết Bảo Hiểm Nhân Sự';
$this->params['breadcrumbs'] = [
    [
        'label' => 'Bảo Hiểm Nhân Sự',
        'url' => ['bao-hiem-nhan-su/index'],
        'template' => "<li><b>{link}</b></li>\n", // template for this link only
    ],
    $this->title];

$this->registerJsFile(Yii::$app->request->baseUrl . '/backend/themes/qltk2/chi-tiet-bao-hiem-nhan-su/assets/chi-tiet-bao-hiem-nhan-su.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]);
CrudAsset::register($this);

?>
<div class="chi-tiet-bao-hiem-nhan-su-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i> Thêm mới', ['create','bao_hiem_nhan_su_id' =>$bao_hiem_nhan_su_id],
                    ['role'=>'modal-remote','title'=> 'Chi Tiết Bảo Hiểm Nhân Sự','class'=>'btn btn-primary']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Làm mới', ['chi-tiet-bao-hiem-nhan-su/index','bao_hiem_nhan_su_id'=>$_GET['bao_hiem_nhan_su_id']],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh Sách Chi Tiết Bảo Hiểm Nhân Sự',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>


