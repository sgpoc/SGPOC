<?php

namespace app\models;

use yii\base\Model;
use Yii;


class Insumos extends Model
{
    public $IdInsumo;
    public $IdSubFamilia;
    //public $IdFamilia;
    //public $IdGT;
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
            [['IdSubFamilia', 'IdUnidad', 'TipoInsumo', 'Insumo'], 'required'],
            [['IdSubFamilia',/* 'IdFamilia', 'IdGT',*/ 'IdUnidad'], 'integer'],
            [['TipoInsumo'], 'string', 'max' => 100],
            [['Insumo'], 'string', 'max' => 100],
            [['Insumo'], 'unique'],
            [['IdSubFamilia'/*, 'IdFamilia', 'IdGT'*/], 'exist', 'skipOnError' => true, 'targetClass' => Subfamilias::className(), 'targetAttribute' => ['IdSubFamilia' => 'IdSubFamilia'/*, 'IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT'*/]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdInsumo' => 'Insumo',
            'IdSubFamilia' => 'SubFamilia',
      //      'IdFamilia' => 'Familia',
        //    'IdGT' => 'Grupo de Trabajo',
            'IdUnidad' => 'Unidad',
            'TipoInsumo' => 'Tipo de Insumo',
            'Insumo' => 'Insumo',
        ];
    }

}
