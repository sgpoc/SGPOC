<?php

namespace app\models;
use yii\base\Model;

class GruposTrabajo extends Model
{
    public $IdGT;
    public $GrupoTrabajo;
    public $Mail;
    public $Estado;
    public $fechaCreacion;
    
    public static function tableName()
    {
        return 'grupostrabajo';
    }
    
    public function rules()
    {
        return [
            [['GrupoTrabajo', 'Mail','fechaCreacion'], 'required'],
            [['IdGT'], 'integer'],
            [['GrupoTrabajo', 'Mail'], 'string', 'max' => 100],
            [['Estado'], 'string', 'max' => 1],
            [['fechaCreacion'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdGT' => 'Grupo Trabajo',
            'GrupoTrabajo' => 'Grupo Trabajo',
            'Mail' => 'Mail',
            'Estado' => 'Estado',
            'fechaCreacion' => 'Fecha de Creacion',
        ];
    }

}
