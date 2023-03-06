<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%phong_ban_nhan_vien}}".
 *
 * @property int $id
 * @property int|null $phong_ban_id
 * @property int|null $nhan_vien_id
 * @property int|null $truong_phong
 * @property string|null $created
 * @property int|null $user_id
 * @property int|null $active
 * @property string|null $ngay_thuc_hien
 * @property string|null $ghi_chu
 * @property int|null $chuc_danh_id
 * @property float|null $luong_co_ban
 *
 * @property ChamCongThang[] $chamCongThangs
 * @property ChiTietBangLuong[] $chiTietBangLuongs
 * @property ChiTietBaoHiemNhanSu[] $chiTietBaoHiemNhanSus
 * @property NghiPhep[] $nghiPheps
 * @property DanhMuc $chucDanh
 * @property PhongBan $phongBan
 * @property User $nhanVien
 * @property User $user
 * @property ThayDoiLuong[] $thayDoiLuongs
 */
class PhongBanNhanVien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%phong_ban_nhan_vien}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phong_ban_id', 'nhan_vien_id', 'truong_phong', 'user_id', 'active', 'chuc_danh_id'], 'integer'],
            [['created', 'ngay_thuc_hien'], 'safe'],
            [['ghi_chu'], 'string'],
            [['luong_co_ban'], 'number'],
            [['chuc_danh_id'], 'exist', 'skipOnError' => true, 'targetClass' => DanhMuc::className(), 'targetAttribute' => ['chuc_danh_id' => 'id']],
            [['phong_ban_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongBan::className(), 'targetAttribute' => ['phong_ban_id' => 'id']],
            [['nhan_vien_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['nhan_vien_id' => 'id']],
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
            'phong_ban_id' => 'Phong Ban ID',
            'nhan_vien_id' => 'Nhan Vien ID',
            'truong_phong' => 'Truong Phong',
            'created' => 'Created',
            'user_id' => 'User ID',
            'active' => 'Active',
            'ngay_thuc_hien' => 'Ngay Thuc Hien',
            'ghi_chu' => 'Ghi Chu',
            'chuc_danh_id' => 'Chuc Danh ID',
            'luong_co_ban' => 'Luong Co Ban',
        ];
    }

    /**
     * Gets query for [[ChamCongThangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChamCongThangs()
    {
        return $this->hasMany(ChamCongThang::className(), ['nhan_vien_phong_ban_id' => 'id']);
    }

    /**
     * Gets query for [[ChiTietBangLuongs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChiTietBangLuongs()
    {
        return $this->hasMany(ChiTietBangLuong::className(), ['nhan_su_phong_ban_id' => 'id']);
    }

    /**
     * Gets query for [[ChiTietBaoHiemNhanSus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChiTietBaoHiemNhanSus()
    {
        return $this->hasMany(ChiTietBaoHiemNhanSu::className(), ['nhan_su_phong_ban_id' => 'id']);
    }

    /**
     * Gets query for [[NghiPheps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNghiPheps()
    {
        return $this->hasMany(NghiPhep::className(), ['nhan_vien_phong_ban_id' => 'id']);
    }

    /**
     * Gets query for [[ChucDanh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChucDanh()
    {
        return $this->hasOne(DanhMuc::className(), ['id' => 'chuc_danh_id']);
    }

    /**
     * Gets query for [[PhongBan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhongBan()
    {
        return $this->hasOne(PhongBan::className(), ['id' => 'phong_ban_id']);
    }

    /**
     * Gets query for [[NhanVien]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNhanVien()
    {
        return $this->hasOne(User::className(), ['id' => 'nhan_vien_id']);
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

    /**
     * Gets query for [[ThayDoiLuongs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThayDoiLuongs()
    {
        return $this->hasMany(ThayDoiLuong::className(), ['nhan_su_phong_ban_id' => 'id']);
    }
}
