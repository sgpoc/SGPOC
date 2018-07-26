<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $IdUsuario
 * @property int $IdGT
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Rol
 * @property string $Email
 * @property string $Password
 * @property string $Estado
 * @property string $auth_key
 * @property Grupostrabajo $gT
 */
class Usuarios extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdGT', 'Nombre', 'Apellido', 'Rol', 'Email', 'Password', 'Estado'], 'required'],
            [['IdGT'], 'integer'],
            [['IdRol'], 'integer'],
            [['Nombre', 'Apellido', 'Email'], 'string', 'max' => 100],
            [['Password'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['auth_key'], 'string', 'max' => 255],
            [['IdGT'], 'exist', 'skipOnError' => true, 'targetClass' => Grupostrabajo::className(), 'targetAttribute' => ['IdGT' => 'IdGT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdUsuario' => 'Id Usuario',
            'IdGT' => 'Id Gt',
            'Nombre' => 'Nombre',
            'Apellido' => 'Apellido',
            'Rol' => 'Rol',
            'Email' => 'Email',
            'Password' => 'Password',
            'Estado' => 'Estado',
            'auth_key' => 'auth_key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGT()
    {
        return $this->hasOne(Grupostrabajo::className(), ['IdGT' => 'IdGT']);
    }
    
    public static function findByEmail($username){
        return self::findOne(['Email'=>$username]);
        
    }
    
    public function validatePassword($password){
        return Yii::$app->getSecurity()->validatePassword($password,$this->Password);  
    }

    public function getAuthKey(): string {
        return $this->auth_key;
    }   

    public function getId() {
        return $this->IdUsuario;
    }

    public function validateAuthKey($authKey): bool {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id): \yii\web\IdentityInterface {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): \yii\web\IdentityInterface {
        throw new \yii\base\NotSupportedException;
    }

}
