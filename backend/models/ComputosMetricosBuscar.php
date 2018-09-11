<?php

namespace app\models;
use Yii;
use yii\base\Model;

class ComputosMetricosBuscar extends Model
{
    public $Obra;
    public $FechaComputoMetrico;
    
    public static function tableName()
    {
        return 'computosmetricosbuscar';
    }
    
    public function rules()
    {
        return [
            [['Obra'], 'string', 'max' => 100],
            [['FechaComputoMetrico'], 'date', 'format' => 'php:Y-m-d'],
            ['Obra', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['FechaComputoMetrico', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            [['Obra', 'FechaComputoMetrico'], 'safe'],
        ];
    }
    
}