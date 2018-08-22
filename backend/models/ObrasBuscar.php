<?php

namespace app\models;

use yii\base\Model;
use Yii;

class ObrasBuscar extends Model
{
    public $Localidad;
    public $Obra;
    public $Direccion;
    public $Estado;
    
    public static function tableName()
    {
        return 'obrasbuscar';
    }

    public function rules()
    {
        return [
            [['Localidad', 'Obra', 'Direccion', 'Estado'], 'safe'],
            [['Localidad', 'Obra', 'Direccion'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            ['Localidad', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Obra', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Direccion', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Estado', 'default', 'value' => 0, 'skipOnEmpty' => FALSE]
        ];
    }
}