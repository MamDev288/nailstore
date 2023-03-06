<?php

namespace backend\helpers;

class StringHelper
{
    /**
     * Hiển thị text trong object
     * @param $object
     * @param $key
     * @return string
     */
    public static function getTextInObject($object, $key) {
        $result = "";
        if(is_array($object)){
            $count = 0;
            foreach ($object as $item){
                if(isset($item[$key])){
                    if($count == 0){
                        $result = $item[$key];
                    }else{
                        $result .= ", ".$item[$key];
                    }
                    $count++;
                }
            }
        }else{
            return isset($object[$key]) ? $object[$key] : "";
        }
        return $result;
    }

    /**
     * Kiểm tra email có hợp lệ hay không
     * @param string $email
     * @return bool
     */
    public static function checkEmailValid($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    /**
     * Lấy tên ngày trong tuần
     * @param string $dayName
     * @return string|null
     */
    public static function getNameDayTrongTuan($dayName){
        switch ($dayName) {
            case ConstHelper::DAY_THU2:
                return "Monday";
            case ConstHelper::DAY_THU3:
                return "Tuesday";
            case ConstHelper::DAY_THU4:
                return "Wednesday";
            case ConstHelper::DAY_THU5:
                return "Thursday";
            case ConstHelper::DAY_THU6:
                return "Friday";
            case ConstHelper::DAY_THU7:
                return "Saturday";
            case ConstHelper::DAY_CHUNHAT:
                return "Sunday";
            default:
                return null;
        }
    }

    public static function formatMoney($input)
    {
        $input = str_replace('.', '', $input);
        return $input;
    }

    /**
     * Lấy tên ngày tiếng Việt trong tuần
     * @param string $dayName
     * @return string|null
     */
    public static function getDayNameVietnamese($dayName){
        switch ($dayName) {
            case "Monday":
                return ConstHelper::DAY_THU2;
            case "Tuesday":
                return ConstHelper::DAY_THU3;
            case "Wednesday":
                return ConstHelper::DAY_THU4;
            case "Thursday":
                return ConstHelper::DAY_THU5;
            case "Friday":
                return ConstHelper::DAY_THU6;
            case "Saturday":
                return ConstHelper::DAY_THU7;
            case "Sunday":
                return ConstHelper::DAY_CHUNHAT;
            default:
                return null;
        }
    }
}