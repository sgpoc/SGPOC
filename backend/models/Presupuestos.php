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
            [['IdComputoMetrico', 'IdObra', 'FechaDePresupuesto'], 'required', 'on' => 'alta-presupuesto'],
            [['FechaDePresupuesto'], 'required'],
            [['FechaDePresupuesto'], 'date', 'format' => 'php:Y-m-d'],
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
