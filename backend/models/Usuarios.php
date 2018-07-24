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
            'IdRol' => 'Id Rol',
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
    
}
