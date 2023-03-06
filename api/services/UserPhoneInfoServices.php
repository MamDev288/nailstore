<?php

namespace api\services;

use api\helper\StringHelper;
use api\models\UserPhoneInfo;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\HttpException;

class UserPhoneInfoServices
{
    public static function checkUserOfPhone($uniIdPhone,$userId){
        $phone = UserPhoneInfo::findOne(['unique_id_phone'=>$uniIdPhone,'active'=>1]);
        if($phone== null)
            return;
        if($phone->user_id != $userId){
            throw new HttpException(500,"Thiết bị đã được đăng kí bởi tài khoản khác vui lòng kiểm tra lại");

        }
    }
    public static function SetNewPhone($uniIdPhone, $userId,$phoneName){
        self::checkUserOfPhone($uniIdPhone,$userId);
        $data = UserPhoneInfo::findOne(['user_id'=>$userId,'active'=>1]);
        if($data!= null){
            if($data->unique_id_phone == $uniIdPhone)
                return $data;
            else{
                self::checkTimeCreated($data->created_at);
            }
        }
        self::SetAllPhoneDeActice($userId);
        $phoneInfo = new UserPhoneInfo();
        $phoneInfo->user_id = $userId;
        $phoneInfo->unique_id_phone = $uniIdPhone;
        $phoneInfo->phone_name = $phoneName;
        $phoneInfo->created_by = $userId;
        $phoneInfo->created_at = date("Y-m-d H:i:s");
        if(!$phoneInfo->save()){
            throw new HttpException(500,Html::errorSummary($phoneInfo));
        }else{
            return $phoneInfo;
        }
    }
    public static function SetAllPhoneDeActice($user_id){
        UserPhoneInfo::updateAll(['active'=>0],['user_id'=>$user_id]);
    }
    public static function getPhoneInfoByUniID($uniIdPhone,$user_id = 0){
        $phone = null;
        if($uniIdPhone != "")
            $phone = UserPhoneInfo::findOne(['unique_id_phone'=>$uniIdPhone,'active'=>1]);
        elseif($user_id > 0)
            $phone = UserPhoneInfo::findOne(['user_id'=>$user_id,'active'=>1]);
        if($phone == null)
            throw new HttpException(500,"Không tìm thấy thông tin");
        return $phone;
    }

    public static function CheckInfoPhone($uniIdPhone){
        $phone = self::getPhoneInfoByUniID($uniIdPhone);
        return [
            'id' => $phone->id,
            'tenThietBi'=>(isset($phone->phone_name)?$phone->phone_name:"UNKNOW"),
            'tenNguoiDung'=>$phone->getUser()->one()->hoten,
            'ngayKhoiTao'=>$phone->created_at
        ];
    }
    public static function checkTimeCreated($phone_created_at){
       if(!StringHelper::vaidTimeSmall($phone_created_at,date("Y-m-d H:i:s"),60*60*24*3)){
            throw new HttpException(500,"Thiết bị phải đăng kí trên 3 ngày mới có thể sử dụng chức năng này");
        }
    }
    public static function deletePhoneUniId($uniIdPhone = "", $user_id = 0){
        $phone = self::getPhoneInfoByUniID($uniIdPhone ,$user_id);
        self::checkTimeCreated($phone->created_at);
        $phone->updateAttributes(['active'=>0]);
        $user_id=$phone->user_id;
        if($user_id > 0){
            self::SetAllPhoneDeActice($user_id);
        }
        return true;
    }

}