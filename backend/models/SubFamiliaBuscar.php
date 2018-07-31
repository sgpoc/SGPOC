<?php

namespace app\models;
use Yii;
use yii\base\Model;

class SubFamiliaBuscar extends Model
{
    public $pCadena;

       public static function tableName()
    {
        return 'subfamiliabuscar';
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

