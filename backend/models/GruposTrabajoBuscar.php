<?php

namespace app\models;
use yii\base\Model;

class GruposTrabajoBuscar extends Model
{
    public $pCadena;
    public $pIncluyeBajas;
    
    public static function tableName()
    {
        return 'grupostrabajobuscar';
    }
    
    public function rules()
    {
        return [
            [['pCadena', 'pIncluyeBajas'], 'required'],
            [['pCadena'], 'string', 'max' => 100],
            [['pIncluyeBajas'], 'string', 'max' => 1],
        ];
    }
}