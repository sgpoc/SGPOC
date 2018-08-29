<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ItemsBuscar extends Model
{
    public $Item;
    public $RubroItem;
    public $Abreviatura;
    
    public static function tableName()
    {
        return 'items';
    }

    public function rules()
    {
        return [
            [['Item','RubroItem', 'Unidad'], 'safe'],
            [['Item','RubroItem'], 'string', 'max' => 100],
            [['Abreviatura'], 'string', 'max' => 10],
            ['Item', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['RubroItem', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Abreviatura', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
        ];
    }
}
