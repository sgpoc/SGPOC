<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LineaPresupuestos extends Model
{
    public $IdPresupuesto;
    public $IdComputoMetrico;
    public $IdInsumo;
    public $IdSubFamilia;
    public $IdFamilia;
    public $IdObra;
    public $IdLocalidad;
    public $IdProveedor;
    public $IdGT;
    public $Precio;
    public $Beneficios;
    public $GastosGenerales;
    public $CargasSociales;
    public $IVA;
           
    public static function tableName()
    {
        return 'lineapresupuesto';
    }

    public function rules()
    {
        return [
            [['IdProveedor', 'IdLocalidad'], 'required', 'on' => 'eleccion-precio'],
            [['Beneficios','GastosGenerales', 'CargasSociales', 'IVA'], 'required', 'on' => 'modificar-porcentajes'],
            //[['Beneficios','GastosGenerales', 'CargasSociales', 'IVA'], 'compare', 'compareValue' => 0, 'operator' => '!=', 'on' => 'modificar-porcentajes'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdPresupuesto' => 'Presupuesto',
            'IdComputoMetrico' => 'Cómputo Metrico',
            'IdInsumo' => 'Insumo',
            'IdSubFamilia' => 'SubFamilia',
            'IdFamilia' => 'Familia',
            'IdObra' => 'Obra',
            'IdLocalidad' => 'Localidad',
            'IdProveedor' => 'Proveedor',
            'IdGT' => 'Grupo de Trabajo',
            'GastosGenerales' => 'Gastos Generales',
            'CargasSociales' => 'Cargas Sociales',
        ];
    }
}
