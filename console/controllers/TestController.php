<?php

namespace console\controllers;

use api\services\FirebaseServices;
use backend\helpers\DateTimeHelper;
use backend\models\form\DiMuonVeSomForm;
use backend\models\NghiPhep;
use backend\services\CauHinhChamCongService;
use backend\services\ChamCongService;
use backend\services\DuyetNghiPhepService;
use backend\services\LogService;
use backend\services\NghiPhepService;
use backend\services\PhongBanService;
use backend\services\QueueService;
use backend\services\VaiTroService;
use common\models\User;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $ngayCong = ChamCongService::getChamCongById(38343);

        $diMuonVeSomArr = [];
        if(!empty($ngayCong->vao1)){
            $diMuonVeSomArr['vao1'] = DateTimeHelper::getNumOfMinutesInThePeriod(ChamCongService::getGioChamVaoSang($ngayCong->date), max($ngayCong->vao1, ChamCongService::getGioChamVaoSang($ngayCong->date)));
        }
        if(!empty($ngayCong->ra1)){
            $diMuonVeSomArr['ra1'] = DateTimeHelper::getNumOfMinutesInThePeriod(min($ngayCong->ra1, ChamCongService::getGioChamRaSang($ngayCong->date)), ChamCongService::getGioChamRaSang($ngayCong->date));
        }
        if(!empty($ngayCong->vao2)){
            $diMuonVeSomArr['vao2'] = DateTimeHelper::getNumOfMinutesInThePeriod(ChamCongService::getGioChamVaoChieu($ngayCong->date), max($ngayCong->vao2, ChamCongService::getGioChamVaoChieu($ngayCong->date)));
        }
        if(!empty($ngayCong->ra2)){
            $diMuonVeSomArr['ra2'] = DateTimeHelper::getNumOfMinutesInThePeriod(min($ngayCong->ra2, ChamCongService::getGioChamRaChieu($ngayCong->date)), ChamCongService::getGioChamRaChieu($ngayCong->date));
        }

        $maxTime = max($diMuonVeSomArr);

        if ($maxTime >= 5){
            $typeChamCong = array_search($maxTime, $diMuonVeSomArr);
            $timeCauHinh = CauHinhChamCongService::getCauHinhChamBasedOnTypeChamCong($typeChamCong)->standard_time;

            $donDiMuonVeSom = new DiMuonVeSomForm();
            $donDiMuonVeSom->type = NghiPhep::DI_MUON_VE_SOM;
            if ($typeChamCong == 'ra1' || $typeChamCong == 'ra2'){
                $donDiMuonVeSom->nghi_tu_ngay = $ngayCong->$typeChamCong;
                $donDiMuonVeSom->nghi_den_ngay = date('Y-m-d '.$timeCauHinh, strtotime($ngayCong->$typeChamCong));
            } else {
                $donDiMuonVeSom->nghi_tu_ngay = date('Y-m-d '.$timeCauHinh, strtotime($ngayCong->$typeChamCong));
                $donDiMuonVeSom->nghi_den_ngay = $ngayCong->$typeChamCong;
            }
            $donDiMuonVeSom->loai_nghi = NghiPhep::NGHI_CO_LUONG;
            $donDiMuonVeSom->ly_do = "Lý do khác";
            $donDiMuonVeSom->nguoi_lam_don_id = $donDiMuonVeSom->user_id = $ngayCong->nhan_vien_id;
            $donDiMuonVeSom->scenario = "import_excel";
            var_dump($donDiMuonVeSom);
//            $donDiMuonVeSom = NghiPhepService::createNghiPhep($donDiMuonVeSom, 1, false);
//            $duyetDonNghiPhep = DuyetNghiPhepService::getDuyetNghiPhepByNghiPhepId($donDiMuonVeSom->id);
//            DuyetNghiPhepService::confirmDuyetNghiPhep($duyetDonNghiPhep->id);
        }
    }
}