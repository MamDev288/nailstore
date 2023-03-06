<?php

namespace backend\controllers\helper;

class requestFormat
{
    public static function except($data, $post_name)
    {
        unset($data[$post_name]);
        return $data;
    }

}