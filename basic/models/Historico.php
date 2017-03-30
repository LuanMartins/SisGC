<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historico".
 *
 * @property integer $idhistorico
 * @property string $data
 * @property string $nome_vendedor
 * @property string $nome_cliente
 * @property double $valor
 */
class Historico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'historico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data', 'nome_vendedor', 'nome_cliente', 'valor'], 'required'],
            [['valor'], 'number'],
            [['data'], 'string', 'max' => 45],
            [['nome_vendedor', 'nome_cliente'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idhistorico' => Yii::t('app', 'Idhistorico'),
            'data' => Yii::t('app', 'Data'),
            'nome_vendedor' => Yii::t('app', 'Nome Vendedor'),
            'nome_cliente' => Yii::t('app', 'Nome Cliente'),
            'valor' => Yii::t('app', 'Valor'),
        ];
    }
}
