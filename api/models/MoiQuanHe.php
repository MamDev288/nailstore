<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%moi_quan_he}}".
 *
 * @property int $id
 * @property int|null $moi_quan_he_id
 * @property string|null $dien_thoai
 * @property string|null $ho_ten
 * @property int|null $nhan_su_id
 * @property int|null $active
 * @property int|null $lien_lac_khan
 *
 * @property DanhMuc $moiQuanHe
 * @property User $nhanSu
 */
class MoiQuanHe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%moi_quan_he}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['moi_quan_he_id', 'nhan_su_id', 'active', 'lien_lac_khan'], 'integer'],
            [['dien_thoai'], 'string', 'max' => 20],
            [['ho_ten'], 'string', 'max' => 100],
            [['moi_quan_he_id'], 'exist', 'skipOnError' => true, 'targetClass' => DanhMuc::className(), 'targetAttribute' => ['moi_quan_he_id' => 'id']],
            [['nhan_su_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['nhan_su_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'moi_quan_he_id' => 'Moi Quan He ID',
            'dien_thoai' => 'Dien Thoai',
            'ho_ten' => 'Ho Ten',
            'nhan_su_id' => 'Nhan Su ID',
            'active' => 'Active',
            'lien_lac_khan' => 'Lien Lac Khan',
        ];
    }

    /**
     * Gets query for [[MoiQuanHe]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoiQuanHe()
    {
        return $this->hasOne(DanhMuc::className(), ['id' => 'moi_quan_he_id']);
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
}
