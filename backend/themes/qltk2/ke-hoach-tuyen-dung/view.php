<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\KeHoachTuyenDung */
?>
<div class="ke-hoach-tuyen-dung-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Hình thức đăng ký',
                'value' => implode(', ', array_map(function ($item) {
                    return $item->hinh_thuc_dang_ky;
                }, $model->khHinhThucDangKies)),
            ],
            [
                'attribute' => 'kh_nguoi_lap_ke_hoach_id',
                'value' => $model->khNguoiLapKeHoach->hoten ?? null
            ],
            [
                'attribute' => 'vi_tri_tuyen_dung_id',
                'value' => $model->viTriTuyenDung->vi_tri ?? null
            ],
            [
                'attribute' => 'phong_ban_id',
                'value' => $model->phongBan->name ?? null
            ],
            [
                'attribute' => 'kh_ngay_lap_ke_hoach',
                'value' => \backend\helpers\DateTimeHelper::formatDate($model->kh_ngay_lap_ke_hoach)
            ],
            [
                'attribute' => 'so_luong_nv_hien_tai',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->so_luong_nv_hien_tai)
            ],
            [
                'attribute' => 'so_luong_nv_tuyen_them',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->so_luong_nv_tuyen_them)
            ],
            [
                'attribute' => 'muc_luong_du_kien',
                'value' => \backend\helpers\NumberHelper::formatMoney($model->muc_luong_du_kien)
            ],
            [
                'attribute' => 'mo_ta_cong_viec',
                'value' => \backend\helpers\NumberHelper::formatMoney($model->mo_ta_cong_viec)
            ],
            [
                'attribute' => 'tieu_chuan_ung_vien',
                'value' => $model->tieu_chuan_ung_vien
            ],
            [
                'attribute' => 'kh_de_xuat_cb_pv_chuyen_mon',
                'value' => $model->kh_de_xuat_cb_pv_chuyen_mon,
            ],
            'kh_hinh_thuc_tuyen_dung',
            'kh_tien_trinh_bo_sung_nhan_su',
        ],
    ]) ?>

</div>
