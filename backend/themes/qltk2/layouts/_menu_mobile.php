<?php

use backend\models\User;
use yii\helpers\Html;
use common\models\myAPI;
use yii\helpers\Url;
?>
<ul class="page-sidebar-menu" data-slide-speed="200" data-auto-scroll="true">
    <?= \backend\components\MenuMobileWidget::widget(["menus" => \backend\helpers\MenuHelper::getMenuMobile()]) ?>
</ul>
