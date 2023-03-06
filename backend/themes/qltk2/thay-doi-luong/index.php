<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ThayDoiLuongSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $hop_dong_nhan_su_id  */

$this->title = 'Thay Đổi Lương';
$this->params['breadcrumbs'] = [[
        'label' => 'Hợp Đồng Nhân Sự',
        'url' => ['hop-dong-nhan-su/index'],
        'template' => "<li><b>{link}</b></li>\n", // template for this link only
    ],
    $this->title];

CrudAsset::register($this);

?>
<div class="thay-doi-luong-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i>Danh Sách Thanh Đổi Lương',
                'before'=>'<em>*</em>',
                'after'=> '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
