<?php

namespace api\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%danh_muc}}".
 *
 * @property int $id
 * @property string|null $key
 * @property int|null $expire
 */
class TempSecret extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%temp_secret}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'expire'], 'integer'],
            [['key'], 'string'],
        ];
    }
}