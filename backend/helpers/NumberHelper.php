<?php

namespace backend\helpers;

class NumberHelper
{
    /**
     * Định dạng số
     * @param $value
     * @return string
     */
    public static function formatNumber($value, $decimal = 0) {
        return number_format((double)$value, $decimal, '.', ',');
    }

    public static function formatMoney($value, $decimal = 0){
        return number_format((double)$value, $decimal, ',', '.');
    }

    /**
     * Tính tổng
     * @param array $objects
     * @param string $field
     * @return float
     */
    public static function calcSummary($objects, $field){
        $result = 0;
        foreach ($objects as $object){
            $result += $object[$field];
        }
        return $result;
    }
}