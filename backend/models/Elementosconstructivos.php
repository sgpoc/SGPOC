<?php

namespace app\models;

use Yii;


class Elementosconstructivos extends \yii\db\ActiveRecord
{
    public $IdElementoConstructivo;
    public $IdRubroEC;
    public $idGT;
    public $IdUnidad;
    public $ElementoConstructivo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'elementosconstructivos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdRubroEC','IdUnidad', 'ElementoConstructivo'], 'required', 'on'=>'alta-elemento'],
            [['ElementoConstructivo'], 'required'],
            [['IdRubroEC', 'IdGT', 'IdUnidad'], 'integer'],
            [['ElementoConstructivo'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdElementoConstructivo' => 'IdElementoConstructivo',
            'IdRubroEC' => 'Rubro Elemento Constructivo',
            'IdGT' => 'Id Gt',
            'IdUnidad' => 'Id Unidad',
            'ElementoConstructivo' => 'Elemento Constructivo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComposicionecs()
    {
        return $this->hasMany(Composicionec::className(), ['IdElementoConstructivo' => 'IdElementoConstructivo', 'IdRubroEC' => 'IdRubroEC', 'IdGT' => 'IdGT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['IdItem' => 'IdItem', 'IdRubroItem' => 'IdRubroItem'])->viaTable('composicionec', ['IdElementoConstructivo' => 'IdElementoConstructivo', 'IdRubroEC' => 'IdRubroEC', 'IdGT' => 'IdGT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubroEC()
    {
        return $this->hasOne(Rubrosec::className(), ['IdRubroEC' => 'IdRubroEC']);
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
    public function getUnidad()
    {
        return $this->hasOne(Unidades::className(), ['IdUnidad' => 'IdUnidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineacomputometricos()
    {
        return $this->hasMany(Lineacomputometrico::className(), ['IdElementoConstructivo' => 'IdElementoConstructivo', 'IdRubroEC' => 'IdRubroEC']);
    }
}
