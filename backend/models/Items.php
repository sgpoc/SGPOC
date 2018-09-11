<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Items extends Model
{
    public $IdItem;
    public $IdRubroItem;
    public $IdIdGT;
    public $IdUnidad;
    public $Item;
    
    public static function tableName()
    {
        return 'items';
    }

    public function rules()
    {
        return [
            [['IdRubroItem', 'IdUnidad', 'Item'], 'required', 'on' => 'alta-item'],
            [['Item'], 'required'],
            [['IdRubroItem', 'IdGT', 'IdUnidad'], 'integer'],
            [['Item'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdItem' => 'Item',
            'IdRubroItem' => 'Rubro Item',
            'IdGT' => 'Grupo de Trabajo',
            'IdUnidad' => 'Unidad',
            'Item' => 'Item',
        ];
    }
}
