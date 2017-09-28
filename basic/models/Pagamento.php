<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagamento".
 *
 * @property integer $idpagamento
 * @property string $data_pagamento
 * @property double $valor_pago
 * @property double $compra_fiado
 */
class Pagamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_pagamento', 'valor_pago', 'compra_fiado'], 'required'],
            [['valor_pago', 'compra_fiado'], 'double'],
            [['data_pagamento'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpagamento' => Yii::t('app', 'Idpagamento'),
            'data_pagamento' => Yii::t('app', 'Data Pagamento'),
            'valor_pago' => Yii::t('app', 'Valor Pago'),
            'compra_fiado' => Yii::t('app', 'Compra Fiado'),
        ];
    }
}
