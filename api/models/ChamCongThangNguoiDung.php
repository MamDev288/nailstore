<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "vh_cham_cong_thang_nguoi_dung".
 *
 * @property int $id
 * @property int|null $month
 * @property int|null $year
 * @property int|null $nhan_vien_id
 * @property string|null $trang_thai
 * @property int $so_buoi_di_muon
 * @property int $quen_checkin_checkout
 * @property int $so_ngay_den_du
 * @property string|null $ghi_chu
 */
class ChamCongThangNguoiDung extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vh_cham_cong_thang_nguoi_dung';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'month', 'year', 'nhan_vien_id', 'so_buoi_di_muon', 'quen_checkin_checkout', 'so_ngay_den_du'], 'integer'],
            [['trang_thai'], 'string'],
            [['ghi_chu'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'month' => 'Month',
            'year' => 'Year',
            'nhan_vien_id' => 'Nhan Vien ID',
            'trang_thai' => 'Trang Thai',
            'so_buoi_di_muon' => 'So Buoi Di Muon',
            'quen_checkin_checkout' => 'Quen Checkin Checkout',
            'so_ngay_den_du' => 'So Ngay Den Du',
            'ghi_chu' => 'Ghi Chu',
        ];
    }
}
