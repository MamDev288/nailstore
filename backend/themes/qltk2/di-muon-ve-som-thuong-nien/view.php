<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\form\DiMuonVeSomThuongNienForm */
?>
<div class="nghi-phep-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'loai_nghi',
            [
                'attribute' => 'nghi_tu_ngay',
                'value' => \backend\helpers\DateTimeHelper::formatDate($model->nghi_tu_ngay)
            ],
            [
                'attribute' => 'nghi_den_ngay',
                'value' => \backend\helpers\DateTimeHelper::formatDate($model->nghi_den_ngay)
            ],
            [
                'attribute' => 'so_phut',
                'value' => $model->truongHopDacBiet->so_phut_co_the_di_muon ?? 60
            ],
            'ly_do:ntext',
            'nguoiLamDon.hoten',
            [
                'attribute' => 'trang_thai',
                'value' => \backend\models\NghiPhep::getListTrangThai()[$model->trang_thai],
                'format' => 'raw',
            ],
            'ghi_chu:ntext',
        ],
    ]) ?>

</div>
