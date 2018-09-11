<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Insumos extends Model
{
    public $IdInsumo;
    public $IdSubFamilia;
    public $IdFamilia;
    public $IdGT;
    public $IdUnidad;
    public $TipoInsumo;
    public $Insumo;
    
    public static function tableName()
    {
        return 'insumos';
    }
    
    public function rules()
    {
        return [
            [['IdSubFamilia', 'IdUnidad', 'TipoInsumo', 'Insumo'], 'required', 'on' => 'alta-insumo'],
            [['TipoInsumo', 'Insumo'], 'required'],
            [['IdSubFamilia','IdFamilia', 'IdGT', 'IdUnidad'], 'integer'],
            [['TipoInsumo'], 'string', 'max' => 100],
            [['Insumo'], 'string', 'max' => 100]
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdInsumo' => 'Insumo',
            'IdSubFamilia' => 'SubFamilia',
            'IdFamilia' => 'Familia',
            'IdGT' => 'Grupo de Trabajo',
            'IdUnidad' => 'Unidad',
            'TipoInsumo' => 'Tipo de Insumo',
            'Insumo' => 'Insumo',
        ];
    }

}
