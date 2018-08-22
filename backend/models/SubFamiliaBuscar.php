<?php

namespace app\models;
use Yii;
use yii\base\Model;

class SubFamiliaBuscar extends Model
{
    public $SubFamilia;
    public $Familia;

       public static function tableName()
    {
        return 'subfamiliabuscar';
    }
    
    public function rules()
    {
        return [
            [['SubFamilia', 'Familia'], 'string', 'max' => 100],
            ['SubFamilia', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Familia', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            [['SubFamilia', 'Familia'], 'safe'],
            
        ];
    }
    
    public function attributeLabels() {
        return [
           'SubFamilia' => 'Cadena de Búsqueda',
        ];
    }
}

