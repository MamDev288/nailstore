<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PhongVan */
?>
<div class="phong-van-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'ung_vien_id',
                'value' => $model->ungVien->hoten ?? null,
            ],
            [
                'attribute' => 'tuyen_dung_dk_nhu_cau_ns_id',
                'value' => \backend\services\TuyenDungDkNhuCauNsService::getNameTuyenDungDkNhuCauNsDaDuyetById($model->tuyen_dung_dk_nhu_cau_ns_id),
            ],
            [
                'attribute' => 'cv',
                'format' => 'raw',
                'value' => \yii\helpers\Html::a($model->cv, '.' . $model->cv, ['target' => '_blank'])
            ],
            [
                'label' => 'Người phỏng vấn',
                'value' => $model->tuyenDungDkNhuCauNs->deXuatNguoiPhongVan->hoten ?? null,
            ],
            [
                'label' => 'Tình trạng',
                'format' => 'raw',
                'value' => \backend\services\TrangThaiPhongVanService::getTrangThaiPhongVanStatusLabelColor($model->trangThaiPhongVan->status ?? null),
            ],
            [
                'label' => 'Điểm đạt được',
                'value' => $model->trangThaiPhongVan->diem_dat_duoc ?? null,
            ],
            [
                'label' => 'Ngày phỏng vấn',
                'value' => $model->trangThaiPhongVan->ngay_phong_van ? \backend\helpers\DateTimeHelper::formatDateTime($model->trangThaiPhongVan->ngay_phong_van) : null,
            ],
//            'cv',
            [
                'attribute' => 'created_by',
                'value' => $model->createdBy->hoten ?? null,
            ],
            [
                'attribute' => 'updated_by',
                'value' => $model->updatedBy->hoten ?? null,
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
