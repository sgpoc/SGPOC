<?php

namespace app\models;

use yii\base\Model;

class ListaPreciosBuscar extends Model 
{
    public $Proveedor;
    public $Localidad;
    
    public function rules()
    {
         return [
            [['Proveedor', 'Localidad'], 'string', 'max' => 100],
            ['Proveedor', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Localidad', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            [['Proveedor', 'Localidad'], 'safe'],
        ];
    }
}