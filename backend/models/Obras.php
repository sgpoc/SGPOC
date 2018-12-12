<?php

namespace app\models;

use yii\base\Model;
use Yii;

class Obras extends Model
{
    
    public $IdObra;
    public $IdGT;
    public $IdLocalidad;
    public $Obra;
    public $Direccion;
    public $Propietario;
    public $Telefono;
    public $Email;
    public $Comentarios;
    public $SuperficieTerreno;
    public $SuperficieCubiertaTotal;
    public $Estado;
    
    public static function tableName()
    {
        return 'obras';
    }
    
    public function rules()
    {
        return [
            [['IdLocalidad', 'Obra', 'Direccion', 'Propietario', 'Telefono', 'SuperficieTerreno', 'SuperficieCubiertaTotal'], 'required'],
            [['IdGT', 'IdLocalidad'], 'integer'],
            [['Comentarios'], 'string'],
            [['Obra', 'Direccion', 'Propietario', 'Telefono', 'Email'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdObra' => 'Obra',
            'IdGT' => 'Grupo de Trabajo',
            'IdLocalidad' => 'Localidad',
            'Obra' => 'Obra',
            'Direccion' => 'Direccion',
            'Propietario' => 'Propietario',
            'Telefono' => 'Telefono',
            'Email' => 'Email',
            'Comentarios' => 'Comentarios',
            'SuperficieTerreno' => 'Superficie Terreno',
            'SuperficieCubiertaTotal' => 'Superficie Cubierta Total',
            'Estado' => 'Estado',
        ];
    }

}
