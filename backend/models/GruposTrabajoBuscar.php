<?php

namespace app\models;

use yii\base\Model;

class GruposTrabajoBuscar extends Model
{

    public $GrupoTrabajo;
    public $Mail;
    public $Estado;
    
    public static function tableName()
    {
        return 'grupostrabajobuscar';
    }
    
    public function rules()
    {
         return [
            [['GrupoTrabajo', 'Mail'], 'string', 'max' => 100],
            ['GrupoTrabajo', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Mail', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            ['Estado', 'default', 'value' => NULL, 'skipOnEmpty' => FALSE],
            [['GrupoTrabajo', 'Mail', 'Estado'], 'safe'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'GrupoTrabajo' => 'Nombre'
        ];
    }
}