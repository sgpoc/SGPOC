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
 *
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
            [['Nombre', 'Apellido', 'Email'], 'string', 'max' => 100],
            [['Rol'], 'string', 'max' => 20],
            [['Password'], 'string', 'max' => 32],
            [['Estado'], 'string', 'max' => 1],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGT()
    {
        return $this->hasOne(Grupostrabajo::className(), ['IdGT' => 'IdGT']);
    }
//
//     public function getAuthKey(){
//        throw new \yii\base\NotSupportedException;
//    }
//
//    public function getId() {
//        return $this->IdUsuario;
//    }
//
//    public function validateAuthKey($authKey){
//        throw new \yii\base\NotSupportedException; 
//    }
//
//    public static function findIdentity($id): \yii\web\IdentityInterface {
//        return self::findOne($id);
//    }
//
//    public static function findIdentityByAccessToken($token, $type = null): \yii\web\IdentityInterface {
//        throw new \yii\base\NotSupportedException;
//    }
    
    public static function findByEmail($username){
        return self::findOne(['Email'=>$username]);
        
    }
    
    public function validatePassword($password){
        return $this->Password === $password;
        
    }

public function getAuthKey(): string {
throw new \yii\base\NotSupportedException;
}

public function getId() {
 return $this->IdUsuario;
}

public function validateAuthKey($authKey): bool {
throw new \yii\base\NotSupportedException;
}

public static function findIdentity($id): \yii\web\IdentityInterface {
 return self::findOne($id);
}

public static function findIdentityByAccessToken($token, $type = null): \yii\web\IdentityInterface {
   throw new \yii\base\NotSupportedException;
}

}
