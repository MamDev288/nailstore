<?php

namespace api\controllers;

use api\models\DuyetDonNghiPhep;
use api\models\DuyetNghiPhep;
use api\models\LichSuDuyetNghiPhep;
use api\models\NghiPhep;
use api\models\NghiPhepPhongBan;
use api\models\PhongBanNhanVien;
use api\models\TrangThaiNghiPhep;
use api\models\User;
use api\models\UserVaiTro;
use api\services\DonTuServices;
use backend\services\DuyetNghiPhepService;
use backend\services\NghiPhepService;
use common\models\myAPI;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\HttpException;

class DonTuController extends AndinCoreApiController
{
    private function convert($date){
        $arr = explode(' ',$date);
        $date = explode('/',$arr[0]);
        $date = implode('-', array_reverse($date));
        return $date.' '.$arr[1];
    }
    private function convertBack($date){
        $arr = explode(' ',$date);
        $date = explode('-',$arr[0]);
        $date = implode('/', array_reverse($date));
        $format = explode(':',$arr[1]);
        $time = $format[0].":".$format[1];
        return $time.' '.$date;
    }

    public function actionYeuCauXinNghi(){
        $arrFides =  ['nghi_tu_ngay','nghi_den_ngay','ly_do' ];
        $donNghi = new NghiPhep();
//        $user = User::findOne($_POST['uid);
        $donNghi->nguoi_lam_don_id = $_POST['uid'];
        $donNghi->type = \backend\models\NghiPhep::NGHI_THUONG;
//        $donNghi->loai_nghi = \backend\models\NghiPhep::NGHI_CO_LUONG;
        $donNghi->user_id = $_POST['uid'];
        $Pb = PhongBanNhanVien::findOne(['nhan_vien_id'=>$_POST['uid'],'active'=>1]);
        if(!is_null($Pb))
            $donNghi->nhan_vien_phong_ban_id =$Pb->id;
        if($this->checkNull('ghi_chu')){
            $donNghi->ghi_chu = $_POST['ghi_chu'];
        }
        $donNghi->ngay_de_nghi = date('Y-m-d H:i:s');
        $_POST['nghi_tu_ngay'] = $this->convert($_POST['nghi_tu_ngay']);
        $_POST['nghi_den_ngay'] = $this->convert($_POST['nghi_den_ngay']);
        foreach ($arrFides as $item){
            if($this->checkNull($item)) {

                $donNghi->{$item} = $_POST[$item];

            }else{
                $this->error500('Vui l??ng nh???p '.$donNghi->getAttributeLabel($item));
            }
        }
        $tongThoiGianNghi = strtotime($donNghi->nghi_den_ngay) - strtotime($donNghi->nghi_tu_ngay);
        if($tongThoiGianNghi  <= 15 *60){
            $this->error500('Th???i gian ngh??? kh??ng h???p l???');
        }
         if (isset($type)){
            if ($type != ''){
                $donNghi->type = $type;
                $donNghi->loai_nghi = \backend\models\NghiPhep::NGHI_CO_LUONG;
            }
        }
        if(NghiPhepService::createNghiPhep($donNghi) != false){
            return ['message'=>'T???o ????n ngh??? ph??p th??nh c??ng!'];
        }else{
            throw new HttpException(500,"T???o ????n th???t b???i, vui l??ng th??? l???i");
        }
//        if($donNghi->save()){
//            $trang_thai_don = new TrangThaiNghiPhep();
//            $trang_thai_don->nghi_phep_id = $donNghi->id;
//            $trang_thai_don->user_id = $donNghi->nguoi_lam_don_id;
//            $trang_thai_don->trang_thai = NghiPhep::CHO_DUYET;
//            if(!$trang_thai_don->save()){
//                $donNghi->updateAttributes(['active'=>0]);
//                $this->error500(Html::errorSummary($trang_thai_don));
//            }else{
//
//                switch ($tongThoiGianNghi){
//                    case $tongThoiGianNghi >= DuyetNghiPhep::_5_NGAY :
//                        $duyetNew = new DuyetNghiPhep();
//                        $duyetNew->user_duyet_id = 1;
//                        $duyetNew->trang_thai = 1;
//                        $duyetNew->nghi_phep_id= $donNghi->id;
//                        if(!$duyetNew->save())
//                            $this->error500(Html::errorSummary($duyetNew));
//                    case $tongThoiGianNghi >= DuyetNghiPhep::_3_NGAY:
//                        if(!is_null($Pb)){
//                            $duyetNew = new DuyetNghiPhep();
//                            $duyetNew->user_duyet_id = $Pb->phongBan->parent->truong_phong_id;
//                            $duyetNew->trang_thai = 1;
//                            $duyetNew->nghi_phep_id= $donNghi->id;
//                            if(!$duyetNew->save())
//                                $this->error500(Html::errorSummary($duyetNew));
//                        }
//                    case $tongThoiGianNghi >= 0:
//                        if(!is_null($Pb)){
//                            $duyetNew = new DuyetNghiPhep();
//                            $duyetNew->user_duyet_id = $Pb->phongBan->truong_phong_id;
//                            $duyetNew->trang_thai = 2;
//                            $duyetNew->nghi_phep_id= $donNghi->id;
//                            if(!$duyetNew->save())
//                                $this->error500(Html::errorSummary($duyetNew));
//                        }
//                }
////                $duyetNew = new DuyetNghiPhep();
////                $duyetNew->user_duyet_id = 1;
////                $duyetNew->trang_thai = 0;
////                $duyetNew->nghi_phep_id= $donNghi->id;
//
////                if(!$duyetNew->save())
////                    $this->error500(Html::errorSummary($duyetNew));
//                return ['message'=>'T???o ????n ngh??? ph??p th??nh c??ng!'];
//            }
//        }else{
//            $this->error500(Html::errorSummary($donNghi));
//        }
    }

    public function actionDanhSachYeuCau(){
        $donNghi = NghiPhepPhongBan::find()
            ->select(['id','ngay_de_nghi','created','updated','trang_thai','id_nguoi_duyet','anh_nguoi_duyet'])
        ->andFilterWhere(['nguoi_lam_don_id'=>$_POST['uid'],'active'=>1]);
        if(isset($_POST['nghiTuNgay'])){
            if($_POST['nghiTuNgay'] !=""){
                $donNghi->andFilterWhere(['>=','created',myAPI::convertDMY2YMD0h($_POST['nghiTuNgay'])]);
            }
        }
        if(isset($_POST['nghiDenNgay'])){
            if($_POST['nghiDenNgay'] !=""){
                $donNghi->andFilterWhere(['<=','created',myAPI::convertDMY2YMD0h($_POST['nghiDenNgay'])]);
            }
        }

        if($this->checkNull('trang_thai')){
            if($_POST['trang_thai'] == "Hu???")
                $_POST['trang_thai'] = "T??? ch???i";
            $donNghi->andFilterWhere(['trang_thai'=>$_POST['trang_thai']]);
        }
        $page = ceil($donNghi->count()/5);
        $donNghi = $donNghi->offset(((isset($_POST['page'])?$_POST['page']:1)-1)*5)
            ->limit(5)->orderBy(['created'=>SORT_DESC])->all();

        return [
            'tongHop'=> $this->actionTongHop(),
            'so_trang_hien_tai'=>(isset($_POST['page'])?intval($_POST['page']):1),
            'so_trang'=>$page,
            'data'=>$donNghi,
        ];
    }

    public function actionChiTietDon(){
        if(!$this->checkNull('id')){
            throw new HttpException(500,'????n xin ngh??? kh??ng t???n t???i tr??n h??? th???ng');
        }
        $donYeuCau = NghiPhepPhongBan::findOne(['id'=>$_POST['id'],'active'=>1]);
        if (is_null($donYeuCau))
            throw new HttpException(500,'????n xin ngh??? kh??ng t???n t???i tr??n h??? th???ng 1');
        if ($donYeuCau->nguoi_lam_don_id != $_POST['uid'] && $_POST['uid'] != 1 ){
            if($donYeuCau->id_phong_ban != null)
            {
                $pb = PhongBanNhanVien::findOne(['phong_ban_id'=>$donYeuCau->id_phong_ban,'nhan_vien_id'=>$_POST['uid'],'truong_phong'=>1,'active'=>1]);
                if(is_null($pb)){
                    throw new HttpException(500,'????n xin ngh??? kh??ng t???n t???i tr??n h??? th???ng 2');
                }
            }else{
                throw new HttpException(500,'????n xin ngh??? kh??ng t???n t???i tr??n h??? th???ng 3');
            }
        }

        $nguoiDuyets = [];
        if($donYeuCau->id_nguoi_duyet != null)
        {
            $nguoiDuyets= LichSuDuyetNghiPhep::findAll(['nghi_phep_id'=>$_POST['id']]);
            foreach ($nguoiDuyets as $item){
                $item->trang_thai = LichSuDuyetNghiPhep::TRANG_THAI[$item->trang_thai_duyet];
            }

        }
//        $donYeuCau->ngay_de_nghi = myAPI::covertYMD2DMY($donYeuCau->ngay_de_nghi);
//        $donYeuCau->nghi_den_ngay = $this->convertBack($donYeuCau->nghi_den_ngay);
//        $donYeuCau->nghi_tu_ngay = $this->convertBack($donYeuCau->nghi_tu_ngay);
        if($donYeuCau->id_nguoi_duyet == null)
            $donYeuCau->id_nguoi_duyet = [];
        else
            $donYeuCau->id_nguoi_duyet = explode(',',$donYeuCau->id_nguoi_duyet);
        if(!is_array($donYeuCau->id_nguoi_duyet)){
            $donYeuCau->id_nguoi_duyet = [$donYeuCau->id_nguoi_duyet];
        }
        if($donYeuCau->anh_nguoi_duyet == null)
            $donYeuCau->anh_nguoi_duyet = [];
        else
            $donYeuCau->anh_nguoi_duyet = explode(',',$donYeuCau->anh_nguoi_duyet);
        if(!is_array($donYeuCau->anh_nguoi_duyet)){
            $donYeuCau->anh_nguoi_duyet = [$donYeuCau->anh_nguoi_duyet];
        }
        $giosetting = "";
        if($donYeuCau->kieu_don == null){
            $donYeuCau->kieu_don = "1";
        }
        if($donYeuCau->kieu_don == 2)
            $donYeuCau->nghi_den_ngay = date("H:i",strtotime($donYeuCau->nghi_tu_ngay)) . "~" . date("H:i",strtotime($donYeuCau->nghi_den_ngay));
        return [
            'data'=>$donYeuCau,

            'nguoi_duyet'=>$nguoiDuyets,
        ];
    }

    public function actionXoaYeuCau(){
        if(!$this->checkNull('id')){
            throw new HttpException(500,'????n xin ngh??? kh??ng t???n t???i tr??n h??? th???ng');
        }
        $donYeuCau = NghiPhep::findOne(['id'=>$_POST['id'],'active'=>1]);
        if (is_null($donYeuCau))
            $this->error500('????n xin ngh??? kh??ng t???n t???i tr??n h??? th???ng');
        if ($donYeuCau->nguoi_lam_don_id != $_POST['uid'])
            $this->error500('????n xin ngh??? kh??ng t???n t???i tr??n h??? th???ng');
        if($donYeuCau->trang_thai != NghiPhep::CHO_DUYET){
            $this->error500('????n ???? thay ?????i tr???ng th??i kh??ng th??? xo?? ??i ???????c!');
        }
        $donYeuCau->updateAttributes(['active'=>0]);
        return['message'=>'C???p nh???p y??u c???u th??nh c??ng'];

    }

    public function actionSuaYeuCau(){
        if(!$this->checkNull('id')){
            throw new HttpException(500,'????n xin ngh??? kh??ng t???n t???i tr??n h??? th???ng');
        }
        $donYeuCau = NghiPhep::findOne(['id'=>$_POST['id'],'active'=>1]);
        if (is_null($donYeuCau))
            $this->error500('????n xin ngh??? kh??ng t???n t???i tr??n h??? th???ng');
        if ($donYeuCau->nguoi_lam_don_id != $_POST['uid'])
            $this->error500('????n xin ngh??? kh??ng t???n t???i tr??n h??? th???ng');
        if($donYeuCau->trang_thai != NghiPhep::CHO_DUYET){
            $this->error500('????n ???? thay ?????i tr???ng th??i kh??ng th??? xo?? ??i ???????c!');
        }
        $arrFides =  ['nghi_tu_ngay','nghi_den_ngay','ly_do'];
        $arrFidesUpdate = [];
        $_POST['nghi_tu_ngay'] = $this->convert($_POST['nghi_tu_ngay']);
        $_POST['nghi_den_ngay'] = $this->convert($_POST['nghi_den_ngay']);
        $donYeuCau->ngay_de_nghi = date('Y-m-d H:i:s');
        foreach ($arrFides as $item){
            if($this->checkNull($item)){
                $arrFidesUpdate[$item] = $_POST[$item];
            }else{
                $this->error500('Vui l??ng ??i???n ?????y ????? '.$donYeuCau->getAttributeLabel($item));
            }
        }
        if($this->checkNull('ghi_chu')){
            $arrFidesUpdate['ghi_chu'] = $_POST['ghi_chu'];
        }
        $donYeuCau->updateAttributes($arrFidesUpdate);
        return['message'=>'C???p nh???p y??u c???u th??nh c??ng'];
    }

    public function actionDanhSachDonYeuCauDuyet()
    {
        $vaiTro = UserVaiTro::findOne(['id'=>$_POST['uid']]);
        if($vaiTro->vai_tro_id != 5 && $vaiTro->vai_tro_id != 7 && $vaiTro->id != 1)
            $this->error500('B???n kh??ng c?? quy???n truy c???p ch???c n??ng n??y');
        $data = LichSuDuyetNghiPhep::find()->andFilterWhere(['user_duyet_id'=>$_POST['uid'],'active'=>1])->andFilterWhere(['<>','trang_thai_duyet',1])
//            ->andFilterWhere(['<>','nguoi_lam_don_id',$_POST['uid']
//    ])
;
        if(isset($_POST['nghiTuNgay'])){
            if($_POST['nghiTuNgay'] !=""){
                $data->andFilterWhere(['>=','nghi_tu_ngay',myAPI::convertDMY2YMD0h($_POST['nghiTuNgay'])]);
            }
        }
        if(isset($_POST['nghiDenNgay'])){
            if($_POST['nghiDenNgay'] !=""){
                $data->andFilterWhere(['<=','nghi_den_ngay',myAPI::convertDMY2YMD0h($_POST['nghiDenNgay'])]);
            }
        }
        if(!isset($_POST['trang_thai'])){
        }elseif ($_POST['trang_thai'] == 'Duy???t'){
            $data->andFilterWhere(['trang_thai_duyet'=>\backend\models\DuyetNghiPhep::TRANGTHAI_DUYET]);
        }elseif ($_POST['trang_thai'] == 'Hu???'){
            $data->andFilterWhere(['trang_thai_duyet'=>\backend\models\DuyetNghiPhep::TRANGTHAI_HUY]);
        }elseif ($_POST['trang_thai'] == 'Ch??? duy???t'){
            $data->andFilterWhere(['trang_thai_duyet'=>\backend\models\DuyetNghiPhep::TRANGTHAI_CHODUYET]);
        }
        $page = ceil($data->count()/5);
        $data = $data->offset(((isset($_POST['page'])?$_POST['page']:1)-1)*5)
            ->limit(5)->orderBy(['created'=>SORT_DESC])
            ->orderBy(['id'=>SORT_DESC])->all();
        foreach ($data as $item){
            $item->trang_thai = LichSuDuyetNghiPhep::TRANG_THAI[$item->trang_thai_duyet];
        }
        return
            [
                'tongHop'=> $this->actionTongHopCanDuyet(),
            'so_trang'=>$page,
                'so_trang_hien_tai'=>(isset($_POST['page'])?intval($_POST['page']):1),
            'data'=>$data
        ];
    }

    public function actionDuyetDon(){
        if(!isset($_POST['id'])){
            $this->error500('Kh??ng t??m th???y ????n');
        }
        if(!isset($_POST['type'])){
            $this->error500('Kh??ng t??m th???y tr???ng th??i');
        }
        $donYeuCau = NghiPhep::findOne($_POST['id']);
        if(is_null($donYeuCau)){
            $this->error500('Kh??ng t??m th???y ????n');
        }
       $duyetYeuCau = DuyetNghiPhep::findOne(['nghi_phep_id'=>$_POST['id'],'user_duyet_id'=>$_POST['uid']]);
        if(is_null($duyetYeuCau)){
            $this->error500('Kh??ng t??m th???y ????n');
        }
        if($_POST['type']=='duyet'){
           DuyetNghiPhepService::confirmDuyetNghiPhep($duyetYeuCau->id);
        }elseif($_POST['type']=='huy') {
            DuyetNghiPhepService::rejectDuyetNghiPhep($duyetYeuCau->id);
        }
        return[
            'message'=>'Duy???t ????n y??u c???u th??nh c??ng!',
        ];
    }
    public function getCountDonYeuCau($trang_thai,$active = 1){
        $don = LichSuDuyetNghiPhep::find()->andWhere(['active'=>1,'user_duyet_id'=>$_POST['uid']])->andWhere(['<>','trang_thai_duyet',1]);

        if(!empty($trang_thai)){
            $don->andWhere(['trang_thai_duyet'=>$trang_thai]);
        }

        if(isset($_POST['nghiTuNgay'])){
            if($_POST['nghiTuNgay'] !=""){
                $don->andWhere(['>=','nghi_tu_ngay',myAPI::convertDMY2YMD0h($_POST['nghiTuNgay'])]);
            }
        }
        if(isset($_POST['nghiDenNgay'])){
            if($_POST['nghiDenNgay'] !=""){
                $don->andWhere(['<=','nghi_den_ngay',myAPI::convertDMY2YMD0h($_POST['nghiDenNgay'])]);
            }
        }
        if($active!=1){
            $don->andWhere(['active'=>$active]);
        }
        return $don->count('id');
    }
    public function getCount($trang_thai){
        $don = NghiPhepPhongBan::find()->andFilterWhere(['active'=>1,'nguoi_lam_don_id'=>$_POST['uid']]);
        if($trang_thai != ""){
            $don->andFilterWhere(['trang_thai'=>$trang_thai]);
        }
        if(isset($_POST['nghiTuNgay'])){
            if($_POST['nghiTuNgay'] !=""){
                $don->andFilterWhere(['>=','created',myAPI::convertDMY2YMD0h($_POST['nghiTuNgay'])]);
            }
        }
        if(isset($_POST['nghiDenNgay'])){
            if($_POST['nghiDenNgay'] !=""){
                $don->andFilterWhere(['<=','created',myAPI::convertDMY2YMD0h($_POST['nghiDenNgay'])]);
            }
        }
        return $don->count();
    }
    public function actionTongHop(){
        $tongDon = $this->getCount("");
        $choDuyet = $this->getCount("Ch??? duy???t");
        $daDuyet = $this->getCount("Duy???t");
        $daHuy = $this->getCount("T??? ch???i");
        return[
          'tongDon' => $tongDon,
            'choDuyet'=> $choDuyet,
            'daDuyet'=>$daDuyet,
            'daHuy'=>$daHuy,
        ];
    }
    public function actionTongHopCanDuyet(){
        $tongDon = $this->getCountDonYeuCau("");
        $choDuyet =$this->getCountDonYeuCau(\backend\models\DuyetNghiPhep::TRANGTHAI_CHODUYET);
        $daDuyet = $this->getCountDonYeuCau(\backend\models\DuyetNghiPhep::TRANGTHAI_DUYET);
        $daHuy = $this->getCountDonYeuCau("",\backend\models\DuyetNghiPhep::TRANGTHAI_HUY);
        return[
            'tongDon' => $tongDon,
            'choDuyet'=> $choDuyet,
            'daDuyet'=>$daDuyet,
            'daHuy'=>$daHuy,
        ];
    }

    public function actionXinDiMuonVeSom(){
        $arrField = ["indexTime","date","content"];
        foreach ($arrField as $item){
            if(!isset($_POST[$item]))
                throw new HttpException(500,"Vui l??ng ??i???n ?????y ????? n???i dung");
            elseif ($_POST[$item] == "")
                throw new HttpException(500,"Vui l??ng ??i???n ?????y ????? n???i dung");
        }

        $res = DonTuServices::taoDon($_POST["indexTime"],$_POST["uid"],$_POST["content"],(isset($_POST["note"])?$_POST["note"]:""),$_POST["date"],(isset($_POST["id"])?$_POST["id"]:0),(isset($_POST["type"])?$_POST["type"]:2),(isset($_POST["days"])?$_POST["days"]:0));
        if($res != ""){
            throw new HttpException(500,$res);
        }
        return [
            "message"=>(isset($_POST["id"])?"C???p nh???t":"T???o")." y??u c???u th??nh c??ng!"
        ];
    }
}