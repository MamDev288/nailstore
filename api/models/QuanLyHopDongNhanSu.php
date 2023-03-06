<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%quan_ly_hop_dong_nhan_su}}".
 *
 * @property int $id
 * @property string|null $hoten
 * @property string|null $ten_hop_dong
 * @property string|null $loai_hop_dong
 * @property string|null $don_vi_ky_hop_dong
 * @property int|null $nhan_su_id
 * @property int|null $user_id
 * @property string|null $created
 * @property string|null $ngay_thuc_hien
 * @property string|null $ngay_het_han
 * @property int|null $active
 * @property string|null $ngay_hieu_luc
 */
class QuanLyHopDongNhanSu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%quan_ly_hop_dong_nhan_su}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nhan_su_id', 'user_id', 'active'], 'integer'],
            [['created', 'ngay_thuc_hien', 'ngay_het_han', 'ngay_hieu_luc'], 'safe'],
            [['hoten', 'ten_hop_dong', 'loai_hop_dong'], 'string', 'max' => 100],
            [['don_vi_ky_hop_dong'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hoten' => 'Hoten',
            'ten_hop_dong' => 'Ten Hop Dong',
            'loai_hop_dong' => 'Loai Hop Dong',
            'don_vi_ky_hop_dong' => 'Don Vi Ky Hop Dong',
            'nhan_su_id' => 'Nhan Su ID',
            'user_id' => 'User ID',
            'created' => 'Created',
            'ngay_thuc_hien' => 'Ngay Thuc Hien',
            'ngay_het_han' => 'Ngay Het Han',
            'active' => 'Active',
            'ngay_hieu_luc' => 'Ngay Hieu Luc',
        ];
    }
}
