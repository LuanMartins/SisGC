<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $authkey
 * @property string $accesstoken
 *
 * @property Venda[] $vendas
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $vendedor;
    public $senha;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'authkey'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 50],
            [['accesstoken'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Vendedor'),
            'password' => Yii::t('app', 'Senha'),
            'authkey' => Yii::t('app', 'Authkey'),
            'accesstoken' => Yii::t('app', 'Accesstoken'),
        ];
    }


    public function beforeSave($insert)
    {
        $this->password = sha1($this->password);


        return parent::beforeSave($insert);
    }


    public static function findByUsername($username)

	    {

	        return static::findOne(['username' => $username]);

	    }

    public function getAuthKey()

	    {

	        return $this->auth_key;

	    }

    public function validatePassword($password)

	    {

	        return $this->password === sha1($password);

	    }

    public static function findIdentityByAccessToken($token, $type = null)

	    {

	          return static::findOne(['access_token' => $token]);

	    }

    public static function findIdentity($id)

    {

        return static::findOne($id);

    }

    public function validateAuthKey($authKey)
    {

        return $this->getAuthKey() === $authKey;

    }

    public function getId()

	    {

	        return $this->getPrimaryKey();

	    }






    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendas()
    {
        return $this->hasMany(Venda::className(), ['user_id' => 'id']);
    }
}
