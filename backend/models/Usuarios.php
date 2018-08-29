<?php

namespace app\models;

use yii\base\Model;
use Yii;

class Usuarios extends Model
{
    public $IdUsuario;
    public $IdGT;
    public $IdRol;
    public $Nombre;
    public $Apellido;
    public $Email;
    public $Password;
    public $Estado;
    public $auth_key;
    
    public static function tableName()
    {
        return 'usuarios';
    }

    public function rules()
    {
        return [
            [['IdUsuario','IdGT', 'IdRol', 'Nombre', 'Apellido', 'Email', 'Password', 'Estado'], 'required'],
            [['IdGT'], 'integer'],
            [['IdUsuario'], 'integer'],
            [['IdRol'], 'integer'],
            [['Nombre', 'Apellido', 'Email'], 'string', 'max' => 100],
            [['Password'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['auth_key'], 'string', 'max' => 255],
            [['IdGT'], 'exist', 'skipOnError' => true, 'targetClass' => Grupostrabajo::className(), 'targetAttribute' => ['IdGT' => 'IdGT']],
            [['auth_key'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdUsuario' => 'Usuario',
            'IdGT' => 'Grupo Trabajo',
            'IdRol' => 'Rol',
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
    
    public function beforeSave()
    {
        return $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
