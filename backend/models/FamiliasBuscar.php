<?php

namespace app\models;
use Yii;
use yii\base\Model;

class FamiliasBuscar extends Model
{
    public $pCadena;
    
    public static function tableName()
    {
        return 'familiasbuscar';
    }
    
    public function rules()
    {
        return [
            [['pCadena'], 'required'],
            [['pCadena'], 'string', 'max' => 100],
        ];
    }
    
    public function attributeLabels() {
        return [
           'pCadena' => 'Cadena de Búsqueda',
        ];
    }
}