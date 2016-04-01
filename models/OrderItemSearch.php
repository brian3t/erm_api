<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderItem;

/**
 * app\models\OrderItemSearch represents the model behind the search form about `app\models\OrderItem`.
 */
 class OrderItemSearch extends OrderItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'quantity'], 'integer'],
            [['sku', 'product', 'status', 'mp_item_id'], 'safe'],
            [['price_per_unit'], 'number'],
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
        $query = OrderItem::find();

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
            'order_id' => $this->order_id,
            'price_per_unit' => $this->price_per_unit,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'mp_item_id', $this->mp_item_id]);

        return $dataProvider;
    }
}
