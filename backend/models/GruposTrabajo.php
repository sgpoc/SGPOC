<?php

namespace app\models;
use yii\base\Model;

class GruposTrabajo extends Model
{
    public $IdGT;
    public $GrupoTrabajo;
    public $Mail;
    public $Estado;
    
    public static function tableName()
    {
        return 'grupostrabajo';
    }

    
    public function rules()
    {
        return [
            [['IdGT', 'GrupoTrabajo', 'Mail', 'Estado'], 'required'],
            [['IdGT'], 'integer'],
            [['GrupoTrabajo', 'Mail', 'Estado'], 'string', 'max' => 100],
            [['IdGT'], 'unique'],
            [['GrupoTrabajo'], 'unique'],
            [['Mail'], 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdGT' => 'Grupo Trabajo',
            'GrupoTrabajo' => 'Grupo Trabajo',
            'Mail' => 'Mail',
            'Estado' => 'Estado',
        ];
    }

}
