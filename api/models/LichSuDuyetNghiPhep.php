<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%lich_su_duyet_nghi_phep}}".
 *
 * @property int|null $id
 * @property int|null $nghi_phep_id
 * @property string|null $created
 * @property string|null $updated
 * @property int|null $user_duyet_id
 * @property int|null $active
 * @property string|null $trang_thai
 *
 * @property NghiPhep $nghiPhep
 * @property User $userDuyet
 */
class LichSuDuyetNghiPhep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%nghi_phep_duyet_don}}';
    }
    const TRANG_THAI = ['','Nháp','Chờ duyệt','Duyệt','Từ chối','Huỷ'];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nghi_phep_id', 'cau_hinh_nghi_phep_id', 'user_duyet_id', 'active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['trang_thai'], 'string'],
            [['nghi_phep_id'], 'exist', 'skipOnError' => true, 'targetClass' => NghiPhep::className(), 'targetAttribute' => ['nghi_phep_id' => 'id']],
            [['user_duyet_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_duyet_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nghi_phep_id' => 'Nghi Phep ID',
            'cau_hinh_nghi_phep_id' => 'Cau Hinh Nghi Phep ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'user_duyet_id' => 'User Duyet ID',
            'active' => 'Active',
            'trang_thai' => 'Trang Thai',
        ];
    }

    /**
     * Gets query for [[NghiPhep]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNghiPhep()
    {
        return $this->hasOne(NghiPhep::className(), ['id' => 'nghi_phep_id']);
    }

    /**
     * Gets query for [[UserDuyet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserDuyet()
    {
        return $this->hasOne(User::className(), ['id' => 'user_duyet_id']);
    }
}
