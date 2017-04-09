<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;

/**
 * ClienteSearch represents the model behind the search form about `app\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcomprador', 'numero_casa'], 'integer'],
            [['nome', 'apelido', 'cpf', 'telefone', 'rua', 'bairro', 'cep'], 'safe'],
            [['limite_credito'], 'number'],
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
        $query = Cliente::find();

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
            'idcomprador' => $this->idcomprador,
            'numero_casa' => $this->numero_casa,
            'limite_credito' => $this->limite_credito,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'apelido', $this->apelido])
            ->andFilterWhere(['like', 'cpf', $this->cpf])
            ->andFilterWhere(['like', 'telefone', $this->telefone])
            ->andFilterWhere(['like', 'rua', $this->rua])
            ->andFilterWhere(['like', 'bairro', $this->bairro])
            ->andFilterWhere(['like', 'cep', $this->cep]);

        return $dataProvider;
    }
}
