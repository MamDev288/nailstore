<?php
/* @var $this yii\web\View */
/* @var $model backend\models\NhanVien */
?>
<link rel="stylesheet" href="backend/themes/qltk2/nhan-vien/asset/chi-tiet-nhan-vien.css">
<div class="row form-chi-tiet-nhan-vien">
    <div class="col-md-4 col-xs-6">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <div class="image-profile">
                <div class="image-cover">
                    <img src="<?= '.' . $model->anh_nguoi_dung ?>">
                </div>
            </div>
            <h4 class="hoten"><?= $model->hoten ?></h4>
            <?= \backend\components\TextWithIconWidget::widget(["icon" => "transgender", "text" => \backend\helpers\ConstHelper::GIOI_TINH_LABEL[$model->gioi_tinh??0] ?? '']) ?>
            <?= \backend\components\TextWithIconWidget::widget(["icon" => "calendar-o", "text" => \backend\helpers\DateTimeHelper::formatDate($model->ngay_sinh)]) ?>
            <?= \backend\components\TextWithIconWidget::widget(["icon" => "phone", "text" => $model->dien_thoai]) ?>
            <?= \backend\components\TextWithIconWidget::widget(["icon" => "envelope-o", "text" => $model->email]) ?>
            <?= \backend\components\TextWithIconWidget::widget(["icon" => "graduation-cap", "text" => $model->trinhDo->name ?? '']) ?>
        </div>
    </div>
    <div class="col-md-8 col-xs-6">
        <?= \backend\components\TextWithIconWidget::widget(["icon" => "map-marker", "label" => "Địa chỉ", "text" => $model->dia_chi]) ?>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <?= \backend\components\TextWithIconWidget::widget(["icon" => "qrcode", "label" => "CMT / CCCD", "text" => $model->cmnd]) ?>
            </div>
            <div class="col-md-6 col-xs-12">
                <?= \backend\components\TextWithIconWidget::widget(["icon" => "map-marker", "label" => "Nơi cấp", "text" => $model->noi_cap]) ?>
            </div>
        </div>

        <?= \backend\components\TextWithIconWidget::widget(["icon" => "building", "label" => "Phòng ban", "text" => \backend\helpers\StringHelper::getTextInObject($model->chiTietPhongBanNhanViens ?? null,'tenphongban')]) ?>
        <?= \backend\components\TextWithIconWidget::widget(["icon" => "bookmark-o", "label" => "Chức vụ", "text" => \backend\helpers\StringHelper::getTextInObject($model->chiTietPhongBanNhanViens ?? null,'ten_chuc_danh')]) ?>
        <?= \backend\components\TextWithIconWidget::widget(["icon" => "calendar-o", "label" => "Ngày thử việc", "text" => \backend\helpers\DateTimeHelper::formatDate(\backend\helpers\StringHelper::getTextInObject($model->hopDongThuViec ?? null,'ngay_hieu_luc'))]) ?>
        <?= \backend\components\TextWithIconWidget::widget(["icon" => "calendar-o", "label" => "Ngày chính thức", "text" => \backend\helpers\DateTimeHelper::formatDate(\backend\helpers\StringHelper::getTextInObject($model->hopDongChinhThuc ?? null,'ngay_hieu_luc'))]) ?>
        <?= \backend\components\TextWithIconWidget::widget(["icon" => "calendar-o", "label" => "Số năm làm việc chính thức", "text" => $model->soNgayHetHanHopDongChinhThuc ?? '']) ?>
        <?= \backend\components\TextWithIconWidget::widget(["icon" => "calendar-o", "label" => "Ngày hết hạn HĐ", "text" => \backend\helpers\DateTimeHelper::formatDate(\backend\helpers\StringHelper::getTextInObject($model->hopDongChinhThuc ?? null,'ngay_het_han'))]) ?>
    </div>
</div>