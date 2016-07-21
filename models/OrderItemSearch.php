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
            [['sku', 'sku_description', 'options', 'item_type', 'status', 'last_mp_updated', 'mp_item_id', 'extra_info'], 'safe'],
            [['unit_price', 'discount_amt', 'discount_pct', 'recycling_amt', 'ship_amt', 'shiptax_amt', 'unit_tax', 'unit_tax_pct', 'vat_pct'], 'number'],
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
            'unit_price' => $this->unit_price,
            'discount_amt' => $this->discount_amt,
            'discount_pct' => $this->discount_pct,
            'recycling_amt' => $this->recycling_amt,
            'ship_amt' => $this->ship_amt,
            'shiptax_amt' => $this->shiptax_amt,
            'unit_tax' => $this->unit_tax,
            'unit_tax_pct' => $this->unit_tax_pct,
            'vat_pct' => $this->vat_pct,
            'quantity' => $this->quantity,
            'last_mp_updated' => $this->last_mp_updated,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'sku_description', $this->sku_description])
            ->andFilterWhere(['like', 'options', $this->options])
            ->andFilterWhere(['like', 'item_type', $this->item_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'mp_item_id', $this->mp_item_id])
            ->andFilterWhere(['like', 'extra_info', $this->extra_info]);

        return $dataProvider;
    }
}
