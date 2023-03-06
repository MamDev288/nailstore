<?php
/**
 * Created by PhpStorm.
 * User: HungLuongHien
 * Date: 6/23/2016
 * Time: 1:54 PM
 */
use yii\helpers\Html;
?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <?=$this->render('_menu_mobile', [
//                'soluongDaHTChoDuyet' => $soluongDaHTChoDuyet,
//                'soLuongCVChoNhanCaNhan' => $dataCVCaNhanChoNhan,
//                'slCVPhongBanChoDuyet' => $slCVPhongBanChoDuyet,
//                'dataCVPhongBanChoNhan' => $dataCVPhongBanChoNhan,
//                'dataCVPhongBanThamVanChoNhan' => $dataCVPhongBanThamVanChoNhan,
//                'dataCVChoLanhDaoDuyet' => $dataCVChoLanhDaoDuyet
            ]); ?>
        </div>
        <!-- END HORIZONTAL RESPONSIVE MENU -->
    </div>
    <!-- END SIDEBAR -->

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                <?= $this->title ?>
            </h3>
            <hr/>
            <!-- END PAGE HEADER-->
            <div id="print-block"></div>
            <div class="thongbao"></div>

<!--            //= \yii\widgets\Breadcrumbs::widget([
////                'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
//                'links' =>   isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//
//
//            ]) -->
            <?= $content ?>
        </div>
    </div>
    <!-- END CONTENT -->

    <!-- BEGIN FOOTER -->
    <div class="page-footer fixed-color">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <div class="text-white text-center">
                    <?=date("Y")?>  &copy; THGROUP
                </div>
            </div>
            <div class="col-xs-4">
                <div class="text-right">
                    <?=Html::a('THGROUP', 'https://thgroup.io', ['target' => '_blank'])?>
                </div>
            </div>
        </div>

        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
</div>
<!-- END CONTAINER -->


