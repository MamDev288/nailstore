<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%phong_ban}}".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $truong_phong_id
 * @property int|null $active
 * @property int|null $parent_id
 *
 * @property PhongBan $parent
 * @property PhongBan[] $phongBans
 * @property User $truongPhong
 * @property PhongBanNhanVien[] $phongBanNhanViens
 */
class PhongBan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%phong_ban}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['truong_phong_id', 'active', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongBan::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['truong_phong_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['truong_phong_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'truong_phong_id' => 'Truong Phong ID',
            'active' => 'Active',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(PhongBan::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[PhongBans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhongBans()
    {
        return $this->hasMany(PhongBan::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[TruongPhong]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTruongPhong()
    {
        return $this->hasOne(User::className(), ['id' => 'truong_phong_id']);
    }

    /**
     * Gets query for [[PhongBanNhanViens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhongBanNhanViens()
    {
        return $this->hasMany(PhongBanNhanVien::className(), ['phong_ban_id' => 'id']);
    }
}
