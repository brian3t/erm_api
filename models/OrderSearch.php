<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * app\models\OrderSearch represents the model behind the search form about `app\models\Order`.
 */
 class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mp_id', 'rop_order_id', 'count_rop_pull'], 'integer'],
            [['mp_reference_number', 'last_mp_updated', 'last_rop_pull', 'order_date_time', 'name', 'company', 'email', 'address', 'address2', 'city', 'state', 'zip', 'country', 'phone', 'ship_name', 'ship_company', 'ship_address', 'ship_address2', 'ship_city', 'ship_state', 'ship_zip', 'ship_country', 'ship_phone', 'pay_type', 'pay_transaction_id', 'comments', 'shipping', 'status'], 'safe'],
            [['product_total', 'tax_total', 'shipping_total', 'grand_total', 'discount'], 'number'],
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
        $query = Order::find();

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
            'mp_id' => $this->mp_id,
            'rop_order_id' => $this->rop_order_id,
            'last_mp_updated' => $this->last_mp_updated,
            'last_rop_pull' => $this->last_rop_pull,
            'count_rop_pull' => $this->count_rop_pull,
            'order_date_time' => $this->order_date_time,
            'product_total' => $this->product_total,
            'tax_total' => $this->tax_total,
            'shipping_total' => $this->shipping_total,
            'grand_total' => $this->grand_total,
            'discount' => $this->discount,
        ]);

        $query->andFilterWhere(['like', 'mp_reference_number', $this->mp_reference_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'ship_name', $this->ship_name])
            ->andFilterWhere(['like', 'ship_company', $this->ship_company])
            ->andFilterWhere(['like', 'ship_address', $this->ship_address])
            ->andFilterWhere(['like', 'ship_address2', $this->ship_address2])
            ->andFilterWhere(['like', 'ship_city', $this->ship_city])
            ->andFilterWhere(['like', 'ship_state', $this->ship_state])
            ->andFilterWhere(['like', 'ship_zip', $this->ship_zip])
            ->andFilterWhere(['like', 'ship_country', $this->ship_country])
            ->andFilterWhere(['like', 'ship_phone', $this->ship_phone])
            ->andFilterWhere(['like', 'pay_type', $this->pay_type])
            ->andFilterWhere(['like', 'pay_transaction_id', $this->pay_transaction_id])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'shipping', $this->shipping])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
