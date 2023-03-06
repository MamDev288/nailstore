<?php

namespace backend\components\Grid;

class GridView extends \kartik\grid\GridView{
    public $dataColumnClass = 'backend\components\Grid\DataColumn';

    public $tableOptionsDefault = [];

    public $responsiveWrap = false;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->tableOptions = array_merge($this->tableOptionsDefault, $this->tableOptions);
        if(!isset($this->tableOptions['class'])){
            $this->tableOptions['class'] = "";
        }
        $this->tableOptions['class'] .= ' table-hover table table-bordered table-stripped';
    }
}