<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "vh_bang_luong".
 *
 * @property int $id
 * @property int|null $thang
 * @property int|null $nam
 * @property string|null $trang_thai
 * @property int|null $user_id
 * @property string|null $created
 * @property string|null $ngay_cham_luong
 *
 * @property User $user
 * @property TrangThaiBangLuong[] $trangThaiBangLuongs
 */
class BangLuong extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vh_bang_luong';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thang', 'nam', 'user_id'], 'integer'],
            [['trang_thai'], 'string'],
            [['created', 'ngay_cham_luong'], 'safe'],
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
            'thang' => 'Thang',
            'nam' => 'Nam',
            'trang_thai' => 'Trang Thai',
            'user_id' => 'User ID',
            'created' => 'Created',
            'ngay_cham_luong' => 'Ngay Cham Luong',
        ];
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
     * Gets query for [[TrangThaiBangLuongs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrangThaiBangLuongs()
    {
        return $this->hasMany(TrangThaiBangLuong::className(), ['bang_luong_id' => 'id']);
    }
}
