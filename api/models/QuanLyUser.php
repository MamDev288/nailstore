<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%quan_ly_user}}".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $hoten
 * @property string|null $ngay_sinh
 * @property string|null $dia_chi
 * @property string|null $dien_thoai
 * @property string|null $cmnd
 * @property string|null $email
 * @property string|null $auth_key
 * @property string|null $anh_nguoi_dung
 * @property string|null $ghi_chu
 * @property int|null $user_id
 * @property string|null $vai_tro
 */
class QuanLyUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%quan_ly_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['ngay_sinh'], 'safe'],
            [['ghi_chu', 'vai_tro'], 'string'],
            [['username', 'hoten', 'email'], 'string', 'max' => 100],
            [['dia_chi'], 'string', 'max' => 200],
            [['dien_thoai', 'cmnd'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['anh_nguoi_dung'], 'string', 'max' => 300],
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
            'ngay_sinh' => 'Ngay Sinh',
            'dia_chi' => 'Địa chỉ',
            'dien_thoai' => 'Dien Thoai',
            'cmnd' => 'Cmnd',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'anh_nguoi_dung' => 'Anh Nguoi Dung',
            'ghi_chu' => 'Ghi Chu',
            'user_id' => 'User ID',
            'vai_tro' => 'Vai Tro',
        ];
    }
}
