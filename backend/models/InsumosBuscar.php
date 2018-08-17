<?php

namespace app\models;
use Yii;
use yii\base\Model;

class InsumosBuscar extends Model
{
    public $Insumo;
    public $TipoInsumo;
    public $Familia;
    public $SubFamilia;
    public $Abreviatura;
    
    public static function tableName()
    {
        return 'insumosbuscar';
    }
    
    public function rules()
    {
        return [
            [['Insumos', 'TipoInsumo'], 'string', 'max' => 100],
            ['Insumo', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['TipoInsumo', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Familia', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['SubFamilia', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Abreviatura', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            [['Insumo', 'TipoInsumo', 'Familia', 'SubFamilia', 'Abreviatura'], 'safe'],
        ];
    }
    
}