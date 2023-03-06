<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%chi_tiet_bao_hiem_nhan_su}}".
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
 *
 * @property BaoHiemNhanSu $baoHiemNhanSu
 * @property PhongBanNhanVien $nhanSuPhongBan
 */
class ChiTietBaoHiemNhanSu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%chi_tiet_bao_hiem_nhan_su}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bao_hiem_nhan_su_id', 'nhan_su_phong_ban_id'], 'integer'],
            [['so_tien_dong', 'doanh_nghiep_dong', 'nguoi_lao_dong_dong', 'tong_nop', 'he_so_doanh_nghiep_dong', 'he_so_nguoi_lao_dong_dong'], 'number'],
            [['bao_hiem_nhan_su_id'], 'exist', 'skipOnError' => true, 'targetClass' => BaoHiemNhanSu::className(), 'targetAttribute' => ['bao_hiem_nhan_su_id' => 'id']],
            [['nhan_su_phong_ban_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongBanNhanVien::className(), 'targetAttribute' => ['nhan_su_phong_ban_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bao_hiem_nhan_su_id' => 'Bảo hiểm nhân sự',
            'nhan_su_phong_ban_id' => 'Nhân sự',
            'so_tien_dong' => 'Số tiền đóng',
            'doanh_nghiep_dong' => 'Doanh nghiệp đóng',
            'nguoi_lao_dong_dong' => 'Người lao động đóng',
            'tong_nop' => 'Tổng nộp',
            'he_so_doanh_nghiep_dong' => 'Hệ số doanh nghiệp đóng',
            'he_so_nguoi_lao_dong_dong' => 'Hệ số người lao động đóng',
        ];
    }

    /**
     * Gets query for [[BaoHiemNhanSu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBaoHiemNhanSu()
    {
        return $this->hasOne(BaoHiemNhanSu::className(), ['id' => 'bao_hiem_nhan_su_id']);
    }

    /**
     * Gets query for [[NhanSuPhongBan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNhanSuPhongBan()
    {
        return $this->hasOne(PhongBanNhanVien::className(), ['id' => 'nhan_su_phong_ban_id']);
    }
}
