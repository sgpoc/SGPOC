<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Subfamilias extends Model
{
    public $IdSubFamilia;
    public $IdFamilia;
    public $IdGT;
    public $SubFamilia;


    public static function tableName()
    {
        return 'subfamilias';
    }

    public function rules()
    {
        return [
            [['IdFamilia', 'SubFamilia'], 'required', 'on' => 'alta-subfamilia'],
            [['SubFamilia'], 'required'],
            [['IdFamilia', 'IdGT'], 'integer'],
            [['SubFamilia'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdSubFamilia' => 'Sub Familia',
            'IdFamilia' => 'Familia',
            'IdGT' => 'Grupo de Trabajo',
            'SubFamilia' => 'Sub Familia',
        ];
    }

}
