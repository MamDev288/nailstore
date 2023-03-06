<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ChiTietBangLuong */
$thangText = isset($model->bangLuong) ? "tháng " . date('m/Y', strtotime($model->bangLuong->nam . '-' . $model->bangLuong->thang)) : "";
$this->title = "Chi tiết bảng lương " . $thangText;
?>
<?php \yii\widgets\Pjax::begin(); ?>
    <div class="chi-tiet-bang-luong-view">
        <div class="text-center">
            <h1 class="text-uppercase">Phiếu lương nhân viên</h1>
            <h3 class="text-uppercase">Tháng <?= $model->bangLuong->thang ?> năm <?= $model->bangLuong->nam ?></h3>
        </div>
        <div class="text-right"><small>Đơn vị tính: VNĐ</small></div>
        <table class="table table-bordered table-vcenter table-sm">
            <tbody>
            <tr>
                <td colspan="2">Mã nhân viên</td>
                <td><?= $model->nhanSuPhongBan->nhanVien->id ?? "" ?></td>
            </tr>
            <tr>
                <td colspan="2">Họ và tên</td>
                <td><?= $model->nhanSuPhongBan->nhanVien->hoten ?? "" ?></td>
            </tr>
            <tr>
                <td colspan="2">Phòng ban</td>
                <td><?= $model->nhanSuPhongBan->phongBan->name ?? "" ?></td>
            </tr>
            <tr>
                <td colspan="2">Chức danh</td>
                <td><?= $model->nhanSuPhongBan->chucDanh->name ?? "" ?></td>
            </tr>
            <tr>
                <td colspan="2">Hình thức lao động</td>
                <td><?= $model->hopDongNhanSu->tenHopDong->name ?? "" ?></td>
            </tr>
            <tr>
                <td colspan="2">Ngày vào công ty</td>
                <td><?=\backend\services\HopDongNhanSuService::getNgayVaoCongTyByNhanVienId($model->nhanSuPhongBan->nhanVien->id ?? null) ?? ''?></td>
            </tr>
            <tr>
                <td colspan="2">Ngày chính thức</td>
                <td><?=\backend\services\HopDongNhanSuService::getNgayVaoCongTyByNhanVienId($model->nhanSuPhongBan->nhanVien->id ?? null) ?? ''?></td>
            </tr>
            <tr>
                <td colspan="2">Mức lương đóng bảo hiểm xã hội</td>
                <td class="text-right"><?= \backend\helpers\NumberHelper::formatMoney($model->luong_dong_bhxh) ?></td>
            </tr>
            <tr>
                <td colspan="2">Số ngày công chuẩn của tháng</td>
                <td class="text-right"><?= $model->ngay_cong_quy_dinh ?></td>
            </tr>
            <tr>
                <td colspan="2">Số ngày công thực tế</td>
                <td class="text-right"><?= $model->so_cong_thuc_te ?></td>
            </tr>
            <tr>
                <td colspan="2">Ngày nghỉ tính phép</td>
                <td class="text-right"><?=$model->ngay_cong_quy_dinh - $model->so_cong_thuc_te?></td>
            </tr>
            <tr>
                <td colspan="2">Ngày nghỉ không tính phép</td>
                <td class="text-right">0</td>
            </tr>
            <tr>
                <th class="align-baseline" colspan="1" rowspan="11">A - Các khoản thu nhập</th>
                <th colspan="1">1. Lương</th>
                <th colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->luong_cung ?? 0) + ($model->luong_mem)) ?></th>
            </tr>
            <tr>
                <td colspan="1">1.1 Lương chính</td>
                <td colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->luong_cung ?? 0)) ?></td>
            </tr>
            <tr>
                <td colspan="1">1.2 Lương mềm</td>
                <td colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->luong_mem ?? 0)) ?></td>
            </tr>
            <tr>
                <th colspan="1">2. Phụ cấp</th>
                <th colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->tong_phu_cap ?? 0)) ?></th>
            </tr>
            <tr>
                <td colspan="1">2.1 Phụ cấp ăn trưa</td>
                <td colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->tien_phu_cap_an_trua ?? 0)) ?></td>
            </tr>
            <tr>
                <td colspan="1">2.2 Phụ cấp xăng xe</td>
                <td colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->phu_cap_xang_xe ?? 0)) ?></td>
            </tr>
            <tr>
                <td colspan="1">2.3 Phụ cấp handle hàng</td>
                <td colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->phu_cap_khac ?? 0)) ?></td>
            </tr>
            <tr>
                <td colspan="1">2.4 Phụ cấp thâm niên</td>
                <td colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->phu_cap_tham_nien ?? 0)) ?></td>
            </tr>
            <tr>
                <td colspan="1">2.5 Phụ cấp công tác</td>
                <td colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->phu_cap_tien_an_di_cong_tac ?? 0)) ?></td>
            </tr>
            <tr>
                <th colspan="1">3. Thưởng</th>
                <th colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->thuong ?? 0)) ?></th>
            </tr>
            <tr>
                <th colspan="1">Tổng thu nhập</th>
                <th colspan="1" class="text-right"><?= \backend\helpers\NumberHelper::formatMoney(($model->tong_luong ?? 0)) ?></th>
            </tr>
            <tr>
                <th colspan="1" rowspan="8">B - Các khoản khấu trừ vào lương</th>
                <td colspan="1">Bảo hiểm xã hội (8%)</td>
                <td colspan="1" class="text-right"><?=\backend\helpers\NumberHelper::formatMoney(($model->BHXH ?? 0))?></td>
            </tr>
            <tr>
                <td colspan="1">Bảo hiểm y tế (1.5%)</td>
                <td colspan="1" class="text-right"><?=\backend\helpers\NumberHelper::formatMoney(($model->BHYT ?? 0))?></td>
            </tr>
            <tr>
                <td colspan="1">Bảo hiểm tai nạn (1%)</td>
                <td colspan="1" class="text-right"><?=\backend\helpers\NumberHelper::formatMoney(($model->BHTN ?? 0))?></td>
            </tr>
            <tr>
                <td colspan="1">Công đoàn (1% trên tổng lương)</td>
                <td colspan="1" class="text-right"><?=\backend\helpers\NumberHelper::formatMoney(($model->cong_doan ?? 0))?></td>
            </tr>
            <tr>
                <td colspan="1">Thuế thu nhập cá nhân</td>
                <td colspan="1" class="text-right"><?=\backend\helpers\NumberHelper::formatMoney(($model->thue_TNCN ?? 0))?></td>
            </tr>
            <tr>
                <td colspan="1">Các khoản trừ lương khác</td>
                <td colspan="1" class="text-right"><?=\backend\helpers\NumberHelper::formatMoney(($model->tien_phat ?? 0))?></td>
            </tr>
            <tr>
                <td colspan="1">Tạm ứng</td>
                <td colspan="1" class="text-right"><?=\backend\helpers\NumberHelper::formatMoney(0)?></td>
            </tr>
            <tr>
                <th colspan="1">Tổng khấu trừ</th>
                <th colspan="1" class="text-right"><?=\backend\helpers\NumberHelper::formatMoney(
                        ($model->tong_cong_giam_tru ?? 0) + ($model->cong_doan ?? 0) + ($model->tien_phat ?? 0)
                    )?></th>
            </tr>
            <tr>
                <th colspan="2" class="text-center">C - Thực lĩnh (C=A-B)</th>
                <th colspan="1" class="text-right"><?=\backend\helpers\NumberHelper::formatMoney(($model->thuc_tra))?></th>
            </tr>
            </tbody>
        </table>
        <?php if ($model->status != \backend\models\ChiTietBangLuong::STATUS_CONFIRMED && isset($model->nhanSuPhongBan) &&
            $model->nhanSuPhongBan->nhan_vien_id == \Yii::$app->user->id && !\Yii::$app->request->isAjax): ?>
            <?= \yii\helpers\Html::a("Xác nhận bảng lương", ['/chi-tiet-bang-luong/confirm', 'id' => $model->id], [
                'class' => 'btn-confirm-chi-tiet-bang-luong btn btn-warning',
                'data-pjax' => 0, 'role' => 'modal-remote', 'data-request-method' => 'post',
                'data-toggle' => 'tooltip', 'data-confirm-title' => 'Thông báo',
                'data-confirm-message' => 'Bạn có chắc chắn muốn xác nhận bảng lương này là chính xác?', 'data-original-title' => 'Xác nhận',
            ]) ?>
            <div id="ajaxCrudModal" class="fade modal" role="dialog" tabindex="-1">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
            <?php $this->registerJs("
        $(document).ready(function () {
        (function ($) {
    $.fn.hasAttr = function (name) {
        return this.attr(name) !== undefined;
    };
}(jQuery));
    if ($('#ajaxCrubModal').length > 0 && $('#ajaxCrudModal').length == 0) {
        modal = new ModalRemote('#ajaxCrubModal');
    } else {
        modal = new ModalRemote('#ajaxCrudModal');
    }

    // Catch click event on all buttons that want to open a modal
    $(document).on('click', '[role=\"modal-remote\"]', function (event) {
        event.preventDefault();
        // Open modal
        modal.open(this, null);
    });
    })", \yii\web\View::POS_END) ?>
        <?php endif; ?>
        <style>
            .btn-confirm-chi-tiet-bang-luong {
                text-transform: uppercase;
                position: fixed;
                bottom: 20px;
                right: 40px;
                text-align: center;
                border-radius: 10px !important;
                box-shadow: 2px 2px 3px #999;
            }
            .table-vcenter td, .table-vcenter th{
                vertical-align: middle !important;
            }
            .chi-tiet-bang-luong-view{
                font-size: 90%;
            }
            .chi-tiet-bang-luong-view h1 {
                font-size: 20px;
            }
            .chi-tiet-bang-luong-view h3 {
                font-size: 16px;
            }
            .chi-tiet-bang-luong-view .table td, .chi-tiet-bang-luong-view .table th{
                padding: 0.3rem;
            }
        </style>
    </div>
<?php \yii\widgets\Pjax::end(); ?>