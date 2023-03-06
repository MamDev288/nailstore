<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\components\Grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use \kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\NhanVienSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý ứng viên';
CrudAsset::register($this);

?>
<div class="phong-ban-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i> Thêm ứng viên', ['create'],
                            ['role'=>'modal-remote','title'=> 'Thêm ứng viên','class'=>'btn btn-primary']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Khôi phục lưới', [''], ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Khôi phục lưới'])
                ]
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'responsiveWrap' => false,
            'tableOptions' => ['class' => 'table table-bordered table-stripped text-nowrap'],
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách ứng viên'
            ],

        ])?>
    </div>
</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
    "size" => 'modal-lg'
])?>
<?php Modal::end(); ?>

