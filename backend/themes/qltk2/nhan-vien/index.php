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

$this->title = 'Quản lý nhân viên';
CrudAsset::register($this);

?>
<div class="phong-ban-index">
    <div id="ajaxCrudDatatable">
        <?=$this->render('_search', ['model' => $searchModel]); ?>

        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Khôi phục lưới', [''], ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Khôi phục lưới'])
                    .ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [['class' => 'yii\grid\SerialColumn'],
                            'username',
                            'email',
                            'hoten',
                            'dien_thoai',
                            'ngay_cap',
                            'dia_chi',
                            'ngay_sinh',
                            'ghi_chu',
                            'ngay_nop_ho_so',
                            'noi_cap',
                            'ngay_chinh_thuc',
                            'so_tai_khoan',
                            'chu_tai_khoan',
                            'token_web',
                            'gioi_tinh',
                            'mst_ca_nhan',
                            'hon_nhan',
                            'tp_gia_dinh',
                            'tp_ban_than',
                            'dan_toc',
                            'ton_giao',
                            'quoc_tich',
                            'cmnd',
                            'ngay_cap_cmnd',
                            'noi_cap_cmnd',
                            'ngay_het_han_cmnd',
                            'so_ho_chieu',
                            'ngay_cap_ho_chieu',
                            'ngay_het_han_ho_chieu',
                            'noi_cap_ho_chieu',
                            'trinh_do_van_hoa',
                            'noi_dao_tao',
                            'khoa',
                            'nam_tot_nghiep',
                            'xep_loai',
                            'dia_chi_cu_the_thuong_tru',
                            'ma_so_ho_kho',
                            'la_chu_ho',
                            'dia_chi_shk',
                            'dia_chi_so_voi_shk',
                            'dia_chi_hien_tai',
                            'ho_dem',
                            'ten',
                            'ten_khac',
                            'noi_sinh',
                            'trang_thai',
                            'ten_phong_ban',
                            'chuc_vu',
                            ['class' => 'yii\grid\ActionColumn']],
                        'clearBuffers' => true, //optional
                    ])
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'responsiveWrap' => false,
            'tableOptions' => ['class' => 'table table-borderd table-stripped text-nowrap'],
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách nhân viên'
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
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/nhan-vien/asset/nhan-vien.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>

