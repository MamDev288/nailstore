<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * Seacrh represents the model behind the search form about `backend\models\Product`.
 */
class Seacrh extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'source_id', 'view', 'created_by', 'update_by'], 'integer'],
            [['name', 'describe', 'image', 'active', 'sku', 'created_at', 'update_at'], 'safe'],
            [['price_in', 'price_out', 'price_display', 'discount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'price_in' => $this->price_in,
            'category_id' => $this->category_id,
            'source_id' => $this->source_id,
            'price_out' => $this->price_out,
            'price_display' => $this->price_display,
            'discount' => $this->discount,
            'view' => $this->view,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'created_by' => $this->created_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'describe', $this->describe])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'active', $this->active])
            ->andFilterWhere(['like', 'sku', $this->sku]);

        return $dataProvider;
    }
}
