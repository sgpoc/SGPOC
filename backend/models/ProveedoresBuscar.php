<?php


namespace app\models;
use Yii;
use yii\base\Model;

class ProveedoresBuscar extends Model
{
   public $Proveedor;
    public $Domicilio;
    public $Email;
    public $Estado;
    
    public static function tableName()
    {
        return 'proveedoresbuscar';
    }
    
    public function rules()
    {
        return [
            [['Proveedor', 'Domicilio','Email','Estado'], 'string', 'max' => 100],
            ['Proveedor', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Domicilio', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Email', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Estado', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            [['Proveedor', 'Domicilio', 'Email', 'Estado'], 'safe'],
            
        ];
    }
}