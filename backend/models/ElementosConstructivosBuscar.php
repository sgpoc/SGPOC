<?php

namespace app\models;
use Yii;
use yii\base\Model;

class ElementosConstructivosBuscar extends Model
{
    public $ElementoConstructivo;
    public $RubroEC;
    public $Abreviatura;
    
    
    public static function tableName()
    {
        return 'elementoconstructivobuscar';
    }
    
    public function rules()
    {
        return [
            [['ElementoConstructivo','RubroEC', 'Unidad'], 'safe'],
            [['ElementoConstructivo','RubroEC'], 'string', 'max' => 100],
            [['Abreviatura'], 'string', 'max' => 10],
            ['ElementoConstructivo', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['RubroEC', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Abreviatura', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
        ];
    }
   
}