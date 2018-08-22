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
            [['IdFamilia', 'IdGT', 'SubFamilia'], 'required'],
            [['IdFamilia', 'IdGT'], 'integer'],
            [['SubFamilia'], 'string', 'max' => 100],
            [['SubFamilia', 'IdFamilia'], 'unique', 'targetAttribute' => ['SubFamilia', 'IdFamilia']],
            [['IdFamilia', 'IdGT'], 'exist', 'skipOnError' => true, 'targetClass' => Familias::className(), 'targetAttribute' => ['IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdSubFamilia' => 'Id Sub Familia',
            'IdFamilia' => 'Id Familia',
            'IdGT' => 'Id Gt',
            'SubFamilia' => 'Sub Familia',
        ];
    }

}
