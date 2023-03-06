<?php

namespace backend\components;

use yii\helpers\Html;
use yii\jui\Widget;

class TextWithIconWidget extends Widget
{
    public $icon;
    public $iconPrefix = "fa";
    public $text;
    public $label;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        if($this->text || $this->label){
            return Html::decode("<p class='text-with-icon'>
                <i class='$this->iconPrefix $this->iconPrefix-$this->icon icon'></i>".(isset($this->label) ? "<label>$this->label:</label> " : "")." ".(isset($this->text) ? $this->text : "")."
            </p>");
        }
        return "";
    }
}