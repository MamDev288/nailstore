<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%bao_hiem_nhan_su}}".
 *
 * @property int $id
 * @property int|null $thang
 * @property int|null $nam
 * @property float|null $tong_tien
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $user_created_id
 * @property int|null $user_updated_id
 * @property string|null $ghi_chu
 *
 * @property User $userCreated
 * @property User $userUpdated
 * @property ChiTietBaoHiemNhanSu[] $chiTietBaoHiemNhanSus
 */
class BaoHiemNhanSu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bao_hiem_nhan_su}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thang', 'nam', 'user_created_id', 'user_updated_id'], 'integer'],
            [['tong_tien'], 'number'],
            [['created', 'updated'], 'safe'],
            [['ghi_chu'], 'string'],
            [['user_created_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_created_id' => 'id']],
            [['user_updated_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_updated_id' => 'id']],
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
            'tong_tien' => 'Tong Tien',
            'created' => 'Created',
            'updated' => 'Updated',
            'user_created_id' => 'User Created ID',
            'user_updated_id' => 'User Updated ID',
            'ghi_chu' => 'Ghi Chu',
        ];
    }

    /**
     * Gets query for [[UserCreated]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreated()
    {
        return $this->hasOne(User::className(), ['id' => 'user_created_id']);
    }

    /**
     * Gets query for [[UserUpdated]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserUpdated()
    {
        return $this->hasOne(User::className(), ['id' => 'user_updated_id']);
    }

    /**
     * Gets query for [[ChiTietBaoHiemNhanSus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChiTietBaoHiemNhanSus()
    {
        return $this->hasMany(ChiTietBaoHiemNhanSu::className(), ['bao_hiem_nhan_su_id' => 'id']);
    }
}
