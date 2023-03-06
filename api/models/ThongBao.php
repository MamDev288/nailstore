<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%thong_bao}}".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @property string|null $noi_dung
 * @property string|null $cretead
 * @property string|null $updated
 * @property string|null $time_seen
 * @property int|null $is_seen
 * @property int|null $active
 * @property int|null $user_created
 *
 * @property User $user
 * @property User $userCreated
 */
class ThongBao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%thong_bao}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'is_seen', 'active', 'user_created'], 'integer'],
            [['title'], 'required'],
            [['noi_dung'], 'string'],
            [['cretead', 'updated', 'time_seen'], 'safe'],
            [['title'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_created'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_created' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'noi_dung' => 'Noi Dung',
            'cretead' => 'Cretead',
            'updated' => 'Updated',
            'time_seen' => 'Time Seen',
            'is_seen' => 'Is Seen',
            'active' => 'Active',
            'user_created' => 'User Created',
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
     * Gets query for [[UserCreated]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreated()
    {
        return $this->hasOne(User::className(), ['id' => 'user_created']);
    }
}
