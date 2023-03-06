<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%chi_tiet_phu_cap}}".
 *
 * @property int $id
 * @property int|null $nhan_vien_id
 * @property string|null $type_phu_cap
 * @property float|null $so_tien
 * @property int|null $active
 *
 * @property User $nhanVien
 */
class ChiTietPhuCap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%chi_tiet_phu_cap}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nhan_vien_id', 'active'], 'integer'],
            [['type_phu_cap'], 'string'],
            [['so_tien'], 'number'],
            [['nhan_vien_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['nhan_vien_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nhan_vien_id' => 'Nhan Vien ID',
            'type_phu_cap' => 'Type Phu Cap',
            'so_tien' => 'So Tien',
            'active' => 'Active',
        ];
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
}
