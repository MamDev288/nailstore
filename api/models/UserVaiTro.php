<?php

namespace api\models;

use Yii;


/**
 * This is the model class for table "{{%user_vai_tro}}".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $hoten
 * @property string|null $trang_thai
 * @property int|null $dia_chi
 * @property float|null $so_du
 * @property string|null $auth_key
 * @property string|null $dien_thoai
 * @property int|null $status
 * @property string|null $email
 * @property string|null $avatar
 * @property string|null $gioi_thieu
 * @property string|null $type
 * @property int|null $doanh_nghiep_id
 * @property int|null $vai_tro_id
 * @property string|null $ten_vai_tro
 * @property string|null $ten_doanh_nghiep
 * @property int|null $id_quan_li
 * @property string|null $trang_thai_doanh_nghiep
 */
class UserVaiTro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_vai_tro}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dia_chi', 'status', 'doanh_nghiep_id', 'vai_tro_id', 'id_quan_li'], 'integer'],
            [['trang_thai', 'avatar', 'gioi_thieu', 'type', 'ten_doanh_nghiep', 'trang_thai_doanh_nghiep'], 'string'],
            [['so_du'], 'number'],
            [['username', 'email'], 'string', 'max' => 50],
            [['hoten', 'auth_key', 'ten_vai_tro'], 'string', 'max' => 100],
            [['dien_thoai'], 'string', 'max' => 13],
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
            'hoten' => 'Hoten',
            'trang_thai' => 'Trang Thai',
            'dia_chi' => 'Địa Chi',
            'so_du' => 'So Du',
            'auth_key' => 'Auth Key',
            'dien_thoai' => 'Dien Thoai',
            'status' => 'Status',
            'email' => 'Email',
            'avatar' => 'Avatar',
            'gioi_thieu' => 'Gioi Thieu',
            'type' => 'Type',
            'doanh_nghiep_id' => 'Doanh Nghiep ID',
            'vai_tro_id' => 'Vai Tro ID',
            'ten_vai_tro' => 'Ten Vai Tro',
            'ten_doanh_nghiep' => 'Ten Doanh Nghiep',
            'id_quan_li' => 'Id Quan Li',
            'trang_thai_doanh_nghiep' => 'Trang Thai Doanh Nghiep',
        ];
    }
    public function getAnhChiTietNguoiDung()
    {
        return $this->hasMany(AnhChiTietNguoiDung::className(), ['user_id' => 'id']);
    }
    public function getNhaTuyenDungCongTac()
    {
        return $this->hasMany(NhaTuyenDungCongTac::className(), ['user_id' => 'id']);
    }
}
