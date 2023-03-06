<?php

use yii\widgets\DetailView;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\QuanLyPhongBan */
/**
 * @var $modelpbnv \backend\models\ChiTietPhongBanNhanVien[]
 * @var $lichSuDieuChuyenTruongPhong array
 */
?>
<div class="phong-ban-view">
    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#thong-tin-chung" aria-controls="thong-tin-chung" role="tab"
                                                      data-toggle="tab">Thông tin chung</a></li>
            <li role="presentation"><a href="#dieu-chuyen-truong-phong" aria-controls="dieu-chuyen-truong-phong"
                                       role="tab" data-toggle="tab">Lịch sử điều chuyển trưởng phòng</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="thong-tin-chung">
                <h4><b>THÔNG TIN PHÒNG BAN</b></h4>
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Tên bộ phận / Phòng ban</label>
                            <input class="form-control" name="name" value="<?= $model->name ?>" disabled/>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Nhóm</label>
                            <select class="form-control" name="parent_id" disabled>
                                <?php if (isset($model->parent)): ?>
                                    <option value="<?= $model->parent_id ?>" selected><?= $model->parent->name ?></option>
                                <?php else: ?>
                                    <option value=""></option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Trưởng phòng</label>
                            <select class="form-control" name="truong_phong_id" disabled>
                                <?php if (isset($model->truong_phong)): ?>
                                    <option value="<?= $model->truong_phong_id ?>" selected><?= $model->truong_phong ?></option>
                                <?php else: ?>
                                    <option value=""></option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <h4><b>DANH SÁCH NHÂN VIÊN</b></h4>
                <div class="table-responsive table-ds-nhan-vien">
                    <table class="table table-bordered table-striped text-nowrap">
                        <thead>
                        <tr>
                            <th width="1%">STT</th>
                            <th>Họ tên</th>
                            <th>Điện thoại</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($modelpbnv as $index => $item): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?=\yii\helpers\Html::a($item->hoten, ['nhan-vien/view', 'id' => $item->nhan_vien_id, 'back_url' => Url::to(['phong-ban/view', 'id' => $model->id])], ['role' => 'modal-remote'])?></td>
                                <td><?= \backend\services\NhanVienService::getAttributeOfNhanVien($item->nhan_vien_id, 'dien_thoai') ?></td>
                                <td><?= \backend\services\NhanVienService::getAttributeOfNhanVien($item->nhan_vien_id, 'email') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="dieu-chuyen-truong-phong">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Tên trưởng phòng</th>
                        <th>Ngày chuyển</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($lichSuDieuChuyenTruongPhong):
                        foreach ($lichSuDieuChuyenTruongPhong as $key => $lichSu): ?>
                            <tr>
                                <td><?= $lichSu['hoten'] ?><?= $key == 0 ? ' (trưởng phòng hiện tại)' : '' ?></td>
                                <td><?= $lichSu['ngay'] ?></td>
                            </tr>
                        <?php endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<script>
    $(document).find('.table-ds-nhan-vien table').dataTable({"language" : {
        "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/vi.json"
        }});
</script>
