<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use backend\helpers\DateTimeHelper;
use backend\helpers\StringHelper;
use backend\helpers\NumberHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\NhanVien */
$request = \Yii::$app->request;
$uid = $request->get('uid') ?? null;
$thang = $request->get('thang') ? date('Y-m', strtotime($request->get('thang'))) : null;
?>
<div class="cham-cong-theo-thang-view">

    <h4>THÔNG TIN CHẤM CÔNG </h4>
    <div class="text-right margin-bottom-10">
        <?=Html::a('Thêm mới', ['cham-cong/create','back_url' => Url::to(['cham-cong-theo-thang/view', 'uid' => $uid, 'thang' => $thang])], ['role' => 'modal-remote', 'class' => 'btn btn-primary'])?>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-nowrap table-fixed table-hover table-small">
            <thead>
            <tr>
                <th width="1%"></th>
                <th width="1%">Ngày</th>
                <th width="1%">Thứ</th>
                <th width="1%" class="text-center">vào 1</th>
                <th width="1%" class="text-center">ra 1</th>
                <th width="1%" class="text-center">vào 2</th>
                <th width="1%" class="text-center">ra 2</th>
                <th width="1%">Quên chấm vào</th>
                <th width="1%">Quên chấm ra</th>
                <th width="1%">Số phút ĐM/VS</th>
                <th width="1%">Số công bị trừ</th>
                <th width="1%">Số tiền phạt</th>
                <th width="1%">Số công</th>

            </tr>
            </thead>
            <tbody>
            <?php /** @var $item \backend\models\ChamCong */ ?>
            <?php foreach ($model as $item): ?>
                <tr>
                    <td class="text-center"><?= Html::a('<i class="fa fa-edit"></i>', Url::toRoute(['cham-cong/update', 'id' => $item->id, 'back_url' => Url::to(['cham-cong-theo-thang/view', 'uid' => $item->nhan_vien_id, 'thang' => date('Y-m',strtotime($item->date)),])]), ['role' => 'modal-remote']) ?></td>
                    <td><?= \backend\helpers\DateTimeHelper::formatDate($item->date) ?></td>
                    <td><?= StringHelper::getDayNameVietnamese(DateTimeHelper::getDayNameFromDate($item->date)) ?></td>
                    <td class="text-center"><?= $item->vao1 ?></td>
                    <td class="text-center"><?= $item->ra1 ?></td>
                    <td class="text-center"><?= $item->vao2 ?></td>
                    <td class="text-center"><?= $item->ra2 ?></td>
                    <td class="text-right"><?= NumberHelper::formatNumber($item->so_lan_quen_check_in) ?></td>
                    <td class="text-right"><?= NumberHelper::formatNumber($item->so_lan_quen_check_out) ?></td>
                    <td class="text-right"><?= NumberHelper::formatNumber($item->so_phut_di_muon) ?></td>
                    <td class="text-right"><?= NumberHelper::formatNumber($item->so_cong_bi_tru) ?></td>
                    <td class="text-right"><?= \backend\helpers\NumberHelper::formatMoney($item->so_tien_phat) ?></td>
                    <td class="text-right"><?= NumberHelper::formatNumber($item->so_cong_chuan) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="7">Tổng</th>
                <th class="text-right"><?= NumberHelper::formatNumber(\backend\helpers\NumberHelper::calcSummary($model, 'so_lan_quen_check_in')) ?></th>
                <th class="text-right"><?= NumberHelper::formatNumber(\backend\helpers\NumberHelper::calcSummary($model, 'so_lan_quen_check_out')) ?></th>
                <th class="text-right"><?= NumberHelper::formatNumber(\backend\helpers\NumberHelper::calcSummary($model, 'so_phut_di_muon')) ?></th>
                <th class="text-right"><?= NumberHelper::formatNumber(\backend\helpers\NumberHelper::calcSummary($model, 'so_cong_bi_tru')) ?></th>
                <th class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(\backend\helpers\NumberHelper::calcSummary($model, 'so_tien_phat')) ?></th>
                <th class="text-right"><?= NumberHelper::formatNumber(\backend\helpers\NumberHelper::calcSummary($model, 'so_cong_chuan')) ?></th>
            </tr>
            </tfoot>

        </table>
    </div>

</div>
<style>
    .cham-cong-theo-thang-view .table-responsive{
        max-height: 600px;
        overflow-y: scroll;
    }
    .cham-cong-theo-thang-view .table-fixed th:first-child,
    .cham-cong-theo-thang-view .table-fixed td:first-child{
        position: sticky;
        left: -1px;
        border: 1px solid #ddd;
        background: #fff;
    }
    @media (min-width: 992px){
        .modal-lg {
            width: auto;
            max-width: 1400px;
        }
    }
</style>