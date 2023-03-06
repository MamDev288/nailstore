<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BangLuong */
?>
<div class="bang-luong-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => isset($model->user) ? $model->user->hoten : '',
            ],
            'thang',
            'nam',
            'trang_thai',
            [
                'attribute' => 'created',
                'value' => !empty($model->created) ? \backend\helpers\DateTimeHelper::formatDate($model->created) : ''
            ],
            [
                'attribute' => 'ngay_cham_cong',
                'value' => !empty($model->ngay_cham_luong) ? \backend\helpers\DateTimeHelper::formatDate($model->ngay_cham_luong) : ''
            ],
        ],
    ]) ?>

</div>
<form method="get" class="inline">
    <input type="hidden" id="r" name="r" value="chi-tiet-bang-luong/index">
    <input type="hidden" id="bang_luong" name="bang_luong" value="<?= $model->id ?>">
    <button class="float-left submit-button btn btn-primary btn-lg btn-block"><i class="fa fa-address-book"></i>Chi tiết
        bảng lương
    </button>
</form>
