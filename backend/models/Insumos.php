<?php

namespace app\models;

use Yii;


class Insumos extends \yii\db\ActiveRecord
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
            [['IdSubFamilia', 'IdUnidad', 'TipoInsumo', 'Insumo'], 'required'],
            [['IdSubFamilia', 'IdFamilia', 'IdGT', 'IdUnidad'], 'integer'],
            [['TipoInsumo'], 'string', 'max' => 100],
            [['Insumo'], 'string', 'max' => 100],
            [['Insumo'], 'unique'],
            [['IdSubFamilia', 'IdFamilia', 'IdGT'], 'exist', 'skipOnError' => true, 'targetClass' => Subfamilias::className(), 'targetAttribute' => ['IdSubFamilia' => 'IdSubFamilia', 'IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT']],
            [['IdUnidad'], 'exist', 'skipOnError' => true, 'targetClass' => Unidades::className(), 'targetAttribute' => ['IdUnidad' => 'IdUnidad']],
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


    public function getComposicionitems()
    {
        return $this->hasMany(Composicionitem::className(), ['IdInsumo' => 'IdInsumo', 'IdSubFamilia' => 'IdSubFamilia', 'IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT']);
    }

    public function getItems()
    {
        return $this->hasMany(Items::className(), ['IdItem' => 'IdItem', 'IdRubroItem' => 'IdRubroItem'])->viaTable('composicionitem', ['IdInsumo' => 'IdInsumo', 'IdSubFamilia' => 'IdSubFamilia', 'IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT']);
    }

    public function getSubFamilia()
    {
        return $this->hasOne(Subfamilias::className(), ['IdSubFamilia' => 'IdSubFamilia', 'IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT']);
    }


    public function getUnidad()
    {
        return $this->hasOne(Unidades::className(), ['IdUnidad' => 'IdUnidad']);
    }

    public function getListadeprecios()
    {
        return $this->hasMany(Listadeprecios::className(), ['IdInsumo' => 'IdInsumo', 'IdSubFamilia' => 'IdSubFamilia', 'IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT']);
    }
}
