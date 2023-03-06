<?php
namespace backend\controllers;

//use common\models\AccessRules;
use app\models\ChiTietContHbl;
use app\models\ThongKeKhaiThacHangBieuDo;
use backend\models\Bienbanhientruong;
use backend\models\ChiPhiKhac;
use backend\models\Chitietchiphi;
use backend\models\Chitietdiengiai;
use backend\models\ChiTietGiaoNhanHang;
use backend\models\ChiTietHangDoor;
use backend\models\ChitietHBL;
use backend\models\ChitietHblOld;
use backend\models\ChitietXuatkho;
use backend\models\ContainerDoor;
use backend\models\ContainerHBL;
use backend\models\Danhsachtenchiphi;
use backend\models\DonViTinh;
use backend\models\GiaoNhanHang;
use backend\models\HangDoor;
use backend\models\HouseBill;
use backend\models\Khachhang;
use backend\models\KhachhangNhanhangDuoikho;
use backend\models\KhoCang;
use backend\models\LichSuThuPhi;
use backend\models\LichSuXuatDebitnote;
use backend\models\Loaiconthbl;
use backend\models\LogDoor;
use backend\models\LogSoQuy;
use backend\models\LogYeucauDoor;
use backend\models\MasterBillOfLoading;
use backend\models\NguoiDaiDien;
use backend\models\Nguoilienhe;
use backend\models\search\ChiTietHBLSearch;
use backend\models\ThongKeSlCont;
use backend\models\ThongKeSlTauVe;
use backend\models\ThuChi;
use backend\models\ThuchidoorChitiet;
use backend\models\TinhTrangDoor;
use backend\models\UngTra;
use backend\models\UnitPakage;
use backend\models\Vessel;
use backend\models\Xuatkho;
use backend\models\XuatKhoContainer;
use common\models\ForwarderAPI;
use common\models\myAPI;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\myFuncs;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends CoreController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
                'access' => [
                'class' => AccessControl::className(),
//                'only' => ['login','logout', 'index', 'error', 'updatekhocang','updatevesselmbl','updatechitietchiphi','updatechiphifullcont','updatehblfullcont', 'updatehblfullcont2'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => ['index', 'logout'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['error'],
                        'allow' => true
                    ],
                    [
                        'actions' => [
                            'update-codes-containers', 'updatelichsuchiphi', 'trimcode', 'convert-id-khach-to-id-consignee-kho',
                            'updatelichsuthuphi', 'updatengaylaplichsuchiphi', 'update-consigee', 'xu-ly-unitpackage',
                            'insertxuatkho', 'getinfokhachhangduoikho','updatekhocang', 'updatehbl', 'tach-shipper',
                            'updatevesselmbl','updatechitietchiphi', 'updatesoluongcankienkhoiconlai',
                            'updatechiphifullcont', 'updatehblfullcont', 'updatehblfullcont2', 'gop-consignee',
                            'importchiphihbl','updatetongtienhbl', 'importkhachhang', 'convert-khach-to-consignee',
                            'updatenguoilienhe', 'xacnhanchuyendoor', 'chuyen-all-door','convert-thu-chi-chi',
                            'ung-tra-sang-thu-chi','convert-lo-door-to-lo-debit', 'cap-nhat'
                        ],
                        'allow' => true,
                        'matchCallback' => function($rule, $action){
                            if(isset(Yii::$app->user->identity->id))
                                return Yii::$app->user->identity->id == 1;
                            return false;
                        }
                    ],
                    [
                        'actions' => [
                            'getsdtnguoidaidien','updatenguoidaidien','deletendd','list','reload','fix1'
                        ],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],

            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {

        return $this->render('index');

    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if(Yii::$app->request->isAjax){
                echo myFuncs::getMessage($exception->getMessage(),'danger', "Lỗi!");
                exit;
            }
            return $this->render('error', ['exception' => $exception]);
        }
    }

    // 1 số hàm update lại db

}

