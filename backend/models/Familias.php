<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Familias extends Model
{
    public $IdFamilia;
    public $IdGT;
    public $Familia;
 
    public static function tableName()
    {
        return 'familias';
    }

    public function rules()
    {
        return [
            [['Familia'], 'required'],
            [['IdFamilia'], 'integer'],
            [['IdGT'], 'integer'],
            [['Familia'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdFamilia' => 'Familia',
            'IdGT' => 'Grupo de Trabajo',
            'Familia' => 'Familia',
        ];
    }
}
