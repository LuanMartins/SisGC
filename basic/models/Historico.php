<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historico".
 *
 * @property integer $idhistorico
 * @property string $data
 * @property integer $user_id
 * @property integer $cliente_idcomprador
 *
 * @property Cliente $clienteIdcomprador
 * @property User $user
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
            [['data', 'user_id', 'cliente_idcomprador'], 'required'],
            [['user_id', 'cliente_idcomprador'], 'integer'],
            [['data'], 'string', 'max' => 45],
            [['cliente_idcomprador'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_idcomprador' => 'idcomprador']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => Yii::t('app', 'User ID'),
            'cliente_idcomprador' => Yii::t('app', 'Cliente Idcomprador'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClienteIdcomprador()
    {
        return $this->hasOne(Cliente::className(), ['idcomprador' => 'cliente_idcomprador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
