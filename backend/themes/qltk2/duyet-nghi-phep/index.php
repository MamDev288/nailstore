<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\components\Grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\DuyetNghiPhepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Duyệt đơn xin nghỉ';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="duyet-nghi-phep-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách đơn xin nghỉ',
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
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/duyet-nghi-phep/asset/loadform.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/main.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php \backend\components\JsBlock::begin() ?>
<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const duyetDonId = urlParams.get('id');
    if(duyetDonId){
        setTimeout(() => {
            const ele = $(document).find("a[href*='loadformduyetphieu&id="+duyetDonId+"']").click();
        }, 1000);
    }
</script>
<?php \backend\components\JsBlock::end() ?>
