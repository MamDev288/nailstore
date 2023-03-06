<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%danh_muc}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property int|null $active
 * @property string|null $code
 * @property int|null $parent_id
 *
 * @property Product[] $products
 * @property Product[] $products0
 */
class DanhMuc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%danh_muc}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type'], 'string'],
            [['active', 'parent_id'], 'integer'],
            [['name', 'code'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'active' => Yii::t('app', 'Active'),
            'code' => Yii::t('app', 'Code'),
            'parent_id' => Yii::t('app', 'Parent ID'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Products0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts0()
    {
        return $this->hasMany(Product::className(), ['source_id' => 'id']);
    }
}
