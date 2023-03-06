<?php
namespace api\services;
use api\models\CauHinhChamCong;
use api\models\ChamCong;
use api\models\UserPhoneInfo;
use backend\models\LuotChamCong;
use backend\models\NgayNghi;
use backend\services\ChamCongService;
use backend\services\LuotChamCongService;
use common\models\myAPI;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\HttpException;

class ChamCongServices extends ChamCongService{
    public const IP = "14.241.100.218";
    public const IP_1 = "117.4.88.189";
    public static function getDateAdd($day){
        $date = new \DateTime(date('Y-m-d H:i:s'));
        $date->modify("-$day day");
        return $date->format('Y-m-d H:i:s');
    }
    public static function vaildUniIdPhone($uniIdPhone,$UserId){
        $date = self::getDateAdd(0);
        $checkData = UserPhoneInfo::findOne(["user_id"=>$UserId,"unique_id_phone"=> $uniIdPhone,'active'=>1]);
        if($checkData == null){
            return "Thiết bị của bạn chưa đăng kí thiết bị trên hệ thống!";
        }
        else if($checkData->created_at >  $date){
            return "Thiết bị phải sử dụng trên 01 ngày mới được sử dụng chức năng này";
        }
        return null;
    }
    public static function getOldRecUser($UserId){
        return UserPhoneInfo::findOne(["user_id"=>$UserId,"active"=>1]);
    }
    public static function checkUniqPhoneUser($uniIdPhone){
        if(!is_null(UserPhoneInfo::findOne(["unique_id_phone"=>$uniIdPhone,"active"=>1])) )
            throw new HttpException(500,"Thiết bị đã tồn tại trên hệ thống!");

    }
    public static function DeletOldRecUser($UserId){
        $get = self::vailAddInfoPhone($UserId);
        if($get == null){
            return true;
        }
        elseif ( $get == false)
            return  false;
        else if($get != null){
            /**
             * @var  UserPhoneInfo $get
             */
            $get->updateAttributes(["active"=>0]);
        }
        return true;
    }
    public static function saveInfoPhone($uniIdPhone,$UserId){
        self::checkUniqPhoneUser($uniIdPhone);
        if(self::DeletOldRecUser($UserId)){
            $phoneInfo = new UserPhoneInfo();
            $phoneInfo->user_id = $UserId;
            $phoneInfo->unique_id_phone = $uniIdPhone;
            $phoneInfo->created_by = $UserId;
            $phoneInfo->created_at = date("Y-m-d H:i:s");
            if(!$phoneInfo->save()){
                throw new HttpException(500,Html::errorSummary($phoneInfo));
            }else{
                return $phoneInfo;
            }
        }
        return null;

    }
    public static function getDataChamCongNow($UserId){
        $data = ChamCong::findOne(["nhan_vien_id"=>$UserId,"date"=>date("Y-m-d")]);
        if(is_null($data)){
            $data = new  ChamCong();
            $data->nhan_vien_id =$UserId;
            $data->date = date("Y-m-d");
            $data->save();
            $data = self::getDataChamCongNow($UserId);
        }
        return $data;
    }
    public static function vailAddInfoPhone($UserId){
        $phoneInfo = self::getOldRecUser($UserId);
        $date = self::getDateAdd(3);
        if(is_null($phoneInfo)){
            return null;
        }else if($phoneInfo->created_at < $date){
            return $phoneInfo;
        }
        return false;
    }
    public static function ChamCong($uniIdPhone,$userId,$ip, $type){
        if(!self::validIP($ip))
            return "Bạn đang không sử dụng mạng của Pacific, vui lòng kiểm tra lại!";
        if ($type == ChamCong::DIEN_THOAI){
            $checkPhone = self::vaildUniIdPhone($uniIdPhone,$userId);
            if(!is_null($checkPhone)){
                return $checkPhone;
            }
        }

        self::checkNgayNghi();
        $dataCham = self::getDataChamCongNow($userId);
        $attr = self::getAttr(self::getTypeChamCong());
        if($attr == "")
          return  "Đã hết giờ check $attr";
        if(is_null($dataCham->{$attr}) ){
            LuotChamCongService::createLuotChamCong(new LuotChamCong([
                "ma_cham_cong" => 1,
                "ngay_cham_cong" => date("Y-m-d"),
                "gio_cham_cong" => date("Y-m-d H:i:s"),
                "type" => self::getTypeChamCong() == "in" ? 0 : 1,
                "cham_cong_id" => $dataCham->id,
            ]));
            $dataCham->updateAttributes([$attr=>date("Y-m-d H:i:s")]);
            self::calcDuLieuChamCong($dataCham->id, $dataCham->date);
        }

    else{
            return "Bạn đã chấm công rồi!";
        }
        //function xử lý thêm chấm công @@
        return "";
    }
    public static function validIP($ip){
        return $ip == self::IP || $ip == self::IP_1;
    }
    public static function checkNgayNghi(){

        $data = NgayNghi::find()->andFilterWhere(["thu_trong_tuan"=>self::getThu(),"active"=>1])->orFilterWhere(["ngay_nghi"=>date("Y-m-d"),"active"=>1])->one();
        if(!is_null($data)) {
            if(NgayNghi::findOne(['ngay_lam_bu'=>date("Y-m-d"),'active'=>1]) == null){
                $typeNghi =$data->kieu_nghi_trong_ngay ;
                if(($typeNghi == NgayNghi::KIEUNGAYNGHI_CANGAY || $typeNghi == self::getBuoiTrongNgay()))
                    throw new HttpException(500, "Hôm nay là ngày được nghỉ $data->loai_ngay_nghi $typeNghi");
            }
        }
        return null;
    }
    public static function getThu(){
        $weekday = date("w");
        $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
        switch($days[$weekday]) {
            case 'Monday':
                $weekday = 'Thứ 2';
                break;
            case 'Tuesday':
                $weekday = 'Thứ 3';
                break;
            case 'Wednesday':
                $weekday = 'Thứ 4';
                break;
            case 'Thursday':
                $weekday = 'Thứ 5';
                break;
            case 'Friday':
                $weekday = 'Thứ 6';
                break;
            case 'Saturday':
                $weekday = 'Thứ 7';
                break;
            default:
                $weekday = 'Chủ nhật';
                break;
        }
        return $weekday;
    }
    public static function getTypeChamCong()
    {
        return CauHinhChamCongServices::getTypeChamCong();
    }
    public static function getBuoiTrongNgay()
    {
      $ca = CauHinhChamCongServices::getCaChamCong();
      return $ca;
    }
    public static function getAttr($type){
        $buoi = self::getBuoiTrongNgay();
        $so = ($buoi ==NgayNghi::KIEUNGAYNGHI_SANG ) ? "1":"2";

        switch ($type){
            case "in":
                return "vao$so";
            case "out" :
                return "ra$so";

        }
    }
    public  static function getStatusCheck($data){
        $checkBuoi = self::getBuoiTrongNgay();
        if($checkBuoi != NgayNghi::KIEUNGAYNGHI_SANG && $checkBuoi != NgayNghi::KIEUNGAYNGHI_CHIEU && $checkBuoi != NgayNghi::KIEUNGAYNGHI_CHIEU_K_DAU)
            return "";
        $atrr = ChamCongServices::getAttr(self::getTypeChamCong());
        return ($atrr != "" && is_null($data->{$atrr})? ChamCongServices::getTypeChamCong():"");
    }
    public  static function convertDateTimeToTime($data){
        $date = new \DateTime($data);
        return $date->format('H:i');
    }
    public  static function formatTime($data){
        $exportData = [];
        $exportData["color_ra2"] = self::getColorTime($data->ra2);
        $exportData["color_ra1"] = self::getColorTime($data->ra1);
        $exportData["color_vao1"] = self::getColorTime($data->vao1);
        $exportData["color_vao2"] = self::getColorTime($data->vao2);
        $exportData["vao1"] = ($data->vao1 == null?  "--:--" : self::convertDateTimeToTime($data->vao1) );
        $exportData["ra1"] = ($data->ra1 == null?  "--:--" : self::convertDateTimeToTime($data->ra1) );
        $exportData["vao2"] = ($data->vao2 == null?  "--:--" : self::convertDateTimeToTime($data->vao2) );
        $exportData["ra2"] = ($data->ra2 == null?  "--:--" : self::convertDateTimeToTime($data->ra2) );

        return $exportData;
    }
    public static function getColorTime($time){
        if($time == null){
            return "#EB455F";
        }
        $timeRender = date("Y-m-d "). date("H:i:s",strtotime($time));
        $data = CauHinhChamCongServices::getSettingChamCong($timeRender);
        if($data != null){
            /**
             * @var  CauHinhChamCong $data
            **/
            $standard_time = strtotime($data->standard_time);
            $standard_time_end = $standard_time + (5*60);
            if($data->type == "out"){
                if($standard_time >= strtotime($timeRender))
                    return "#FF5D6E";
            }else if($data->type == "in")
            if($standard_time_end <= strtotime($timeRender))
                return "#FF5D6E";
        }
        return "#2EB872";
    }
}