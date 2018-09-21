<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Presupuestos extends Model
{
    public $IdPresupuesto;
    public $IdComputoMetrico;
    public $IdObra;
    public $IdGT;
    public $FechaDePresupuesto;
    public $PrecioTotal; 
    
    public static function tableName()
    {
        return 'presupuestos';
    }

    public function rules()
    {
        return [
            [['IdObra', 'FechaDePresupuesto'], 'required', 'on' => 'alta-presupuesto'],
            [['FechaDePresupuesto'], 'required'],
            [['FechaDePresupuesto'], 'date', 'format' => 'php:Y-m-d'],
            ['IdComputoMetrico', 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdPresupuesto' => 'Presupuesto',
            'IdComputoMetrico' => 'Computo Metrico',
            'IdObra' => 'Obra',
            'FechaDePresupuesto' => 'Fecha Presupuesto',
        ];
    }
}
