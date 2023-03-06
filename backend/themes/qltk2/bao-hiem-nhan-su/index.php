<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\components\Grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BaoHiemNhanSuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bảo Hiểm Xã Hội';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="bao-hiem-nhan-su-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i> Thêm bảo hiểm', ['create',''],
                    ['role'=>'modal-remote','title'=> 'Tạo Bảo Hiểm Nhân Sự ','class'=>'btn btn-primary']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Khôi phục lưới', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách nhân sự tham gia Bảo hiểm xã hội',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
