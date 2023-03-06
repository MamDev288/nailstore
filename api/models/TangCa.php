<?php

namespace api\models;

use common\models\myAPI;
use Yii;

/**
 * This is the model class for table "{{%tang_ca}}".
 *
 * @property int $id
 * @property int|null $user_id Người yêu cầu
 * @property string|null $time_start thời gian bắt đầu
 * @property string|null $time_end Thời gian kết thúc
 * @property string|null $date Ngày yêu cầu
 * @property int|null $ly_do
 * @property int|null $ghi_chu
 * @property int|null $trang_thai 0: xoá, 1:Chờ duyệt, 2:Từ chối, 3:Đã duyệt
 * @property int|null $cham_cong_id
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $user_created
 * @property int|null $user_updated
 *
 * @property ChamCong $chamCong
 * @property User $userCreated
 * @property User $user
 * @property User $userUpdated
 */
class TangCa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tang_ca}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'ly_do', 'ghi_chu', 'trang_thai', 'cham_cong_id', 'user_created', 'user_updated'], 'integer'],
            [['time_start', 'time_end', 'date', 'created', 'updated'], 'safe'],
            [['cham_cong_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChamCong::className(), 'targetAttribute' => ['cham_cong_id' => 'id']],
            [['user_created'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_created' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_updated'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_updated' => 'id']],
            [['user_created'], 'default', 'value' => $_POST['uid']],
            [['date'], 'default', 'value' => function ($model) {
                return myAPI::covertTDMY2YMD($model->time_start);
            }],
            [['time_start','time_end'], 'filter', 'filter'  => [$this, 'convertDMYT2YMDT']],
        ];
    }
    public function convertDMYT2YMDT($value) {
        $date = \DateTime::createFromFormat('d/m/Y H:i:s', $value);
        $value = $date->format('Y-m-d H:i:s');
        return $value;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'time_start' => 'Time Start',
            'time_end' => 'Time End',
            'date' => 'Date',
            'ly_do' => 'Ly Do',
            'ghi_chu' => 'Ghi Chu',
            'trang_thai' => 'Trang Thai',
            'cham_cong_id' => 'Cham Cong ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'user_created' => 'User Created',
            'user_updated' => 'User Updated',
        ];
    }

    /**
     * Gets query for [[ChamCong]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChamCong()
    {
        return $this->hasOne(ChamCong::className(), ['id' => 'cham_cong_id']);
    }

    /**
     * Gets query for [[UserCreated]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreated()
    {
        return $this->hasOne(User::className(), ['id' => 'user_created']);
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
     * Gets query for [[UserUpdated]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserUpdated()
    {
        return $this->hasOne(User::className(), ['id' => 'user_updated']);
    }
}
