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
            [['IdRubroItem', 'IdGT', 'IdUnidad', 'Item'], 'required'],
            [['IdRubroItem', 'IdGT', 'IdUnidad'], 'integer'],
            [['Item'], 'string', 'max' => 100],
            [['Item'], 'unique'],
            [['IdGT'], 'exist', 'skipOnError' => true, 'targetClass' => Grupostrabajo::className(), 'targetAttribute' => ['IdGT' => 'IdGT']],
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
