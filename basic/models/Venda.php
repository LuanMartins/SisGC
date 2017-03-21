<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "venda".
 *
 * @property integer $idcompra
 * @property double $valor
 * @property string $data_venda
 * @property integer $comprador_idcomprador
 * @property integer $user_id
 *
 * @property Cliente $compradorIdcomprador
 * @property User $user
 */
class Venda extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor', 'data_venda', 'comprador_idcomprador', 'user_id'], 'required'],
            [['valor'], 'double'],
            [['comprador_idcomprador', 'user_id'], 'integer'],
            [['data_venda'], 'string', 'max' => 45],
            [['comprador_idcomprador'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['comprador_idcomprador' => 'idcomprador']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcompra' => Yii::t('app', 'Idcompra'),
            'valor' => Yii::t('app', 'Valor'),
            'data_venda' => Yii::t('app', 'Data Venda'),
            'comprador_idcomprador' => Yii::t('app', 'Comprador'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompradorIdcomprador()
    {
        return $this->hasOne(Cliente::className(), ['idcomprador' => 'comprador_idcomprador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
