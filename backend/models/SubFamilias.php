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

    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subfamilias';
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdSubFamilia' => 'Id Sub Familia',
            'IdFamilia' => 'Id Familia',
            'IdGT' => 'Id Gt',
            'SubFamilia' => 'Sub Familia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumos()
    {
        return $this->hasMany(Insumos::className(), ['IdSubFamilia' => 'IdSubFamilia', 'IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamilia()
    {
        return $this->hasOne(Familias::className(), ['IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT']);
    }
}
