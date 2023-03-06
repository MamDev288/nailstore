<?php

use backend\models\DuyetNghiPhepUser;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\PhongBan;


/* @var $this yii\web\View */
/* @var $model backend\models\DuyetNghiPhep */
?>
<?php $form = ActiveForm::begin(['class' => 'form-inline']); ?>
<div>
    <h4><strong>Phòng Ban: </strong><?= $model->nghiPhep->nhanVienPhongBan->phongBan->name ?? "" ?></h4>
    <h4><strong>Người làm đơn: </strong><?= $model->nghiPhep->nhanVienPhongBan->nhanVien->hoten ?? "" ?></h4>
    <h4><strong>Loại: </strong><?= \backend\models\NghiPhep::getLoaiNghi()[$model->nghiPhep->type] ?? ""; ?></h4>
    <h4><strong>Nghỉ từ </strong> <?= $model->nghiPhep->nghi_tu_ngay ?>
        <strong>Đến </strong> <?= $model->nghiPhep->nghi_den_ngay ?></h4>
    <h4><strong>Lý do: </strong> <?= $model->nghiPhep->ly_do ?></h4>
    <h4><strong>Nội dung: </strong> <?= $model->nghiPhep->ghi_chu ?></h4>
    <?php if($model->trang_thai == \backend\models\DuyetNghiPhep::TRANGTHAI_CHODUYET): ?>
    <?= $form->field($model, 'trang_thai',
        ['template' => "<h4 style='display: inline'><strong>Trạng thái:</strong></h4>{input}", 'options' => ['class' => 'form-inline']])->dropDownList([
        \backend\models\DuyetNghiPhep::TRANGTHAI_DUYET => 'Duyệt',
        \backend\models\DuyetNghiPhep::TRANGTHAI_TUCHOI => 'Từ chối',
    ]) ?>
    <?php else: ?>
        <h4><strong>Trạng thái: </strong> <?= \backend\services\DuyetNghiPhepService::getStatusDuyetNghiPhepLabelBadge($model->trang_thai); ?></h4>
    <?php endif; ?>
</div>
<?php ActiveForm::end(); ?>
