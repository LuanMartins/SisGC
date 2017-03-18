<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Venda;

/**
 * VendaSearch represents the model behind the search form about `app\models\Venda`.
 */
class VendaSearch extends Venda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcompra', 'comprador_idcomprador', 'user_id'], 'integer'],
            [['valor'], 'number'],
            [['data_venda'], 'safe'],
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
        $query = Venda::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idcompra' => $this->idcompra,
            'valor' => $this->valor,
            'comprador_idcomprador' => $this->comprador_idcomprador,
            'user_id' => $this->user_id,

        ]);

        $query->andFilterWhere(['like', 'data_venda', $this->data_venda]);

        return $dataProvider;
    }
}
