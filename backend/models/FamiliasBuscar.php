<?php

namespace app\models;
use Yii;
use yii\base\Model;

class FamiliasBuscar extends Model
{
    public $Familia;
    
    public static function tableName()
    {
        return 'familiasbuscar';
    }
    
    public function rules()
    {
        return [
            [['Familia'], 'required'],
            [['Familia'], 'string', 'max' => 100],
            [['Familia'],'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            [['Familia'], 'safe']
        ];
    }
    
    public function attributeLabels() {
        return [
           'Familia' => 'Cadena de Búsqueda',
        ];
    }
}