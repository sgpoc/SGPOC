<?php

namespace app\models;
use Yii;
use yii\base\Model;

class UsuariosBuscar extends Model
{
    public $pCadena;
    public $pIncluyeBajas;
    
    public static function tableName()
    {
        return 'usuariosbuscar';
    }
    
    public function rules()
    {
        return [
            [['pCadena', 'pIncluyeBajas'], 'required'],
            [['pCadena'], 'string', 'max' => 100],
            [['pIncluyeBajas'], 'string', 'max' => 1],
        ];
    }
    
    public function attributeLabels() {
        return [
           'pCadena' => 'Cadena de Búsqueda',
           'pIncluyeBajas' => 'Inclusión de Bajas',
        ];
    }
}