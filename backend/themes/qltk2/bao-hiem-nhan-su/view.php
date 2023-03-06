<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BaoHiemNhanSu */
?>
<div class="bao-hiem-nhan-su-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => "Tháng",
                'value' => date("Y-m", strtotime($model->nam . '-' . $model->thang))
            ],
            [
                'attribute' => "Tổng tiền",
                'value' => \backend\helpers\NumberHelper::formatMoney($model->tong_tien)
            ],
            'created',
            [
                'attribute' => "Người tạo",
                'value' => $model->userCreated->hoten
            ],
            'ghi_chu:ntext',
        ],
    ]) ?>
    <form method="get" class="inline">
        <input type="hidden" id="r" name="r" value="chi-tiet-bao-hiem-nhan-su/index">
        <input type="hidden" id="bao_hiem_nhan_su_id" name="bao_hiem_nhan_su_id" value="<?= $model->id ?>">
        <button class="float-left submit-button btn btn-primary btn-lg btn-block"><i class="fa fa-address-book"></i>
            Danh sách nhân viên đóng bảo hiểm
        </button>
    </form>
</div>
