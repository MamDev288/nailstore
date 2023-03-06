<!--<head>-->
<!--    <script src="backend/assets/js-view/select2.js"></script>-->
<!--    <link href="backend/assets/css/select2.css" rel="stylesheet" />-->
<!--</head>-->

<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $phongban_id */
/* @var $searchModel backend\models\search\PhongBanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nhân Viên Phòng Ban';
$this->params['breadcrumbs'] =
[
    [
        'label' => 'Phòng Ban',
        'url' => ['phong-ban/index'],
        'template' => "<li><b>{link}</b></li>\n", // template for this link only
    ],
$this->title,]
;

CrudAsset::register($this);
//$this->registerCssFile(Yii::$app->request->baseUrl . '/backend/assets/js-view/select2/select2.css', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_HEAD]);

//$this->registerJsFile('backend/assets/js-view/select2.js');
//$this->registerCssFile("backend/assets/css/select2.css");
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
                    Html::a('<i class="glyphicon glyphicon-plus"></i> Thêm',['create','phongban_id'=>$phongban_id??null],
                        ['role'=>'modal-remote','title'=> 'Create new Phong Bans','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Khôi Phục', [''],
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh Sách Nhân Viên',

                '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
<?php //$this->registerJsFile(Yii::$app->request->baseUrl.'/backend/assets/js-view/select2/select2.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
