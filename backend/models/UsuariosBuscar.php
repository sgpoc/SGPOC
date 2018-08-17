<?php

namespace app\models;
use Yii;
use yii\base\Model;

class UsuariosBuscar extends Model
{
    public $Nombre;
    public $Apellido;
    public $Email;
    public $Rol;
    public $Estado;
    
    public static function tableName()
    {
        return 'usuariosbuscar';
    }
    
    public function rules()
    {
        return [
            [['Nombre', 'Apellido', 'Email','Rol'], 'string', 'max' => 100],
            ['Nombre', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Apellido', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Email', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Rol', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Estado', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            [['Nombre', 'Apellido', 'Email', 'Rol', 'Estado'], 'safe'],
        ];
    }
    
}