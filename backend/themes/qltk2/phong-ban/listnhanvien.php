<?php

use yii\widgets\DetailView;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\QuanLyPhongBan */
/**
 * @var $modelpbnv \backend\models\ChiTietPhongBanNhanVien[]
 */
?>
<div class="phong-ban-view">
    <h4>THÔNG TIN PHÒNG BAN</h4>

    <p><strong>Tên: </strong><?=$model->name?></p>
    <p><strong>Trưởng phòng: </strong><?=$model->truong_phong?></p>


    <h4>THÔNG TIN NHÂN SỰ</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-nowrap">
            <thead>
            <tr>
                <th width="1%">STT</th>
                <th>Họ tên</th>
                <th width="1%">Chức vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var $item \backend\models\ChiTietPhongBanNhanVien */ ?>
            <?php foreach ($modelpbnv as $index => $item): ?>
            <tr>
                <td><?=$index + 1?></td>
                <td><?=$item->hoten?></td>
                <td></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
