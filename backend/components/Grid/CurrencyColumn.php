<?php

namespace backend\components\Grid;

class CurrencyColumn extends DataColumn {
    public $headerOptions = ['width' => '50px', 'class' => 'text-right'];
    public $contentOptionsDefault = ['class' => 'text-right'];

    public $filter = null;

    public $format = ["currency"];

}