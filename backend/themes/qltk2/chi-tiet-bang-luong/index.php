<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\components\Grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ChiTietBangLuongSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $bangLuong \backend\models\BangLuong */
/* @var $bang_luong int|null */
$this->title = 'Chi tiết bảng lương tháng ' . ($bangLuong ? date('m/Y', strtotime($bangLuong->nam . '-' . $bangLuong->thang)) : '');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::$app->request->baseUrl . '/backend/themes/qltk2/chi-tiet-bang-luong/assets/chi-tiet-bang-luong.js', ['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END]);
CrudAsset::register($this);

?>
<div class="chi-tiet-bang-luong-index">
    <div id="ajaxCrudDatatable">
        <?=$this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
                    (isset($bangLuong) ? \yii\bootstrap\Html::a('<i class="fa fa-send"></i> Gửi thông báo lương', ['/bang-luong/send-mail', 'id' => $bangLuong->id],
                        ['data-pjax' => 0, 'role' => 'modal-remote', 'data-request-method' => 'post',
                            'data-toggle' => 'tooltip', 'data-confirm-title' => 'Thông báo',
                            'data-confirm-message' => 'Bạn có chắc chắn muốn gửi mail thông báo lương tới tất cả nhân sự không?', 'data-original-title' => 'Gửi',
                            'class' => 'btn btn-success']) .
                        (Yii::$app->user->id == 1 ? \yii\bootstrap\Html::a('<i class="fa fa-refresh"></i> Tính toán lại bảng lương', ['/chi-tiet-bang-luong/calc-bang-luong', 'bangLuongId' => $bangLuong->id],
                            ['data-pjax' => 0, 'role' => 'modal-remote', 'data-request-method' => 'post',
                                'data-toggle' => 'tooltip', 'data-confirm-title' => 'Thông báo',
                                'data-confirm-message' => 'Bạn có chắc chắn muốn tính toán lại bảng lương không?', 'data-original-title' => 'Tính toán lại',
                                'class' => 'btn btn-warning']) : "") : "") .
                    (\backend\services\BangLuongService::checkIsDaChotLuong($bangLuong) ? '' : Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create', 'bang_luong' => $bang_luong],
                        ['role' => 'modal-remote', 'title' => 'Create new Chi Tiet Bang Luongs', 'class' => 'btn btn-default'])) .
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


