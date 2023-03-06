<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "{{%cauhinh}}".
 *
 * @property int $id
 * @property string $content
 * @property string $ghi_chu
 * @property string|null $name
 * @property int|null $ckeditor
 */
class Cauhinh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cauhinh}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'ghi_chu'], 'required'],
            [['content', 'ghi_chu'], 'string'],
            [['ckeditor'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'ghi_chu' => 'Ghi Chu',
            'name' => 'Name',
            'ckeditor' => 'Ckeditor',
        ];
    }
}
