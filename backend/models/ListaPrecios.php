<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ListaPrecios extends Model
{
    public $IdProveedor;
    public $IdLocalidad;
    public $IdInsumo;
    public $IdSubFamilia;
    public $IdFamilia;
    public $PrecioLista;
    public $FechaUltimaActualizacion;
    public $IdGT;
    
    public static function tableName()
    {
        return 'listaprecios';
    }

    public function rules()
    {
        return [
            [['IdLocalidad', 'IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdProveedor', 'IdGT', 'PrecioLista', 'FechaUltimaActualizacion'], 'required'],
            [['IdLocalidad', 'IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdProveedor', 'IdGT'], 'integer'],
            [['IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdProveedor', 'IdGT'], 'unique', 'targetAttribute' => ['IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdProveedor', 'IdGT']],
            [['IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdGT'], 'exist', 'skipOnError' => true, 'targetClass' => Insumos::className(), 'targetAttribute' => ['IdInsumo' => 'IdInsumo', 'IdSubFamilia' => 'IdSubFamilia', 'IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT']],
            [['IdProveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedores::className(), 'targetAttribute' => ['IdProveedor' => 'IdProveedor']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdLocalidad' => 'Localidad',
            'IdInsumo' => 'Insumo',
            'IdSubFamilia' => 'SubFamilia',
            'IdFamilia' => 'Familia',
            'IdProveedor' => 'Proveedor',
            'IdGT' => 'Grupo deTrabajo',
            'PrecioLista' => 'Precio Lista',
            'FechaUltimaActualizacion' => 'Fecha Ultima Actualizacion',
        ];
    }

}
