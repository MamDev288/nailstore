<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%quan_ly_chi_tiet_bao_hiem_nhan_su}}".
 *
 * @property int $id
 * @property int|null $bao_hiem_nhan_su_id
 * @property int|null $nhan_su_phong_ban_id
 * @property float|null $so_tien_dong
 * @property float|null $doanh_nghiep_dong
 * @property float|null $nguoi_lao_dong_dong
 * @property float|null $tong_nop
 * @property float|null $he_so_doanh_nghiep_dong
 * @property float|null $he_so_nguoi_lao_dong_dong
 * @property int|null $thang
 * @property int|null $nam
 * @property int|null $nhan_vien_id
 */
class QuanLyChiTietBaoHiemNhanSu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%quan_ly_chi_tiet_bao_hiem_nhan_su}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bao_hiem_nhan_su_id', 'nhan_su_phong_ban_id', 'thang', 'nam', 'nhan_vien_id'], 'integer'],
            [['so_tien_dong', 'doanh_nghiep_dong', 'nguoi_lao_dong_dong', 'tong_nop', 'he_so_doanh_nghiep_dong', 'he_so_nguoi_lao_dong_dong'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bao_hiem_nhan_su_id' => 'Bao Hiem Nhan Su ID',
            'nhan_su_phong_ban_id' => 'Nhan Su Phong Ban ID',
            'so_tien_dong' => 'So Tien Dong',
            'doanh_nghiep_dong' => 'Doanh Nghiep Dong',
            'nguoi_lao_dong_dong' => 'Nguoi Lao Dong Dong',
            'tong_nop' => 'Tong Nop',
            'he_so_doanh_nghiep_dong' => 'He So Doanh Nghiep Dong',
            'he_so_nguoi_lao_dong_dong' => 'He So Nguoi Lao Dong Dong',
            'thang' => 'Thang',
            'nam' => 'Nam',
            'nhan_vien_id' => 'Nhan Vien ID',
        ];
    }
}
