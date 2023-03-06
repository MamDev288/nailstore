<?php
/**
 * Created by PhpStorm.
 * User: HungLuongHien
 * Date: 6/23/2016
 * Time: 1:11 PM
 * @var $this \yii\web\View
 */
use  yii\bootstrap\Html;
use backend\models\ThongBao;
\backend\assets\Qltk2Asset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title><?=\yii\helpers\Html::encode($this->title); ?></title>
    <?= \yii\helpers\Html::csrfMetaTags() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <?php $this->head() ?>
</head>
<body  class="page-header-fixed page-quick-sidebar-over-content page-full-width">
<?php $this->beginBody(); ?>

<?= $this->render('header.php', [
//        'soluongDaHTChoDuyet' => $soluongDaHTChoDuyet,
//        'dataCVCaNhanChoNhan' => $dataCVCaNhanChoNhan,
//        'slCVPhongBanChoDuyet' => $slCVPhongBanChoDuyet,
//        'dataCVPhongBanChoNhan' => $dataCVPhongBanChoNhan,
//        'dataCVPhongBanThamVanChoNhan' => $dataCVPhongBanThamVanChoNhan,
//        'dataCVChoLanhDaoDuyet' => $dataCVChoLanhDaoDuyet
]); ?>
<?= $this->render('content.php', [
    'content' => $content,
//        'soluongDaHTChoDuyet' => $soluongDaHTChoDuyet,
//        'dataCVCaNhanChoNhan' => $dataCVCaNhanChoNhan,
//        'slCVPhongBanChoDuyet' => $slCVPhongBanChoDuyet,
//        'dataCVPhongBanChoNhan' => $dataCVPhongBanChoNhan,
//        'dataCVPhongBanThamVanChoNhan' => $dataCVPhongBanThamVanChoNhan,
//        'dataCVChoLanhDaoDuyet' => $dataCVChoLanhDaoDuyet
]); ?>

<div id="print-block"></div>

<?=$this->render('_doimatkhau'); ?>
<script type="application/javascript">
    const baseUrl = "<?=Yii::$app->urlManager->createAbsoluteUrl(['/']);?>"
</script>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>


