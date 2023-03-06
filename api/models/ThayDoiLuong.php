<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "vh_thay_doi_luong".
 *
 * @property int $id
 * @property int|null $nhan_su_phong_ban_id
 * @property float|null $luong_dong_bao_hiem
 * @property int|null $hop_dong_nhan_su_id
 * @property int|null $user_id
 * @property string|null $created
 * @property float|null $luong_thang
 * @property float|null $luong_mem
 *
 * @property VhFileThayDoiLuong[] $vhFileThayDoiLuongs
 * @property HopDongNhanSu $hopDongNhanSu
 * @property PhongBanNhanVien $nhanSuPhongBan
 * @property User $user
 */
class ThayDoiLuong extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vh_thay_doi_luong';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nhan_su_phong_ban_id', 'hop_dong_nhan_su_id', 'user_id'], 'integer'],
            [['luong_dong_bao_hiem', 'luong_thang', 'luong_mem'], 'number'],
            [['created'], 'safe'],
            [['hop_dong_nhan_su_id'], 'exist', 'skipOnError' => true, 'targetClass' => HopDongNhanSu::className(), 'targetAttribute' => ['hop_dong_nhan_su_id' => 'id']],
            [['nhan_su_phong_ban_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongBanNhanVien::className(), 'targetAttribute' => ['nhan_su_phong_ban_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nhan_su_phong_ban_id' => 'Nhan Su Phong Ban ID',
            'luong_dong_bao_hiem' => 'Luong Dong Bao Hiem',
            'hop_dong_nhan_su_id' => 'Hop Dong Nhan Su ID',
            'user_id' => 'User ID',
            'created' => 'Created',
            'luong_thang' => 'Luong Thang',
            'luong_mem' => 'Luong Mem',
        ];
    }

    /**
     * Gets query for [[VhFileThayDoiLuongs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVhFileThayDoiLuongs()
    {
        return $this->hasMany(VhFileThayDoiLuong::className(), ['thay_doi_luong_id' => 'id']);
    }

    /**
     * Gets query for [[HopDongNhanSu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHopDongNhanSu()
    {
        return $this->hasOne(HopDongNhanSu::className(), ['id' => 'hop_dong_nhan_su_id']);
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
