<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%lich_su_cong_tac}}".
 *
 * @property int $id
 * @property string|null $ten_cong_ty
 * @property string|null $tu_ngay
 * @property string|null $den_ngay
 * @property string|null $cong_viec
 * @property string|null $mo_ta_cong_viec
 * @property int|null $active
 * @property int|null $user_id
 * @property string|null $created
 */
class LichSuCongTac extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lich_su_cong_tac}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tu_ngay', 'den_ngay', 'created'], 'safe'],
            [['mo_ta_cong_viec'], 'string'],
            [['active', 'user_id'], 'integer'],
            [['ten_cong_ty'], 'string', 'max' => 150],
            [['cong_viec'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten_cong_ty' => 'Ten Cong Ty',
            'tu_ngay' => 'Tu Ngay',
            'den_ngay' => 'Den Ngay',
            'cong_viec' => 'Cong Viec',
            'mo_ta_cong_viec' => 'Mo Ta Cong Viec',
            'active' => 'Active',
            'user_id' => 'User ID',
            'created' => 'Created',
        ];
    }
}
