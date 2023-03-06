<?php

namespace api\services;

use backend\models\NghiPhep;
use backend\services\NghiPhepService;
use backend\services\NhanVienService;
use backend\services\PhongBanService;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\HttpException;

class DonTuServices
{
    public static function getDanhSachDonXinNghiBanThan($user_id){
        return NghiPhep::find()->andFilterWhere(['nguoi_lam_don_id'=>$user_id])->all();
    }
    public static function taoDon($idTime,$id,$noi_dung,$ghi_chu="",$date = "",$donID = 0,$type = 2,$day = 0){
        $time = NghiPhepService::CreateMinutesSoonOrLate();
        $time1 = "";
        $time2 = "";
        $explodeTime = explode("~",$time[$idTime]);
        if($type == 2 && count($explodeTime) == 2){
            $time1 = date("Y-m-d $explodeTime[0]:00",($date != ""?strtotime($date):time()));
            $time2 = date("Y-m-d $explodeTime[1]:00",($date != ""?strtotime($date):time()));

        }
        elseif($type == 3){
            $time = new \DateTime($date);

            if($day == 0){
                throw new HttpException(500,"Vui lòng nhập đúng định dạng");
            }
            $time1 = $time->format("Y-m-d H:i:s");
            $time2 = $time->modify("+$day days")->format("Y-m-d H:i:s");

        }
        if($date !=  ""){
            if(!self::validateDate($date) || !self::validateDate($time1,"Y-m-d H:i:s") || !self::validateDate($time2,"Y-m-d H:i:s"))
                return "Ngày nghỉ không hợp lệ";
        }
        $nghiPhep = new NghiPhep();
        if($donID > 0){
            $nghiPhep = NghiPhepService::getNghiPhepById($donID);
            if($nghiPhep == null)
                throw new HttpException(500,"Không tìm thấy đơn này");
            if($nghiPhep->nguoi_lam_don_id != $id && $nghiPhep->truong_bo_phan_id != $id )
                throw new HttpException(500,"Bạn không có quyền truy cập đơn này");
        }
        $nghiPhep->type = $type;
        $nghiPhep->user_id = $id;
        $nghiPhep->nguoi_lam_don_id = $id;
        $nghiPhep->nghi_tu_ngay = $time1;
        $nghiPhep->loai_nghi = "Nghỉ không lương";
        $nghiPhep->nghi_den_ngay = $time2;
        $nghiPhep->ngay_de_nghi = $date;
        $nghiPhep->ly_do = $noi_dung;
        $nghiPhep->ghi_chu = $ghi_chu;;
        if(!NghiPhepService::createNghiPhep($nghiPhep,$id))
            return Html::errorSummary($nghiPhep);
        return "";
    }
    public static function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}