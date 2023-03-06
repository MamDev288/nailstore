<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password_hash
 * @property string|null $hoten
 * @property string|null $email
 * @property string|null $dien_thoai
 * @property string|null $auth_key
 * @property float|null $so_du
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $type
 * @property string|null $trang_thai
 * @property int|null $status
 * @property int|null $doanh_nghiep_id
 * @property string|null $secret_key
 *
 * @property ChiTietTienDoGiaoDich[] $chiTietTienDoGiaoDiches
 * @property DanhGia[] $danhGias
 * @property DanhGia[] $danhGias0
 * @property DoanhNghiep[] $doanhNghieps
 * @property DonHang[] $donHangs
 * @property GiaoDich[] $giaoDiches
 * @property GiaoDich[] $giaoDiches0
 * @property GiaoDich[] $giaoDiches1
 * @property GiayToLienKet[] $giayToLienKets
 * @property LichSuTrangThaiDonHang[] $lichSuTrangThaiDonHangs
 * @property LichSuTrangThaiUser[] $lichSuTrangThaiUsers
 * @property TrangThaiGiaoDich[] $trangThaiGiaoDiches
 * @property DoanhNghiep $doanhNghiep
 * @property Vaitrouser[] $vaitrousers
 */
class UserTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_temp}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['so_du'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'trang_thai'], 'string'],
            [['status', 'doanh_nghiep_id'], 'integer'],
            [['username', 'email'], 'string', 'max' => 50],
            [['password_hash', 'hoten', 'auth_key', 'secret_key'], 'string', 'max' => 100],
            [['dien_thoai'], 'string', 'max' => 13],
            [['doanh_nghiep_id'], 'exist', 'skipOnError' => true, 'targetClass' => DoanhNghiep::className(), 'targetAttribute' => ['doanh_nghiep_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'hoten' => 'Hoten',
            'email' => 'Email',
            'dien_thoai' => 'Dien Thoai',
            'auth_key' => 'Auth Key',
            'so_du' => 'So Du',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type' => 'Type',
            'trang_thai' => 'Trang Thai',
            'status' => 'Status',
            'doanh_nghiep_id' => 'Doanh Nghiep ID',
            'secret_key' => 'SK'
        ];
    }

    /**
     * Gets query for [[ChiTietTienDoGiaoDiches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChiTietTienDoGiaoDiches()
    {
        return $this->hasMany(ChiTietTienDoGiaoDich::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[DanhGias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDanhGias()
    {
        return $this->hasMany(DanhGia::className(), ['doanh_nghiep_id' => 'id']);
    }

    /**
     * Gets query for [[DanhGias0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDanhGias0()
    {
        return $this->hasMany(DanhGia::className(), ['user_created_id' => 'id']);
    }

    /**
     * Gets query for [[DoanhNghieps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoanhNghieps()
    {
        return $this->hasMany(DoanhNghiep::className(), ['user_created' => 'id']);
    }

    /**
     * Gets query for [[DonHangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDonHangs()
    {
        return $this->hasMany(DonHang::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[GiaoDiches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGiaoDiches()
    {
        return $this->hasMany(GiaoDich::className(), ['user_created' => 'id']);
    }

    /**
     * Gets query for [[GiaoDiches0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGiaoDiches0()
    {
        return $this->hasMany(GiaoDich::className(), ['nguoi_cung_cap_id' => 'id']);
    }

    /**
     * Gets query for [[GiaoDiches1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGiaoDiches1()
    {
        return $this->hasMany(GiaoDich::className(), ['nguoi_nhan_id' => 'id']);
    }

    /**
     * Gets query for [[GiayToLienKets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGiayToLienKets()
    {
        return $this->hasMany(GiayToLienKet::className(), ['nha_tuyen_dung_id' => 'id']);
    }

    /**
     * Gets query for [[LichSuTrangThaiDonHangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLichSuTrangThaiDonHangs()
    {
        return $this->hasMany(LichSuTrangThaiDonHang::className(), ['user_createad_id' => 'id']);
    }

    /**
     * Gets query for [[LichSuTrangThaiUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLichSuTrangThaiUsers()
    {
        return $this->hasMany(LichSuTrangThaiUser::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TrangThaiGiaoDiches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrangThaiGiaoDiches()
    {
        return $this->hasMany(TrangThaiGiaoDich::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[DoanhNghiep]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoanhNghiep()
    {
        return $this->hasOne(DoanhNghiep::className(), ['id' => 'doanh_nghiep_id']);
    }

    /**
     * Gets query for [[Vaitrousers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVaitrousers()
    {
        return $this->hasMany(Vaitrouser::className(), ['user_id' => 'id']);
    }
}
