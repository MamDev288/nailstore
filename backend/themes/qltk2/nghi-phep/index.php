<?php

use backend\models\NghiPhep;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\components\Grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\NghiPhepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$type = Yii::$app->request->get('type');
$this->title = 'Đơn xin nghỉ';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="nghi-phep-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i> Tạo đơn đi muộn thường niên', ['create', 'type' => NghiPhep::DI_MUON_VE_SOM_THUONG_NIEN],
                    ['role'=>'modal-remote','title'=> 'Tạo đơn đi muộn thường niên dành cho trường hợp cần đi muộn trong thời gian dài','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-plus"></i> Tạo đơn xin nghỉ', ['create'],
                    ['role'=>'modal-remote','title'=> 'Tạo đơn nghỉ','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Khôi phục lưới', [''], ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Khôi phục lưới']).
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách đơn nghỉ',
                'before'=>'<em>*</em>',
                'after'=>
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",
    'size' => 'model-lg'// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
