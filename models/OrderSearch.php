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
            [['id', 'mp_id', 'rop_order_id', 'force_rop_resend', 'count_rop_pull', 'customer_id'], 'integer'],
            [['mp_reference_number', 'last_mp_updated', 'last_rop_pull', 'channel_date_created', 'first_name', 'last_name', 'company', 'email', 'address1', 'address2', 'city', 'state_match', 'country_match', 'postal_code', 'gift_message', 'phone', 'ship_first_name', 'ship_last_name', 'ship_company', 'ship_address1', 'ship_address2', 'ship_city', 'ship_state_match', 'ship_country_match', 'ship_postal_code', 'ship_phone', 'pay_type', 'pay_transaction_id', 'comments', 'shipcode', 'ip_address', 'status', 'note'], 'safe'],
            [['shipping_amt', 'tax_amt', 'product_total', 'discount_amt', 'grand_total'], 'number'],
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
            'force_rop_resend' => $this->force_rop_resend,
            'count_rop_pull' => $this->count_rop_pull,
            'channel_date_created' => $this->channel_date_created,
            'shipping_amt' => $this->shipping_amt,
            'tax_amt' => $this->tax_amt,
            'product_total' => $this->product_total,
            'customer_id' => $this->customer_id,
            'discount_amt' => $this->discount_amt,
            'grand_total' => $this->grand_total,
        ]);

        $query->andFilterWhere(['like', 'mp_reference_number', $this->mp_reference_number])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state_match', $this->state_match])
            ->andFilterWhere(['like', 'country_match', $this->country_match])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code])
            ->andFilterWhere(['like', 'gift_message', $this->gift_message])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'ship_first_name', $this->ship_first_name])
            ->andFilterWhere(['like', 'ship_last_name', $this->ship_last_name])
            ->andFilterWhere(['like', 'ship_company', $this->ship_company])
            ->andFilterWhere(['like', 'ship_address1', $this->ship_address1])
            ->andFilterWhere(['like', 'ship_address2', $this->ship_address2])
            ->andFilterWhere(['like', 'ship_city', $this->ship_city])
            ->andFilterWhere(['like', 'ship_state_match', $this->ship_state_match])
            ->andFilterWhere(['like', 'ship_country_match', $this->ship_country_match])
            ->andFilterWhere(['like', 'ship_postal_code', $this->ship_postal_code])
            ->andFilterWhere(['like', 'ship_phone', $this->ship_phone])
            ->andFilterWhere(['like', 'pay_type', $this->pay_type])
            ->andFilterWhere(['like', 'pay_transaction_id', $this->pay_transaction_id])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'shipcode', $this->shipcode])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
