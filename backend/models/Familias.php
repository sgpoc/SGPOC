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
            [['IdFamilia','IdGT', 'Familia'], 'required'],
            [['IdFamilia'], 'integer'],
            [['IdGT'], 'integer'],
            [['Familia'], 'string', 'max' => 100],
            [['Familia', 'IdGT'], 'unique', 'targetAttribute' => ['Familia', 'IdGT']],
            [['IdGT'], 'exist', 'skipOnError' => true, 'targetClass' => Grupostrabajo::className(), 'targetAttribute' => ['IdGT' => 'IdGT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdFamilia' => 'Id Familia',
            'IdGT' => 'Id Gt',
            'Familia' => 'Familia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGT()
    {
        return $this->hasOne(Grupostrabajo::className(), ['IdGT' => 'IdGT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubfamilias()
    {
        return $this->hasMany(Subfamilias::className(), ['IdFamilia' => 'IdFamilia', 'IdGT' => 'IdGT']);
    }
}
