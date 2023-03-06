<?php
namespace backend\components;
use yii\base\Widget;

class BulkButtonWidget extends \johnitvn\ajaxcrud\BulkButtonWidget {

    public function run(){
        $content = '<div class="pull-left">'.
            '<span class="glyphicon glyphicon-arrow-right"></span>&nbsp;&nbsp;Những thứ đã chọn&nbsp;&nbsp;'.
            $this->buttons.
            '</div>';
        return $content;
    }
}