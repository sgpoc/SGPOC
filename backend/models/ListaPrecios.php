<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Listaprecios extends Model
{
    public $IdLocalidad;
    public $IdInsumo;
    public $IdSubFamilia;
    public $IdFamilia;
    public $IdProveedor;
    public $IdGT;
    public $PrecioLista;
    public $FechaUltimaActualizacion;
 
    public static function tableName()
    {
        return 'listaprecios';
    }

    public function rules()
    {
        return [
            [['IdLocalidad', 'IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdProveedor', 'IdGT', 'FechaUltimaActualizacion'], 'required'],
            [['IdLocalidad', 'IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdProveedor', 'IdGT'], 'integer'],
            [['IdLocalidad', 'IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdProveedor', 'IdGT'], 'unique', 'targetAttribute' => ['IdLocalidad', 'IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdProveedor', 'IdGT']],
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
