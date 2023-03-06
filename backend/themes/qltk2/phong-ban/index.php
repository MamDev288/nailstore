<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\components\Grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PhongBanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phòng Ban';
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
                ['content'=> Html::a('<i class="glyphicon glyphicon-plus"></i> Thêm phòng ban', ['create'], ['title'=> 'Thêm phòng ban','class'=>'btn btn-primary btn-them-phong-ban', 'role'=>'modal-remote', 'data-modal-size' => 'large']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Khôi phục lưới', [''], ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Khôi phục lưới'])
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'responsiveWrap' => false,
            'tableOptions' => ['class' => 'text-nowrap'],
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách phòng ban'
            ],

        ])?>
    </div>
</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
<?php //$this->registerJsFile(Yii::$app->request->baseUrl.'/backend/assets/js/',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => View::POS_END ]); ?>
<?php $this->registerCssFile('https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_HEAD ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/phong-ban/asset/phong-ban.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile('https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerCssFile(Yii::$app->request->baseUrl.'/backend/assets/css/data-table.css'); ?>
