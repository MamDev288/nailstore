<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ChamCong */
/* @var $model_luot_cham_cong backend\models\LuotChamCong */

?>
<div class="cham-cong-theo-thang-view">

    <h4>THÔNG TIN LƯỢT CHẤM CÔNG </h4>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'date',
                'value' => \backend\helpers\DateTimeHelper::formatDate($model->date)
            ],
            [
                'attribute' => 'nhan_vien_id',
                'value' => $model->nhanVien->hoten ?? null,
            ],
            [
                'attribute' => 'vao1',
                'value' => $model->vao1 ? \backend\helpers\DateTimeHelper::formatDateTime($model->vao1) : null
            ],
            [
                'attribute' => 'ra1',
                'value' => $model->ra1 ? \backend\helpers\DateTimeHelper::formatDateTime($model->ra1) : null
            ],
            [
                'attribute' => 'vao2',
                'value' => $model->vao2 ? \backend\helpers\DateTimeHelper::formatDateTime($model->vao2) : null
            ],
            [
                'attribute' => 'ra2',
                'value' => $model->ra2 ? \backend\helpers\DateTimeHelper::formatDateTime($model->ra2) : null
            ],
            [
                'attribute' => 'so_lan_quen_check_in',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->so_lan_quen_check_in)
            ],
            [
                'attribute' => 'so_lan_quen_check_out',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->so_lan_quen_check_out)
            ],
            [
                'attribute' => 'so_phut_di_muon',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->so_phut_di_muon)
            ],
            [
                'attribute' => 'so_cong_bi_tru',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->so_cong_bi_tru)
            ],
            [
                'attribute' => 'so_tien_phat',
                'value' => \backend\helpers\NumberHelper::formatMoney($model->so_tien_phat)
            ],
            [
                'attribute' => 'so_cong_chuan',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->so_cong_chuan)
            ],
        ],
    ]) ?>


</div>
