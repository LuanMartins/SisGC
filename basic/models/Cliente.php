<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $idcomprador
 * @property string $nome
 * @property string $apelido
 * @property string $cpf
 * @property string $telefone
 * @property string $rua
 * @property string $bairro
 * @property integer $numero_casa
 * @property double $limite_credito
 * @property string $cep
 *
 * @property Venda[] $vendas
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'cpf', 'telefone'], 'required'],
            [['numero_casa'], 'integer'],
            [['limite_credito'], 'number'],
            [['nome', 'bairro'], 'string', 'max' => 100],
            [['apelido'], 'string', 'max' => 45],
            [['cpf'], 'string', 'max' => 14],
            [['telefone'], 'string', 'max' => 15],
            [['rua'], 'string', 'max' => 150],
            [['cep'], 'string', 'max' => 9],
            [['cpf'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcomprador' => Yii::t('app', 'Idcomprador'),
            'nome' => Yii::t('app', 'Nome'),
            'apelido' => Yii::t('app', 'Apelido'),
            'cpf' => Yii::t('app', 'Cpf'),
            'telefone' => Yii::t('app', 'Telefone'),
            'rua' => Yii::t('app', 'Rua'),
            'bairro' => Yii::t('app', 'Bairro'),
            'numero_casa' => Yii::t('app', 'Numero Casa'),
            'limite_credito' => Yii::t('app', 'Limite Credito'),
            'cep' => Yii::t('app', 'Cep'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendas()
    {
        return $this->hasMany(Venda::className(), ['comprador_idcomprador' => 'idcomprador']);
    }
}
