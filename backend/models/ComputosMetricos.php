<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ComputosMetricos extends Model
{
    public $IdComputoMetrico;
    public $IdObra;
    public $IdGT;
    public $FechaComputoMetrico;
    public $TipoComputo;
    public $Descripcion;
    public $Parcial;
    
    public static function tableName()
    {
        return 'computosmetricos';
    }

    public function rules()
    {
        return [
            [['IdObra', 'FechaComputoMetrico','TipoComputo','Descripcion'], 'required', 'on' => 'alta-computo'],
            [['FechaComputoMetrico','TipoComputo'], 'required'],
            [['FechaComputoMetrico'], 'date', 'format' => 'php:Y-m-d'],
            [['TipoComputo'], 'string', 'max' => 1],
            [['Descripcion'], 'string', 'max' => 100],
            
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdComputoMetrico' => 'Computo Metrico',
            'IdObra' => 'Obra',
            'IdGT' => 'Grupo de Trabajo',
            'FechaComputoMetrico' => 'Fecha Computo Metrico',
            'TipoComputo' => 'Tipo de Cómputo',
            'Parcial' => 'Parcial',
        ];
    }
}
