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
            [['IdLocalidad', 'IdInsumo', 'IdProveedor', 'PrecioLista', 'FechaUltimaActualizacion'], 'required', 'on' => 'alta-lista'],
            [['IdInsumo', 'PrecioLista', 'FechaUltimaActualizacion'], 'required', 'on' => 'agregar-insumo'],
            [['PrecioLista', 'FechaUltimaActualizacion'], 'required', 'on' => 'modificar-insumo'],
            [['IdLocalidad', 'IdInsumo', 'IdSubFamilia', 'IdFamilia', 'IdProveedor', 'IdGT'], 'integer'],
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
