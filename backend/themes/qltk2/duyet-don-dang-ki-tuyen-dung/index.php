<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\DuyetDonDangKiTuyenDungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Duyệt đơn đăng kí tuyển dụng';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="duyet-don-dang-ki-tuyen-dung-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Khôi phục lưới', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Khôi phục lưới'])
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'responsiveWrap' => false,
            'tableOptions' => ['class' => 'table table-borderd table-stripped text-nowrap'],
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách đơn đăng kí tuyển dụng'
            ],
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "size" => 'modal-lg',
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/duyet-don-dang-ki-tuyen-dung/asset/phong-ban.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>

