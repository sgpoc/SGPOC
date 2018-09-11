<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LineaPresupuestos extends Model
{
    public $IdPresupuesto;
    public $IdComputoMetrico;
    public $IdItem;
    public $IdInsumo;
    public $IdSubFamilia;
    public $IdFamilia;
    public $IdObra;
    public $IdLocalidad;
    public $IdProveedor;
    public $IdGT;
    public $IdRubroItem;
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
            [['IdUnidad','Descripcion', 'Cantidad', 'Largo', 'Ancho'], 'required', 'on' => 'agregar-linea'],
            [['Descripcion', 'Cantidad', 'Largo', 'Ancho'], 'required'],
            [['Descripcion'], 'string', 'max' => 200],
            [['Alto'],'default', 'value' => 1, 'skipOnEmpty' => FALSE],
            [['IdElementoConstructivo', 'IdItem'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdComputoMetrico' => 'Cómputo Metrico',
            'NroLinea' => 'Número de Línea',
            'IdObra' => 'Obra',
            'IdGT' => 'Grupo de Trabajo',
            'IdElementoConstructivo' => 'Elemento Constructivo',
            'IdRubroEC' => 'Rubro Elemento Constructivo',
            'IdItem' => 'Item',
            'IdRubroItem' => 'Rubro Item',
            'IdUnidad' => 'Unidad',
            'Descripcion' => 'Descripción',
        ];
    }
}
