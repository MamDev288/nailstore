<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%duyet_don_nghi_phep}}".
 *
 * @property int $id
 * @property int|null $nhan_vien_phong_ban_id
 * @property string|null $nghi_tu_ngay
 * @property string|null $nghi_den_ngay
 * @property string|null $ly_do
 * @property int|null $nguoi_lam_don_id
 * @property int|null $truong_bo_phan_id
 * @property string|null $trang_thai
 * @property int|null $active
 * @property int|null $user_id
 * @property string|null $created
 * @property string|null $updated
 * @property string|null $noi_dung
 * @property string|null $ghi_chu
 * @property string|null $ngay_de_nghi
 * @property string|null $id_nguoi_duyet
 * @property string|null $anh_nguoi_duyet
 */
class DuyetDonNghiPhep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%duyet_don_nghi_phep}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nhan_vien_phong_ban_id', 'nguoi_lam_don_id', 'truong_bo_phan_id', 'active', 'user_id'], 'integer'],
            [['nghi_tu_ngay', 'nghi_den_ngay', 'created', 'updated', 'ngay_de_nghi'], 'safe'],
            [['ly_do', 'trang_thai', 'noi_dung', 'ghi_chu', 'id_nguoi_duyet', 'anh_nguoi_duyet'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nhan_vien_phong_ban_id' => 'Nhan Vien Phong Ban ID',
            'nghi_tu_ngay' => 'Nghi Tu Ngay',
            'nghi_den_ngay' => 'Nghi Den Ngay',
            'ly_do' => 'Ly Do',
            'nguoi_lam_don_id' => 'Nguoi Lam Don ID',
            'truong_bo_phan_id' => 'Truong Bo Phan ID',
            'trang_thai' => 'Trang Thai',
            'active' => 'Active',
            'user_id' => 'User ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'noi_dung' => 'Noi Dung',
            'ghi_chu' => 'Ghi Chu',
            'ngay_de_nghi' => 'Ngay De Nghi',
            'id_nguoi_duyet' => 'Id Nguoi Duyet',
            'anh_nguoi_duyet' => 'Anh Nguoi Duyet',
        ];
    }
}
