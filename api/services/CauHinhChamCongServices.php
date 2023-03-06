<?php

namespace api\services;

use api\models\CauHinhChamCong;
use api\models\ChamCong;
use yii\helpers\VarDumper;

class CauHinhChamCongServices
{
    public static function getSettingChamCong($date = null){
        //lấy ca chấm công
        $date = ($date== null?date("Y-m-d H:i:s"):$date);
        return CauHinhChamCong::find()
            ->andFilterWhere([ "<=" ,"(STR_TO_DATE( CONCAT(CURDATE() ,CONCAT(' ',STR_TO_DATE(start_time,'%H:%i:%s'))),'%Y-%m-%d %H:%i:%s'))",$date])
            ->andFilterWhere([ ">=" ,"(STR_TO_DATE( CONCAT(CURDATE() ,CONCAT(' ',STR_TO_DATE(end_time,'%H:%i:%s'))),'%Y-%m-%d %H:%i:%s'))",$date])
            ->one();
    }
    public static function getSettingChamCongByshift($shift,$type = "in"){
        //lấy ca chấm công
        return CauHinhChamCong::findOne([ "shift"=>$shift,"type"=>$type]);
    }
    public static function getTypeChamCong(){
        $setting = self::getSettingChamCong();
        if(is_null($setting))
            return null;
        return $setting->type;
    }
    public static function getCaChamCong(){
        $setting = self::getSettingChamCong();
        if(is_null($setting))
            return null;
        return $setting->shift;
    }
}