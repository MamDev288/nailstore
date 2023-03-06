<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\QuanLyHopDongNhanSu */
//$nhansu = $model->nhanSu;

?>
<div class="hop-dong-nhan-su-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'Tên hợp đồng',
                'value' => $model->ten_hop_dong,
            ],
            [
                'attribute' => 'Loại Hợp Đồng',
                'value' => $model->loai_hop_dong,
            ],
            [
                'attribute' => 'Tài Khoản nhân sự',
                'value' => $model->tai_khoan_nhan_su,
            ],
            [
                'attribute' => 'Họ Tên Nhân Sự',
                'value' => $model->hoten,
            ],
            [
                'attribute' => 'Đơn vị ký hợp đồng',
                'value' => $model->don_vi_ky_hop_dong,
            ],
            [
                'attribute' => 'Người đại diện ký hợp đồng',
                'value' => $model->nguoi_dai_dien_ky,
            ],
            [
                'attribute' => 'Vai trò người đại diện ký',
                'value' => $model->vai_tro_nguoi_dai_dien_ky,
            ],
            [
                'attribute' => 'Người tạo',
                'value' => $model->nguoi_tao,
            ],
            [
                'attribute' => 'Ngày tạo',
                'value' => date('d/m/Y', strtotime($model->created)),
            ],
            [
                'attribute' => 'Ngày thực hiện',
                'value' => $model->ngay_thuc_hien != '' ? date('d/m/Y', strtotime($model->ngay_thuc_hien)) : '',
            ],
            [
                'attribute' => 'Ngày hiệu lực',
                'value' => $model->ngay_hieu_luc != '' ?date('d/m/Y', strtotime($model->ngay_hieu_luc)) : '',
            ],
            [
                'attribute' => 'Ngày hết hạn',
                'value' => $model->ngay_het_han != '' ? date('d/m/Y', strtotime($model->ngay_het_han)) : '',
            ],
            [
                'attribute' => 'Lương cơ bản',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->luong_co_ban).' VNĐ',
            ],
            [
                'attribute' => 'Lương đóng bảo hiểm',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->luong_dong_bao_hiem).' VNĐ',
            ],
            [
                'attribute' => 'Tỷ lệ hưởng lương',
                'value' => \backend\helpers\NumberHelper::formatNumber($model->ty_le_huong_luong, 2). ' %',
            ],
            [
                'attribute' => 'File đính kèm',
                'value' => \yii\helpers\Html::a($model->file_dinh_kem, '.'.$model->file_dinh_kem, ['target' => '_blank']),
                'format' => 'raw'
            ],
        ],
    ]) ?>
    <form  method="get" class="inline">
        <input type="hidden" id="r" name="r" value="thay-doi-luong/index">
        <input type="hidden" id="hop_dong_nhan_su_id" name="hop_dong_nhan_su_id" value="<?=$model->id?>">
        <button class="float-left submit-button btn btn-primary btn-lg btn-block" ><i class="fa fa-address-book"></i>Thay Đổi lương</button>
    </form>
</div>
