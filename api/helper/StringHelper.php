<?php
namespace api\helper;
use yii\db\Exception;
use yii\web\HttpException;

class StringHelper
{
    static function vaildIP($ip){
        if(!filter_var($ip, FILTER_VALIDATE_IP)) {
           return false;
        }
        return true;
    }
    public static function vaidTimeSmall($date1,$date2,$timeaddDate1=0,$timeaddDate2=0){
        try {
            $date1 = strtotime($date1);
            $date2 = strtotime($date2);
            return $date1 + $timeaddDate1 < $date2 + $timeaddDate2;
        }catch (Exception $exception){
            throw new HttpException(500,$exception->getMessage());
        }
    }
    public static function vaidTimeTall($date1,$date2,$timeaddDate1=0,$timeaddDate2=0){
        try {
            $date1 = strtotime($date1);
            $date2 = strtotime($date2);
            return $date1 + $timeaddDate1 > $date2 + $timeaddDate2;
        }catch (Exception $exception){
            throw new HttpException(500,$exception->getMessage());
        }
    }
}
