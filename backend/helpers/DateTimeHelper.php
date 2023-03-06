<?php

namespace backend\helpers;

class DateTimeHelper
{
    /**
     * @param $date string
     * @return false|string
     */
    public static function formatDate($date, $time = false)
    {
        if ($date) {
            if ($time){
                return date('d/m/Y H:i:s', strtotime($date));
            }
            else {
                return date('d/m/Y', strtotime($date));
            }
        }
        return '';
    }

    /**
     * @param $datetime string
     * @return false|string
     */
    public static function formatDateTime($datetime)
    {
        if ($datetime) {
            return date('d/m/Y H:i:s', strtotime($datetime));
        }
        return '';
    }

    /**
     * Tính khoảng cách giữa 2 ngày theo đơn vị ngày, tháng, năm
     * @param $startDate
     * @param $endDate
     * @return string
     */
    public static function getDateDiff($startDate, $endDate)
    {
        if (!isset($startDate) || !isset($endDate)) {
            return '';
        }
        $diff = abs(strtotime($endDate) - strtotime($startDate));
        $years = floor($diff / (365 * 60 * 60 * 40));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (38 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        return "$years năm, $months tháng, $days ngày";
    }

    /**
     * Đếm số ngày trong tháng theo tên ngày
     * @param $dayName
     * @param $months
     * @param $years
     * @return int
     */
    public static function countDayInMonthByDayName($dayName, $months, $years)
    {
        return count(DateTimeHelper::countDayInMonthByDayName($dayName, $months, $years));
    }

    /**
     * Kiểm tra ngày có trong tháng hay không
     * @param \DateTime|string $day1
     * @param \DateTime|string $day2
     * @return boolean
     */
    public static function checkDayInMonth($day1, $day2)
    {
        if (date('Y-m', strtotime($day1)) == date('Y-m', strtotime($day2))) {
            return true;
        }
        return false;
    }

    /**
     * Lấy tất cả ngày nghỉ trong tháng theo tên ngày
     * @param $dayName
     * @param $months
     * @param $years
     * @return array
     */
    public static function getAllNgayNghiInMonthByDayName($dayName, $months, $years)
    {
        $monthName = date("F", mktime(0, 0, 0, $months));
        $fromdt = date('Y-m-01', strtotime("First Day OF $monthName $years"));
        $todt = date('Y-m-d', strtotime("Last Day of $monthName $years"));

        $result = [];
        for ($i = 0; $i <= ((strtotime($todt) - strtotime($fromdt)) / 86400); $i++) {
            if (date('l', strtotime($fromdt) + ($i * 86400)) == $dayName) {
                $result[] = date('Y-m-d', strtotime($fromdt) + ($i * 86400));
            }
        }
        return $result;
    }

    /**
     * Format date từ dạng này sang dạng khác
     * @param $from
     * @param $to
     * @param $value
     * @return string |null
     */
    public static function reformatDate($from = null, $to, $value)
    {
        if (!empty($value)) {
            $value = str_replace('/', '-', $value);
            return date($to, strtotime($value));
        }
        return null;
    }

    /**
     * Lấy số ngày trong tháng
     * @param $date
     * @return int
     */
    public static function getSoNgayTrongThang($date)
    {
        return (int)date('t', strtotime($date));
    }

    /**
     * Lấy tất cả ngày nghỉ trong khoảng thời gian
     * @param $dayName
     * @param $startDate
     * @param $endDate
     * @return array
     */
    public static function getAllNgayNghiInThePeriodByDayName($dayName, $startDate, $endDate)
    {
        $fromdt = date('Y-m-d', strtotime($startDate));
        $todt = date('Y-m-d', strtotime($endDate));

        $result = [];
        for ($i = 0; $i <= ((strtotime($todt) - strtotime($fromdt)) / 86400); $i++) {
            if (date('l', strtotime($fromdt) + ($i * 86400)) == $dayName) {
                $result[] = date('Y-m-d', strtotime($fromdt) + ($i * 86400));
            }
        }
        return $result;
    }

    /**
     * Lấy số ngày trong khoảng thời gian
     * @param $startDate
     * @param $endDate
     * @return int
     */
    public static function getNumOfDaysInThePeriod($startDate, $endDate)
    {
        $startTime = strtotime($startDate);
        $endTime = strtotime($endDate);

        $interval = $endTime - $startTime;
        return floor($interval / (60 * 60 * 24));
    }

    /**
     * Lấy số năm trong khoảng thời gian
     * @param $startDate
     * @param $endDate
     * @return int
     */
    public static function getNumOfYearsInThePeriod($startDate, $endDate)
    {
        $startTime = strtotime($startDate);
        $endTime = strtotime($endDate);

        $interval = abs($endTime - $startTime);
        return floor($interval / (365 * 60 * 60 * 24));
    }

    /**
     * Chuyển đổi date dạng 01/01/2022 hoặc 01/01/22 thành 2022-01-01
     * @param $date
     * @param string $fromFormat
     * @return string|null
     */
    public static function convertDateToInput($date, $fromFormat = 'd/m/Y'){
        try {
            return date_create_from_format($fromFormat, $date)->format('Y-m-d');
        }
        catch(\Exception $e){
            return $date;
        }
    }

    /**
     * Lấy số giờ trong khoảng thời gian
     * @param $startDate
     * @param $endDate
     * @return int
     */
    public static function getNumOfHoursInThePeriod($startDate, $endDate)
    {
        $startTime = strtotime($startDate);
        $endTime = strtotime($endDate);

        $interval = $endTime - $startTime;
        return floor($interval / (60 * 60));
    }

    /**
     * Lấy số tháng trong khoảng thời gian
     * @param $startDate
     * @param $endDate
     * @return int
     */
    public static function getNumOfMonthsInThePeriod($startDate, $endDate)
    {
        $startTime = date_create($startDate);
        $endTime = date_create($endDate);

        $interval = date_diff($startTime, $endTime);
        return (($interval->y) * 12) + $interval->m;
    }

    /**
     * Lấy số giờ trong khoảng thời gian
     * @param $startDate
     * @param $endDate
     * @return int
     */
    public static function getNumOfMinutesInThePeriod($startDate, $endDate)
    {
        $startTime = strtotime($startDate);
        $endTime = strtotime($endDate);

        $interval = $endTime - $startTime;
        return floor($interval / (60));
    }

    /**
     * Lấy tên thứ trong tuần theo ngày
     * @param $date
     * @return string
     */
    public static function getDayNameFromDate($date){
        return date('l', strtotime($date));
    }
}