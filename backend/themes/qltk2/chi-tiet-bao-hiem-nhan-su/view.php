<?php

use backend\helpers\NumberHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ChiTietBaoHiemNhanSu */
?>
<div class="chi-tiet-bao-hiem-nhan-su-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'Mã bảo hiểm nhân sự',
                'value' => $model->bao_hiem_nhan_su_id
            ],
            [
                'attribute' => 'Ngày tạo',
                'value' => \backend\helpers\DateTimeHelper::formatDateTime($model->created)
            ],
            [
                'attribute' => 'Số tiền đóng',
                'value' => NumberHelper::formatMoney($model->so_tien_dong). ' VNĐ'
            ],
            [
                'attribute' => 'Hệ số doanh nghiệp đóng',
                'value' => $model->he_so_doanh_nghiep_dong. ' %'
            ],
            [
                'attribute' => 'Hệ số người lao động đóng',
                'value' =>  $model->he_so_nguoi_lao_dong_dong. ' %'
            ],
            [
                'attribute' => 'Doanh nghiệp đóng',
                'value' => NumberHelper::formatMoney($model->doanh_nghiep_dong). ' VNĐ'
            ],
            [
                'attribute' => 'Người lao động đóng',
                'value' => NumberHelper::formatMoney($model->nguoi_lao_dong_dong). ' VNĐ'
            ],
            [
                'attribute' => 'Tổng nộp',
                'value' => '<strong>'.NumberHelper::formatMoney($model->tong_nop).' VNĐ</strong>',
                'format' => 'raw'
            ],
            'ghi_chu:ntext',
        ],
    ]) ?>
</div>
