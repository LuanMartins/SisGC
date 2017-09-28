<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Historico;

/**
 * HistoricoSearch represents the model behind the search form about `app\models\Historico`.
 */
class HistoricoSearch extends Historico
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idhistorico'], 'integer'],
            [['data', 'nome_vendedor', 'nome_cliente'], 'safe'],
            [['valor'], 'number'],
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
        $query = Historico::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idhistorico' => $this->idhistorico,
            'valor' => $this->valor,

        ]);

        $query->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'nome_vendedor', $this->nome_vendedor])
            ->andFilterWhere(['like', 'nome_cliente', $this->nome_cliente]);

        return $dataProvider;
    }
}
