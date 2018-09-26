<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PresupuestosBuscar extends Model
{
    public $Obra;
    public $FechaDePresupuesto;
    
    public static function tableName()
    {
        return 'presupuestosbuscar';
    }

    public function rules()
    {
        return [
            [['Obra'], 'string', 'max' => 100],
            [['FechaDePresupuesto'], 'date', 'format' => 'php:Y-m-d'],
            ['Obra', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['FechaDePresupuesto', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            [['Obra', 'FechaDePresupuesto'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Obra' => 'Obra',
            'FechaDePresupuesto' => 'Fecha Presupuesto',
        ];
    }
}