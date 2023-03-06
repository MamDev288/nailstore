<?php

namespace backend\components\Grid;

class ActionColumn extends DataColumn{

    public $width = "30px";


    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->headerOptions = array_merge(['class' => ' text-center '], $this->headerOptions);
        $this->contentOptions = array_merge(['class' => 'text-center'], $this->contentOptions);
    }
}