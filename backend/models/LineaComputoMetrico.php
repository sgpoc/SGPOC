<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LineaComputoMetrico extends Model
{
    public $IdComputoMetrico;
    public $NroLinea;
    public $IdObra;
    public $IdGT;
    public $IdElementoConstructivo;
    public $IdRubroEC;
    public $IdItem;
    public $IdRubroItem;
    public $IdUnidad;
    public $Descripcion;
    public $Cantidad;
    public $Largo;
    public $Ancho;
    public $Alto;
    public $Parcial;
           
    public static function tableName()
    {
        return 'lineacomputometrico';
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
            'Parcial' => 'Parcial',
        ];
    }
}
