<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ComposicionItem extends Model
{
    public $IdItem;
    public $IdInsumo;
    public $IdSubFamilia;
    public $IdFamilia;
    public $IdRubroItem;
    public $IdGT;
    public $Incidencia;
    
    public static function tableName()
    {
        return 'composicionitem';
    }

    public function rules()
    {
        return [
            [['IdItem', 'IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdRubroItem', 'IdGT','Incidencia'], 'required'],
            [['IdItem', 'IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdRubroItem', 'IdGT'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdItem' => 'Item',
            'IdInsumo' => 'Insumo',
            'IdSubFamilia' => 'SubFamilia',
            'IdFamilia' => 'Familia',
            'IdRubroItem' => 'Rubro Item',
            'IdGT' => 'Grupo de Trabajo',
            'Incidencia' => 'Incidencia',
        ];
    }

}
