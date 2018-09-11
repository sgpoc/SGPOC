<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Composicionec extends Model
{
    public $IdItem;
    public $IdElementoConstructivo;
    public $IdRubroItem;
    public $IdRubroEC;
    public $IdGT;
    public $Incidencia;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'composicionec';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdItem', 'IdElementoConstructivo', 'IdRubroItem', 'IdRubroEC', 'IdGT', 'Incidencia'], 'required'],
            [['IdItem', 'IdElementoConstructivo', 'IdRubroItem', 'IdRubroEC', 'IdGT'], 'integer'],
            [['Incidencia'], 'number'],
          ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdItem' => 'Id Item',
            'IdElementoConstructivo' => 'Id Elemento Constructivo',
            'IdRubroItem' => 'Id Rubro Item',
            'IdRubroEC' => 'Id Rubro Ec',
            'IdGT' => 'Id Gt',
            'Incidencia' => 'Incidencia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['IdItem' => 'IdItem', 'IdRubroItem' => 'IdRubroItem', 'IdGT' => 'IdGT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElementoConstructivo()
    {
        return $this->hasOne(Elementosconstructivos::className(), ['IdElementoConstructivo' => 'IdElementoConstructivo', 'IdRubroEC' => 'IdRubroEC', 'IdGT' => 'IdGT']);
    }
}
