<?php
/** @var $this View */
use yii\helpers\Html;
use yii\web\View;
use backend\models\User;

?>

<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top" style="background-color: #344dba">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?=Yii::$app->urlManager->createUrl('site/index')?>" class="text-default">
            </a>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN HORIZANTAL MENU -->
        <div class="hor-menu hidden-sm hidden-xs">
            <?=$this->render('_menu'); ?>
        </div>
        <!-- END HORIZANTAL MENU -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->

        <!-- END TOP NAVIGATION MENU -->


        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">

<!--            <ul class="nav navbar-nav">-->
<!--                <li>-->
<!--                    <div class="icon" id="bell"><i class="fa fa-bell"></i><span class="badge-notification" id="number-notify" style="top: 4px;">--><?//= User::getNumberNotification() ?><!--</span> </div>-->
<!--                    <div class="notifications" id="box">-->
<!--                        <div class="header-notify">-->
<!--                            <h3 style="display: inline">Thông báo</h3>-->
<!--                            <a class="text-primary btn-read-all-notify" style="margin-left: 50px;">Đánh dấu tất cả đã đọc</a>-->
<!--                        </div>-->
<!---->
<!--                        <div class="item-notification" style="overflow: auto;height: 250px;"></div>-->
<!--                    </div>-->
<!--                </li>-->
<!--            </ul>-->

            <ul class="nav navbar-nav pull-right">
                <li>
                    <div class="icon" id="bell"><i class="fa fa-bell"></i><span class="badge-notification" id="number-notify" style="top: 4px;"><?= User::getNumberNotification() ?></span> </div>
                    <div class="notifications" id="box">
                        <div class="header-notify">
                            <h3 style="display: inline">Thông báo</h3>
                            <a class="text-primary btn-read-all-notify" style="margin-left: 50px;">Đánh dấu tất cả đã đọc</a>
                        </div>

                        <div class="item-notification" style="overflow: auto;height: 250px;"></div>
                    </div>
                </li>
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user dropdown-menu" style="background: transparent; text-align: right;border: none; min-width: auto;">
                    <a href="javascript:;" class="dropdown-toggle" style="position: relative" data-click="dropdown" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-haspopup="true">
                        <img alt="" class="img-circle" src="<?=isset(Yii::$app->user->identity->anh_nguoi_dung)? Yii::$app->request->baseUrl.'/images'.Yii::$app->user->identity->anh_nguoi_dung : Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/admin/layout/img/avatar3_small.jpg' ?>"/>
                        <span class="username  white-text">
                            <?=Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->username; ?>
                        </span>
                        <i class="fa fa-angle-down white-text"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <?= Html::a('<i class="fa fa-clock-o"></i> Chấm công', \yii\helpers\Url::toRoute(['me/lich-cham-cong']),
                                ['title'=> 'Lịch chấm công', 'class' => 'black-text-drop', 'data-value' => Yii::$app->user->id])?>
                        </li>
                        <li>
                            <?= Html::a('<i class="fa fa-table"></i> Bảng lương', \yii\helpers\Url::toRoute(['me/view-bang-luong']),
                                ['title'=> 'Bảng lương', 'class' => 'black-text-drop btn-bang-luong'])?>
                        </li>
                        <li>
                            <?= Html::a('<i class="fa fa-user"></i> Hồ sơ cá nhân', ['me/update-ho-so-ca-nhan'],
                                ['title'=> 'Hồ sơ cá nhân', 'class' => 'black-text-drop', 'role' => 'modal-remote'])?>
                        </li>
                        <li>
                            <?=Html::a('<i class="icon-key"></i> Đổi mật khẩu', ['me/change-password'], ['class' => 'black-text-drop','role' => 'modal-remote'])?>
                        </li>
                        <li>
                            <?=Html::a('<i class="glyphicon glyphicon-log-out"></i> Đăng xuất', Yii::$app->urlManager->createUrl('site/logout'), [ 'class' => 'black-text-drop'])?>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix"></div>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script src="backend/assets/js-view/index.js"></script>

