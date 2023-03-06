<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\QuanLyTuyenDungNhuCauNsUser */
/** @var $trangThai \backend\models\QuanLyTrangThaiPhieuTuyenDung */
?>
<div class="tuyen-dung-dk-nhu-cau-ns-view">
    <div class="tabbale-line">
        <ul class="nav nav-tabs">
            <li class="nav-item active">
                <a href="#tab_1" data-toggle="tab" aria-expanded="true">THÔNG TIN PHIẾU ĐĂNG KÍ</a>
            </li>
            <li class="nav-item">
                <a href="#tab_2" data-toggle="tab" aria-expanded="false">LỊCH SỬ TRẠNG THÁI</a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="row">
                <div class="col-md-4"><strong>Người thực hiện: </strong><?= $model->ten_nguoi_lap ?></div>
                <div class="col-md-4"><strong>Ngày thực hiện: </strong><?= date("d/m/Y H:i:s", strtotime($model->created)) ?></div>
                <div class="col-md-4"><strong>Phòng ban: </strong><?= $model->ten_phong_ban ?></div>
                <div class="col-md-4"><strong>Người phỏng vấn: </strong><?= $model->ten_nguoi_phong_van ?></div>
                <div class="col-md-4"><strong>Tên người duyệt: </strong> <?= isset($model->ten_nguoi_duyet) ? $model->ten_nguoi_duyet : 'Đơn chưa duyệt'?></div>
                <div class="col-md-4"><strong>Thời gian duyệt: </strong><?= isset($model->thoi_gian_duyet) ? date("d/m/Y H:i:s", strtotime($model->thoi_gian_duyet)) : 'Đơn chưa duyệt' ?></div>
                <div class="col-md-4"><strong>Vị trí tuyển dụng: </strong><?= \backend\services\TuyenDungDkNhuCauNsService::getViTriTuyenDungByTuyenDungNsId($model->id) ?></div>
                <div class="col-md-4"><strong>Số lượng nhân viên hiện tại: </strong><?= number_format($model->so_luong_nv_hien_tai, 0, ',', '.') ?></div>
                <div class="col-md-4"><strong>Số lượng nhân viên tuyển thêm: </strong><?= number_format($model->so_luong_nv_tuyen_them, 0, ',', '.') ?></div>
                <div class="col-md-4"><strong>Mức lương dự kiến: </strong><?= number_format($model->muc_luong_du_kien, 0, ',', '.')?> VNĐ</div>
                <div class="col-md-8"><strong>Trạng thái: </strong>
                    <?= \backend\models\TuyenDungDkNhuCauNs::getListTrangThai()[$model->trang_thai] ?>
                </div>
                <div class="col-md-12">
                    <hr>
                    <label><strong>Mô tả công việc:</strong></label>
                </div>
                <div class="col-md-12">
                    <?= $model->mo_ta_cong_viec ?>
                    <hr>
                </div>
                <div class="col-md-12"><label><strong>Tiêu chuẩn ứng viên:</strong></label></div>
                <div class="col-md-12">
                    <?= $model->tieu_chuan_ung_vien ?>
                    <hr>
                </div>
                <div class="col-md-12"><label><strong>Lý do bổ sung:</strong></label></div>
                <div class="col-md-12"><?= $model->ly_do_bo_xung ?></div>
            </div>
        </div>

        <div class="tab-pane table-responsive" id="tab_2">
            <table class="table table-bordered table-striped text-nowrap">
                <thead>
                    <tr>
                        <th>Người duyệt</th>
                        <th>Trạng thái</th>
                        <th>Ngày duyệt</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($trangThai)>0): ?>
                    <?php foreach ($trangThai as $item): ?>
                        <tr>
                            <td><?= $item->hoten ?></td>
                            <td width="1%"><?= \backend\models\TuyenDungDkNhuCauNs::getListTrangThai()[$item->trang_thai]?></td>
                            <td width="1%"><?= $item->trang_thai != \backend\models\TuyenDungDkNhuCauNs::CHO_DUYET ? date('d/m/Y', strtotime($item->created)) : '' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
