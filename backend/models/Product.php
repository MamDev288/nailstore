<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $describe
 * @property float|null $price_in
 * @property string|null $image
 * @property int|null $category_id
 * @property int|null $active
 * @property string|null $sku
 * @property int|null $source_id
 * @property float|null $price_out
 * @property float|null $price_display
 * @property float|null $discount
 * @property int|null $view
 * @property string|null $created_at
 * @property string|null $update_at
 * @property int|null $created_by
 * @property int|null $update_by
 *
 * @property DanhMuc $category
 * @property DanhMuc $source
 * @property ProductImageDetail[] $productImageDetails
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['describe'], 'string'],
            [['price_in', 'price_out', 'price_display', 'discount'], 'number'],
            [['category_id', 'active', 'source_id', 'view', 'created_by', 'update_by'], 'integer'],
            [['created_at', 'update_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['image', 'sku'], 'string', 'max' => 50],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => DanhMuc::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['source_id'], 'exist', 'skipOnError' => true, 'targetClass' => DanhMuc::className(), 'targetAttribute' => ['source_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Mã sản phẩm'),
            'name' => Yii::t('app', 'Tên sản phẩm'),
            'describe' => Yii::t('app', 'Mô tả'),
            'price_in' => Yii::t('app', 'Giá nhập'),
            'image' => Yii::t('app', 'Ảnh nổi bật'),
            'category_id' => Yii::t('app', 'loại sản phẩm'),
            'active' => Yii::t('app', 'trạng thái'),
            'sku' => Yii::t('app', ' mã SKU'),
            'source_id' => Yii::t('app', 'nguồn gốc'),
            'price_out' => Yii::t('app', 'giá bán'),
            'price_display' => Yii::t('app', 'giá hiển thị'),
            'discount' => Yii::t('app', 'giảm giá'),
            'view' => Yii::t('app', 'số lượt xem'),
            'created_at' => Yii::t('app', 'Created At'),
            'update_at' => Yii::t('app', 'Update At'),
            'created_by' => Yii::t('app', 'Created By'),
            'update_by' => Yii::t('app', 'Update By'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(DanhMuc::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Source]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(DanhMuc::className(), ['id' => 'source_id']);
    }

    /**
     * Gets query for [[ProductImageDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductImageDetails()
    {
        return $this->hasMany(ProductImageDetail::className(), ['product_id' => 'id']);
    }
}
