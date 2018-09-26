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
            [['Incidencia'], 'number'],
            [['Incidencia','IdInsumo'], 'required','on' => 'agregar-insumo-item'],
            [['Incidencia'], 'required','on' => 'modificar-incidencia'],
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
