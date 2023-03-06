<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ChiTietBangLuongTungNhanVienSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $bangLuong \backend\models\BangLuong */
/* @var $bang_luong int|null */
$this->title = 'Bảng lương của tôi';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::$app->request->baseUrl . '/backend/themes/qltk2/chi-tiet-bang-luong/assets/chi-tiet-bang-luong.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]);
CrudAsset::register($this);

?>
<div class="chi-tiet-bang-luong-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
                    ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [['class' => 'yii\grid\SerialColumn'],
                            'ten_phong_ban',
                            'hoten',
                            'so_tai_khoan',
                            'luong_dong_bhxh',
                            'luong_thang',
                            'luong_mem',
                            'ngay_cong_quy_dinh',
                            'luong_mot_ngay_cong',
                            'so_cong_thuc_te',
                            'luong_theo_so_cong_thuc_te',
                            'thuong_Logistics',
                            'thuong_Agent_Broker',
                            'ngay_cong_huong_phu_cap_an_trua',
                            'tien_phu_cap_an_trua_1_bua',
                            'tien_phu_cap_an_trua',
                            'so_nam_cong_tac',
                            'phu_cap_tham_nien_1_nam',
                            'phu_cap_tham_nien',
                            'phu_cap_xang_xe',
                            'tong_phu_cap',
                            'BHXH',
                            'BHYT',
                            'BHTN',
                            'thue_TNCN',
                            'tong_cong_giam_tru',
                            'luong_thuc_te',
                            'cong_doan',
                            'phu_cap_tien_an_di_cong_tac',
                            'phu_cap_khac',
                            'tien_phat',
                            'thuc_tra',
                            'tong_luong',
                            'tong_luong_full_cong',
                            'ghi_chu',


                            ['class' => 'yii\grid\ActionColumn']],
                        'clearBuffers' => true, //optional
                    ])
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách chi tiết bảng lương theo nhân viên',
                'after' =>
                    '<div class="clearfix"></div>',
            ]
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",// always need it for jquery plugin
]);
?>
<?php Modal::end(); ?>


