<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "vh_hop_dong_nhan_su".
 *
 * @property int $id
 * @property int|null $loai_hop_dong_id
 * @property int|null $nhan_su_id
 * @property int|null $user_id
 * @property string|null $created
 * @property string|null $ngay_thuc_hien
 * @property string|null $ngay_het_han
 * @property int|null $active
 * @property string|null $ngay_hieu_luc
 *
 * @property LoaiHopDong $loaiHopDong
 * @property User $nhanSu
 * @property User $user
 * @property ThayDoiLuong[] $thayDoiLuongs
 */
class HopDongNhanSu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vh_hop_dong_nhan_su';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loai_hop_dong_id', 'nhan_su_id', 'user_id', 'active'], 'integer'],
            [['created', 'ngay_thuc_hien', 'ngay_het_han', 'ngay_hieu_luc'], 'safe'],
            [['loai_hop_dong_id'], 'exist', 'skipOnError' => true, 'targetClass' => LoaiHopDong::className(), 'targetAttribute' => ['loai_hop_dong_id' => 'id']],
            [['nhan_su_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['nhan_su_id' => 'id']],
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
            'loai_hop_dong_id' => 'Loai Hop Dong ID',
            'nhan_su_id' => 'Nhan Su ID',
            'user_id' => 'User ID',
            'created' => 'Created',
            'ngay_thuc_hien' => 'Ngay Thuc Hien',
            'ngay_het_han' => 'Ngay Het Han',
            'active' => 'Active',
            'ngay_hieu_luc' => 'Ngay Hieu Luc',
        ];
    }

    /**
     * Gets query for [[LoaiHopDong]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiHopDong()
    {
        return $this->hasOne(LoaiHopDong::className(), ['id' => 'loai_hop_dong_id']);
    }

    /**
     * Gets query for [[NhanSu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNhanSu()
    {
        return $this->hasOne(User::className(), ['id' => 'nhan_su_id']);
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
        return $this->hasMany(ThayDoiLuong::className(), ['hop_dong_nhan_su_id' => 'id']);
    }
}
